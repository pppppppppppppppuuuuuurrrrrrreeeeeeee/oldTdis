<?php

require_once('config.php');
require_once('functions.php');

//start observe
if(isset($_GET['todayObserve'])) {
    //select all user ids
    $datas = [];

    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $sql = "SELECT DISTINCT userID FROM `UserActivities`";
    $res = $conn->query($sql);
    if( $res->num_rows > 0) {
        while ($row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], 0];
        }
    }

    $today = date('Y-m-d');

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 0 AND date > '$today' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            for($i = 0; $i < count($datas); $i++) {
                if($datas[$i][0] == $row['userID']) {
                    $datas[$i][1] = $row['count'];
                    break;
                }  
            }
        }
    }
    echo json_encode($datas);
    

    die();
}



if(isset($_GET['yesterdayObserve'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime(("-1 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 0 AND date < '$today' AND date > '$yesterday' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}


if(isset($_GET['weekObserve'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $week = date('Y-m-d', strtotime(("-7 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 0 AND date < '$today' AND date > '$week' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}

//start edit

if(isset($_GET['todayEdit'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 1 AND date > '$today' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}



if(isset($_GET['yesterdayEdit'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime(("-1 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 1 AND date < '$today' AND date > '$yesterday' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}


if(isset($_GET['weekEdit'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $week = date('Y-m-d', strtotime(("-7 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 1 AND date < '$today' AND date > '$week' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}


//start Delete

if(isset($_GET['todayDelete'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 2 AND date > '$today' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}



if(isset($_GET['yesterdayDelete'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime(("-1 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 2 AND date < '$today' AND date > '$yesterday' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}


if(isset($_GET['weekDelete'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $week = date('Y-m-d', strtotime(("-7 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE status = 2 AND date < '$today' AND date > '$week' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}


//start SendToPolice

if(isset($_GET['todaySendToPolice'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE police > 0 AND date > '$today' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}



if(isset($_GET['yesterdaySendToPolice'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d', strtotime(("-1 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE police > 0 AND date < '$today' AND date > '$yesterday' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}


if(isset($_GET['weekSendToPolice'])) {
    //select all user ids
    $allusers = allUsers();
    $allUsersIds = [];
    foreach($allusers as &$user){
        $allUsersIds[] = getIDByUsername($user);
    }

    $datas = [];
    $today = date('Y-m-d');
    $week = date('Y-m-d', strtotime(("-7 days")));

    $sql = "SELECT COUNT(*) as count, userID FROM `UserActivities` WHERE police > 0 AND date < '$today' AND date > '$week' GROUP BY userID";
    $res = $conn->query($sql);
    if( $res -> num_rows > 0){
        while( $row = $res->fetch_assoc() ) {
            $datas[] = [$row['userID'], $row['count']];
        }
    }
    echo json_encode($datas);
    

    die();
}

