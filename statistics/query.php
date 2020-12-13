<?php
require_once './functions.php';
require_once './ChromePhp.php';
require __DIR__.'/lib/miladiBeShmsi.php';

$query = filter_input(INPUT_POST, 'query');
$startDate = filter_input(INPUT_POST, 'startDate');
$startTime = filter_input(INPUT_POST, 'startTime');
$endDate = filter_input(INPUT_POST, 'endDate');
$endTime = filter_input(INPUT_POST, 'endTime');

//converting dates
$startDate = explode('/', $startDate);
$startDate =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

$endDate = explode('/', $endDate);
$endDate =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);

if($query === 'map') {
    //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\map global variables
    $stateAndTags = [];
    $statesAndAllRecivesCounts = [];
    $statesAndInfractionsCounts = [];
    $statesAndObserveCounts = [];
    $statesAndEditCounts = [];

    //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\map functions for assignment global variables
    readStateTags();
    calculateAllRecives();
    calculateInfractions();
    calculateObserves();
    calculateEdits();

    ChromePhp::log($stateAndTags);


    $final = [];
    //make colors
    $rgbs = [];
    for($i = 0; $i <= 255; $i += 8) {
        $rgbs[] = "rgba($i,$i,$i, 0.7)";
    }
    //sort for colors
    arsort($statesAndAllRecivesCounts);
    $keys = array_keys($statesAndAllRecivesCounts);
    for($i = 0; $i < count($statesAndAllRecivesCounts); $i++) {
        $stdClass = new stdClass();
        $stdClass->id = $keys[$i];
        //find name
        for ($j=0; $j < count($stateAndTags); $j++) { 
            if($keys[$i] == $stateAndTags[$j][0]) {
                $stdClass->name = $stateAndTags[$j][2];
                break;
            }
        }

        $stdClass->color = $rgbs[$i];
        //AllRecives
        $stdClass->countAllRecives = $statesAndAllRecivesCounts[$keys[$i]];
        //AllInfractions
        $stdClass->countAllInfractions = $statesAndInfractionsCounts[$keys[$i]];
        $stdClass->countAllObserves = $statesAndObserveCounts[$keys[$i]];
        $stdClass->countAllEdits = $statesAndEditCounts[$keys[$i]];
        $final[$i] = $stdClass;
    }

    echo json_encode($final);
} else if($query === 'usr') {
    $userObserves = getUsersObserves();
    $userEdits = getUsersEdits();
    $UsersSendToPolice = getUsersSendToPolice();
    $UsersReports = getUsersReports();

    $json = [];
    for ($i=0; $i < count($userObserves); $i++) { 
        $stdClass = new stdClass();
        $stdClass->user = $userObserves[$i][0];
        $stdClass->observes = $userObserves[$i][1];
        $stdClass->edits = $userEdits[$i][1];
        $stdClass->sendToPolice = $UsersSendToPolice[$i][1];
        $stdClass->reports = $UsersReports[$i][1];
        $json[] = $stdClass;
    }
    echo json_encode($json);
    
} else if($query === 'cam') {
    $getCameraSendToPolice = getCameraSendToPolice();
    $getCameraAllRecives = getCameraAllRecives();
    $getCameraReports = getCameraReports();
    $getCameraObserves = getCameraObserves();
    $getCameraEdits = getCameraEdits();
    $getCameraDIDNTSendToPolice = getCameraDIDNTSendToPolice();
    $getCameraUnseen = getCameraUnseen();



    $json = [];
    for ($i=0; $i < count($getCameraSendToPolice); $i++) { 
        $stdClass = new stdClass();
        $stdClass->cam = $getCameraSendToPolice[$i][0];
        $stdClass->CameraSendToPolice = $getCameraSendToPolice[$i][1];
        $stdClass->CameraAllRecives = $getCameraAllRecives[$i][1];
        $stdClass->CameraReports = $getCameraReports[$i][1];
        $stdClass->CameraObserves = $getCameraObserves[$i][1];
        $stdClass->CameraEdits = $getCameraEdits[$i][1];
        $stdClass->CameraDIDNTSendToPolice = $getCameraDIDNTSendToPolice[$i][1];
        $stdClass->CameraUnseen = $getCameraUnseen[$i][1];
        $json[] = $stdClass;
    }
    echo json_encode($json);
} else if($query == 'repTable') {
    ChromePhp::log('getCameraReportsTable()');
    $json = getCameraReportsTable();
    ChromePhp::log($json);
    echo json_encode($json);
}


