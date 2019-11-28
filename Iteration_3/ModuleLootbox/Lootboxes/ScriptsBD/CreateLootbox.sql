USE `cegepjon_p2019-dev`;

DROP TABLE IF EXISTS Lootbox;
CREATE TABLE Lootbox (
    noLootbox				INT 			NOT NULL    AUTO_INCREMENT,
    nomLootbox				VARCHAR(50) 	NOT NULL,
    description				VARCHAR(100),
    PRIMARY KEY(noLootbox)
) ENGINE=INNODB;

DROP TABLE IF EXISTS RareteCategorieLootbox;
CREATE TABLE RareteCategorieLootbox (
    noRarete				INT				NOT NULL,
    noCategorie				INT				NOT NULL,
    prix    				INT 			NOT NULL,
    pourcentageCommun		INT 			NOT NULL,
    pourcentageRare			INT  			NOT NULL,
    pourcentageEpique		INT 			NOT NULL,
    pourcentageLegendaire   INT 			NOT NULL,
    PRIMARY KEY (noRarete, noCategorie),
    FOREIGN KEY(noRarete) REFERENCES Rarete(noRarete)
		ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(noCategorie) REFERENCES Categorie(noCategorie)
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;