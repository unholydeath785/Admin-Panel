<?php
$aH = $_GET['aH'];
$p = $_GET['p'];
$t = $_GET['t'];
$d = date("Y-m-d H:i:s");
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn,"INSERT INTO `news`(`article_html`, `title`,`date`,`bg_path`) VALUES ('".$aH."','".$t."','".$d."','".$p."')");
?>
