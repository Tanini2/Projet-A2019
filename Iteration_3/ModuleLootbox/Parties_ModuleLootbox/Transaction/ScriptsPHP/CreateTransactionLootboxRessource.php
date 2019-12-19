<?php
require 'TransactionLootboxRessource.php';

function CreateTransactionsLootboxRessource($TransactionsLootboxRessource){
	//On va chercher le total des transactionsLootboxRessource
	$totalTransactionsLootboxRessource = count((array)$TransactionsLootboxRessource);
	$listeTransactionsLootboxRessource = array();
	//On boucle dans chaque transactionLootboxRessource et on va chercher les champs
	for($i = 0; $i < $totalTransactionsLootboxRessource; $i++){
		$noTransactionLootbox = $TransactionsLootboxRessource[$i]['noTransactionLootbox'];
		$noRessource = $TransactionsLootboxRessource[$i]['noRessource'];
		//On crée une nouvelle transactionLootboxRessource et on la pousse dans le tableau
		$transactionLootboxRessource = new TransactionLootboxRessource($noTransactionLootbox, $noRessource);
		array_push($listeTransactionsLootboxRessource, $transactionLootboxRessource);
	}
	return $listeTransactionsLootboxRessource;
}
?>