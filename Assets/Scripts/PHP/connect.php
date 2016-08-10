<?php
$servername = "localhost";
$username = "root";
$password = "";
// $username = "unholyde_ath7856";
// $password = "Bertschi2012";

$conn = new mysqli($servername,$username,$password);

if ($conn->connect_error) {
  die ("Connection failed: " . $conn->connect_error);
}
 ?>
