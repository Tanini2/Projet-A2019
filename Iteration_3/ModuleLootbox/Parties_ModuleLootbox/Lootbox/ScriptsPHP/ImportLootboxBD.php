<?php
//Informations du serveur contenant la BD MySQL
$servername = "dicj.info";
$username = "cegepjon_p2019";
$password = "ProjFGH19!";
$database = "cegepjon_p2019-dev";

//On ouvre la connection à partir des informatons du serveur
$conn = new mysqli($servername, $username, $password, $database);
//Si la connection échoue, on envoie un message d'erreur
if($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$Lootboxes = array();
//On va chercher toutes les infos des lootbox, ainsi que le prix et les pourcentages selon la rareté et la catégorie de chaque lootbox 
$sql = "SELECT noLootbox , nomLootbox, categorie, rarete, description, prix, pourcentageCommun, pourcentageRare, pourcentageEpique, pourcentageLegendaire
		FROM Lootbox
		INNER JOIN Categorie ON Lootbox.categorie = Categorie.noCategorie
        INNER JOIN Rarete ON Lootbox.rarete = Rarete.noRarete
        INNER JOIN RareteCategorieLootbox ON RareteCategorieLootbox.noCategorie = Categorie.noCategorie
        AND RareteCategorieLootbox.noRarete = Rarete.noRarete
		ORDER BY noLootbox ASC";
//On envoie la requête
$stmt = $conn->query($sql);
//Si on a au moins un résultat
if($stmt->num_rows > 0){
	//Pour chaque ligne, on va chercher le résultat de chaque champ et on l'ajoute dans un tableau temporaire
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'noLootbox'=>$row['noLootbox'],
			'nomLootbox'=>utf8_encode($row['nomLootbox']),
			'categorie'=>$row['categorie'],
			'rarete'=>$row['rarete'],
			'description'=>utf8_encode($row['description']),
			'prix'=>$row['prix'],
			'pourcentageCommun'=>$row['pourcentageCommun'],
			'pourcentageRare'=>$row['pourcentageRare'],
			'pourcentageEpique'=>$row['pourcentageEpique'],
			'pourcentageLegendaire'=>$row['pourcentageLegendaire']
		];
		//On pousse dans un tableau 
		array_push($Lootboxes, $temp);
	}
}
return $Lootboxes;
mysqli_free_result($stmt);
?>