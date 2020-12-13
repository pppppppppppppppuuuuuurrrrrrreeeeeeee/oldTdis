<?php 
require_once('config.php');
require_once('functions.php');


$sql = "SELECT DeviceID, latitude, longitude FROM `CameraInformation` WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
$cams = [];

$result = $conn->query($sql);
if( $result-> num_rows > 0) {
    while( $row = $result->fetch_assoc() ) {
        $cams[] = $row;
    }
}

$infos = [];
foreach($cams as &$cam) {
    $deviceId = $cam['DeviceID'];
    $sql = "SELECT PlateValue, Lane, PassedTime, VehicleType, ImageAddress FROM `PassedVehicleRecords` WHERE CameraID = $deviceId ORDER BY ID DESC LIMIT 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['ImageAddress'] = getImageByUrl($row['ImageAddress']);
            $infos[] = [$cam, $row];
        }
    }
}
echo json_encode($infos);

