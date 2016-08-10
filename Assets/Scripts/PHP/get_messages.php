<?php

// $db = new mysqli("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
$db = new mysqli("localhost","root","","Admin-Panel");
if ($db -> connect_error) {
  die("Sorry, there was a problem connecting to our database.");
}

$userfrom = stripslashes(htmlspecialchars($_GET['userfrom']));
$username = stripslashes(htmlspecialchars($_GET['username']));

$result = $db->prepare("SELECT * FROM messages WHERE (userto=(?) AND username=(?)) OR (userto=(?) AND username=(?))");
$result->bind_param("ssss",$username, $userfrom, $userfrom, $username);
$result->execute();

$result = $result->get_result();

while($row = $result->fetch_row()) {
  echo $row[1];
  echo "\\";
  echo $row[2];
  echo "\n";
}
?>
