<?php


require_once 'config.php';
require_once __DIR__.'/../ChromePhp.php';

date_default_timezone_set('Asia/Tehran');

function readCameras() {
    global $conn;
    $cameras = [];
    $sql = "SELECT Name, DeviceID, Enable FROM CameraInformation";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $cameras[] = [$row['Name'], $row['DeviceID'], $row['Enable']];
        }
    } else {
        return [];
    }
    return $cameras;

}

function readCamerasDeviceIDS() {
    global $conn;
    $cameras = [];
    $sql = "SELECT DeviceID FROM CameraInformation";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $cameras[] = $row['DeviceID'];
        }
    } else {
        return [];
    }
    return $cameras;

}

function readStates() {
    global $conn;
    $states = [];
    $sql = "SELECT State FROM `CameraInformation` GROUP BY State";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $states[] = $row['State'];
        }
    } else {
        return [];
    }
    return $states;
}

function getIDsByStates() {
    global $conn;
    $states = readStates();
    $all = [];
    foreach($states as &$state) {
        $any = [];
        $sql = "SELECT DeviceID FROM `CameraInformation` WHERE State = '$state'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $any[] = $row['DeviceID'];
        }
        $all[] = [$state, $any];
    }
    return $all;
}

function getIRMapData() {
    // global $conn;
    // $sql = "SELECT * FROM States";
    // $res = $conn->query($sql);
    // $allStates = [];
    // while( $row = $res->fetch_assoc() ) {
    //     $allStates[] = [$row['state'], $row['codes']];
    // }
    // $stateCounts = [];
    // foreach($allStates as &$state) {
    //     $sql = "SELECT PlateValue "
    // }
}




function readPassedVehicleRecords(&$startDate, &$startTime, &$endDate,
&$endTime, &$speed, &$accuracy, &$lane, &$whiteList, &$vehicles, &$cameraId, &$camera)
{
    global $conn;
    $startDateGeo = '';
    $endDateGeo = '';

    require_once('./miladiBeShmsi.php');

    $startDate = explode('/', $startDate);
    $startDateGeo =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

    $endDate = explode('/', $endDate);
    $endDateGeo =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);
    
    $whiteQuery = "WhiteList = 0";
    if($whiteList == 1) {
        $whiteQuery = "WhiteList > 0";
    }
    // echo $startDateGeo.PHP_EOL;
    // echo $endDateGeo.PHP_EOL;
    // echo $whiteList.PHP_EOL;

    $sql = "SELECT * FROM `PassedVehicleRecords` 
    WHERE PassedTime >= '$startDateGeo $startTime'
    AND PassedTime <= '$endDateGeo $endTime'
    AND Speed > $speed
    AND Accuracy >= $accuracy
    AND Lane IN $lane
    AND $whiteQuery
    AND VehicleType IN ($vehicles)".PHP_EOL;
    if($camera != "تمام دوربین ها") {
        $sql .= "AND CameraID = $cameraId";
    }
   // echo $sql.PHP_EOL;

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
   ChromePhp::log(count($jsonArray));

    $jsonArray = json_encode($jsonArray);


    return $jsonArray;
}

function readPassedVehicleRecordsAll(&$startDate, &$startTime, &$endDate,
&$endTime, &$speed, &$accuracy, &$lane, &$whiteList, &$vehicles, &$cameraId, &$camera)
{
    global $conn;
    $startDateGeo = '';
    $endDateGeo = '';

    require_once('./miladiBeShmsi.php');

    $startDate = explode('/', $startDate);
    $startDateGeo =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

    $endDate = explode('/', $endDate);
    $endDateGeo =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);
    
    $whiteQuery = "WhiteList = 0";
    if($whiteList == 1) {
        $whiteQuery = "WhiteList > 0";
    }
    // echo $startDateGeo.PHP_EOL;
    // echo $endDateGeo.PHP_EOL;
    // echo $whiteList.PHP_EOL;

    $sql = "SELECT * FROM `PassedVehicleRecords` 
    WHERE PassedTime >= '$startDateGeo $startTime'
    AND PassedTime <= '$endDateGeo $endTime'
    AND Speed >= $speed
    AND Accuracy >= $accuracy
    AND Lane IN $lane
    AND $whiteQuery
    AND VehicleType IN ($vehicles)".PHP_EOL;
    if($camera != "تمام دوربین ها") {
        $sql .= "AND CameraID = $cameraId";
    }
   // echo $sql.PHP_EOL;

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

    $sql = "SELECT passedVehicleRecordID, police FROM `UserActivities`
    WHERE passedVehicleRecordID IN $IDSquey";
    $result = $conn->query($sql);
    $IDSUserActivity = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // echo "be police ersal shode".PHP_EOL;
            if( $row["police"] > 0 )
                $json[$row['passedVehicleRecordID']]['police'] = 1; 
        }
    }

    $sql = "SELECT passedVehicleRecordID FROM `UserActivities`
    WHERE passedVehicleRecordID IN $IDSquey
    AND (status >= 2)";
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
    $jsonArray = json_encode($jsonArray);
    return $jsonArray;
}

function getCameraID($name){
  global $conn;
  $name = trim($name);
  $sql = "SELECT DeviceID FROM `CameraInformation` WHERE Name='$name'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc(); 
  return $row["DeviceID"];
}

function getImageByUrl($url) {
    return [$url];
}

function dateCompare($date) {
    $date = new DateTime($date);
    $today = new DateTime(date("Y-m-d H:i:s"));

    $daysDiff = $today->diff($date)->days;
    $hoursDiff = $today->diff($date)->h;
    if ($daysDiff == 0 && $hoursDiff <= 24)
        return 'green'; //today
    elseif ($daysDiff == 1 && $hoursDiff <= 24) {
        return 'yellow'; //yesterday
    }
    else {
        return 'red'; //before yesterday
    }
}

function readCamerasLatestDateStatus() {
    global $conn;
    $cameraIDS = readCamerasDeviceIDS();
    $allCameras = [];
    foreach ($cameraIDS as &$id) {
        $sql = "SELECT PassedTime FROM `PassedVehicleRecords` WHERE CameraID='$id' ORDER BY PassedTime DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $allCameras[] = [$id, dateCompare($row['PassedTime'])];
        }
    }
    return $allCameras;
}

function readUserData($day, $user, $status) {
    global $conn;
    $start = date('Y-m-d 00:00:00');
    $end = date('Y-m-d 23:59:59');
    if ($day == "Yesterday") {
        $start = date('Y-m-d 00:00:00', strtotime("-1 days"));
        $end = date('Y-m-d 23:59:59', strtotime("-1 days"));
    } elseif ($day == "Month") {
        $start = date('Y-m-d 00:00:00', strtotime("-1 months"));
        $end = date('Y-m-d 23:59:59', strtotime("-1 days"));
    } elseif ($day == "Year") {
        $start = date('Y-m-d 00:00:00', strtotime("-1 years"));
        $end = date('Y-m-d 23:59:59', strtotime("-1 days"));
    }
    $sql = "SELECT COUNT(*) AS count FROM `UserActivities` WHERE
    date >= '$start' AND date <= '$end' AND
    userID = '$user' AND
    status = $status";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}
function readUserDataPolice($day, $user) {
    global $conn;
    $start = date('Y-m-d 00:00:00');
    $end = date('Y-m-d 23:59:59');
    if ($day == "Yesterday") {
        $start = date('Y-m-d 00:00:00', strtotime("-1 days"));
        $end = date('Y-m-d 23:59:59', strtotime("-1 days"));
    } elseif ($day == "Month") {
        $start = date('Y-m-d 00:00:00', strtotime("-1 months"));
        $end = date('Y-m-d 23:59:59', strtotime("-1 days"));
    } elseif ($day == "Year") {
        $start = date('Y-m-d 00:00:00', strtotime("-1 years"));
        $end = date('Y-m-d 23:59:59', strtotime("-1 days"));
    }
    $sql = "SELECT COUNT(*) AS count FROM `UserActivities` WHERE
    date >= '$start' AND date <= '$end' AND
    userID = '$user' AND
    police > 0";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'];
}


function AllVisibles() {
    global $conn;
    $data = [];
    $sql = "SELECT COUNT(*) AS count FROM `UserActivities` WHERE
    status = 0
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data[] = $row['count'];

    $sql = "SELECT COUNT(*) AS count FROM `UserActivities` WHERE
    status = 1
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data[] = $row['count'];

    $sql = "SELECT COUNT(*) AS count FROM `UserActivities` WHERE
    status = 2
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data[] = $row['count'];

    $sql = "SELECT COUNT(*) AS count FROM `UserActivities` WHERE
    police > 0
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $data[] = $row['count'];
    
    return $data;
}


function allUsers() {
    global $conn;
    $users = [];
    $sql = "SELECT * FROM `Users` ORDER BY `Users`.`ID` ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $users[] = $row['Username'];
    }
    return $users;
}

function getIDByUsername($username){
    global $conn;
    $sql = "SELECT ID FROM `Users` WHERE Username = '$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        return $row['ID'];
    }
    return null;
}

