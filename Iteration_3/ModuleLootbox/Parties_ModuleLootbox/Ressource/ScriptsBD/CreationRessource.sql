USE `cegepjon_p2019-dev`;

DROP TABLE IF EXISTS Categorie;
CREATE TABLE Categorie (
	noCategorie		int				NOT NULL	AUTO_INCREMENT,
	nomCategorie	varchar(50)		NOT NULL,
	PRIMARY KEY(noCategorie)
) ENGINE=INNODB;

DROP TABLE IF EXISTS Rarete;
CREATE TABLE Rarete (
	noRarete		int				NOT NULL	AUTO_INCREMENT,
	nomRarete		varchar(50)		NOT NULL,
	PRIMARY KEY(noRarete)
) ENGINE=INNODB;

DROP TABLE IF EXISTS Ressource;
CREATE TABLE Ressource (
	noRessource		int				NOT NULL	AUTO_INCREMENT,
	nomRessource	varchar(50)		NOT NULL,
	categorie		int				NOT NULL,
	rarete			int				NOT NULL,
	description		tinytext		NOT NULL,
	lienImage		varchar(100)	NOT NULL,
	ressourceUnique	boolean			DEFAULT false,
	statut			char(3)			NOT NULL,
	PRIMARY KEY(noRessource),
	FOREIGN KEY(categorie) REFERENCES Categorie(noCategorie) 
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(rarete) REFERENCES Rarete(noRarete) 
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

DROP TABLE IF EXISTS RareteCategorieRessource;
CREATE TABLE RareteCategorieRessource (
	noRarete		int				NOT NULL,
	noCategorie		int				NOT NULL,
	prix			int				NOT NULL,
	PRIMARY KEY(noRarete, noCategorie),
	FOREIGN KEY(noCategorie) REFERENCES Categorie(noCategorie) 
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(noRarete) REFERENCES Rarete(noRarete) 
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;


