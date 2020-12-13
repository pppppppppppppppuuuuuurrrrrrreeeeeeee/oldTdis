<?php
require './config.php';
require './ChromePhp.php';


//////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\CAMERA FUNCTIONS////////////////////////////////////\\\\\\\\\\\
function camerasWithIDS() {
    global $conn;
    $sql = "SELECT Name, DeviceID, speed FROM `CameraInformation`";
    $res = $conn->query($sql);
    $camera = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $camera[] = [$row['DeviceID'], $row['Name'], $row['speed']];
        }
    }
    return $camera;
}
// var_dump(camerasWithIDS());

function getCameraSendToPolice() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $camerasWithIDS = camerasWithIDS();
    $sql = "SELECT COUNT(*) as count, cameraID FROM `UserActivities` WHERE police=1 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY cameraID";
    // $sql = "SELECT COUNT(*) as count, cameraID FROM `UserActivities` WHERE police=1 AND `date` >= '2020-06-07 13:25:35' AND `date` <= '2020-06-09 14:31:06' GROUP BY cameraID";
    ChromePhp::log($sql.PHP_EOL);
    $res = $conn->query($sql);
    $cameraIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $camID = $row['cameraID'];
            foreach($camerasWithIDS as &$cam) {
                if($camID == $cam[0]) {
                    $cameraIdsWithCounts[] = [$cam[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($camerasWithIDS as &$cam) {
        $find = false;
        for($i = 0; $i < count($cameraIdsWithCounts); $i++) {
            if($cam[1] == $cameraIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $cameraIdsWithCounts[] = [$cam[1], 0];
        }
    }
    usort($cameraIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $cameraIdsWithCounts;
}



function getCameraDIDNTSendToPolice() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $cameras = camerasWithIDS();
    $all = [];
    foreach ($cameras as &$cam) {
        $speed = $cam[2];
        $camName = $cam[1];
        $camId = $cam[0];
        $sql = "SELECT ID FROM `PassedVehicleRecords` WHERE CameraID = $camId AND Speed > $speed AND PassedTime >= '$startDate $startTime' AND PassedTime <= '$endDate $endTime'";
        ChromePhp::log($sql.PHP_EOL);
        $allPaseed = [];
        $res = $conn->query($sql);
        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $allPaseed[] = $row['ID'];
            }
        }
        $sentToPolice = [];
        $sql = "SELECT passedVehicleRecordID FROM `UserActivities` WHERE cameraID = $camId AND police = 1 AND date >= '$startDate $startTime' AND date <= '$endDate $endTime'";
        ChromePhp::log($sql.PHP_EOL);
        $res = $conn->query($sql);
        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $sentToPolice[] = $row['passedVehicleRecordID'];
            }
        }

        for ($i=0; $i < count($allPaseed); $i++) { 
            for ($j=0; $j < count($sentToPolice); $j++) { 
                if($allPaseed[$i] == $sentToPolice[$j]) {
                    unset($allPaseed[$i]);
                    break;
                }
            }
        }
        $allPaseed = array_values($allPaseed);
        $all[] = [$camName, count($allPaseed)];
    }
    usort($all, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return ($all);
}
// var_dump(getCameraDIDNTSendToPolice());
function getCameraUnseen() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $cameras = camerasWithIDS();
    $all = [];
    foreach ($cameras as &$cam) {
        $speed = $cam[2];
        $camName = $cam[1];
        $camId = $cam[0];
        $sql = "SELECT ID FROM `PassedVehicleRecords` WHERE CameraID = $camId AND Speed > $speed AND PassedTime >= '$startDate $startTime' AND PassedTime <= '$endDate $endTime'";
        ChromePhp::log($sql.PHP_EOL);
        $allPaseed = [];
        $res = $conn->query($sql);
        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $allPaseed[] = $row['ID'];
            }
        }
        $observed = [];
        $sql = "SELECT passedVehicleRecordID FROM `UserActivities` WHERE cameraID = $camId AND status = 0 AND date >= '$startDate $startTime' AND date <= '$endDate $endTime'";
        ChromePhp::log($sql.PHP_EOL);
        $res = $conn->query($sql);
        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $observed[] = $row['passedVehicleRecordID'];
            }
        }

        for ($i=0; $i < count($allPaseed); $i++) { 
            for ($j=0; $j < count($observed); $j++) { 
                if($allPaseed[$i] == $observed[$j]) {
                    unset($allPaseed[$i]);
                    break;
                }
            }
        }
        $allPaseed = array_values($allPaseed);
        $all[] = [$camName, count($allPaseed)];
    }
    usort($all, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return ($all);
}


function getCameraAllRecives() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $camerasWithIDS = camerasWithIDS();
    $sql = "SELECT COUNT(*) as count, CameraID FROM `PassedVehicleRecords` WHERE `PassedTime` >= '$startDate $startTime' AND `PassedTime` <= '$endDate $endTime' GROUP BY CameraID";
    // $sql = "SELECT COUNT(*) as count, CameraID FROM `PassedVehicleRecords` WHERE `PassedTime` >= '2020-06-14 13:21:49' AND `PassedTime` <= '2020-06-14 13:22:00' GROUP BY CameraID";
    ChromePhp::log($sql.PHP_EOL);
    $res = $conn->query($sql);
    $cameraIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $camID = $row['CameraID'];
            foreach($camerasWithIDS as &$cam) {
                if($camID == $cam[0]) {
                    $cameraIdsWithCounts[] = [$cam[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($camerasWithIDS as &$cam) {
        $find = false;
        for($i = 0; $i < count($cameraIdsWithCounts); $i++) {
            if($cam[1] == $cameraIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $cameraIdsWithCounts[] = [$cam[1], 0];
        }
    }
    usort($cameraIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $cameraIdsWithCounts;
}

function getCameraReports() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $camerasWithIDS = camerasWithIDS();
    $sql = "SELECT COUNT(*) as count, CameraID FROM `UserActivities` WHERE status > 2 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY CameraID";
    // $sql = "SELECT COUNT(*) as count, CameraID FROM `UserActivities` WHERE status > 2 AND `date` >= '2020-06-07 13:40:13' AND `date` <= '2020-06-08 00:34:43' GROUP BY CameraID";
    ChromePhp::log($sql.PHP_EOL);
    $res = $conn->query($sql);
    $cameraIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $camID = $row['CameraID'];
            foreach($camerasWithIDS as &$cam) {
                if($camID == $cam[0]) {
                    $cameraIdsWithCounts[] = [$cam[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($camerasWithIDS as &$cam) {
        $find = false;
        for($i = 0; $i < count($cameraIdsWithCounts); $i++) {
            if($cam[1] == $cameraIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $cameraIdsWithCounts[] = [$cam[1], 0];
        }
    }
    usort($cameraIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $cameraIdsWithCounts;
}

function getCameraObserves() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $camerasWithIDS = camerasWithIDS();
    $sql = "SELECT COUNT(*) as count, CameraID FROM `UserActivities` WHERE status = 0 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY CameraID";
    // $sql = "SELECT COUNT(*) as count, CameraID FROM `UserActivities` WHERE status = 0 AND `date` >= '2020-06-07 13:24:23' AND `date` <= '2020-06-07 13:26:46' GROUP BY CameraID";
    ChromePhp::log($sql.PHP_EOL);
    $res = $conn->query($sql);
    $cameraIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $camID = $row['CameraID'];
            foreach($camerasWithIDS as &$cam) {
                if($camID == $cam[0]) {
                    $cameraIdsWithCounts[] = [$cam[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($camerasWithIDS as &$cam) {
        $find = false;
        for($i = 0; $i < count($cameraIdsWithCounts); $i++) {
            if($cam[1] == $cameraIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $cameraIdsWithCounts[] = [$cam[1], 0];
        }
    }
    usort($cameraIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $cameraIdsWithCounts;
}

function getCameraEdits() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $camerasWithIDS = camerasWithIDS();
    $sql = "SELECT COUNT(*) as count, CameraID FROM `UserActivities` WHERE status = 1 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY CameraID";
    // $sql = "SELECT COUNT(*) as count, CameraID FROM `UserActivities` WHERE status = 1 AND `date` >= '2020-06-07 13:24:23' AND `date` <= '2020-06-07 13:26:05' GROUP BY CameraID";
    ChromePhp::log($sql.PHP_EOL);
    $res = $conn->query($sql);
    $cameraIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $camID = $row['CameraID'];
            foreach($camerasWithIDS as &$cam) {
                if($camID == $cam[0]) {
                    $cameraIdsWithCounts[] = [$cam[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($camerasWithIDS as &$cam) {
        $find = false;
        for($i = 0; $i < count($cameraIdsWithCounts); $i++) {
            if($cam[1] == $cameraIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $cameraIdsWithCounts[] = [$cam[1], 0];
        }
    }
    usort($cameraIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $cameraIdsWithCounts;
}


function getCameraReportsTable() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $camerasWithIDS = camerasWithIDS();
    foreach($camerasWithIDS as &$camera) {
        $camid = $camera[0];
        $camera[10] = 0;
        $camera[11] = 0;
        $camera[12] = 0;
        $camera[13] = 0;
        $camera[14] = 0;
        $camera[15] = 0;
        $sql = "SELECT status FROM `UserActivities` WHERE cameraID = $camid AND status > 2 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime'";
        ChromePhp::log("reports table".PHP_EOL);
        ChromePhp::log($sql.PHP_EOL);

        $res = $conn->query($sql);
        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $status = $row['status'];
                $camera[$status] += 1;
            }
        }
    }
    return($camerasWithIDS);
}
// var_dump(getCameraSendToPolice());
// var_dump(getCameraAllRecives());
// var_dump(getCameraReports());
// var_dump(getCameraObserves());
// var_dump(getCameraEdits());

//////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ END CAMERA FUNCTIONS////////////////////////////////////\\\\\\\\\\\
//////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  USER FUNCTIONS////////////////////////////////////\\\\\\\\\\\

function usersWithIds() {
    global $conn;
    $sql = "SELECT ID, Username FROM `Users`";
    $res = $conn->query($sql);
    $users = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $users[] = [$row['ID'], $row['Username']];
        }
    }
    return $users;
}
function getUsersObserves() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $userWithIds = usersWithIds();
    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status=0 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY userID";
    ChromePhp::log($sql.PHP_EOL);
    $res = $conn->query($sql);
    $userIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $userId = $row['userID'];
            foreach($userWithIds as &$user) {
                if($userId == $user[0]) {
                    $userIdsWithCounts[] = [$user[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($userWithIds as &$user) {
        $find = false;
        for($i = 0; $i < count($userIdsWithCounts); $i++) {
            if($user[1] == $userIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $userIdsWithCounts[] = [$user[1], 0];
        }
    }
    usort($userIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $userIdsWithCounts;
}

function getUsersEdits() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $userWithIds = usersWithIds();
    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status=1 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY userID";
    ChromePhp::log($sql.PHP_EOL);

    $res = $conn->query($sql);
    $userIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $userId = $row['userID'];
            foreach($userWithIds as &$user) {
                if($userId == $user[0]) {
                    $userIdsWithCounts[] = [$user[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($userWithIds as &$user) {
        $find = false;
        for($i = 0; $i < count($userIdsWithCounts); $i++) {
            if($user[1] == $userIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $userIdsWithCounts[] = [$user[1], 0];
        }
    }
    usort($userIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $userIdsWithCounts;
}

function getUsersSendToPolice() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $userWithIds = usersWithIds();
    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE police=1 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY userID";
    ChromePhp::log($sql.PHP_EOL);

    $res = $conn->query($sql);
    $userIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $userId = $row['userID'];
            foreach($userWithIds as &$user) {
                if($userId == $user[0]) {
                    $userIdsWithCounts[] = [$user[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($userWithIds as &$user) {
        $find = false;
        for($i = 0; $i < count($userIdsWithCounts); $i++) {
            if($user[1] == $userIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $userIdsWithCounts[] = [$user[1], 0];
        }
    }
    usort($userIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $userIdsWithCounts;
}


function getUsersReports() {
    global $conn, $startDate, $startTime, $endDate, $endTime;
    $userWithIds = usersWithIds();
    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status > 2 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime' GROUP BY userID";
    ChromePhp::log($sql.PHP_EOL);

    $res = $conn->query($sql);
    $userIdsWithCounts = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $userId = $row['userID'];
            foreach($userWithIds as &$user) {
                if($userId == $user[0]) {
                    $userIdsWithCounts[] = [$user[1], (int)$row['count']];
                    break;
                }
            }
        }
    }
    foreach($userWithIds as &$user) {
        $find = false;
        for($i = 0; $i < count($userIdsWithCounts); $i++) {
            if($user[1] == $userIdsWithCounts[$i][0])
                $find = true;
        }
        if($find === false) {
            $userIdsWithCounts[] = [$user[1], 0];
        }
    }
    usort($userIdsWithCounts, function($a, $b) {
        return $a[0] <=> $b[0];
    });
    return $userIdsWithCounts;
}
//////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\END  USER FUNCTIONS////////////////////////////////////\\\\\\\\\\\
//////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  MAP FUNCTIONS////////////////////////////////////\\\\\\\\\\\
/////////////////////////\\\\\\\\\\\\\\\\\\\\\\ive been used global variables in map functions with void: functions
function readStateTags() {
    global $conn, $stateAndTags, $statesAndAllRecivesCounts, $statesAndInfractionsCounts,
    $statesAndObserveCounts, $statesAndEditCounts;
    $sql = "SELECT * FROM statesTags";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $stateAndTags[] = [$row["state"], explode(',', $row["tags"]), $row['name']];
        ////Assignmet default value 0 Zero
        $statesAndAllRecivesCounts[$row["state"]] = 0;
        $statesAndInfractionsCounts[$row["state"]] = 0;
        $statesAndObserveCounts[$row["state"]] = 0;
        $statesAndEditCounts[$row["state"]] = 0;
    }
    }
}

function calculateAllRecives() {
    global $conn, $stateAndTags, $statesAndAllRecivesCounts, $startDate, $startTime, $endDate, $endTime;
    $sql = "SELECT PlateValue FROM PassedVehicleRecords WHERE PassedTime >= '$startDate $startTime' AND PassedTime <= '$endDate $endTime'";
    $result = $conn->query($sql);

    ChromePhp::log($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $lastTwoNum = substr($row['PlateValue'], -2);
            $flag = false;
            foreach($stateAndTags as &$stateNtag) {
                if($flag)
                    break;
                foreach($stateNtag[1] as &$code) {
                    if($lastTwoNum == $code) {
                        $statesAndAllRecivesCounts[$stateNtag[0]] += 1;
                        $flag = true;
                        break;
                    }
                }
            }
        }
    }
    // ChromePhp::log($statesAndAllRecivesCounts);
}


function calculateInfractions() {
    global $conn, $stateAndTags, $statesAndInfractionsCounts, $startDate, $startTime, $endDate, $endTime;
    $sql = "SELECT editedPlate FROM UserActivities WHERE police = 1 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime'";
    $result = $conn->query($sql);

    ChromePhp::log($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $lastTwoNum = substr($row['editedPlate'], -2);
            $flag = false;
            foreach($stateAndTags as &$stateNtag) {
                if($flag)
                    break;
                foreach($stateNtag[1] as &$code) {
                    if($lastTwoNum == $code) {
                        $statesAndInfractionsCounts[$stateNtag[0]] += 1;
                        $flag = true;
                        break;
                    }
                }
            }
        }
    }
    // ChromePhp::log($statesAndInfractionsCounts);
}

function calculateObserves() {
    global $conn, $stateAndTags, $statesAndObserveCounts, $startDate, $startTime, $endDate, $endTime;
    $sql = "SELECT editedPlate FROM UserActivities WHERE `status` = 0 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime'";
    $result = $conn->query($sql);

    ChromePhp::log($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $lastTwoNum = substr($row['editedPlate'], -2);
            $flag = false;
            foreach($stateAndTags as &$stateNtag) {
                if($flag)
                    break;
                foreach($stateNtag[1] as &$code) {
                    if($lastTwoNum == $code) {
                        $statesAndObserveCounts[$stateNtag[0]] += 1;
                        $flag = true;
                        break;
                    }
                }
            }
        }
    }
    // ChromePhp::log($statesAndObserveCounts);
}


function calculateEdits() {
    global $conn, $stateAndTags, $statesAndEditCounts, $startDate, $startTime, $endDate, $endTime;
    $sql = "SELECT editedPlate FROM UserActivities WHERE `status` = 1 AND `date` >= '$startDate $startTime' AND `date` <= '$endDate $endTime'";
    $result = $conn->query($sql);

    ChromePhp::log($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $lastTwoNum = substr($row['editedPlate'], -2);
            $flag = false;
            foreach($stateAndTags as &$stateNtag) {
                if($flag)
                    break;
                foreach($stateNtag[1] as &$code) {
                    if($lastTwoNum == $code) {
                        $statesAndEditCounts[$stateNtag[0]] += 1;
                        $flag = true;
                        break;
                    }
                }
            }
        }
    }
    // ChromePhp::log($statesAndObserveCounts);
}

//////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\END  MAP FUNCTIONS////////////////////////////////////\\\\\\\\\\\
