USE `cegepjon_p2019-dev`;

DROP TABLE IF EXISTS TransactionTest;
CREATE TABLE TransactionTest (
	noTransactionTest		varchar(15)		NOT NULL,
	source					varchar(15)		NOT NULL,
	destination				varchar(12)		NOT NULL,
	nbFortune				int				NOT NULL,
	description				tinytext		NOT NULL,
	PRIMARY KEY(noTransactionTest),
	FOREIGN KEY(destination) REFERENCES EtudiantTest(noEtudiant)
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

DROP TABLE IF EXISTS TransactionLootbox;
CREATE TABLE TransactionLootbox (
	noTransactionLootbox	varchar(15)		NOT NULL,
	source					varchar(12)		NOT NULL,
	destination				varchar(15)		NOT NULL,
	nbFortune				int				NOT NULL,
	prix					int				NOT NULL,
	description				tinytext		NOT NULL,
	PRIMARY KEY(noTransactionLootbox),
	FOREIGN KEY(source) REFERENCES EtudiantTest(noEtudiant)
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;

DROP TABLE IF EXISTS TransactionLootboxRessource;
CREATE TABLE TransactionLootboxRessource (
	noTransactionLootbox	varchar(15)		NOT NULL,
	noRessource				int				NOT NULL,
	PRIMARY KEY(noRessource, noTransactionLootbox),
	FOREIGN KEY(noRessource) REFERENCES Ressource(noRessource) 
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(noTransactionLootbox) REFERENCES TransactionLootbox(noTransactionLootbox)
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;