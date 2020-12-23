<?php
require_once __DIR__.'/reportFunctions.php';
require_once __DIR__.'/miladiBeShmsi.php';

$status = filter_input(INPUT_POST, 'status');
if($status == 'readCams') 
{
    echo json_encode(camerasWithIDS());
} 
else if ($status == 'readUsers') 
{
    echo json_encode(readUsers());
} 
else if($status == 'readPassedCols') 
{
    echo json_encode(readPassedVehicleRecordsCols());
} 
else if($status == 'readUsrCols') 
{
    echo json_encode(readUsrActivitiesCols());
} 
else if ($status == 'PassedVehicleRecords') 
{
    $cols = filter_input(INPUT_POST, 'cols');
    $boll = filter_input(INPUT_POST, 'boll');
    $startDate = filter_input(INPUT_POST, 'startDate');
    $startTime = filter_input(INPUT_POST, 'startTime');
    $endDate = filter_input(INPUT_POST, 'endDate');
    $endTime = filter_input(INPUT_POST, 'endTime');

    $Poles = filter_input(INPUT_POST, 'Poles');
    $Cameras = filter_input(INPUT_POST, 'Cameras');

    $AccuracyMin = filter_input(INPUT_POST, 'AccuracyMin');
    $AccuracyMax = filter_input(INPUT_POST, 'AccuracyMax');
    $minSpeed = filter_input(INPUT_POST, 'minSpeed');
    $maxSpeed = filter_input(INPUT_POST, 'maxSpeed');
    $lane1 = filter_input(INPUT_POST, 'lane1');
    $lane2 = filter_input(INPUT_POST, 'lane2');
    $lane3 = filter_input(INPUT_POST, 'lane3');
    $lane4 = filter_input(INPUT_POST, 'lane4');
    $lane5 = filter_input(INPUT_POST, 'lane5');
    $upToDown = filter_input(INPUT_POST, 'upToDown');
    $downToUp = filter_input(INPUT_POST, 'downToUp');
    $vehicleLight = filter_input(INPUT_POST, 'vehicleLight');
    $vehicleHeavy = filter_input(INPUT_POST, 'vehicleHeavy');
    $plate = filter_input(INPUT_POST, 'plate');


    //converting dates
    $startDate = explode('/', $startDate);
    $startDate =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

    $endDate = explode('/', $endDate);
    $endDate =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);
    
    //poles and cameras
    $Poles = explode(',', $Poles);
    ChromePhp::log($Poles);
    ChromePhp::log($Cameras);
    if($cameraNames === "" or $cameraIds === "") 
    {
        $cameraQuery = "";
    }
    else 
    {
        $cameraNames = explode(',', $cameraNames);
        $cameraAllIDs = [];
        foreach($cameraNames as &$names) 
        {
            $cameraAllIDs[] = getCameraID($names);
        }
        $cameraIds = explode(',', $cameraIds);
        $cameraAllIDs = array_merge($cameraAllIDs, $cameraIds);
        $cameraAllIDs = array_filter(array_unique($cameraAllIDs));
        $cameraQuery = "";
        if(count($cameraAllIDs) > 0) 
        {
            $cameraQuery =  "AND CameraID IN (".implode(',', $cameraAllIDs).")";
        }
    }
    
    //acc
    if($AccuracyMin === "" and $AccuracyMax === "") 
    {
        $AccuracyQuery = "";
    } 
    else if($AccuracyMax !== "" and $AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMax !== "")
    {
        $AccuracyQuery = "AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin";
    }
    //speed
    if($minSpeed === "" and $maxSpeed === "") 
    {
        $speedQuery = "";
    } 
    else if($maxSpeed !== "" and $minSpeed !== "") 
    {
        $speedQuery = "AND Speed >= $minSpeed AND Speed <= $maxSpeed";
    } 
    else if($maxSpeed !== "") 
    {
        $speedQuery = "AND Speed <= $maxSpeed";
    } 
    else if($minSpeed !== "") 
    {
        $speedQuery = "AND Speed >= $minSpeed";
    }

    //lanes
    $lanes = [];
    if($lane1 === "true") 
    {
        array_push($lanes, 1);
    }
    if($lane2 === "true") 
    {
        array_push($lanes, 2);
    }
    if($lane3 === "true") {
        array_push($lanes, 3);
    }
    if($lane4 === "true") 
    {
        array_push($lanes, 4);
    }
    if($lane5 === "true") 
    {
        array_push($lanes, 5);
    }
    $lanesQuery = "";
    if(count($lanes) > 0) 
    {
        $lanes = "(".implode("," , $lanes).")";
        $lanesQuery = "AND Lane IN $lanes";
    }

    //dirs 
    $dir = [];
    if($upToDown === "true") 
    {
        array_push($dir, 1);
    }
    if($downToUp === "true") 
    {
        array_push($dir, 2);
    }
    $dirQuery = "";
    if(count($dir) > 0) {
        $dir = "(".implode("," , $dir).")";
        $dirQuery = "AND Direction IN $dir";
    }

    //vehs
    $veh = [];
    if($vehicleLight === "true")
    {
        array_push($veh, 1);
    }
    if($vehicleHeavy === "true") 
    {
        array_push($veh, 2);
    }
    if($vehicleUnkown === "true") 
    {
        array_push($veh, 0);
    }

    $vehQuery = "";
    if(count($veh) > 0) 
    {
        $veh = "(".implode("," , $veh).")";
        $vehQuery = "AND VehicleType IN $veh";
    }

    //create SQL
    $sql = "
    SELECT {?} FROM `PassedVehicleRecords` WHERE
    PassedTime >= '$startDate $startTime' AND PassedTime <= '$endDate $endTime'
    $cameraQuery
    $AccuracyQuery
    $speedQuery
    $lanesQuery
    $dirQuery
    $vehQuery
    AND MasterPlateValue LIKE '$plate'";

    $sqlCount = str_replace('{?}', 'COUNT(*)', $sql);
    if($boll == 'false') 
    {
        echo sqlCountStar($sqlCount);
        return;
    }
    if(sqlCountStar($sqlCount) !== 0) 
    {
        Report(str_replace('{?}', $cols, $sql), $cols);
    }
    else 
    {
        echo "no rec!";
    }

} 
else if ($status == 'innerJoin') 
{
    $cols = filter_input(INPUT_POST, 'cols');
    $boll = filter_input(INPUT_POST, 'boll');
    $Usrcols = filter_input(INPUT_POST, 'Usrcols');
    $startDate = filter_input(INPUT_POST, 'startDate');
    $startTime = filter_input(INPUT_POST, 'startTime');
    $endDate = filter_input(INPUT_POST, 'endDate');
    $endTime = filter_input(INPUT_POST, 'endTime');
    $cameraNames = filter_input(INPUT_POST, 'cameraNames');
    $cameraIds = filter_input(INPUT_POST, 'cameraIds');
    $AccuracyMin = filter_input(INPUT_POST, 'AccuracyMin');
    $AccuracyMax = filter_input(INPUT_POST, 'AccuracyMax');
    $minSpeed = filter_input(INPUT_POST, 'minSpeed');
    $maxSpeed = filter_input(INPUT_POST, 'maxSpeed');
    $lane1 = filter_input(INPUT_POST, 'lane1');
    $lane2 = filter_input(INPUT_POST, 'lane2');
    $lane3 = filter_input(INPUT_POST, 'lane3');
    $lane4 = filter_input(INPUT_POST, 'lane4');
    $lane5 = filter_input(INPUT_POST, 'lane5');
    $upToDown = filter_input(INPUT_POST, 'upToDown');
    $downToUp = filter_input(INPUT_POST, 'downToUp');
    $vehicleLight = filter_input(INPUT_POST, 'vehicleLight');
    $vehicleHeavy = filter_input(INPUT_POST, 'vehicleHeavy');
    $vehicleUnkown = filter_input(INPUT_POST, 'vehicleUnkown');
    $plate = filter_input(INPUT_POST, 'plate');
    $usrObs = filter_input(INPUT_POST, 'usrObs');
    $usrEdi = filter_input(INPUT_POST, 'usrEdi');
    $usrDEL = filter_input(INPUT_POST, 'usrDEL');
    $usrSENT = filter_input(INPUT_POST, 'usrSENT');

    // var_dump($usrObs);
    // var_dump($usrEdi);
    // var_dump($usrDEL);
    // var_dump($usrSENT);


    //converting dates
    $startDate = explode('/', $startDate);
    $startDate =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

    $endDate = explode('/', $endDate);
    $endDate =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);
    
    if($cameraNames === "" or $cameraIds === "") 
    {
        $cameraQuery = "";
    }
    else 
    {
        $cameraNames = explode(',', $cameraNames);
        $cameraAllIDs = [];
        foreach($cameraNames as &$names) 
        {
            array_push($cameraAllIDs, $names);
        }
        $cameraIds = explode(',', $cameraIds);
        $cameraAllIDs = array_merge($cameraAllIDs, $cameraIds);
        $cameraAllIDs = array_filter(array_unique($cameraAllIDs));
        $cameraQuery = "";
        if(count($cameraAllIDs) > 0) 
        {
            $cameraQuery =  "AND CameraID IN (".implode(',', $cameraAllIDs).")";
        }
    }
    
    //acc
    if($AccuracyMin === "" and $AccuracyMax === "") 
    {
        $AccuracyQuery = "";
    } 
    else if($AccuracyMax !== "" and $AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMax !== "") 
    {
        $AccuracyQuery = "AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin";
    }
    //speed
    if($minSpeed === "" and $maxSpeed === "") 
    {
        $speedQuery = "";
    } 
    else if($maxSpeed !== "" and $minSpeed !== "") 
    {
        $speedQuery = "AND Speed >= $minSpeed AND Speed <= $maxSpeed";
    } 
    else if($maxSpeed !== "") 
    {
        $speedQuery = "AND Speed <= $maxSpeed";
    } 
    else if($minSpeed !== "")
    {
        $speedQuery = "AND Speed >= $minSpeed";
    }

    //lanes
    $lanes = [];
    if($lane1 === "true") 
    {
        array_push($lanes, 1);
    }
    if($lane2 === "true") 
    {
        array_push($lanes, 2);
    }
    if($lane3 === "true")
    {
        array_push($lanes, 3);
    }
    if($lane4 === "true") 
    {
        array_push($lanes, 4);
    }
    if($lane5 === "true") 
    {
        array_push($lanes, 5);
    }
    $lanesQuery = "";
    if(count($lanes) > 0) 
    {
        $lanes = "(".implode("," , $lanes).")";
        $lanesQuery = "AND Lane IN $lanes";
    }

    //dirs 
    $dir = [];
    if($upToDown === "true") 
    {
        array_push($dir, 1);
    }
    if($downToUp === "true") 
    {
        array_push($dir, 2);
    }
    $dirQuery = "";
    if(count($dir) > 0) 
    {
        $dir = "(".implode("," , $dir).")";
        $dirQuery = "AND Direction IN $dir";
    }

    //vehs
    $veh = [];
    if($vehicleLight === "true") 
    {
        array_push($veh, 1);
    }
    if($vehicleHeavy === "true")
    {
        array_push($veh, 2);
    }
    if($vehicleUnkown === "true") 
    {
        array_push($veh, 0);
    }

    $vehQuery = "";
    if(count($veh) > 0) 
    {
        $veh = "(".implode("," , $veh).")";
        $vehQuery = "AND VehicleType IN $veh";
    }

    //create camera SQL
    $sqlCamera = "
        SELECT {?} FROM `PassedVehicleRecords` WHERE
        PassedTime >= '$startDate $startTime' AND PassedTime <= '$endDate $endTime'
        $cameraQuery
        $AccuracyQuery
        $speedQuery
        $lanesQuery
        $dirQuery
        $vehQuery
        AND MasterPlateValue LIKE '$plate'";
        
    $sqlCamera = str_replace('{?}', $cols, $sqlCamera);
    
    //create users SQL
    if($usrObs === "AllOftheUsers") 
    {
        $observeQuery = "status = 0";
    }
    else if($usrObs === "") 
    {
        $observeQuery = "status = 0 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrObs = explode(',', $usrObs);
        foreach($usrObs as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $observeQuery = "status = 0 AND userID IN $allIDs";
    }

    if($usrEdi === "AllOftheUsers") 
    {
        $editQuery = "status = 1";
    }
    else if($usrEdi === "") 
    {
        $editQuery = "status = 1 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrEdi = explode(',', $usrEdi);
        foreach($usrEdi as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $editQuery = "status = 1 AND userID IN $allIDs";
    }

    if($usrDEL === "AllOftheUsers") 
    {
        $deletesQuery = "status = 2";
    }

    else if($usrDEL === "") 
    {
        $deletesQuery = "status = 2 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrDEL = explode(',', $usrDEL);
        foreach($usrDEL as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $deletesQuery = "status = 2 AND userID IN $allIDs";
    }


    if($usrSENT === "AllOftheUsers") 
    {
        $sentsQuery = "police = 1";
    }
    else if($usrSENT === "") 
    {
        $sentsQuery = "police = 1 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrSENT = explode(',', $usrSENT);
        foreach($usrSENT as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $sentsQuery = "police = 1 AND userID IN $allIDs";
    }

    $sqlUser = "
        SELECT {?} FROM `UserActivities` WHERE
        ($observeQuery) OR
        ($editQuery) OR
        ($deletesQuery) OR
        ($sentsQuery)
    ";
    $sqlUser = str_replace('{?}', $Usrcols, $sqlUser);

    $finalSql = "
        SELECT {?}
        FROM ($sqlCamera) AS A
        JOIN ($sqlUser) AS B
        ON A.ID = B.passedVehicleRecordID
    ";

    $cols = explode(',', $cols);
    $Usrcols = explode(',', $Usrcols);
    $clomns = array_merge($cols, $Usrcols);
    $clomns = implode(',', $clomns);

    $sqlCount = str_replace('{?}', 'COUNT(*)', $finalSql);
    if($boll == 'false') {
        echo sqlCountStar($sqlCount);
        return;
    }
    if(sqlCountStar($sqlCount) !== 0) {
        Report(str_replace('{?}', "*", $finalSql), $clomns);
    } else {
        echo "no rec!";
    }
} 
else if($status == "PassedVehicleRecordsZip") {
    $cols = filter_input(INPUT_POST, 'cols');
    $boll = filter_input(INPUT_POST, 'boll');
    $startDate = filter_input(INPUT_POST, 'startDate');
    $startTime = filter_input(INPUT_POST, 'startTime');
    $endDate = filter_input(INPUT_POST, 'endDate');
    $endTime = filter_input(INPUT_POST, 'endTime');
    $cameraNames = filter_input(INPUT_POST, 'cameraNames');
    $cameraIds = filter_input(INPUT_POST, 'cameraIds');
    $AccuracyMin = filter_input(INPUT_POST, 'AccuracyMin');
    $AccuracyMax = filter_input(INPUT_POST, 'AccuracyMax');
    $minSpeed = filter_input(INPUT_POST, 'minSpeed');
    $maxSpeed = filter_input(INPUT_POST, 'maxSpeed');
    $lane1 = filter_input(INPUT_POST, 'lane1');
    $lane2 = filter_input(INPUT_POST, 'lane2');
    $lane3 = filter_input(INPUT_POST, 'lane3');
    $lane4 = filter_input(INPUT_POST, 'lane4');
    $lane5 = filter_input(INPUT_POST, 'lane5');
    $upToDown = filter_input(INPUT_POST, 'upToDown');
    $downToUp = filter_input(INPUT_POST, 'downToUp');
    $vehicleLight = filter_input(INPUT_POST, 'vehicleLight');
    $vehicleHeavy = filter_input(INPUT_POST, 'vehicleHeavy');
    $vehicleUnkown = filter_input(INPUT_POST, 'vehicleUnkown');
    $plate = filter_input(INPUT_POST, 'plate');


    //converting dates
    $startDate = explode('/', $startDate);
    $startDate =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

    $endDate = explode('/', $endDate);
    $endDate =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);
    
    if($cameraNames === "" or $cameraIds === "") 
    {
        $cameraQuery = "";
    }
    else 
    {
        $cameraNames = explode(',', $cameraNames);
        $cameraAllIDs = [];
        foreach($cameraNames as &$names) 
        {
            $cameraAllIDs[] = getCameraID($names);
        }
        $cameraIds = explode(',', $cameraIds);
        $cameraAllIDs = array_merge($cameraAllIDs, $cameraIds);
        $cameraAllIDs = array_filter(array_unique($cameraAllIDs));
        $cameraQuery = "";
        if(count($cameraAllIDs) > 0) 
        {
            $cameraQuery =  "AND CameraID IN (".implode(',', $cameraAllIDs).")";
        }
    }
    
    //acc
    if($AccuracyMin === "" and $AccuracyMax === "") 
    {
        $AccuracyQuery = "";
    } 
    else if($AccuracyMax !== "" and $AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMax !== "")
    {
        $AccuracyQuery = "AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin";
    }
    //speed
    if($minSpeed === "" and $maxSpeed === "") 
    {
        $speedQuery = "";
    } 
    else if($maxSpeed !== "" and $minSpeed !== "") 
    {
        $speedQuery = "AND Speed >= $minSpeed AND Speed <= $maxSpeed";
    } 
    else if($maxSpeed !== "") 
    {
        $speedQuery = "AND Speed <= $maxSpeed";
    } 
    else if($minSpeed !== "") 
    {
        $speedQuery = "AND Speed >= $minSpeed";
    }

    //lanes
    $lanes = [];
    if($lane1 === "true") 
    {
        array_push($lanes, 1);
    }
    if($lane2 === "true") 
    {
        array_push($lanes, 2);
    }
    if($lane3 === "true") {
        array_push($lanes, 3);
    }
    if($lane4 === "true") 
    {
        array_push($lanes, 4);
    }
    if($lane5 === "true") 
    {
        array_push($lanes, 5);
    }
    $lanesQuery = "";
    if(count($lanes) > 0) 
    {
        $lanes = "(".implode("," , $lanes).")";
        $lanesQuery = "AND Lane IN $lanes";
    }

    //dirs 
    $dir = [];
    if($upToDown === "true") 
    {
        array_push($dir, 1);
    }
    if($downToUp === "true") 
    {
        array_push($dir, 2);
    }
    $dirQuery = "";
    if(count($dir) > 0) {
        $dir = "(".implode("," , $dir).")";
        $dirQuery = "AND Direction IN $dir";
    }

    //vehs
    $veh = [];
    if($vehicleLight === "true")
    {
        array_push($veh, 1);
    }
    if($vehicleHeavy === "true") 
    {
        array_push($veh, 2);
    }
    if($vehicleUnkown === "true") 
    {
        array_push($veh, 0);
    }

    $vehQuery = "";
    if(count($veh) > 0) 
    {
        $veh = "(".implode("," , $veh).")";
        $vehQuery = "AND VehicleType IN $veh";
    }

    //create SQL
    $sql = "
    SELECT {?} FROM `PassedVehicleRecords` WHERE
    PassedTime >= '$startDate $startTime' AND PassedTime <= '$endDate $endTime'
    $cameraQuery
    $AccuracyQuery
    $speedQuery
    $lanesQuery
    $dirQuery
    $vehQuery
    AND MasterPlateValue LIKE '$plate'";

    $sqlCount = str_replace('{?}', 'COUNT(*)', $sql);
    if($boll == 'false') 
    {
        echo sqlCountStar($sqlCount);
        return;
    }
    if(sqlCountStar($sqlCount) !== 0) 
    {
        ReportZip(str_replace('{?}', $cols, $sql), $cols);
    }
    else 
    {
        echo "no rec!";
    }
} 
else if($status == 'innerJoinZip') {
    $cols = filter_input(INPUT_POST, 'cols');
    $boll = filter_input(INPUT_POST, 'boll');
    $Usrcols = filter_input(INPUT_POST, 'Usrcols');
    $startDate = filter_input(INPUT_POST, 'startDate');
    $startTime = filter_input(INPUT_POST, 'startTime');
    $endDate = filter_input(INPUT_POST, 'endDate');
    $endTime = filter_input(INPUT_POST, 'endTime');
    $cameraNames = filter_input(INPUT_POST, 'cameraNames');
    $cameraIds = filter_input(INPUT_POST, 'cameraIds');
    $AccuracyMin = filter_input(INPUT_POST, 'AccuracyMin');
    $AccuracyMax = filter_input(INPUT_POST, 'AccuracyMax');
    $minSpeed = filter_input(INPUT_POST, 'minSpeed');
    $maxSpeed = filter_input(INPUT_POST, 'maxSpeed');
    $lane1 = filter_input(INPUT_POST, 'lane1');
    $lane2 = filter_input(INPUT_POST, 'lane2');
    $lane3 = filter_input(INPUT_POST, 'lane3');
    $lane4 = filter_input(INPUT_POST, 'lane4');
    $lane5 = filter_input(INPUT_POST, 'lane5');
    $upToDown = filter_input(INPUT_POST, 'upToDown');
    $downToUp = filter_input(INPUT_POST, 'downToUp');
    $vehicleLight = filter_input(INPUT_POST, 'vehicleLight');
    $vehicleHeavy = filter_input(INPUT_POST, 'vehicleHeavy');
    $vehicleUnkown = filter_input(INPUT_POST, 'vehicleUnkown');
    $plate = filter_input(INPUT_POST, 'plate');
    $usrObs = filter_input(INPUT_POST, 'usrObs');
    $usrEdi = filter_input(INPUT_POST, 'usrEdi');
    $usrDEL = filter_input(INPUT_POST, 'usrDEL');
    $usrSENT = filter_input(INPUT_POST, 'usrSENT');

    // var_dump($usrObs);
    // var_dump($usrEdi);
    // var_dump($usrDEL);
    // var_dump($usrSENT);


    //converting dates
    $startDate = explode('/', $startDate);
    $startDate =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

    $endDate = explode('/', $endDate);
    $endDate =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);
    
    if($cameraNames === "" or $cameraIds === "") 
    {
        $cameraQuery = "";
    }
    else 
    {
        $cameraNames = explode(',', $cameraNames);
        $cameraAllIDs = [];
        foreach($cameraNames as &$names) 
        {
            array_push($cameraAllIDs, $names);
        }
        $cameraIds = explode(',', $cameraIds);
        $cameraAllIDs = array_merge($cameraAllIDs, $cameraIds);
        $cameraAllIDs = array_filter(array_unique($cameraAllIDs));
        $cameraQuery = "";
        if(count($cameraAllIDs) > 0) 
        {
            $cameraQuery =  "AND CameraID IN (".implode(',', $cameraAllIDs).")";
        }
    }
    
    //acc
    if($AccuracyMin === "" and $AccuracyMax === "") 
    {
        $AccuracyQuery = "";
    } 
    else if($AccuracyMax !== "" and $AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMax !== "") 
    {
        $AccuracyQuery = "AND Accuracy <= $AccuracyMax";
    } 
    else if($AccuracyMin !== "") 
    {
        $AccuracyQuery = "AND Accuracy >= $AccuracyMin";
    }
    //speed
    if($minSpeed === "" and $maxSpeed === "") 
    {
        $speedQuery = "";
    } 
    else if($maxSpeed !== "" and $minSpeed !== "") 
    {
        $speedQuery = "AND Speed >= $minSpeed AND Speed <= $maxSpeed";
    } 
    else if($maxSpeed !== "") 
    {
        $speedQuery = "AND Speed <= $maxSpeed";
    } 
    else if($minSpeed !== "")
    {
        $speedQuery = "AND Speed >= $minSpeed";
    }

    //lanes
    $lanes = [];
    if($lane1 === "true") 
    {
        array_push($lanes, 1);
    }
    if($lane2 === "true") 
    {
        array_push($lanes, 2);
    }
    if($lane3 === "true")
    {
        array_push($lanes, 3);
    }
    if($lane4 === "true") 
    {
        array_push($lanes, 4);
    }
    if($lane5 === "true") 
    {
        array_push($lanes, 5);
    }
    $lanesQuery = "";
    if(count($lanes) > 0) 
    {
        $lanes = "(".implode("," , $lanes).")";
        $lanesQuery = "AND Lane IN $lanes";
    }

    //dirs 
    $dir = [];
    if($upToDown === "true") 
    {
        array_push($dir, 1);
    }
    if($downToUp === "true") 
    {
        array_push($dir, 2);
    }
    $dirQuery = "";
    if(count($dir) > 0) 
    {
        $dir = "(".implode("," , $dir).")";
        $dirQuery = "AND Direction IN $dir";
    }

    //vehs
    $veh = [];
    if($vehicleLight === "true") 
    {
        array_push($veh, 1);
    }
    if($vehicleHeavy === "true")
    {
        array_push($veh, 2);
    }
    if($vehicleUnkown === "true") 
    {
        array_push($veh, 0);
    }

    $vehQuery = "";
    if(count($veh) > 0) 
    {
        $veh = "(".implode("," , $veh).")";
        $vehQuery = "AND VehicleType IN $veh";
    }

    //create camera SQL
    $sqlCamera = "
        SELECT {?} FROM `PassedVehicleRecords` WHERE
        PassedTime >= '$startDate $startTime' AND PassedTime <= '$endDate $endTime'
        $cameraQuery
        $AccuracyQuery
        $speedQuery
        $lanesQuery
        $dirQuery
        $vehQuery
        AND MasterPlateValue LIKE '$plate'";
        
    $sqlCamera = str_replace('{?}', $cols, $sqlCamera);
    
    //create users SQL
    if($usrObs === "AllOftheUsers") 
    {
        $observeQuery = "status = 0";
    }
    else if($usrObs === "") 
    {
        $observeQuery = "status = 0 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrObs = explode(',', $usrObs);
        foreach($usrObs as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $observeQuery = "status = 0 AND userID IN $allIDs";
    }

    if($usrEdi === "AllOftheUsers") 
    {
        $editQuery = "status = 1";
    }
    else if($usrEdi === "") 
    {
        $editQuery = "status = 1 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrEdi = explode(',', $usrEdi);
        foreach($usrEdi as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $editQuery = "status = 1 AND userID IN $allIDs";
    }

    if($usrDEL === "AllOftheUsers") 
    {
        $deletesQuery = "status = 2";
    }

    else if($usrDEL === "") 
    {
        $deletesQuery = "status = 2 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrDEL = explode(',', $usrDEL);
        foreach($usrDEL as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $deletesQuery = "status = 2 AND userID IN $allIDs";
    }


    if($usrSENT === "AllOftheUsers") 
    {
        $sentsQuery = "police = 1";
    }
    else if($usrSENT === "") 
    {
        $sentsQuery = "police = 1 AND userID NOT LIKE '%'";
    } 
    else 
    {
        $allIDs = [];
        $usrSENT = explode(',', $usrSENT);
        foreach($usrSENT as &$user) {
            array_push($allIDs, getUserID($user));
        }
        $allIDs = "(".implode(',', $allIDs).")";
        $sentsQuery = "police = 1 AND userID IN $allIDs";
    }

    $sqlUser = "
        SELECT {?} FROM `UserActivities` WHERE
        ($observeQuery) OR
        ($editQuery) OR
        ($deletesQuery) OR
        ($sentsQuery)
    ";
    $sqlUser = str_replace('{?}', $Usrcols, $sqlUser);

    $finalSql = "
        SELECT {?}
        FROM ($sqlCamera) AS A
        JOIN ($sqlUser) AS B
        ON A.ID = B.passedVehicleRecordID
    ";

    $cols = explode(',', $cols);
    $Usrcols = explode(',', $Usrcols);
    $clomns = array_merge($cols, $Usrcols);
    $clomns = implode(',', $clomns);

    $sqlCount = str_replace('{?}', 'COUNT(*)', $finalSql);
    if($boll == 'false') {
        echo sqlCountStar($sqlCount);
        return;
    }
    if(sqlCountStar($sqlCount) !== 0) {
        ReportZip(str_replace('{?}', "*", $finalSql), $clomns);
    } else {
        echo "no rec!";
    }
}
