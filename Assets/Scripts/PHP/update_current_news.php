<?php
$url = $_GET['url'];
$s = $_GET['s'];
$id = $_GET['id'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
$result = mysqli_query($conn,"UPDATE `news` SET `summary_html`='".$s."',`bg_path`='".$url."' WHERE id='".$id."'");
echo "yay";
?>
