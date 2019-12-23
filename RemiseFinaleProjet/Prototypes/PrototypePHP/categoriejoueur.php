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
$sql = "SELECT noJoueur, noCategorie, score
		FROM tblcategoriejoueur";
$stmt = $conn->query($sql);

if($stmt->num_rows > 0){
	
	while($row = $stmt->fetch_assoc()){
		
		$temp = [
			'noJoueur'=>$row['noJoueur'],
			'noCategorie'=>$row['noCategorie'],
			'score'=>$row['score']
		];
		array_push($Infos, $temp);
	
	}
	
}

echo json_encode($Infos);
mysqli_free_result($stmt);
?>