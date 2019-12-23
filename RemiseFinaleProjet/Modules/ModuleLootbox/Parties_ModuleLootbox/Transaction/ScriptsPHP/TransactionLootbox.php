<?php
class TransactionLootbox {
	private $no;
	private $source;
	private $destination;
	private $nbFortune;
	private $prix;
	private $description;
	
	function __construct ($no, $source, $destination, $nbFortune, $prix, $description){
		$this->no = $no;
		$this->source = $source;
		$this->destination = $destination;
		$this->nbFortune = $nbFortune;
		$this->prix = $prix;
		$this->description = $description;
	}
	
	function ReturnNo() {
		return $this->no;
	}
	
	function ReturnSource() {
		return $this->source;
	}
	
	function ReturnDestination() {
		return $this->destination;
	}
	
	function ReturnNbFortune() {
		return $this->nbFortune;
	}
	
	function ReturnPrix() {
		return $this->prix;
	}
	
	function ReturnDescription() {
		return $this->description;
	}
}
?>