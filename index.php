<?php
require_once ('./model/login.php');
require_once ('./controller/writeLogin.php');
require_once ('./controller/writeDashboard.php');
require_once ('./model/config.php');
date_default_timezone_set('Asia/Tehran');
if ( isset($_POST['username']) && isset($_POST['password']) ) {
  $username = filter_input(INPUT_POST, "username");
  $password = filter_input(INPUT_POST, "password");
  $data = connect($username, $password);
  if ( $data[0] ) {
    //update last login 
    if(!isset($_POST['time'])) {
      $today = date('Y-m-d H:i:s');
      $sql = "UPDATE Users SET LastLogin = '$today' WHERE Username = '$username'";

      if ($conn->query($sql) === TRUE) {
        //render the page
        $now = date('H:i:s');
        wrtiteDashboard($username, $password, $data[1], $now);
      } else {
        die('There is a problem with database!');
      }
    }
    else {
      $now = $_POST['time'];
      wrtiteDashboard($_POST['username'], $_POST['password'], $_POST['usergrup'], $now);
    }
          
    
    
  } else {
    //show login page again
    writeLogin(false);
  }
} else {
  writeLogin(true);
}