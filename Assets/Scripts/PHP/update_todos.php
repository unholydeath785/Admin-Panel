<?php
$id = $_GET['id'];
$complete = $_GET['completed'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "UPDATE `todos` SET `completed`=".$complete." WHERE id=".$id."");
echo $complete;
?>
