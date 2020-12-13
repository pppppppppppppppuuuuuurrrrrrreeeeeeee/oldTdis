<?php
date_default_timezone_set('Asia/Tehran');

$returnValue = filter_input(INPUT_POST, "returnValue");
$recId = filter_input(INPUT_POST, "recId");
$time = date("Y-m-d H:i:s");

$myfile = fopen("packetProblems.txt", "a") or die("Unable to open file!");
$txt = <<< lable

time: $time
return value: $returnValue
record id in passedvehiclerecords: $recId
-------------------------------------------------------
lable;
fwrite($myfile, $txt);
fclose($myfile);

