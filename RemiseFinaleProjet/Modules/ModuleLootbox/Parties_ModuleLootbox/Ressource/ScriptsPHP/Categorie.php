<?php
class Categorie {
	private $nom;
	
	function __construct ($nom){
		$this->nom = $nom;
	}
	
	function ReturnNom() {
		return $this->nom;
	}
}
?>