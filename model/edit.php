<?php
date_default_timezone_set('Asia/Tehran');

require_once 'config.php';
require_once 'functions.php';

$recordID = filter_input(INPUT_POST, "recordID");
$plate = filter_input(INPUT_POST, "plate");
$userID = filter_input(INPUT_POST, "userID");
$userID = getIDByUsername($userID);
$status = filter_input(INPUT_POST, "status");
$today = date('Y-m-d H:i:s');


$flagUserActivities = false;

$sql = "SELECT status FROM `UserActivities` WHERE passedVehicleRecordID = '$recordID'";
$res = $conn->query($sql);
if ($res->num_rows == 0) {
  //INSERT
  $sqlInsert = "INSERT INTO `UserActivities` (date, passedVehicleRecordID, editedPlate, userID, status, police)
  VALUES ('$today', $recordID, '$plate', '$userID', 1, 0)";

  if ($conn->query($sqlInsert) === TRUE) {
    $flagUserActivities = true;
  }
} else if ($res->num_rows == 1) {
  //UPDATE
  $row = $res->fetch_assoc();
  if ($row['status'] != 2) {
    $sqlUpdate = "UPDATE UserActivities SET status = 1, date = '$today', userID = '$userID', editedPlate = '$plate' WHERE passedVehicleRecordID = '$recordID'";

    if ($conn->query($sqlUpdate) === TRUE) {
      $flagUserActivities = true;
    }
  }

}

if ($flagUserActivities) {
  echo 'true';
} else {
  echo 'something is wrong';
}

