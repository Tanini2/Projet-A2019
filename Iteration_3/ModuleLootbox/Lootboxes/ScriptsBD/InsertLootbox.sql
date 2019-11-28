USE `cegepjon_p2019-dev`;
INSERT INTO Lootbox (nomLootbox ,description) VALUES
	('Lootbox commune d\'objets de carte','Cette lootbox contient 3 objets de carte aléatoires'),
    ('Lootbox rare d\'objets de carte','Cette lootbox contient 3 objets de cartes aléatoires dont une rare est assurée'),
    ('Lootbox épique d\'objets de carte','Cette lootbox contient 3 objets de cartes aléatoires dont une épique est assurée'),
    ('Lootbox légendaire d\'objets de carte','Cette lootbox contient 3 objets de cartes aléatoires dont une légendaire est assurée'),
	('Lootbox commune de cadres de carte','Cette lootbox contient 3 cadres de cartes aléatoires'),
    ('Lootbox rare de cadres de carte','Cette lootbox contient 3 cadres de cartes aléatoires dont une rare est assurée'),
    ('Lootbox épique de cadres de carte','Cette lootbox contient 3 cadres de cartes aléatoires dont une épique est assurée'),
    ('Lootbox légendaire de cadres de carte','Cette lootbox contient 3 cadres de cartes aléatoires dont une légendaire est assurée'),
	('Lootbox commune de caractéristiques ','Cette lootbox contient 3 caractéristiques aléatoires'),
    ('Lootbox rare de caractéristiques','Cette lootbox contient 3 caractéristiques aléatoires dont une rare est assurée'),
    ('Lootbox épique de caractéristiques','Cette lootbox contient 3 caractéristiques aléatoires dont une épique est assurée'),
    ('Lootbox légendaire de caractéristiques','Cette lootbox contient 3 caractéristiques aléatoires dont une légendaire est assurée'),
	('Lootbox commune d\'aléatoires ','Cette lootbox contient 3 objets aléatoires'),
    ('Lootbox rare d\'aléatoires','Cette lootbox contient 3 objets aléatoires dont une rare est assurée'),
    ('Lootbox épique d\'aléatoires','Cette lootbox contient 3 objets aléatoires dont une épique est assurée'),
    ('Lootbox légendaire d\'aléatoires','Cette lootbox contient 3 objets aléatoires dont une légendaire est assurée');

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
	

