<?php

class Lootbox {
	private $no;
	private $nom;
	private $categorie;
	private $rarete;
	private $description;
	private $prix;
	private $pourcentageCommun;
	private $pourcentageRare;
	private $pourcentageEpique;
	private $pourcentageLegendaire;

	function __construct ($no, $nom, $categorie, $rarete, $description, $prix, $pourcentageCommun, $pourcentageRare, $pourcentageEpique, $pourcentageLegendaire){
		$this->no = $no;
		$this->nom = $nom;		
		$this->categorie = $categorie;
		$this->rarete = $rarete;
		$this->description = $description;
		$this->prix = $prix;
		$this->pourcentageCommun = $pourcentageCommun;
		$this->pourcentageRare = $pourcentageRare;
		$this->pourcentageEpique = $pourcentageEpique;
		$this->pourcentageLegendaire = $pourcentageLegendaire;
	}

	function ReturnNo() {
		return $this->no;
	}

	function ReturnNom() {
		return $this->nom;
	}

	function ReturnCategorie(){
		return $this->categorie;
	}

	function ReturnRarete(){
		return $this->rarete;
	}

	function ReturnDescription(){
		return $this->description;
	}

	function ReturnPrix(){
		return $this->prix;
	}
	
	function ReturnPourcentageCommun(){
		return $this->pourcentageCommun;
	}
	
	function ReturnPourcentageRare(){
		return $this->pourcentageRare;
	}
	
	function ReturnPourcentageEpique(){
		return $this->pourcentageEpique;
	}
	
	function ReturnPourcentageLegendaire(){
		return $this->pourcentageLegendaire;
	}
}

?>