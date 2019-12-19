<?php
class Ressource {
	private $no;
	private $nom;
	private $categorie;
	private $rarete;
	private $description;
	private $lienImage;
	private $ressourceUnique;
	private $statut;
	private $prix;
	
	function __construct ($no, $nom, $categorie, $rarete, $description, $lienImage, $ressourceUnique, $statut, $prix){
		$this->no = $no;
		$this->nom = $nom;
		$this->categorie = $categorie;
		$this->rarete = $rarete;
		$this->description = $description;
		$this->lienImage = $lienImage;
		$this->ressourceUnique = $ressourceUnique;
		$this->statut = $statut;
		$this->prix = $prix;
	}
	
	function ReturnNo() {
		return $this->no;
	}
	
	function ReturnNom() {
		return $this->nom;
	}
	
	function ReturnCategorie() {
		return $this->categorie;
	}
	
	function ReturnRarete() {
		return $this->rarete;
	}
	
	function ReturnDescription() {
		return $this->description;
	}
	
	function ReturnLienImage() {
		return $this->lienImage;
	}
	
	function ReturnRessourceUnique() {
		return $this->ressourceUnique;
	}
	
	function ReturnStatut() {
		return $this->statut;
	}
	
	function ReturnPrix() {
		return $this->prix;
	}
}
?>