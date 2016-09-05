<?php
// $db = new mysqli("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
$db = new mysqli("localhost","root","","Admin-Panel");
if ($db -> connect_error) {
  die("Sorry, there was a problem connecting to our database.");
}

$username = stripslashes(htmlspecialchars($_GET['username']));
$message = stripslashes(htmlspecialchars($_GET['message']));
$userto = stripslashes(htmlspecialchars($_GET['userto']));

if ($username == "" || $message == "" || $userto == "") {
  die();
}

$result = $db->prepare("INSERT INTO `messages` VALUES('',?,?,?,'','')");
$result->bind_param("sss", $username, $message, $userto);
$result->execute();
?>
