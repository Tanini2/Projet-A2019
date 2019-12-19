<?php
class TransactionLootboxRessource {
	private $noTransactionLootbox;
	private $noRessource;
	
	function __construct ($noTransactionLootbox, $noRessource){
		$this->noTransactionLootbox = $noTransactionLootbox;
		$this->noRessource = $noRessource;
	}
	
	function ReturnNoTransactionLootbox() {
		return $this->noTransactionLootbox;
	}
	
	function ReturnNoRessource() {
		return $this->noRessource;
	}
}
?>