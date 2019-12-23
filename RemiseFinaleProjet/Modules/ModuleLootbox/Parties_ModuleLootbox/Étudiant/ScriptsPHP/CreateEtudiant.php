<?php
//Va chercher les scripts nécessaires 
require 'ImportEtudiantBD.php';
require 'Etudiant.php';
//Compte le nombre d'étudiants dans la liste 
$totalEtudiants = count((array)$Etudiants);
$listeEtudiants = array();
//Itère dans chacun des étudiants et va chercher chaque champ
for($i = 0; $i < $totalEtudiants; $i++){
	$noEtudiant = $Etudiants[$i]['noEtudiant'];
	$nomEtudiant = $Etudiants[$i]['nomEtudiant'];
	$prenomEtudiant = $Etudiants[$i]['prenomEtudiant'];
	//Crée un nouvel étudiant à partir des champs
	$etudiant = new Etudiant($noEtudiant, $nomEtudiant, $prenomEtudiant);
	//Pousse l'étudiant dans la nouvelle liste
	array_push($listeEtudiants, $etudiant);
}
return $listeEtudiants;
?>