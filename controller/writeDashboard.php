<?php

function wrtiteDashboard($uname, $pass, $usergrup) {
  $now = date('H:i:s');
  if($usergrup == 'Administrator') {
    echo str_replace(['{user-name}', '{time-login}', '{$uname}', '{$pass}', '{$usergrup}', '{$time}'], [$uname, $now, $uname, $pass, $usergrup, $now], file_get_contents(__DIR__."/../views/html/dashbord-admin.html"));
  } else {
    echo str_replace(['{user-name}', '{time-login}', '{$uname}', '{$pass}', '{$usergrup}', '{$time}'], [$uname, $now, $uname, $pass, $usergrup, $now], file_get_contents(__DIR__."/../views/html/dashbord-user.html"));
  }
}
