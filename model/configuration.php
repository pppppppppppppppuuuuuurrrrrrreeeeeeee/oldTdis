<?php
require_once('config.php');
$key= filter_input(INPUT_POST, "key");

if ($key == 'deleteFlag') {
    $id= filter_input(INPUT_POST, "id");
    $sql = "DELETE FROM `Users` WHERE ID = $id";
    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    die();
}

if ($key == 'insertFlag') {
    $today = date('Y-m-d H:i:s');

    $userGroup = filter_input(INPUT_POST, "userGroup");
    $usernameInp = filter_input(INPUT_POST, "usernameInp");
    $passInp = md5(filter_input(INPUT_POST, "passInp"));

    $sql = "INSERT INTO Users (Username, Password, UserGroup, CreatedTime)
    VALUES ('$usernameInp', '$passInp', '$userGroup', '$today')";

    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    die();
}

if ($key == 'insertFlagCompany') {
    $name = filter_input(INPUT_POST, "name");
    $num = filter_input(INPUT_POST, "num");

    $sql = "INSERT INTO CompanyIDMapping (Description, CodeD) VALUES ('$name', $num)";
    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    die();
}

if ($key == 'editCompany') {
    $desc = filter_input(INPUT_POST, "desc");
    $cid = filter_input(INPUT_POST, "cid");
    $sql = "UPDATE CompanyIDMapping SET Description = '$desc' WHERE ID = $cid";
    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    die();
}

if ($key == 'editSys') {
    $sysid = filter_input(INPUT_POST, "sysid");
    $sysDesc = filter_input(INPUT_POST, "sysDesc");
    $sql = "UPDATE SystemIDMapping SET Description = '$sysDesc' WHERE ID = $sysid";
    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    die();
}

if ($key == 'editSysCid') {
    $syscid = filter_input(INPUT_POST, "syscid");
    $sysCode = filter_input(INPUT_POST, "sysCode");
    $sql = "UPDATE SystemIDMapping SET Code = '$sysCode' WHERE ID = $syscid";
    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    die();
}

if ($key == 'editCompanyCid') {
    $Coded = filter_input(INPUT_POST, "Coded");
    $cid = filter_input(INPUT_POST, "cid");
    $sql = "UPDATE CompanyIDMapping SET CodeD = '$Coded' WHERE ID = $cid";
    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    die();
}

if ($key == 'insertFlagSys') {
    $nameSys = filter_input(INPUT_POST, "nameSys");
    $codeSys = filter_input(INPUT_POST, "codeSys");
    $sql = "INSERT INTO SystemIDMapping (Description, Code) VALUES ('$nameSys', $codeSys)";
    if ($conn->query($sql) === TRUE) {
        echo "true";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    die();
}

if($key == 'insertCameraFlag') {
    $nameCamera = filter_input(INPUT_POST, "nameCamera");
    $idCamera = filter_input(INPUT_POST, "idCamera");
    $locationCamera = filter_input(INPUT_POST, "locationCamera");
    $LatitudeCamera = filter_input(INPUT_POST, "LatitudeCamera");
    $longitudeCamera = filter_input(INPUT_POST, "longitudeCamera");
    $sysCamera = filter_input(INPUT_POST, "sysCamera");
    $companyCamera = filter_input(INPUT_POST, "companyCamera");
    $stateCamera = filter_input(INPUT_POST, "stateCamera");
    $policeCamera = filter_input(INPUT_POST, "policeCamera");

    //get systemId
    $sql = "SELECT Code FROM SystemIDMapping WHERE Description = '$sysCamera'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $sysCamera = $row['Code'];

    //get companyid
    $sql = "SELECT CodeD FROM CompanyIDMapping WHERE Description = '$companyCamera'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    $companyCamera = $row['CodeD'];

    $sql = "INSERT INTO `CameraInformation` (Name, DeviceID, Location, latitude, longitude, SystemID, CompanyID, State, Enable, PoliceCode) VALUES
    ('$nameCamera', $idCamera, '$locationCamera', $LatitudeCamera, $longitudeCamera, $sysCamera, $companyCamera, '$stateCamera', 1, $policeCamera)";
    if ($conn->query($sql) === TRUE){
        echo 'true';
    } else {
        echo "error".$conn->error.PHP_EOL;
        echo $sql.PHP_EOL;
    }

    die();
}
