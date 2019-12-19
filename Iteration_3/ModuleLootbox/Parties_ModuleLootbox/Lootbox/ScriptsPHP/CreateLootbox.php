<?php
require 'ImportLootboxBD.php';
require 'Lootbox.php';

//On calcule le nombre de lootbox
$totalLootbox = count((array) $Lootboxes);
$listeLootbox = array();

//On boucle dans les lootbox et on va chercher chaque champ
for ($i = 0; $i < $totalLootbox; $i++)
{
	$no = $Lootboxes[$i]['noLootbox'];
	$nom = $Lootboxes[$i]['nomLootbox'];	
	$categorie = $Lootboxes[$i]['categorie'];
	$rarete = $Lootboxes[$i]['rarete'];
	$description = $Lootboxes[$i]['description'];
	$prix = $Lootboxes[$i]['prix'];
	$pourcentageCommun = $Lootboxes[$i]['pourcentageCommun'];
	$pourcentageRare = $Lootboxes[$i]['pourcentageRare'];
	$pourcentageEpique = $Lootboxes[$i]['pourcentageEpique'];
	$pourcentageLegendaire = $Lootboxes[$i]['pourcentageLegendaire'];
	//On crée la lootbox à partir des champs recueillis
	$lootbox = new Lootbox($no, $nom, $categorie, $rarete, $description, $prix, $pourcentageCommun, $pourcentageRare, $pourcentageEpique, $pourcentageLegendaire);
	//On pousse la lootbox créée dans la liste de lootbox
	array_push($listeLootbox, $lootbox);
}
return $listeLootbox;
?>