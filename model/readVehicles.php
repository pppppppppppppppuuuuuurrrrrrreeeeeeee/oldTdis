<?php
require_once('functions.php');

$status = filter_input(INPUT_POST, "status");
// var_dump($status);

$startDate = filter_input(INPUT_POST, "startDate");
$startTime = filter_input(INPUT_POST, "startTime");
$endDate = filter_input(INPUT_POST, "endDate");
$endTime = filter_input(INPUT_POST, "endTime");
$speed = filter_input(INPUT_POST, "speed");
$accuracy = filter_input(INPUT_POST, "accuracy");
$lane = filter_input(INPUT_POST, "lane");
$camera = filter_input(INPUT_POST, "camera");
$cameraId = getCameraID($camera);



$whiteList = 0;
if(filter_input(INPUT_POST, "wanted") == "on" ) {
    $whiteList = 1;
}

$vehicles = [];
if ( filter_input(INPUT_POST, "lightVehicle") == "on" ) {
    $vehicles[] = 1;
}
if ( filter_input(INPUT_POST, "heavyVehicle") == "on" ) {
    $vehicles[] = 2;
}
if ( filter_input(INPUT_POST, "unkownVehicle") == "on" ) {
    $vehicles[] = 0;
}
$vehicles = implode(",",$vehicles);

if($status == 'NotSended'){
    echo readPassedVehicleRecords($startDate, $startTime, $endDate, $endTime,
    $speed, $accuracy, $lane, $whiteList, $vehicles, $cameraId, $camera);
} else {
    echo readPassedVehicleRecordsAll($startDate, $startTime, $endDate, $endTime,
    $speed, $accuracy, $lane, $wanted, $vehicles, $cameraId, $camera);
}
$conn->close();

