<?php
require_once 'config.php';
require_once '../ChromePhp.php';


function getCameraSendInfo($id) {
    global $conn;
    $sql = "SELECT * FROM `CameraInformation` WHERE DeviceID = '$id'";
    ChromePhp::log($sql);
    $res = $conn->query($sql);
    if($res->num_rows != 1) {
        return "NULL";
    }
    $row = $res->fetch_assoc();
    return json_encode($row);
}

$id = filter_input(INPUT_POST, 'id');
echo getCameraSendInfo($id);