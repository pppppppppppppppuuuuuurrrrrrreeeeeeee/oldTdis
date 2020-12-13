<?php
require_once('config.php');

function connect($uname, $pass) {
    global $conn;
    $md5pass = md5($pass);
    $sql = "SELECT * FROM Users WHERE Username = '$uname' AND Password = '$md5pass'";
    $result = $conn->query($sql);
    if ( $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        return [true, $row['UserGroup']];
    }
    return [false];
}