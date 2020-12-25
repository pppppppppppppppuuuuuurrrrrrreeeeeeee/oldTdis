<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/ChromePhp.php';
require_once __DIR__.'/lib/miladiBeShmsi.php';
ini_set('memory_limit', '-1');
header_remove('Set-Cookie');
date_default_timezone_set('Asia/Tehran');


function harfConvertor($key) {
    $alphabetKeyCode = [
        "01" => "الف",
        "02" => "ب",
        "03" => "پ",
        "04" => "ت",
        "05" => "ث",
        "06" => "ج",
        "07" => "چ",
        "10" => "د",
        "12" => "ر",
        "13" => "ز",
        "15" => "س",
        "16" => "ش",
        "17" => "ص",
        "19" => "ط",
        "21" => "ع",
        "23" => "ف",
        "24" => "ق",
        "25" => "ک",
        "26" => "گ",
        "27" => "ل",
        "28" => "م",
        "29" => "ن",
        "30" => "و",
        "31" => "ﻫ",
        "32" => "ی",
    ];
    return $alphabetKeyCode[$key];
}

function toPersianNum($number)
{
    $number = str_replace("1","۱",$number);
    $number = str_replace("2","۲",$number);
    $number = str_replace("3","۳",$number);
    $number = str_replace("4","۴",$number);
    $number = str_replace("5","۵",$number);
    $number = str_replace("6","۶",$number);
    $number = str_replace("7","۷",$number);
    $number = str_replace("8","۸",$number);
    $number = str_replace("9","۹",$number);
    $number = str_replace("0","۰",$number);
    return $number;
}

function sqlCountStar($sql) {
    global $conn;
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    return (int)$row['COUNT(*)'];
}

function Report($sql, $columns) {
    ChromePhp::log($sql);

    global $conn;
    $now = date('Y-m-d H_i_s');
    chdir('export');
    mkdir($now) or die('cant create dir');
    chdir($now);
    mkdir('data');
    chdir('data');

    //create table headers
    $columns = explode(',', $columns);
    $headers = "";
    $headers .= "<th>row</th>";
    foreach($columns as &$head) {
        if($head == 'ImageAddress') {
            $headers .= "<th>".'tag image'."</th>";
            $headers .= "<th>".'vehicle image'."</th>";
        } else {
            $headers .= "<th>".$head."</th>";
        }
    }

    $result = $conn->query($sql);
    $content = "";
    if($result->num_rows > 0) {
        $i = 0;
        $z = 0;
        $pageNumber = 0;
        while($row = $result->fetch_assoc()) {
            if($i == 500) {
                $i = 0;
                $pageNumber++;
                file_put_contents($pageNumber, $content);
                $content = "";
            }
            $tr = "<tr>";
            $tr .= "<td>".($z + 1)."</td>";
            foreach($columns as &$head) {
                if($head == "PassedTime" or $head == "date") {
                    $dateTime = explode(' ', $row[$head]);
                    $date = $dateTime[0];
                    $time = $dateTime[1];
                    $date = explode('-', $date);
                    $date =  gregorian_to_jalali($date[0], $date[1], $date[2], true);
                    $tr .= "
                        <td>
                            $date $time
                        </td>
                    ";
                } 
                else if($head == "ImageAddress") {
                    $veh = $src = $row[$head];
                    $src = str_replace("I.jpg", "P.jpg", $src);
                    $alt = $row['MasterPlateValue'];
                    $root = getRoot();
                    $tr .= "
                    <td>
                        <img style=\"width:200px; height:60px;\" src =\"$root/store/$src\" alt=\"$alt\" onclick=\"window.open(this.src)\" />
                    </td>
                    ";
                    $tr .= "
                    <td>
                        <img style=\"width:200px; height:100px;\" src =\"$root/store/$veh\" alt=\"$alt\" onclick=\"window.open(this.src)\" />
                    </td>
                    ";
                }                
                else if($head == "MasterPlateValue" or $head == 'editedPlate') {
                    $val = $row[$head];
                    $twoFirstNum = toPersianNum(substr($val, 0, 2));
                    $harf = harfConvertor(substr($val, 2, 2));
                    $threeNum = toPersianNum(substr($val, 4, 3));
                    $lastTwonum = toPersianNum(substr($val, 7, 2));
                    $tr .= "
                    <td>
                        <div class=\"plateBox plateWhite\">
                            <div class=\"box1\">
                                <input class=\"boxNumber1\" value=\"$twoFirstNum\" name=\"plate\" type=\"text\" readonly>
                            </div>
                            <div class=\"box2\">
                                <input class=\"boxNumber2\" value=\"$harf\" name=\"plate\" type=\"text\" readonly>
                            </div>
                            <div class=\"box3\">
                                <input class=\"boxNumber3\" value=\"$threeNum\" name=\"plate\" type=\"text\" readonly>
                            </div>
                            <div class=\"box4\">
                                <input class=\"boxNumber4\" value=\"$lastTwonum\" name=\"plate\" type=\"text\" readonly>
                            </div>
                        </div>
                    </td>
                    ";
                }
                else {
                    $tr .= "<td>".$row[$head]."</td>";
                }
            }
            $tr .= "</tr>";
            $content .= $tr;

            //conter plus plus
            $i++;
            $z++;
        }
        $pageNumber++;
        file_put_contents($pageNumber, $content);

        chdir('..');
        $html = str_replace(['{headers}', '{title}', '{len}'], [$headers, "$now Report", $pageNumber], file_get_contents('../../templates/localReport.html'));
        if(file_put_contents("index.html", $html) !== FALSE) {
            echo "export/$now/index.html";
        } else {
            echo "fail";
        }
    }

}

function ReportZip($sql, $columns) {
    ChromePhp::log($sql);

    global $conn;
    $now = date('Y-m-d H_i_s');
    chdir('export');
    mkdir($now) or die('cant create dir');
    chdir($now);
    mkdir('data');
    chdir('data');
    copy('../../../lib/bootstrap.min.css', 'bootstrap.min.css');
    copy('../../../fonts/roya/BRoyaBold.woff', 'BRoyaBold.woff');
    copy('../../../fonts/roya/BRoyaBold.woff2', 'BRoyaBold.woff2');
    copy('../../../lib/jquery.min.js', 'jquery.min.js');
    copy('../../../lib/popper.min.js', 'popper.min.js');
    copy('../../../lib/bootstrap.min.js', 'bootstrap.min.js');
    copy('../../../img/plateWhite.png', 'plateWhite.png');
    //create table headers
    $columns = explode(',', $columns);
    $headers = "";
    $headers .= "<th>row</th>";
    foreach($columns as &$head) {
        if($head == 'ImageAddress') {
            $headers .= "<th>".'tag image'."</th>";
            $headers .= "<th>".'vehicle image'."</th>";
        } else {
            $headers .= "<th>".$head."</th>";
        }
    }

    $result = $conn->query($sql);
    $content = "";
    $dataString = "";
    if($result->num_rows > 0) {
        $i = 0;
        $z = 0;
        $pageNumber = 0;
        while($row = $result->fetch_assoc()) {
            if($i == 500) {
                $i = 0;
                $pageNumber++;
                $dataString .= "data.push(`$content`);";
                // file_put_contents($pageNumber, $content);
                $content = "";
            }
            $tr = "<tr>";
            $tr .= "<td>".($z + 1)."</td>";
            foreach($columns as &$head) {
                if($head == "PassedTime" or $head == "date") {
                    $dateTime = explode(' ', $row[$head]);
                    $date = $dateTime[0];
                    $time = $dateTime[1];
                    $date = explode('-', $date);
                    $date =  gregorian_to_jalali($date[0], $date[1], $date[2], true);
                    $tr .= "<td>$date $time</td>";
                } 
                else if($head == "ImageAddress") {
                    $veh = $src = $row[$head];
                    $src = str_replace("I.jpg", "P.jpg", $src);
                    $plateName = explode('/', $src);
                    $plateName = $plateName[count($plateName) - 1];
                    $vehName = explode('/', $veh);
                    $vehName = $vehName[count($vehName) - 1];
                    copy("/var/www/html/store/$src", $plateName);
                    copy("/var/www/html/store/$veh", $vehName);
                    $alt = $row['MasterPlateValue'];
                    $tr .= "<td><img style=\"width:200px; height:60px;\" src =\"./data/$plateName\" onclick=\"window.open(this.src)\" alt=\"$alt\" /></td>";
                    $tr .= "<td><img style=\"width:200px; height:100px;\" src =\"./data/$vehName\" onclick=\"window.open(this.src)\" alt=\"$alt\" /></td>";
                }                
                else if($head == "MasterPlateValue" or $head == 'editedPlate') {
                    $val = $row[$head];
                    $twoFirstNum = toPersianNum(substr($val, 0, 2));
                    $harf = harfConvertor(substr($val, 2, 2));
                    $threeNum = toPersianNum(substr($val, 4, 3));
                    $lastTwonum = toPersianNum(substr($val, 7, 2));
                    $tr .= "<td><div class=\"plateBox plateWhite\"><div class=\"box1\"><input class=\"boxNumber1\" value=\"$twoFirstNum\" name=\"plate\" type=\"text\" readonly></div><div class=\"box2\"><input class=\"boxNumber2\" value=\"$harf\" name=\"plate\" type=\"text\" readonly></div><div class=\"box3\"><input class=\"boxNumber3\" value=\"$threeNum\" name=\"plate\" type=\"text\" readonly></div><div class=\"box4\"><input class=\"boxNumber4\" value=\"$lastTwonum\" name=\"plate\" type=\"text\" readonly></div></div></td>";
                }
                else {
                    $tr .= "<td>".$row[$head]."</td>";
                }
            }
            $tr .= "</tr>";
            $content .= $tr;

            //conter plus plus
            $i++;
            $z++;
        }
        $pageNumber++;
        // file_put_contents($pageNumber, $content);
        $dataString .= "data.push(`$content`);";

        chdir('..');
        $html = str_replace(['{headers}', '{title}', '{len}', '{dataArr}'], [$headers, "$now Report", $pageNumber, $dataString], file_get_contents('../../templates/expReport.html'));
        if(file_put_contents("index.html", $html) !== FALSE) {
            echo "export/$now/index.html";
        } else {
            echo "fail";
        }
    }
}

function getCameraID($name){
    global $conn;
    $name = trim($name);
    $sql = "SELECT DeviceID FROM `CameraInformation` WHERE Name='$name'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
    return $row["DeviceID"];
}

function getUserID($username) {
    global $conn;
    $username = trim($username);
    $sql = "SELECT ID FROM `Users` WHERE Username='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
    return $row["ID"];
}

function camerasWithIDS() {
    global $conn;
    $sql = "SELECT Name, DeviceID, speed FROM `CameraInformation`";
    $res = $conn->query($sql);
    $camera = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $camera[] = [$row['DeviceID'], $row['Name'], $row['speed']];
        }
    }
    return $camera;
}


function readUsers() {
    global $conn;
    $sql = "SELECT Username FROM `Users`";
    $res = $conn->query($sql);
    $usr = [];
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $usr[] = $row['Username'];
        }
    }
    return $usr;
}

function readPassedVehicleRecordsCols() {
    global $conn, $dbname;
    $sql = "SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='$dbname' AND `TABLE_NAME`='PassedVehicleRecords' ORDER BY ORDINAL_POSITION ASC";
    $all = [];
    $res = $conn->query($sql);
    if($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $all[] = $row['COLUMN_NAME'];
        }
    }
    return $all;
}

function readUsrActivitiesCols() {
    global $conn, $dbname;
    $sql = "SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='$dbname' AND `TABLE_NAME`='UserActivities' ORDER BY ORDINAL_POSITION ASC";
    $all = [];
    $res = $conn->query($sql);
    if($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $all[] = $row['COLUMN_NAME'];
        }
    }
    return $all;
}

// var_dump(readUsrActivitiesCols());
