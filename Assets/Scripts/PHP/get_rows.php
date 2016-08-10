<?php
$range_string = $_GET['range'];
$conn = mysqli_connect("localhost","root","","Admin-Panel");
// $conn = mysqli_connect("localhost","unholyde_ath7856","Bertschi2012","unholyde_ath7856_AdminPanel");
$date = explode("_",$range_string);
$date1 = $date[0];
$date2 = $date[1];
$result = mysqli_query($conn, "SELECT * FROM `access` WHERE date BETWEEN '".$date1."' and '".$date2."'");
$map = array();
while ($row = mysqli_fetch_assoc($result)) {
  $key = "".$row['date']."h".$row['time']."";
  $count = 0;
  if (isset($map[$key]) || array_key_exists($key, $map)) {
    $count = $map[$key];
    $count++;
    $map[$key] = $count;
  } else {
    $count++;
    $map[$key] = $count;
  }
}
echo json_encode($map, 128);
?>
