<?php

function wrtiteDashboard($uname, $pass, $usergrup, $time) {
  if($usergrup == 'Administrator') {
    echo str_replace(['{user-name}', '{time-login}', '{$uname}', '{$pass}', '{$usergrup}', '{$time}'], [$uname, $time, $uname, $pass, $usergrup, $time], file_get_contents(__DIR__."/../views/html/dashbord-admin.html"));
  } else {
    echo str_replace(['{user-name}', '{time-login}', '{$uname}', '{$pass}', '{$usergrup}', '{$time}'], [$uname, $time, $uname, $pass, $usergrup, $time], file_get_contents(__DIR__."/../views/html/dashbord-user.html"));
  }
}
