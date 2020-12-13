<?php
date_default_timezone_set('Asia/Tehran');
require_once('functions.php');
require_once('config.php');

$cameras = readCameras();
$lablesAndValues = [];

$today = date('Y-m-d');
// echo $today.PHP_EOL;
$sql = "SELECT DISTINCT Name FROM CameraInformation";
$res = $conn->query($sql);
$lablesAndValues = [];
if ($res->num_rows > 0) {
    while( $row = $res->fetch_assoc() ) {
        $lablesAndValues[] = [$row['Name'], 0];
    }
}

$sql = "SELECT CameraInformation.Name, t.tedad FROM CameraInformation
 INNER JOIN (SELECT CameraID, count(*)
  AS tedad FROM PassedVehicleRecords
   where PassedTime > '$today'
    GROUP BY CameraID) AS t ON
     CameraInformation.DeviceID = t.CameraID
";
//echo $sql.PHP_EOL;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        for($i = 0; $i < count($lablesAndValues); $i++) {
            if($lablesAndValues[$i][0] == $row['Name']) {
                $lablesAndValues[$i][1] = $row['tedad'];
                break;
            }  
        }
    }
}
$lablesAndValues = json_encode($lablesAndValues);

// echo date('Y-m-d H:i:s');
echo $lablesAndValues;
