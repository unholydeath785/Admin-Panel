<?php
$page = $_GET['page'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "SELECT * FROM `pages` WHERE page='".$page."'");
$html = '';
while ($row = mysqli_fetch_assoc($result)) {
	$html = $row['html'];
}
echo $html;
?>
