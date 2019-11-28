<?php
$servername = "dicj.info";
$username = "cegepjon_p2019";
$password = "ProjFGH19!";
$database = "cegepjon_p2019-dev";

$conn = new mysqli($servername, $username, $password, $database);
if($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$InfosRessources = array();
$sql = "SELECT noRessource, nomRessource, nomCategorie, nomRarete, Ressource.description, lienImage, ressourceUnique, statut, prix
		FROM Ressource
		INNER JOIN Categorie ON Ressource.categorie = Categorie.noCategorie
		INNER JOIN Rarete ON Ressource.rarete = Rarete.noRarete
		INNER JOIN RareteCategorieRessource ON RareteCategorieRessource.noCategorie = Categorie.noCategorie 
		AND RareteCategorieRessource.noRarete = Rarete.noRarete
		ORDER BY noRessource ASC";
$stmt = $conn->query($sql);
if($stmt->num_rows > 0){
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'noRessource'=>$row['noRessource'],
			'nomRessource'=>utf8_encode($row['nomRessource']),
			'nomCategorie'=>utf8_encode($row['nomCategorie']),
			'nomRarete'=>utf8_encode($row['nomRarete']),
			'description'=>utf8_encode($row['description']),
			'lienImage'=>$row['lienImage'],
			'ressourceUnique'=>$row['ressourceUnique'],
			'statut'=>$row['statut'],
			'prix'=>$row['prix']
		];
		array_push($InfosRessources, $temp);
	}
}
return $InfosRessources;

mysqli_free_result($stmt);
?>