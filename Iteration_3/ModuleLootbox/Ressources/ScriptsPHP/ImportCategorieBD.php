<?php
$servername = "dicj.info";
$username = "cegepjon_p2019";
$password = "ProjFGH19!";
$database = "cegepjon_p2019-dev";

$conn = new mysqli($servername, $username, $password, $database);
if($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$Categories = array();
$sql = "SELECT noCategorie, nomCategorie
		FROM Categorie
		ORDER BY noCategorie ASC";
$stmt = $conn->query($sql);
if($stmt->num_rows > 0){
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'nomCategorie'=>$row['nomCategorie']
		];
		array_push($Categories, $temp);
	}
}
return $Categories;
mysqli_free_result($stmt);
?>