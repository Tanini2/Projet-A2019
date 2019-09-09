USE cegepjon_1337589
GO

CREATE TABLE IF NOT EXISTS tbljoueur (
	noJoueur		int			NOT NULL	AUTO_INCREMENT,
	nomJoueur		varchar(50)	NOT NULL,
	PRIMARY KEY(noJoueur)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblcategorie (
	noCategorie		int			NOT NULL	AUTO_INCREMENT,
	nomCategorie	varchar(50)	NOT NULL,
	PRIMARY KEY(noCategorie)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tblcategoriejoueur (
	noJoueur		int			NOT NULL,
	noCategorie		int			NOT NULL,
	score			int			NOT NULL,
	PRIMARY KEY(noJoueur, noCategorie),
	FOREIGN KEY (noJoueur) REFERENCES tbljoueur(noJoueur),
	FOREIGN KEY (noCategorie) REFERENCES tblcategorie(noCategorie)
) ENGINE=INNODB;