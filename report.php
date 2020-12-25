<?php
$username = filter_input(INPUT_POST, "username");
$pass = filter_input(INPUT_POST, "password");
$usergrup = filter_input(INPUT_POST, "usergrup");
$time = filter_input(INPUT_POST, "time");
if (!isset($_POST['username'])) {
    die('Access denied! You are not login!');
} else {
    echo str_replace(['{username}', '{time}', '{password}', '{usergrup}'], [$username, $time, $pass, $usergrup], file_get_contents(__DIR__."/views/html/report.html"));
}
