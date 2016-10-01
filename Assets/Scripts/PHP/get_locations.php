<?php
$city = $_GET['city'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "SELECT * FROM `known_locations`");
$locations = array();
$found = false;
while ($row = mysqli_fetch_assoc($result)) {
	array_push($locations,$row);
	if ($row['city'] == $city) {
		$found = true;
	}
}
if (!$found) {
	mysqli_query($conn,"INSERT INTO `known_locations`(`city`, `lat`,`lon`) VALUES ('".$city."','".$lat."','".$lon."')");
}
echo json_encode($locations);
?>
