<?php
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn, "SELECT * FROM `todos`");
$todos = array();
while ($row = mysqli_fetch_assoc($result)) {
	array_push($todos,$row);
}
echo json_encode($todos);
?>
