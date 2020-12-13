<?php
require_once 'config.php';

date_default_timezone_set('Asia/Tehran');

$recordID= filter_input(INPUT_POST, "ID");
$camID= filter_input(INPUT_POST, "camID");
$speed= filter_input(INPUT_POST, "speed");
$plate= filter_input(INPUT_POST, "plate");
$passedtime= filter_input(INPUT_POST, "passedtime");
$imgAddress= filter_input(INPUT_POST, "imgAddress");
$postTime = date('Y-m-d H:i:s');

$f2 = false;

$sql = "UPDATE `UserActivities` SET police = 1 WHERE passedVehicleRecordID = $recordID";
if ($conn->query($sql) === TRUE) {
  $f2 = true;
}

if($f2) {
  echo 'true';
} else {
  echo $conn->error.PHP_EOL;
}

