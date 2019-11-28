<?php
require 'ImportRessourceBD.php';
require 'Ressource.php';

$totalRessource = count((array)$InfosRessources);
$listeRessources = array();
for($i = 0; $i < $totalRessource; $i++){
	$no = $InfosRessources[$i]['noRessource'];
	$nom = $InfosRessources[$i]['nomRessource'];
	$categorie = $InfosRessources[$i]['nomCategorie'];
	$rarete = $InfosRessources[$i]['nomRarete'];
	$description = $InfosRessources[$i]['description'];
	$lienImage = $InfosRessources[$i]['lienImage'];
	$ressourceUnique = $InfosRessources[$i]['ressourceUnique'];
	$statut = $InfosRessources[$i]['statut'];
	$prix = $InfosRessources[$i]['prix'];
	$ressource = new Ressource($no, $nom, $categorie, $rarete, $description, $lienImage, $ressourceUnique, $statut, $prix);
	array_push($listeRessources, $ressource);
}
return $listeRessources;
?>