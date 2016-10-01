<?php
$aH = $_GET['aH'];
$t = $_GET['t'];
$id = $_GET['id'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn,"UPDATE `news` SET `article_html`='".$aH."', `title`='".$t."' WHERE id='".$id."'");
?>
