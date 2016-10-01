<?php
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$title = $_GET['title'];
$result = mysqli_query($conn, "SELECT * FROM `news` WHERE id='".$title."'");
$a = array();
while ($row = mysqli_fetch_assoc($result)) {
	array_push($a, $row);
}
echo json_encode($a);
?>
