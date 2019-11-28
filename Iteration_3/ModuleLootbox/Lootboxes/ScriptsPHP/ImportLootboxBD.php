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

$Lootboxes = array();
$sql = "SELECT noLootbox, nomLootbox, description
		FROM Lootbox
		ORDER BY noLootbox ASC";
$stmt = $conn->query($sql);
if($stmt->num_rows > 0){
	while($row = $stmt->fetch_assoc()){
		$temp = [
			'noLootbox'=>utf8_encode($row['noLootbox']),
			'nomLootbox'=>utf8_encode($row['nomLootbox']),
			'description'=>utf8_encode($row['description'])
		];
		array_push($Lootboxes, $temp);
	}
}
var_dump($Lootboxes);
return $Lootboxes;
mysqli_free_result($stmt);
?>