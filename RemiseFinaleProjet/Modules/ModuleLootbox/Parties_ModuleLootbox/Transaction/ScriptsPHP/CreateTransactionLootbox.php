<?php

require 'TransactionLootbox.php';
//On calcule le total de transactionLootbox 
$totalTransactionsLootbox = count((array)$TransactionsLootbox);
$listeTransactionsLootbox = array();
//On boucle à travers chaque transactionLootbox et on va chercher chaque champs
for($i = 0; $i < $totalTransactionsLootbox; $i++){
	$noTransactionLootbox = $TransactionsLootbox[$i]['noTransactionLootbox'];
	$source = $TransactionsLootbox[$i]['source'];
	$destination = $TransactionsLootbox[$i]['destination'];
	$nbFortune = $TransactionsLootbox[$i]['nbFortune'];
	$prix = $TransactionsLootbox[$i]['prix'];
	$description = $TransactionsLootbox[$i]['description'];
	//On crée une nouvelle TransactionLootbox
	$transactionLootbox = new TransactionLootbox($noTransactionLootbox, $source, $destination, $nbFortune, $prix, $description);
	//On envoie la transactionLootbox dans la liste
	array_push($listeTransactionsLootbox, $transactionLootbox);
}
return $listeTransactionsLootbox;
?>