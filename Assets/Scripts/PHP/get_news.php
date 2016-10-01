<?php
$opt = $_GET['opt'];
$var = $_GET['var'];
$save = $_GET['save'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "SELECT * FROM `news` ORDER BY `news`.`".$var."` ".$opt."");
$a = array();
while ($row = mysqli_fetch_assoc($result)) {
	array_push($a, $row);
}
$result = mysqli_query($conn, "UPDATE `news` SET `sort_by`='".$save."'");
echo json_encode($a);
?>
