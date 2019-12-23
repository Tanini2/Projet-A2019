<?php
function GetTransactionLootboxeRessourceBD($noTransactionLootbox){
	//Informations du serveur contenant la BD MySQL
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";
	
	//On ouvre la connexion
	$conn = new mysqli($servername, $username, $password, $database);
	//Si la connexion échoue, on tue la connexion et on envoie un message d'erreur
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$TransactionsLootboxRessource = array();
	//On va chercher toutes les transactionLootboxRessource selon le noTransactionLootbox passé en paramètre
	$sql = "SELECT noTransactionLootbox, noRessource
			FROM TransactionLootboxRessource
			WHERE noTransactionLootbox = '$noTransactionLootbox'";
	//On envoie la requête
	$stmt = $conn->query($sql);
	//Si on a des résultats
	if($stmt->num_rows > 0){
		//Pour chaque ligne, on va chercher les champs et on les met dans une table temporaire
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noTransactionLootbox'=>$row['noTransactionLootbox'],
				'noRessource'=>$row['noRessource']
			];
			//On pousse la table temporaire dans la vraie table
			array_push($TransactionsLootboxRessource, $temp);
		}
	}
	return $TransactionsLootboxRessource;
	mysqli_free_result($stmt);
}
?>