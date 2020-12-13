<?php
require_once '../model/functions.php';


echo json_encode(array_filter(readCamerasLatestDateStatus()));