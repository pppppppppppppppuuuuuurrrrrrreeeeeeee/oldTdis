<?php

require_once('functions.php');
$time = filter_input(INPUT_POST, "time");
$uname = filter_input(INPUT_POST, "uname");
$uname = getIDByUsername($uname);

$data = [];

$data[] = readUserData($time, $uname, 0);
$data[] = readUserData($time, $uname, 1);
$data[] = readUserData($time, $uname, 2);
$data[] = readUserDataPolice($time, $uname);



echo json_encode($data);

