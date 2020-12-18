<?php
date_default_timezone_set('Asia/Tehran');

require_once 'config.php';
require_once 'functions.php';

$id = filter_input(INPUT_POST, "id");
$status = filter_input(INPUT_POST, "status");
$statusint = 10;
if ($status == 'تصویر پر نور'){
    $statusint = 10;
} elseif ($status == 'تصویر کم نور') {
    $statusint = 11;
} elseif ($status == 'پلاک پر نور') {
    $statusint = 12;
} elseif ($status == 'پلاک کم نور') {
    $statusint = 13;
} elseif ($status == 'پلاک ناواضح') {
    $statusint = 14;
} elseif ($status == 'موارد دیگر') {
    $statusint = 15;
}

$flagUserActivities = false;


//UPDATE
$sqlUpdate = "UPDATE UserActivities SET status = $statusint WHERE passedVehicleRecordID = '$id'";
if ($conn->query($sqlUpdate) === TRUE) {
    $flagUserActivities = true;
    
} else {
    echo $conn->error.PHP_EOL;
}


if ($flagUserActivities) {
  echo 'true';
} else {
  echo 'something is wrong';
}

