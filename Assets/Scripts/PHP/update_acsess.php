<?php
$conn = mysqli_connect("localhost","root","","Admin-Panel");
// $conn = mysqli_connect("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
date_default_timezone_set($_GET['zone']);
$timestamp = date("H");
$day = date("j");
$month = date("n");
$year = date("Y");
$query = "INSERT INTO access (time,date) VALUES (".$timestamp.",NOW())";
mysqli_query($conn, $query);
?>
