<?php

function GetTransactionTestBD($noEtudiant){
	//Informations du serveur contenant la BD MySQL
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";

	//On ouvre la connexion
	$conn = new mysqli($servername, $username, $password, $database);
	//Si la connexion échoue, on tue la connection et on envoie un message d'erreur
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$TransactionsTest = array();
	//On va chercher toutes les transactionTest selon le noEtudiant passé en paramètre
	$sql = "SELECT noTransactionTest, source, destination, nbFortune, description
			FROM TransactionTest
			WHERE destination = '$noEtudiant'
			ORDER BY noTransactionTest ASC";
	//On envoie la requête
	$stmt = $conn->query($sql);
	//Si on a des résultats
	if($stmt->num_rows > 0){
		//Pour chaque ligne, on va chercher les champs et on les met dans un tableau temporaire
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noTransactionTest'=>$row['noTransactionTest'],
				'source'=>$row['source'],
				'destination'=>$row['destination'],
				'nbFortune'=>$row['nbFortune'],
				'description'=>utf8_encode($row['description'])
			];
			//On pousse le tableau temporaire dans la vraie table
			array_push($TransactionsTest, $temp);
		}
	}
	return $TransactionsTest;
	mysqli_free_result($stmt);
}
?>