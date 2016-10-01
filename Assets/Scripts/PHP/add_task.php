<?php
$task = $_GET['task'];
$completed = $_GET['completed'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn,"INSERT INTO `todos`(`task`, `completed`, `date`) VALUES ('".$task."','".$completed."','".date("Y-m-d H:i:s")."')");
?>
