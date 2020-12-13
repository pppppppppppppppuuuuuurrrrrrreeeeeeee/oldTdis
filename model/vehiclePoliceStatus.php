<?php
require_once 'config.php';

function sentToPolice($passedVehicleRecordId) {
    global $conn;
    $sql = "SELECT police FROM `UserActivities` WHERE passedVehicleRecordID = $passedVehicleRecordId";
    $res = $conn->query($sql);
    if($res->num_rows) {
        $row = $res->fetch_assoc();
        $row['police'] = (int) $row['police'];
        if($row['police'] == 0) {
            return false;
        }
        return true;
    }
    return false;
}

echo json_encode(sentToPolice($_POST['passId']));