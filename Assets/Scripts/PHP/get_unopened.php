<?php

$conn = mysqli_connect("localhost","root","","Admin-Panel");
// $conn = mysqli_connect("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
$user = $_GET['username'];
$result = mysqli_query($conn, "SELECT * FROM `messages` WHERE userto='".$user."' AND unopened='0'");
$unopenedArray = array();
while ($row = mysqli_fetch_assoc($result)) {
	array_push($unopenedArray, $row);
}
echo json_encode($unopenedArray);
?>
