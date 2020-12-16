<?php
require_once('./miladiBeShmsi.php');
require_once('./functions.php');
require_once('../ChromePhp.php');

function readPassedVehicleRecords($startDate, $startTime, $endDate, $endTime,
$cameras, $lanes, $types, $minAcc, $maxAcc, $minSpeed, $maxSpeed)
{
    global $conn;


    $startDate = explode('/', $startDate);
    $startDate =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

    $endDate = explode('/', $endDate);
    $endDate =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);
    
    $cameras = '('. implode(',', $cameras). ')';
    $lanes = '('. implode(',', $lanes). ')';
    $types = '('. implode(',', $types). ')';

    $sql = <<< lab
        SELECT * FROM `PassedVehicleRecords` 
        WHERE PassedTime >= '$startDate $startTime'
        AND PassedTime <= '$endDate $endTime'
        AND Speed >= $minSpeed AND Speed <= $maxSpeed 
        AND Accuracy >= $minAcc AND Accuracy <= $maxAcc
        AND CameraID IN $cameras
        AND VehicleType IN $types
        AND Lane IN $lanes
lab;
    // ChromePhp::log($sql);

    $result = $conn->query($sql);
    $json = [];
    $IDS = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $row["ImageAddress"] = getImageByUrl($row["ImageAddress"]);
            $row["police"] = 0;
            $key = $row['ID'];
            $IDS[] = $key;
            $json[$key] = $row;
        }
    }
    $IDSquey = '('.implode(",", $IDS).')';

    $sql = "SELECT passedVehicleRecordID FROM `UserActivities`
    WHERE passedVehicleRecordID IN $IDSquey
    AND (status >= 2 OR police <> 0)";
    $result = $conn->query($sql);
    $IDSUserActivity = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $IDSUserActivity[] = $row['passedVehicleRecordID'];
        }
    }
    foreach ($IDSUserActivity as &$id) {
        unset($json[$id]);
    }
    $sql = "SELECT passedVehicleRecordID, editedPlate FROM `UserActivities`
    WHERE passedVehicleRecordID IN $IDSquey AND status = 1";
    $result = $conn->query($sql);
    $edited = [];
    if($result->num_rows > 0) {
        while ( $row = $result->fetch_assoc() ) {
            $edited[] = $row;
        }
    }
    // var_dump($edited).PHP_EOL;
    foreach($edited as &$item) {
        $json[$item['passedVehicleRecordID']]['PlateValue'] = $item['editedPlate'];
    }

    $jsonArray = [];
    foreach($json as $item){
        $jsonArray[] = $item;
    }
    $jsonArray = array_filter($jsonArray);

    $jsonArray = json_encode($jsonArray);


    return $jsonArray;
}

$cameras = filter_input(INPUT_POST, "cameras");
$cameras = json_decode($cameras, true);
for($i = 0; $i < count($cameras); $i++)
    $cameras[$i] = getCameraID($cameras[$i]);



$startDate = filter_input(INPUT_POST, "startDate");
$startTime = filter_input(INPUT_POST, "startTime");
$endDate = filter_input(INPUT_POST, "endDate");
$endTime = filter_input(INPUT_POST, "endTime");

$minAcc = filter_input(INPUT_POST, "minAcc");
$maxAcc = filter_input(INPUT_POST, "maxAcc");
$minSpeed = filter_input(INPUT_POST, "minSpeed");
$maxSpeed = filter_input(INPUT_POST, "maxSpeed");

$lanes = filter_input(INPUT_POST, "lanes");
$lanes = json_decode($lanes, true);

$types = filter_input(INPUT_POST, "types");
$types = json_decode($types, true);


echo readPassedVehicleRecords($startDate, $startTime, $endDate, $endTime,
    $cameras, $lanes, $types, $minAcc, $maxAcc, $minSpeed, $maxSpeed);


$conn->close();

