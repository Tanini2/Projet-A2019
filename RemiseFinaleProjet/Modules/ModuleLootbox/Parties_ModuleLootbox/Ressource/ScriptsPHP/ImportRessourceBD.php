<?php
//Va chercher toutes les ressources de la BD
function GetRessourcesBD(){
	//Infos du serveur contenant la BD MySQL
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";
	//On crée la connection
	$conn = new mysqli($servername, $username, $password, $database);
	//Si la connection échoue, on envoie un message d'erreur et on tue la connection
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$InfosRessources = array();
	//On va chercher toutes les infos des ressources incluant le prix, dépendamment de la rareté et de la catégorie de chaque ressource
	$sql = "SELECT noRessource, nomRessource, nomCategorie, nomRarete, Ressource.description, lienImage, ressourceUnique, statut, prix
			FROM Ressource
			INNER JOIN Categorie ON Ressource.categorie = Categorie.noCategorie
			INNER JOIN Rarete ON Ressource.rarete = Rarete.noRarete
			INNER JOIN RareteCategorieRessource ON RareteCategorieRessource.noCategorie = Categorie.noCategorie 
			AND RareteCategorieRessource.noRarete = Rarete.noRarete
			ORDER BY noRessource ASC";
	//On envoie la requête
	$stmt = $conn->query($sql);
	//Si on a des résultats
	if($stmt->num_rows > 0){
		//Pour chaque ligne, on va chercher les champs et on les mets dans un tableau temporaire
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noRessource'=>$row['noRessource'],
				'nomRessource'=>utf8_encode($row['nomRessource']),
				'nomCategorie'=>utf8_encode($row['nomCategorie']),
				'nomRarete'=>utf8_encode($row['nomRarete']),
				'description'=>utf8_encode($row['description']),
				'lienImage'=>$row['lienImage'],
				'ressourceUnique'=>$row['ressourceUnique'],
				'statut'=>$row['statut'],
				'prix'=>$row['prix']
			];
			//On pousse le tableau temporaire dans le tableau de ressources
			array_push($InfosRessources, $temp);
		}
	}
	return $InfosRessources;
	mysqli_free_result($stmt);
}
//On va chercher toutes les ressources selon la catégorie et la rareté qui ont été passées en paramètres
function GetRessourcesWithParamBD($noCategorie, $noRarete){
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";

	$conn = new mysqli($servername, $username, $password, $database);
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$InfosRessources = array();
	$sql = "SELECT noRessource, nomRessource, nomCategorie, nomRarete, Ressource.description, lienImage, ressourceUnique, statut, prix
			FROM Ressource
			INNER JOIN Categorie ON Ressource.categorie = Categorie.noCategorie
			INNER JOIN Rarete ON Ressource.rarete = Rarete.noRarete
			INNER JOIN RareteCategorieRessource ON RareteCategorieRessource.noCategorie = Categorie.noCategorie 
			AND RareteCategorieRessource.noRarete = Rarete.noRarete
			WHERE Categorie.noCategorie = '$noCategorie' AND Rarete.noRarete = '$noRarete'
			ORDER BY noRessource ASC";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noRessource'=>$row['noRessource'],
				'nomRessource'=>utf8_encode($row['nomRessource']),
				'nomCategorie'=>utf8_encode($row['nomCategorie']),
				'nomRarete'=>utf8_encode($row['nomRarete']),
				'description'=>utf8_encode($row['description']),
				'lienImage'=>$row['lienImage'],
				'ressourceUnique'=>$row['ressourceUnique'],
				'statut'=>$row['statut'],
				'prix'=>$row['prix']
			];
			array_push($InfosRessources, $temp);
		}
	}
	return $InfosRessources;
	mysqli_free_result($stmt);
}
//On va chercher toutes les ressources selon le noEtudiant qui a été passé en paramètres
function GetRessourcesWithEtudiantBD($noEtudiant){
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";

	$conn = new mysqli($servername, $username, $password, $database);
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$InfosRessources = array();
	$sql = "SELECT Ressource.noRessource, nomRessource, nomCategorie, nomRarete, Ressource.description, lienImage, ressourceUnique, statut, prix
			FROM Ressource
			INNER JOIN RessourceEtudiant ON RessourceEtudiant.noRessource = Ressource.noRessource
			INNER JOIN EtudiantTest ON RessourceEtudiant.noEtudiant = EtudiantTest.noEtudiant
			INNER JOIN Categorie ON Ressource.categorie = Categorie.noCategorie
			INNER JOIN Rarete ON Ressource.rarete = Rarete.noRarete
			INNER JOIN RareteCategorieRessource ON RareteCategorieRessource.noCategorie = Categorie.noCategorie 
			AND RareteCategorieRessource.noRarete = Rarete.noRarete
			WHERE EtudiantTest.noEtudiant = '$noEtudiant' 
			ORDER BY noRessource ASC";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noRessource'=>$row['noRessource'],
				'nomRessource'=>utf8_encode($row['nomRessource']),
				'nomCategorie'=>utf8_encode($row['nomCategorie']),
				'nomRarete'=>utf8_encode($row['nomRarete']),
				'description'=>utf8_encode($row['description']),
				'lienImage'=>$row['lienImage'],
				'ressourceUnique'=>$row['ressourceUnique'],
				'statut'=>$row['statut'],
				'prix'=>$row['prix']
			];
			array_push($InfosRessources, $temp);
		}
	}
	return $InfosRessources;
	mysqli_free_result($stmt);
}
//On va chercher les ressources selon le niveau de rareté passé en paramètre
function GetRessourcesWithRareteBD($noRarete){
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";

	$conn = new mysqli($servername, $username, $password, $database);
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$InfosRessources = array();
	$sql = "SELECT Ressource.noRessource, nomRessource, nomCategorie, nomRarete, Ressource.description, lienImage, ressourceUnique, statut, prix
			FROM Ressource
			INNER JOIN Categorie ON Ressource.categorie = Categorie.noCategorie
			INNER JOIN Rarete ON Ressource.rarete = Rarete.noRarete
			INNER JOIN RareteCategorieRessource ON RareteCategorieRessource.noCategorie = Categorie.noCategorie 
			AND RareteCategorieRessource.noRarete = Rarete.noRarete
			WHERE Rarete.noRarete = '$noRarete' 
			ORDER BY noRessource ASC";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noRessource'=>$row['noRessource'],
				'nomRessource'=>utf8_encode($row['nomRessource']),
				'nomCategorie'=>utf8_encode($row['nomCategorie']),
				'nomRarete'=>utf8_encode($row['nomRarete']),
				'description'=>utf8_encode($row['description']),
				'lienImage'=>$row['lienImage'],
				'ressourceUnique'=>$row['ressourceUnique'],
				'statut'=>$row['statut'],
				'prix'=>$row['prix']
			];
			array_push($InfosRessources, $temp);
		}
	}
	return $InfosRessources;
	mysqli_free_result($stmt);
}
//On va chercher la ressource demandée selon le no de ressource
function GetRessourcesWithNoBD($noRessource){
	$servername = "dicj.info";
	$username = "cegepjon_p2019";
	$password = "ProjFGH19!";
	$database = "cegepjon_p2019-dev";

	$conn = new mysqli($servername, $username, $password, $database);
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$InfosRessources = array();
	$sql = "SELECT Ressource.noRessource, nomRessource, nomCategorie, nomRarete, Ressource.description, lienImage, ressourceUnique, statut, prix
			FROM Ressource
			INNER JOIN Categorie ON Ressource.categorie = Categorie.noCategorie
			INNER JOIN Rarete ON Ressource.rarete = Rarete.noRarete
			INNER JOIN RareteCategorieRessource ON RareteCategorieRessource.noCategorie = Categorie.noCategorie 
			AND RareteCategorieRessource.noRarete = Rarete.noRarete
			WHERE Ressource.noRessource = '$noRessource' 
			ORDER BY noRessource ASC";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
		while($row = $stmt->fetch_assoc()){
			$temp = [
				'noRessource'=>$row['noRessource'],
				'nomRessource'=>utf8_encode($row['nomRessource']),
				'nomCategorie'=>utf8_encode($row['nomCategorie']),
				'nomRarete'=>utf8_encode($row['nomRarete']),
				'description'=>utf8_encode($row['description']),
				'lienImage'=>$row['lienImage'],
				'ressourceUnique'=>$row['ressourceUnique'],
				'statut'=>$row['statut'],
				'prix'=>$row['prix']
			];
			array_push($InfosRessources, $temp);
		}
	}
	return $InfosRessources;
	mysqli_free_result($stmt);
}
?>