<?php
// takes a String, gets users Like this string
// returns array of names
$conn = mysqli_connect("localhost","root","","Admin-Panel");
// $conn = mysqli_connect("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
$user = $_GET['username'];
$result = mysqli_query($conn, "SELECT * FROM `users` WHERE username LIKE '%".$user."%' LIMIT 5");
$users = array();
while ($row = mysqli_fetch_assoc($result)) {
	array_push($users, $row['username']);
}
echo json_encode($users);
?>
