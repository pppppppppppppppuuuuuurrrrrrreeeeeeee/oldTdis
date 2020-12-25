<?php

require 'config.php';


$sql = "SELECT DISTINCT(PoleName) FROM `CameraInformation`";

$res = $conn->query($sql);

echo json_encode($res->fetch_all(MYSQLI_ASSOC));