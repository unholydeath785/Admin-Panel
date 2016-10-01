<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] =='') {
  // header("Location:http://www.mundanewebsitename.me/Admin-Panel/login.php");
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>

	</body>
</html>
