<?php
require 'ImportTransactionLootboxBD.php';
$TransactionsLootbox = GetAllTransactionLootboxBD();
if(count($TransactionsLootbox) > 0){
	require 'CreateTransactionLootbox.php';
}
$Max =0;
$Actuel = 0;
//Si on a des éléments dans la liste 
if(count($listeTransactionsLootbox) > 0){
	//On boucle dans chaque transactionLootbox
	foreach($listeTransactionsLootbox as $transactionLootbox)
	{
		//On split le no du TRL pour pouvoir incrémenter par la suite
		$no = explode("TRL", $transactionLootbox->ReturnNo()); //no de transaction
		$Actuel = $no[1];
		//On cherche le no le plus élevé
		if($Actuel > $Max)
		{
			$Max = $Actuel;
		}
	}
}
//Si on n'a pas d'éléments dans la liste
else{
	$Max = 0;
}
//On crée le nouvel ID en incrémentantde 1 le $Max
$nouveauId = 'TRL'.($Max+1);

//On va chercher les informations contenues dans le POST
$ressource2 = $_POST['ressource2'];
$ressource3 = $_POST['ressource3'];
$noEtudiant = $_POST['noEtudiant'];
$nbFortune = $_POST['fortuneObtenue'];
$prix = $_POST['prix'];
$ressourceLootbox = $_POST['noRessourceLootbox'];

//Informations du serveur
$servername = "dicj.info";
$username = "cegepjon_p2019";
$password = "ProjFGH19!";
$database = "cegepjon_p2019-dev";

//On ouvre la connection
$conn = new mysqli($servername, $username, $password, $database);
//S'il y a une erreur de connexion, on tue la connection et on affiche une erreur
if($conn->connect_error)
{
    die("Connection failed: ".$conn->connect_error);
}
//On insert la nouvelle transaction dans la BD àpartir des champs du POST et du nouveau ID créé
$sql = "INSERT INTO  TransactionLootbox (noTransactionLootbox, source, destination, nbFortune, prix, description)
VALUES ('$nouveauId', '$noEtudiant', 'IdBanque', '$nbFortune', '$prix', 'Achat de lootbox');";
//On envoie la requête
$stmt = $conn->query($sql);
echo "Transaction ajoutée dans la base de données";
?> <br /> <?php

//Si on a pas de 2e et 3e ressource, on fait une requête pour ajouter seulement la ressource de la lootbox dans TransactionLootboxRessource et RessourceEtudiant
if($ressource2 == null && $ressource3 ==  null)
{
    $sql2 = "INSERT INTO TransactionLootboxRessource (noTransactionLootbox, noRessource)
	VALUES ('$nouveauId', '$ressourceLootbox');";
    $stmt2 = $conn->query($sql2);

    $sql3 = "INSERT INTO RessourceEtudiant (noRessource, noEtudiant)
	VALUES ('$ressourceLootbox', '$noEtudiant');";
    $stmt3 = $conn->query($sql3);

    echo'Envoi de la ressource de la lootbox dans la table TransactionLootboxRessource et dans la table RessourceEtudiant';
}
//Si on a la ressource de la lootbox et la 3e ressource, on fait une requête pour les ajouter dans TransactionLootboxRessource et RessourceEtudiant
elseif ($ressource3 == null && $ressource2 != null)
{
    $sql4 = "INSERT INTO TransactionLootboxRessource (noTransactionLootbox, noRessource)
	VALUES ('$nouveauId', '$ressourceLootbox'), ('$nouveauId', '$ressource2');";
    $stmt4 = $conn->query($sql4);

    $sql5 = "INSERT INTO RessourceEtudiant (noRessource, noEtudiant)
	VALUES ('$ressourceLootbox', '$noEtudiant'), ('$ressource2', '$noEtudiant');";
    $stmt5 = $conn->query($sql5);
    echo'Envoi de la ressource de la lootbox et 1 ressource supplémentaire dans la table TransactionLootboxRessource et dans la table RessourceEtudiant';
}
//Si on a la ressource de la lootbox et la 2e ressource, on fait une requête pour les ajouter dans TransactionLootboxRessource et RessourceEtudiant
elseif ($ressource3 != null && $ressource2 == null)
{
    $sql6 = "INSERT INTO TransactionLootboxRessource (noTransactionLootbox, noRessource)
	VALUES ('$nouveauId', '$ressourceLootbox'), ('$nouveauId', '$ressource3');";
    $stmt6 = $conn->query($sql6);

    $sql7 = "INSERT INTO RessourceEtudiant (noRessource, noEtudiant)
	VALUES ('$ressourceLootbox', '$noEtudiant'), ('$ressource3', '$noEtudiant');";
    $stmt7 = $conn->query($sql7);
    echo'Envoi de la ressource de la lootbox et 1 ressource supplémentaire dans la table TransactionLootboxRessource et dans la table RessourceEtudiant';
}
//si on a les 3 ressources, on fait une requête pourles insérer dans TransactionLootboxRessource et RessourceEtudiant
elseif ($ressource2 != null && $ressource3 !=null)
{
    $sql8 = "INSERT INTO TransactionLootboxRessource (noTransactionLootbox, noRessource)
	VALUES ('$nouveauId', '$ressourceLootbox'), ('$nouveauId', '$ressource2'), ('$nouveauId', '$ressource3');";
    $stmt8 = $conn->query($sql8);

    $sql9 = "INSERT INTO RessourceEtudiant (noRessource, noEtudiant)
	VALUES ('$ressourceLootbox', '$noEtudiant'), ('$ressource2', '$noEtudiant'), ('$ressource3', '$noEtudiant');";
    $stmt9 = $conn->query($sql9);
    echo'Envoi de la ressource de la lootbox et 2 ressources supplémentaires dans la table TransactionLootboxRessource et dans la table RessourceEtudiant';
}
// Bouton pour aller à la PageTransaction avec le noEtudiant?>
<form action="PageTransaction.php" method="post">
	<input type="hidden" name="Etudiants" value="<?php echo $noEtudiant ?>"/>
	<input type="submit" value="Aller à la page Transaction"/>
</form>