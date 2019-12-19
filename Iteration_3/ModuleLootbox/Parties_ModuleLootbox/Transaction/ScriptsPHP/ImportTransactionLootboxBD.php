<?php
function GetTransactionLootboxBD($noEtudiant){
	//Informations du serveur contenant la BD MySQL
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";

	//Ouvrir la connection 
	$conn = new mysqli($servername, $username, $password, $database);
	
	//Si la connexion échoue, on tue la connexion et on envoie un message d'erreur
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$TransactionsLootbox = array();
	//On va chercher toutes les transactionLootbox avec toutes leurs informations selon le noÉtudiant
	$sql = "SELECT noTransactionLootbox, source, destination, nbFortune, prix, description
			FROM TransactionLootbox
			WHERE source = '$noEtudiant'
			ORDER BY noTransactionLootbox ASC";
	//On envoit la requête
	$stmt = $conn->query($sql);
	//Si on a au moins un résultat
	if($stmt->num_rows > 0){
		//Pour chaque ligne, on va chercher les informations et on les rentre dans une table temporaire
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noTransactionLootbox'=>$row['noTransactionLootbox'],
				'source'=>$row['source'],
				'destination'=>$row['destination'],
				'nbFortune'=>$row['nbFortune'],
				'prix'=>$row['prix'],
				'description'=>utf8_encode($row['description'])
			];
			//On pousse la table temporaire dans la table de transactionLootbox
			array_push($TransactionsLootbox, $temp);
		}
	}
	return $TransactionsLootbox;
	mysqli_free_result($stmt);
}

//On va chercher toutes les transactionsLootbox
function GetAllTransactionLootboxBD(){
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";

	$conn = new mysqli($servername, $username, $password, $database);
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$TransactionsLootbox = array();
	$sql = "SELECT noTransactionLootbox, source, destination, nbFortune, prix, description
			FROM TransactionLootbox
			ORDER BY noTransactionLootbox ASC";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noTransactionLootbox'=>$row['noTransactionLootbox'],
				'source'=>$row['source'],
				'destination'=>$row['destination'],
				'nbFortune'=>$row['nbFortune'],
				'prix'=>$row['prix'],
				'description'=>utf8_encode($row['description'])
			];
			array_push($TransactionsLootbox, $temp);
		}
	}
	return $TransactionsLootbox;
	mysqli_free_result($stmt);
}
?>