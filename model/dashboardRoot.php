<?php

require_once('functions.php');

if(!isset($_GET['users']))
    echo json_encode(AllVisibles());

if(isset($_GET['users']))
    echo json_encode(allUsers());


