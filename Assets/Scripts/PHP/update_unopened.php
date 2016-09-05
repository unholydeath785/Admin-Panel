<?php
$userto = $_GET['userto'];
$user = $_GET['user'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
// $conn = mysqli_connect("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
$result = mysqli_query($conn, "UPDATE `messages` SET unopened='1' WHERE username='".$userto."' AND userto='".$user."'");
echo $userto;
?>
