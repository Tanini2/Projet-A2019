USE `cegepjon_p2019-dev`;
INSERT INTO Lootbox (nomLootbox ,description) VALUES
	('Lootbox commune d\'objets de carte','Cette lootbox contient 3 objets de carte al�atoires'),
    ('Lootbox rare d\'objets de carte','Cette lootbox contient 3 objets de cartes al�atoires dont une rare est assur�e'),
    ('Lootbox �pique d\'objets de carte','Cette lootbox contient 3 objets de cartes al�atoires dont une �pique est assur�e'),
    ('Lootbox l�gendaire d\'objets de carte','Cette lootbox contient 3 objets de cartes al�atoires dont une l�gendaire est assur�e'),
	('Lootbox commune de cadres de carte','Cette lootbox contient 3 cadres de cartes al�atoires'),
    ('Lootbox rare de cadres de carte','Cette lootbox contient 3 cadres de cartes al�atoires dont une rare est assur�e'),
    ('Lootbox �pique de cadres de carte','Cette lootbox contient 3 cadres de cartes al�atoires dont une �pique est assur�e'),
    ('Lootbox l�gendaire de cadres de carte','Cette lootbox contient 3 cadres de cartes al�atoires dont une l�gendaire est assur�e'),
	('Lootbox commune de caract�ristiques ','Cette lootbox contient 3 caract�ristiques al�atoires'),
    ('Lootbox rare de caract�ristiques','Cette lootbox contient 3 caract�ristiques al�atoires dont une rare est assur�e'),
    ('Lootbox �pique de caract�ristiques','Cette lootbox contient 3 caract�ristiques al�atoires dont une �pique est assur�e'),
    ('Lootbox l�gendaire de caract�ristiques','Cette lootbox contient 3 caract�ristiques al�atoires dont une l�gendaire est assur�e'),
	('Lootbox commune d\'al�atoires ','Cette lootbox contient 3 objets al�atoires'),
    ('Lootbox rare d\'al�atoires','Cette lootbox contient 3 objets al�atoires dont une rare est assur�e'),
    ('Lootbox �pique d\'al�atoires','Cette lootbox contient 3 objets al�atoires dont une �pique est assur�e'),
    ('Lootbox l�gendaire d\'al�atoires','Cette lootbox contient 3 objets al�atoires dont une l�gendaire est assur�e');

INSERT INTO RareteCategorieLootbox (noRarete, noCategorie, prix, pourcentageCommun, PourcentageRare, PourcentageEpique, PourcentageLegendaire) VALUES
	(1,1,15,70,20,9,1),
	(2,1,30,50,30,15,5),
	(3,1,60,30,30,30,10),
	(4,1,120,20,25,25,30),
	(1,2,5,70,20,9,1),
	(2,2,10,50,30,15,5),
	(3,2,20,30,30,30,10),
	(4,2,40,20,25,25,30),
	(1,3,10,70,20,9,1),
	(2,3,20,50,30,15,5),
	(3,3,40,30,30,30,10),
	(4,3,80,20,25,25,30),
	(1,4,10,70,20,9,1),
	(2,4,20,50,30,15,5),
	(3,4,40,30,30,30,10),
	(4,4,80,20,25,25,30);
	

