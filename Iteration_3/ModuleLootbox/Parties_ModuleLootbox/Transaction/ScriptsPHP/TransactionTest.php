<?php
class TransactionTest {
	private $no;
	private $source;
	private $destination;
	private $nbFortune;
	private $description;
	
	function __construct ($no, $source, $destination, $nbFortune, $description){
		$this->no = $no;
		$this->source = $source;
		$this->destination = $destination;
		$this->nbFortune = $nbFortune;
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
	
	function ReturnDescription() {
		return $this->description;
	}
	
}
?>