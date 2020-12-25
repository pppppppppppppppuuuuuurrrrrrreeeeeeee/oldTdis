<?php
require_once 'config.php';


$sql = "SELECT Name From `CameraInformation`";

$res = $conn->query($sql);

echo json_encode($res->fetch_all(MYSQLI_ASSOC));