<?php exec('node multiUser.js'); ?>
<?php
$username = filter_input(INPUT_POST, "username");
$time = filter_input(INPUT_POST, "time");
if (!isset($_POST['username'])) {
    die('Access denied! You are not login!');
} else {
    echo str_replace(['{username}', '{time}'], [$username, $time], file_get_contents(__DIR__."/views/html/vio.html"));
}
