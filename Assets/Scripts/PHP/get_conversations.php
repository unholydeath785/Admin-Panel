<?php
$user = $_GET['username'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
// $conn = mysqli_connect("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
$result = mysqli_query($conn, "SELECT * FROM `messages` WHERE username='".$user."'");
$conversations = array();
while ($row = mysqli_fetch_assoc($result)) {
	array_push($conversations, $row['userto']);
}
echo json_encode($conversations);
?>
