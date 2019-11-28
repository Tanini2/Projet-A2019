<?php
class Lootbox {
	private $nom;
	private $description;
	
	function __construct ($nom, $description){
		$this->nom = $nom;
		$this->description = $description;
	}
	
	function ReturnNom() {
		return $this->nom;
	}
	
	function ReturnDescription(){
		return $this->description;
	}
}
?>