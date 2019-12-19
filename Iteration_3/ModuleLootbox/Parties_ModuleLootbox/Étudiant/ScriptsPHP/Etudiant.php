<?php
class Etudiant {
	private $no;
	private $nom;
	private $prenom;
	
	function __construct ($no, $nom, $prenom){
		$this->no = $no;
		$this->nom = $nom;
		$this->prenom = $prenom;
	}
	
	function ReturnNo(){
		return $this->no;
	}
	
	function ReturnNom() {
		return $this->nom;
	}
	
	
	function ReturnPrenom(){
		return $this->prenom;
	}
}
?>