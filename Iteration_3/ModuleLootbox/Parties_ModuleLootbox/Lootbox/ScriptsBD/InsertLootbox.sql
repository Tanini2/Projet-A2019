USE `cegepjon_p2019-dev`;
INSERT INTO Lootbox (nomLootbox, categorie, rarete, description) VALUES
	('Lootbox commune d\'objets de carte',1,1,'Cette lootbox contient 1 objet de carte al�atoire de raret� commune'),
    ('Lootbox rare d\'objets de carte',1,2,'Cette lootbox contient 1 objet de carte al�atoire de raret� rare'),
    ('Lootbox �pique d\'objets de carte',1,3,'Cette lootbox contient 1 objet de carte al�atoire de raret� �pique'),
    ('Lootbox l�gendaire d\'objets de carte',1,4,'Cette lootbox contient 1 objet de carte al�atoire de raret� l�gendaire'),
	('Lootbox commune de cadres de carte',2,1,'Cette lootbox contient 1 cadre de carte al�atoire de raret� commune'),
    ('Lootbox rare de cadres de carte',2,2,'Cette lootbox contient 1 cadre de carte al�atoire de raret� rare'),
    ('Lootbox �pique de cadres de carte',2,3,'Cette lootbox contient 1 cadre de carte al�atoire de raret� �pique'),
    ('Lootbox l�gendaire de cadres de carte',2,4,'Cette lootbox contient 1 cadre de carte al�atoire de raret� l�gendaire'),
	('Lootbox commune de caract�ristiques ',3,1,'Cette lootbox contient 1 caract�ristique al�atoire de raret� commune'),
    ('Lootbox rare de caract�ristiques',3,2,'Cette lootbox contient 1 caract�ristique al�atoire de raret� rare'),
    ('Lootbox �pique de caract�ristiques',3,3,'Cette lootbox contient 1 caract�ristique al�atoire de raret� �pique'),
    ('Lootbox l�gendaire de caract�ristiques',3,4,'Cette lootbox contient 1 caract�ristique al�atoire de raret� l�gendaire');

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
	

