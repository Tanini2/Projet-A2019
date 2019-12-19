<?php
require 'ImportCategorieBD.php';
require 'Categorie.php';

$totalCategorie = count((array)$Categories);
$listeCategories = array();
for($i = 0; $i < $totalCategorie; $i++){
	$nom = $Categories[$i]['nomCategorie'];
	$categorie = new Categorie($nom);
	array_push($listeCategories, $categorie);	
}
return $listeCategories;
?>