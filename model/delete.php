<?php


date_default_timezone_set('Asia/Tehran');

require_once 'config.php';
require_once 'functions.php';


$recordID = filter_input(INPUT_POST, "recordID"); //soft delete in passedVehcileRecords and use in UserActivities
$plate = filter_input(INPUT_POST, "plate");
$userID = filter_input(INPUT_POST, "userID");
$userID = getIDByUsername($userID);

$status = filter_input(INPUT_POST, "status");
$today = date('Y-m-d H:i:s');

$flagUserActivities = false;

//table UserActivites
  //if not exists create
  //else update
$sql = "SELECT id FROM `UserActivities` WHERE passedVehicleRecordID = '$recordID'";
$res = $conn->query($sql);
if ($res->num_rows == 0) {
  //INSERT
  $sqlInsert = "INSERT INTO `UserActivities` (date, passedVehicleRecordID, editedPlate, userID, status, police)
  VALUES ('$today', $recordID, '$plate', '$userID', 2, 0)";

  if ($conn->query($sqlInsert) === TRUE) {
    $flagUserActivities = true;
  } else {
    echo $conn->error.PHP_EOL;
  }
} else if ($res->num_rows == 1) {
  //UPDATE
  $sqlUpdate = "UPDATE UserActivities SET status = 2, date = '$today', userID = '$userID', editedPlate = '$plate' WHERE passedVehicleRecordID = '$recordID'";

  if ($conn->query($sqlUpdate) === TRUE) {
    $flagUserActivities = true;
  } else {
    echo $conn->error.PHP_EOL;
  }
}

if ($flagUserActivities) {
  echo 'true';
} else {
  echo 'something is wrong';
}

