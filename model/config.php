<?php
$host = "localhost";
$username = "root";
$database = "MonitoringAnpr";
$password = "Anpr@1234";

// Create connection
$conn = new mysqli($host, $username, $password, $database);
//set charset
$conn -> set_charset("utf8");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
