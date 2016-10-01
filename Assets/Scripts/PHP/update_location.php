<?php
//get city
$city = $_GET['city'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "SELECT * FROM `location`");
$found = false;
$cities = array();
while ($row = mysqli_fetch_assoc($result)) {
	//if location exists
	$count = 1;
	$cities[$city] = $count;
	if ($row['city'] == $city) {
		$count = $row['count'];
		$count = $count + 1;
		$cities[$city] = $count;
		mysqli_query($conn,"UPDATE `location` SET `city`='".$city."',`count`='".$count."'");
		$found = true;
	}
}
if (!$found) {
	$count = 1;
	mysqli_query($conn,"INSERT INTO `location`(`city`, `count`) VALUES ('".$city."','".$count."')");
}
echo json_encode($cities);
?>
