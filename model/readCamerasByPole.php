<?php

require 'config.php';

$pole = $_POST['pole'];

$sql = "SELECT Name FROM `CameraInformation` WHERE PoleName = '$pole'";

$res = $conn->query($sql);

echo json_encode($res->fetch_all(MYSQLI_ASSOC));