USE `cegepjon_p2019-dev`;

DROP TABLE IF EXISTS TransactionLootboxRessource;
DROP TABLE IF EXISTS RessourceEtudiant;
DROP TABLE IF EXISTS RareteCategorieLootbox;
DROP TABLE IF EXISTS RareteCategorieRessource;
DROP TABLE IF EXISTS Ressource;
DROP TABLE IF EXISTS TransactionLootbox;
DROP TABLE IF EXISTS TransactionTest;
DROP TABLE IF EXISTS Lootbox;
DROP TABLE IF EXISTS EtudiantTest;
DROP TABLE IF EXISTS Rarete;
DROP TABLE IF EXISTS Categorie;

CREATE TABLE Categorie (
	noCategorie				int				NOT NULL	AUTO_INCREMENT,
	nomCategorie			varchar(50)		NOT NULL,
	PRIMARY KEY(noCategorie)
) ENGINE=INNODB;

INSERT INTO Categorie(nomCategorie) VALUES 
('Objets de carte'), ('Cadres de carte'), ('Caractéristiques'), ('Évolution');

CREATE TABLE Rarete (
	noRarete				int				NOT NULL	AUTO_INCREMENT,
	nomRarete				varchar(50)		NOT NULL,
	PRIMARY KEY(noRarete)
) ENGINE=INNODB;

INSERT INTO Rarete(nomRarete) VALUES 
('Commun'), ('Rare'), ('Épique'), ('Légendaire');

CREATE TABLE EtudiantTest (
	noEtudiant				varchar(12)		NOT NULL,
	nomEtudiant				varchar(50)		NOT NULL,
	prenomEtudiant			varchar(50)		NOT NULL,
	PRIMARY KEY(noEtudiant)
) ENGINE=INNODB;

INSERT INTO EtudiantTest(noEtudiant, nomEtudiant, prenomEtudiant) VALUES 
('VANTA1337589', 'Vanier', 'Tanya'),
('BRICL1734534', 'Bricout', 'Clément'),
('DUFNI1456777', 'Dufour', 'Nicolas'),
('LESCE1654777', 'Lespérance', 'Cédric'),
('TREBO1337788', 'Tremblay', 'Bob');

CREATE TABLE Lootbox (
    noLootbox				int 			NOT NULL    AUTO_INCREMENT,
    nomLootbox				varchar(50) 	NOT NULL,
	categorie				int				NOT NULL,
	rarete					int				NOT NULL,
    description				varchar(100),
    PRIMARY KEY(noLootbox),
	FOREIGN KEY(categorie) REFERENCES Categorie(noCategorie),
	FOREIGN KEY(rarete) REFERENCES Rarete(noRarete)
) ENGINE=INNODB;

INSERT INTO Lootbox (nomLootbox, categorie, rarete, description) VALUES
	('Lootbox commune d\'objets de carte',1,1,'Cette lootbox contient 1 objet de carte aléatoire de rareté commune'),
    ('Lootbox rare d\'objets de carte',1,2,'Cette lootbox contient 1 objet de carte aléatoire de rareté rare'),
    ('Lootbox épique d\'objets de carte',1,3,'Cette lootbox contient 1 objet de carte aléatoire de rareté épique'),
    ('Lootbox légendaire d\'objets de carte',1,4,'Cette lootbox contient 1 objet de carte aléatoire de rareté légendaire'),
	('Lootbox commune de cadres de carte',2,1,'Cette lootbox contient 1 cadre de carte aléatoire de rareté commune'),
    ('Lootbox rare de cadres de carte',2,2,'Cette lootbox contient 1 cadre de carte aléatoire de rareté rare'),
    ('Lootbox épique de cadres de carte',2,3,'Cette lootbox contient 1 cadre de carte aléatoire de rareté épique'),
    ('Lootbox légendaire de cadres de carte',2,4,'Cette lootbox contient 1 cadre de carte aléatoire de rareté légendaire'),
	('Lootbox commune de caractéristiques ',3,1,'Cette lootbox contient 1 caractéristique aléatoire de rareté commune'),
    ('Lootbox rare de caractéristiques',3,2,'Cette lootbox contient 1 caractéristique aléatoire de rareté rare'),
    ('Lootbox épique de caractéristiques',3,3,'Cette lootbox contient 1 caractéristique aléatoire de rareté épique'),
    ('Lootbox légendaire de caractéristiques',3,4,'Cette lootbox contient 1 caractéristique aléatoire de rareté légendaire');

CREATE TABLE TransactionTest (
	noTransactionTest		varchar(15)		NOT NULL,
	source					varchar(15)		NOT NULL,
	destination				varchar(12)		NOT NULL,
	nbFortune				int				NOT NULL,
	description				tinytext		NOT NULL,
	PRIMARY KEY(noTransactionTest),
	FOREIGN KEY(destination) REFERENCES EtudiantTest(noEtudiant)
) ENGINE=INNODB;

INSERT INTO TransactionTest(noTransactionTest, source, destination, nbFortune, description) VALUES
('TRT1', 'IdBanque', 'VANTA1337589', 200, 'Création de l\'étudiant'),
('TRT2', 'IdBanque', 'BRICL1734534', 200, 'Création de l\'étudiant'),
('TRT3', 'IdBanque', 'DUFNI1456777', 200, 'Création de l\'étudiant'),
('TRT4', 'IdBanque', 'LESCE1654777', 200, 'Création de l\'étudiant'),
('TRT5', 'IdBanque', 'TREBO1337788', 30, 'Création de l\'étudiant');

CREATE TABLE TransactionLootbox (
	noTransactionLootbox	varchar(15)		NOT NULL,
	source					varchar(12)		NOT NULL,
	destination				varchar(15)		NOT NULL,
	nbFortune				int				NOT NULL,
	prix					int				NOT NULL,
	description				tinytext		NOT NULL,
	PRIMARY KEY(noTransactionLootbox),
	FOREIGN KEY(source) REFERENCES EtudiantTest(noEtudiant)
) ENGINE=INNODB;

CREATE TABLE Ressource (
	noRessource				int				NOT NULL	AUTO_INCREMENT,
	nomRessource			varchar(50)		NOT NULL,
	categorie				int				NOT NULL,
	rarete					int				NOT NULL,
	description				tinytext		NOT NULL,
	lienImage				varchar(100)	NOT NULL,
	ressourceUnique			boolean			DEFAULT false,
	statut					char(3)			NOT NULL,
	PRIMARY KEY(noRessource),
	FOREIGN KEY(categorie) REFERENCES Categorie(noCategorie),
	FOREIGN KEY(rarete) REFERENCES Rarete(noRarete)
) ENGINE=INNODB;

INSERT INTO Ressource(nomRessource, categorie, rarete, description, lienImage, ressourceUnique, statut) VALUES 
('Rattata', 1, 1, 'Pokémon Normal', '/ObjetsCarte/Rattata', true, 'ACT'),
('Pidgey', 1, 1, 'Pokémon Vol', '/ObjetsCarte/Pidgey', true, 'ACT'),
('Caterpie', 1, 1, 'Pokémon Insecte', '/ObjetsCarte/Caterpie', true, 'ACT'),
('Ekans', 1, 1, 'Pokémon Poison', '/ObjetsCarte/Ekans', true, 'ACT'),
('Bulbasaur', 1, 2, 'Pokémon Plante', '/ObjetsCarte/Bulbasaur', false, 'ACT'),
('Eevee', 1, 2, 'Pokémon Normal', '/ObjetsCarte/Eevee', false, 'ACT'),
('Charmander', 1, 2, 'Pokémon Feu', '/ObjetsCarte/Charmander', false, 'ACT'),
('Squirtle', 1, 2, 'Pokémon Eau', '/ObjetsCarte/Squirtle', false, 'ACT'),
('Clefairy', 1, 3, 'Pokémon Fée', '/ObjetsCarte/Clefairy', false, 'ACT'),
('Togepi', 1, 3, 'Pokémon Fée', '/ObjetsCarte/Togepi', false, 'ACT'),
('Ditto', 1, 3, 'Pokémon Normal', '/ObjetsCarte/Ditto', false, 'ACT'),
('Jynx', 1, 3, 'Pokémon Glace', '/ObjetsCarte/Jynx', false, 'ACT'),
('Mew', 1, 4, 'Pokémon Psy', '/ObjetsCarte/Mew', false, 'ACT'),
('Mewtwo', 1, 4, 'Pokémon Psy', '/ObjetsCarte/Mewtwo', false, 'ACT'),
('Articuno', 1, 4, 'Pokémon Glace', '/ObjetsCarte/Articuno', false, 'ACT'),
('Moltres', 1, 4, 'Pokémon Feu', '/ObjetsCarte/Moltres', false, 'ACT'),
('Zapdos', 1, 4, 'Pokémon Électrik', '/ObjetsCarte/Zapdos', false, 'ACT'),
('Plante', 2, 1, 'Cadre simple aux couleurs du type Plante', '/CadresCarte/CadrePlante', false, 'ACT'),
('Feu', 2, 1, 'Cadre simple aux couleurs du type Feu', '/CadresCarte/CadreFeu', false, 'ACT'),
('Eau', 2, 1, 'Cadre simple aux couleurs du type Eau', '/CadresCarte/CadreEau', false, 'ACT'),
('Insecte', 2, 1, 'Cadre simple aux couleurs du type Insecte', '/CadresCarte/CadreInsecte', false, 'ACT'),
('Électrik', 2, 2, 'Cadre aux couleurs du type Électrik', '/CadresCarte/CadreÉlectrik', false, 'ACT'),
('Glace', 2, 2, 'Cadre aux couleurs du type Glace', '/CadresCarte/CadreGlace', false, 'ACT'),
('Poison', 2, 2, 'Cadre aux couleurs du type Poison', '/CadresCarte/CadrePoison', false, 'ACT'),
('Sol', 2, 2, 'Cadre aux couleurs du type Sol', '/CadresCarte/CadreSol', false, 'ACT'),
('Psy', 2, 3, 'Beau cadre aux couleurs du type Psy', '/CadresCarte/CadrePsy', false, 'ACT'),
('Vol', 2, 3, 'Beau cadre aux couleurs du type Vol', '/CadresCarte/CadreVol', false, 'ACT'),
('Combat', 2, 3, 'Beau cadre aux couleurs du type Combat', '/CadresCarte/CadreCombat', false, 'ACT'),
('Acier', 2, 3, 'Beau cadre aux couleurs du type Acier', '/CadresCarte/CadreAcier', false, 'ACT'),
('Ténèbres', 2, 4, 'Magnifique cadre aux couleurs du type Ténèbres', '/CadresCarte/CadreTenebres', false, 'ACT'),
('Spectre', 2, 4, 'Magnifique cadre aux couleurs du type Spectre', '/CadresCarte/CadreSpectre', false, 'ACT'),
('Dragon', 2, 4, 'Magnifique cadre aux couleurs du type Dragon', '/CadresCarte/CadreDragon', false, 'ACT'),
('Fée', 2, 4, 'Magnifique cadre aux couleurs du type Fée', '/CadresCarte/CadreFee', false, 'ACT'),
('Résistance Feu 1', 3, 1, 'Résistance au feu de niveau 1', '/Caracteristiques/ResistanceFeu1', false, 'ACT'),
('Résistance Eau 1', 3, 1, 'Résistance à l\'eau de niveau 1', '/Caracteristiques/ResistanceEau1', false, 'ACT'),
('Résistance Plante 1', 3, 1, 'Résistance aux plantes de niveau 1', '/Caracteristiques/ResistancePlante1', false, 'ACT'),
('Résistance Glace 1', 3, 1, 'Résistance à la glace de niveau 1', '/Caracteristiques/ResistanceGlace1', false, 'ACT'),
('Résistance Feu 2', 3, 2, 'Résistance au feu de niveau 2', '/Caracteristiques/ResistanceFeu2', false, 'ACT'),
('Résistance Eau 2', 3, 2, 'Résistance à l\'eau de niveau 2', '/Caracteristiques/ResistanceEau2', false, 'ACT'),
('Résistance Plante 2', 3, 2, 'Résistance aux plantes de niveau 2', '/Caracteristiques/ResistancePlante2', false, 'ACT'),
('Résistance Glace 2', 3, 2, 'Résistance à la glace de niveau 2', '/Caracteristiques/ResistanceGlace2', false, 'ACT'),
('Résistance Feu 3', 3, 3, 'Résistance au feu de niveau 3', '/Caracteristiques/ResistanceFeu3', false, 'ACT'),
('Résistance Eau 3', 3, 3, 'Résistance à l\'eau de niveau 3', '/Caracteristiques/ResistanceEau3', false, 'ACT'),
('Résistance Plante 3', 3, 3, 'Résistance aux plantes de niveau 3', '/Caracteristiques/ResistancePlante3', false, 'ACT'),
('Résistance Glace 3', 3, 3, 'Résistance à la glace de niveau 3', '/Caracteristiques/ResistanceGlace3', false, 'ACT'),
('Résistance Feu 4', 3, 4, 'Résistance au feu de niveau 4', '/Caracteristiques/ResistanceFeu4', false, 'ACT'),
('Résistance Eau 4', 3, 4, 'Résistance à l\'eau de niveau 4', '/Caracteristiques/ResistanceEau4', false, 'ACT'),
('Résistance Plante 4', 3, 4, 'Résistance aux plantes de niveau 4', '/Caracteristiques/ResistancePlante4', false, 'ACT'),
('Résistance Glace 4', 3, 4, 'Résistance à la glace de niveau 4', '/Caracteristiques/ResistanceGlace4', false, 'ACT'),
('Wartortle Eau', 4, 1, 'Évolution Eau de Squirtle', '/Evolution/WartortleEau', false, 'ACT'),
('Wartortle Feu', 4, 1, 'Évolution Feu de Squirtle', '/Evolution/WartortleFeu', false, 'ACT'),
('Wartortle Glace', 4, 1, 'Évolution Glace de Squirtle', '/Evolution/WartortleGlace', false, 'ACT'),
('Wartortle Plante', 4, 1, 'Évolution Plante de Squirtle', '/Evolution/WartortlePlante', false, 'ACT'),
('Ivysaur Eau', 4, 1, 'Évolution Eau de Bubasaur', '/Evolution/IvysaurEau', false, 'ACT'),
('Ivysaur Feu', 4, 1, 'Évolution Feu de Bulbasaur', '/Evolution/IvysaurFeu', false, 'ACT'),
('Ivysaur Glace', 4, 1, 'Évolution Glace de Bulbasaur', '/Evolution/IvysaurGlace', false, 'ACT'),
('Ivysaur Plante', 4, 1, 'Évolution Plante de Bulbasaur', '/Evolution/IvysaurPlante', false, 'ACT'),
('Charmeleon Eau', 4, 1, 'Évolution Eau de Charmander', '/Evolution/CharmeleonEau', false, 'ACT'),
('Charmeleon Feu', 4, 1, 'Évolution Feu de Charmander', '/Evolution/CharmeleonFeu', false, 'ACT'),
('Charmeleon Glace', 4, 1, 'Évolution Glace de Charmander', '/Evolution/CharmeleonGlace', false, 'ACT'),
('Charmeleon Plante', 4, 1, 'Évolution Plante de Charmander', '/Evolution/CharmeleonPlante', false, 'ACT');

CREATE TABLE RareteCategorieRessource (
	noRarete				int				NOT NULL,
	noCategorie				int				NOT NULL,
	prix					int				NOT NULL,
	PRIMARY KEY(noRarete, noCategorie),
	FOREIGN KEY(noCategorie) REFERENCES Categorie(noCategorie),
	FOREIGN KEY(noRarete) REFERENCES Rarete(noRarete)
) ENGINE=INNODB;

INSERT INTO RareteCategorieRessource(noRarete, noCategorie, prix) VALUES
(1, 1, 40), (1, 2, 25), (1, 3, 40), (1, 4, 100),
(2, 1, 70), (2, 2, 30), (2, 3, 45), (2, 4, 125),
(3, 1, 100), (3, 2, 35), (3, 3, 50), (3, 4, 150),
(4, 1, 130), (4, 2, 40), (4, 3, 55), (4, 4, 175);

CREATE TABLE RareteCategorieLootbox (
    noRarete				int				NOT NULL,
    noCategorie				int				NOT NULL,
    prix    				int 			NOT NULL,
    pourcentageCommun		int 			NOT NULL,
    pourcentageRare			int  			NOT NULL,
    pourcentageEpique		int 			NOT NULL,
    pourcentageLegendaire   int 			NOT NULL,
    PRIMARY KEY (noRarete, noCategorie),
    FOREIGN KEY(noRarete) REFERENCES Rarete(noRarete),
    FOREIGN KEY(noCategorie) REFERENCES Categorie(noCategorie)
) ENGINE=INNODB;

INSERT INTO RareteCategorieLootbox (noRarete, noCategorie, prix, pourcentageCommun, PourcentageRare, PourcentageEpique, PourcentageLegendaire) VALUES
	(1,1,30,70,20,9,1),
	(2,1,60,50,30,15,5),
	(3,1,90,30,30,30,10),
	(4,1,120,20,25,25,30),
	(1,2,15,70,20,9,1),
	(2,2,20,50,30,15,5),
	(3,2,25,30,30,30,10),
	(4,2,30,20,25,25,30),
	(1,3,30,70,20,9,1),
	(2,3,45,50,30,15,5),
	(3,3,60,30,30,30,10),
	(4,3,75,20,25,25,30);

CREATE TABLE RessourceEtudiant (
	noRessource				int				NOT NULL,
	noEtudiant				varchar(12)		NOT NULL,
	PRIMARY KEY(noRessource, noEtudiant),
	FOREIGN KEY(noRessource) REFERENCES Ressource(noRessource),
	FOREIGN KEY(noEtudiant) REFERENCES EtudiantTest(noEtudiant)
) ENGINE=INNODB;

INSERT INTO RessourceEtudiant(noRessource, noEtudiant) VALUES
(1, 'VANTA1337589'),
(20, 'VANTA1337589'),
(40, 'VANTA1337589'),
(12, 'VANTA1337589'),
(5, 'BRICL1734534'),
(25, 'BRICL1734534'),
(45, 'BRICL1734534'),
(10, 'DUFNI1456777'),
(30, 'DUFNI1456777'),
(49, 'DUFNI1456777'),
(3, 'DUFNI1456777'),
(17, 'DUFNI1456777'),
(15, 'LESCE1654777'),
(35, 'LESCE1654777'),
(47, 'LESCE1654777'),
(1, 'TREBO1337788'),
(2, 'TREBO1337788'),
(3, 'TREBO1337788'),
(4, 'TREBO1337788');

CREATE TABLE TransactionLootboxRessource (
	noTransactionLootbox	varchar(15)		NOT NULL,
	noRessource				int				NOT NULL,
	PRIMARY KEY(noRessource, noTransactionLootbox),
	FOREIGN KEY(noRessource) REFERENCES Ressource(noRessource),
	FOREIGN KEY(noTransactionLootbox) REFERENCES TransactionLootbox(noTransactionLootbox)
) ENGINE=INNODB;

