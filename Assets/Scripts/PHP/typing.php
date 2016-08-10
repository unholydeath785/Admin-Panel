<?php
$typing = $_GET['typing'];
$user = $_GET['username'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "UPDATE users SET typing='".$typing."' WHERE username='".$user."'");
?>
