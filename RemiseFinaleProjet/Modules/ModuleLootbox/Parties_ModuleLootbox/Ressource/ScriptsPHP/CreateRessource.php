<?php
require 'Ressource.php';
function CreateRessources($InfosRessources){
	//On va chercher le total de toutes les ressources du tableau
	$totalRessource = count((array)$InfosRessources);
	$listeRessources = array();
	//On boucle dans chaque ressource, on va chercher chaque champ
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
		//On crée la ressource
		$ressource = new Ressource($no, $nom, $categorie, $rarete, $description, $lienImage, $ressourceUnique, $statut, $prix);
		//On la pousse dans le tableau
		array_push($listeRessources, $ressource);
	}
	return $listeRessources;
}
?>