<?php
$user = $_GET['username'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "SELECT * FROM users WHERE username='".$user."'");
while($row = mysqli_fetch_assoc($result)) {
  echo $row['typing'];
}
?>
