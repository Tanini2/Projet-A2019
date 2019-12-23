USE `cegepjon_p2019-dev`;

DROP TABLE IF EXISTS EtudiantTest;
CREATE TABLE EtudiantTest (
	noEtudiant		varchar(12)		NOT NULL,
	nomEtudiant		varchar(50)		NOT NULL,
	prenomEtudiant	varchar(50)		NOT NULL,
	PRIMARY KEY(noEtudiant)
) ENGINE=INNODB;

DROP TABLE IF EXISTS RessourceEtudiant;
CREATE TABLE RessourceEtudiant (
	noRessource		int				NOT NULL,
	noEtudiant		varchar(12)		NOT NULL,
	PRIMARY KEY(noRessource, noEtudiant),
	FOREIGN KEY(noRessource) REFERENCES Ressource(noRessource) 
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY(noEtudiant) REFERENCES EtudiantTest(noEtudiant)
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=INNODB;