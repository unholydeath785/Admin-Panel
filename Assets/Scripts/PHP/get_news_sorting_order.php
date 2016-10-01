<?php
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "SELECT * FROM `news`");
$str = "";
while ($row = mysqli_fetch_assoc($result)) {
	$str = $row['sort_by'];
}
echo $str;
?>
