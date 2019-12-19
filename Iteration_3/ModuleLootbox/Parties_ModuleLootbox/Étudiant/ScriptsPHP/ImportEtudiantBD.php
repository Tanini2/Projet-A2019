<?php
//Infos du serveur contenant la BD MySQL
$servername = "dicj.info";
$username = "cegepjon_p2019";
$password = "ProjFGH19!";
$database = "cegepjon_p2019-dev";

//Crée la connection
$conn = new mysqli($servername, $username, $password, $database);
//S'il y a une erreur, affiche un message d'erreur et "kill" la connection
if($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$Etudiants = array();
//Va chercher les informations de la table Étudiant
$sql = "SELECT noEtudiant, nomEtudiant, prenomEtudiant
		FROM EtudiantTest
		ORDER BY noEtudiant ASC";
//Envoi la requête
$stmt = $conn->query($sql);
//S'il y a des résultats
if($stmt->num_rows > 0){
	//Pour chaque ligne de résultats on va chercher les champs et on remplit un tableau temporaire
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'noEtudiant'=>$row['noEtudiant'],
			'nomEtudiant'=>utf8_encode($row['nomEtudiant']),
			'prenomEtudiant'=>utf8_encode($row['prenomEtudiant'])
		];
		//Et on pousse dans le tableau $Etudiants
		array_push($Etudiants, $temp);
	}
}
return $Etudiants;
mysqli_free_result($stmt);
?>