<?php
require_once '../vendor/autoload.php';

function getPDFExport(&$headers, &$values) {
    $name = getHTMLExport($headers, $values);
    $name = str_replace('http://192.168.98.162/export/', '', $name);
    try
    {
        // create the API client instance
        $client = new \Pdfcrowd\HtmlToPdfClient("alipure", "3e678f3f0ed689ebeab70937b79daea6");

        // run the conversion and write the result to a file
        $pdfName = str_replace('html', 'pdf', $name);
        $client->convertFileToFile("../export/$name", "../export/$pdfName");

        return "http://192.168.98.162/export/$pdfName";
    }
    catch(\Pdfcrowd\Error $why)
    {
        // report the error
        error_log("Pdfcrowd Error: {$why}\n");

        // rethrow or handle the exception
        throw $why;
    }
}
function getHTMLExport(&$headers, &$values) {
    $headerHTML = '';
    foreach($headers as &$header) {
        $headerHTML .= "<th>$header</th>";
    }

    $valuesHTML = "";
    foreach($values as &$value) {
        $tr = '<tr>';
        foreach($value as &$item) {
            $tr .= "<td>$item</td>";
        }
        $tr .= '</tr>';
        $valuesHTML .= $tr;
    }
    $content = <<< lable
<!DOCTYPE html>
<html>
<head>
<style>
<!-- boot strap 4-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
  font-size: 10px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-sm-10" style="text-align: center">
            <table style="text-align: center">
            <tr>
            $headerHTML
            </tr>
            $valuesHTML
            </table>
        </div>
    </div>
</div>

</body>
</html>

lable;
    $name = time().'report.html';
    $myfile = fopen("../export/".$name, "w") or die('active chmod');
    fwrite($myfile, $content);
    fclose($myfile);
    $url = "http://192.168.98.162/export/$name";
    return $url;
    
}

require_once('config.php');
require_once('functions.php');

if( isset($_GET['cameras']) ) {
    $cameras = readCameras();
    $json = [];
    foreach($cameras as &$cam) {
        $json[] = $cam[0];
    }
    echo json_encode($json);
    die();
}

if( isset($_GET['users']) ) {
    echo json_encode(allUsers());
    die();
}

// var_dump($_POST);
// die();

$cameraDataBase = filter_input(INPUT_POST, "cameraDataBase");
$userDataBase = filter_input(INPUT_POST, "userDataBase");

$startDate = filter_input(INPUT_POST, "startDate");
$startTime = filter_input(INPUT_POST, "startTime");
$endDate = filter_input(INPUT_POST, "endDate");
$endTime = filter_input(INPUT_POST, "endTime");


require_once('./miladiBeShmsi.php');
$startDateGeo = '';
$endDateGeo = '';


$startDate = explode('/', $startDate);
$startDateGeo =  jalali_to_gregorian($startDate[0], $startDate[1], $startDate[2], true);

$endDate = explode('/', $endDate);
$endDateGeo =  jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], true);

$sql = '';

if($cameraDataBase == 'true') {
    $lightVehicle = filter_input(INPUT_POST, "lightVehicle");
    $heavyVehicle = filter_input(INPUT_POST, "heavyVehicle");
    $unkownVehicle = filter_input(INPUT_POST, "unkownVehicle");

    $arrvehicle = [];

    if($lightVehicle == 'true')
        $arrvehicle[] = 1;

    if($heavyVehicle == 'true')
        $arrvehicle[] = 2;

    if($unkownVehicle == 'true')
        $arrvehicle[] = 0;

    $arrvehicle = '('.implode(",",$arrvehicle).')';
    

    $upToDown = filter_input(INPUT_POST, "upToDown");
    $downToUp = filter_input(INPUT_POST, "downToUp");

    $arrDirections = [];

    if($upToDown == 'true')
        $arrDirections[] = 0;

    if($downToUp == 'true')
        $arrDirections[] = 1;

    $arrDirections = '('.implode(",",$arrDirections).')';

    
    //Speed >= $startSpeed AND
    //Speed <= $endSpeed AND
    $querySpeed = "";
    $startSpeed = filter_input(INPUT_POST, "startSpeed");
    $endSpeed = filter_input(INPUT_POST, "endSpeed");
    if($startSpeed != '')
        $querySpeed .= " Speed >= $startSpeed AND ";
    if($endSpeed != '')
        $querySpeed .= " Speed <= $endSpeed AND ";

    $lane1 = filter_input(INPUT_POST, "lane1");
    $lane2 = filter_input(INPUT_POST, "lane2");
    $lane3 = filter_input(INPUT_POST, "lane3");
    $lane4 = filter_input(INPUT_POST, "lane4");
    $lane5 = filter_input(INPUT_POST, "lane5");
    $lane6 = filter_input(INPUT_POST, "lane6");

    $lanes = [];

    if($lane1 == 'true')
        $lanes[] = 0;
    if($lane2 == 'true')
        $lanes[] = 1;
    if($lane3 == 'true')
        $lanes[] = 2;
    if($lane4 == 'true')
        $lanes[] = 3;
    if($lane5 == 'true')
        $lanes[] = 4;
    if($lane6 == 'true')
        $lanes[] = 5;

    $lanes = '('.implode(',', $lanes).')';
    

    $plate = filter_input(INPUT_POST, "plate");
    $queryPlate = '';
    if($plate != 'undefined')
        $queryPlate = "MasterPlateValue = $plate AND ";

    $whiteList = filter_input(INPUT_POST, "whiteList");

    if($whiteList == 'true')
        $whiteList = "WhiteList > 0";
    else
        $whiteList = 'WhiteList = 0';

    $suspicious = filter_input(INPUT_POST, "suspicious");

    if($suspicious == 'true')
        $suspicious = "Suspicious <> ''";
    else
        $suspicious = "Suspicious = ''";

    $cameraQuery = '';

    $camerasInp = filter_input(INPUT_POST, "camerasInp");
    $camerasInp = explode(',', $camerasInp);
    $cameraIds = [];
    foreach($camerasInp as &$cam) {
        if($cam == 'تمام دوربین ها') {
            $cameraIds = null;
            break;
        }
        $cameraIds[] = getCameraID($cam);
    }

    if ( $cameraIds != null ) {
        $cameraIds = '('.implode(',', $cameraIds).')';
        $cameraQuery = "AND CameraID IN $cameraIds";
    }

    //Accuracy >= $startAcc AND
    //Accuracy <= $endAcc AND
    $queryAccuracy = '';
    $startAcc = filter_input(INPUT_POST, "startAcc");
    $endAcc = filter_input(INPUT_POST, "endAcc");
    if($startAcc != '')
        $queryAccuracy .= " Accuracy >= $startAcc AND ";
    if($endAcc != '')
        $queryAccuracy .= " Accuracy <= $endAcc AND ";

    $sql = "SELECT * FROM `PassedVehicleRecords` WHERE
    PassedTime >= '$startDateGeo $startTime' AND
    PassedTime <= '$endDateGeo $endTime' AND
    Direction IN $arrDirections AND
    $querySpeed
    Lane IN $lanes AND
    $queryAccuracy
    VehicleType IN $arrvehicle AND
    $queryPlate
    $suspicious AND 
    $whiteList
    $cameraQuery
    ";



} else {
    $usersQuery = '';

    $usersInp = filter_input(INPUT_POST, "usersInp");
    $usersInp = explode(',', $usersInp);
    $usersIds = [];
    foreach($usersInp as &$user) {
        if($user == 'تمام کاربران') {
            $usersIds = null;
            break;
        }
        $usersIds[] = getIDByUsername($user);
    }

    if ( $usersIds != null ) {
        $usersIds = '('.implode(',', $usersIds).')';
        $usersQuery = "AND userID IN $usersIds";
    }

    $operationsQuery = '';
    $operationsInp = filter_input(INPUT_POST, "operationsInp");
    $operationsInp = explode(',', $operationsInp);
    $operationsIds = [];
    foreach($operationsInp as &$opt) {
        if($opt == 'تمام عملیات') {
            $operationsIds = null;
            break;
        }
        if($opt == 'مشاهده') {
            $operationsIds[] = 0;
        } elseif ($opt == 'ویرایش') {
            $operationsIds[] = 1;
        } elseif ($opt == 'حذف') {
            $operationsIds[] = 2;
        }
    }

    if ( $operationsIds != null ) {
        $operationsIds = '('.implode(',', $operationsIds).')';
        $operationsQuery = "AND status IN $operationsIds";
    }
    

    $sql = "SELECT * FROM `UserActivities` WHERE 
    date >= '$startDateGeo $startTime' AND
    date <= '$endDateGeo $endTime'
    $usersQuery
    $operationsQuery
    ";
}

$html = filter_input(INPUT_POST, "html");
$pdf = filter_input(INPUT_POST, "pdf");
// echo $sql.PHP_EOL;
$txt = [];
$result = $conn->query($sql);
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $txt[] = $row;
    }
}

if($html == 'true') {
    echo getHTMLExport(array_keys($txt[0]), $txt);
}
else{
    echo getPDFExport(array_keys($txt[0]), $txt);
}
