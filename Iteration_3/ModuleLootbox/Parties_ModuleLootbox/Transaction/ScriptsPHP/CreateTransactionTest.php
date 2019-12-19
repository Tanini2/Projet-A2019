<?php

require 'TransactionTest.php';

//On compte le total de transactionTest
$totalTransactionsTest = count((array)$TransactionsTest);
$listeTransactionsTest = array();
//On boucle pour chaque transactionTest on va chercher les champs
for($i = 0; $i < $totalTransactionsTest; $i++){
	$noTransactionTest = $TransactionsTest[$i]['noTransactionTest'];
	$source = $TransactionsTest[$i]['source'];
	$destination = $TransactionsTest[$i]['destination'];
	$nbFortune = $TransactionsTest[$i]['nbFortune'];
	$description = $TransactionsTest[$i]['description'];
	//On crée une nouvelle transactionTest et on la pousse dans le tableau
	$transactionTest = new TransactionTest($noTransactionTest, $source, $destination, $nbFortune, $description);
	array_push($listeTransactionsTest, $transactionTest);
}
return $listeTransactionsTest;
?>