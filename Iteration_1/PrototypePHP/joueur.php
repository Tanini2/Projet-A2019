<?php
$servername = "localhost";
$username = "cegepjon_1337589";
$password = "Hiver2019";
$database = "cegepjon_1337589";

$conn = new mysqli($servername, $username, $password, $database);
if($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$Infos = array();
$sql = "SELECT noJoueur, nomJoueur
		FROM tbljoueur
		ORDER BY noJoueur ASC";
$stmt = $conn->query($sql);
if($stmt->num_rows > 0){
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'noJoueur'=>$row['noJoueur'],
			'nomJoueur'=>utf8_encode($row['nomJoueur'])
		];
		array_push($Infos, $temp);
	}
}
echo json_encode($Infos,JSON_UNESCAPED_UNICODE);
mysqli_free_result($stmt);
?>
