<?php

require "config.php";

function getPoliceStatus() {
    global $conn;
    $sql = "SELECT policeStatus, DeviceID FROM `CameraInformation` WHERE policeStatus = 7";
    $res = $conn->query($sql);
    $all = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $all[] = $row['DeviceID'];
        }
    }
    echo json_encode($all);
}
getPoliceStatus();