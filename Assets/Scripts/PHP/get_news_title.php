<?php
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM `news` WHERE id='".$id."'");
$a;
while ($row = mysqli_fetch_assoc($result)) {
	$a = $row['title'];
}
echo $a;
?>
