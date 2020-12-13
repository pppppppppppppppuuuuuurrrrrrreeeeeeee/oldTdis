<?php

require_once __DIR__.'/../model/config.php';



function writeUsersForRoot() {
    global $conn;
    $users = [];
    $sql = "SELECT * FROM `Users` ORDER BY `Users`.`ID` ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    foreach($users as &$user) {
        $id = $user['ID'];
        $Username = $user['Username'];
        $UserGroup = $user['UserGroup'];
        $CreatedTime = $user['CreatedTime'];
        $LastLogin = $user['LastLogin'];
        $tag = <<< lable
        <tr>
            <td>$id</td>
            <td>$Username</td>
            <td>$UserGroup</td>
            <td>$CreatedTime</td>
            <td>$LastLogin</td>
            <td onclick="deleteUser(this)" id="$id"><button type="button" class="btn btn-danger"><i class="material-icons">clear</i></button></td>
        </tr>
lable;
        echo $tag.PHP_EOL;
    }
    
}

function writeCompanies() {
    global $conn;
    $companies = [];
    $sql = "SELECT * FROM `CompanyIDMapping` ORDER BY `CompanyIDMapping`.`ID` ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    foreach($users as &$user) {
        $id = $user['ID'];
        $code = $user['CodeD'];
        $Description = $user['Description'];
        $tag = <<< lable
        <tr>
            <td>$id</td>
            <td><input type="text" defaultValue="$code" value="$code" id="companyCid$id" readonly="readonly"><button type="button" class="btn btn-info" id="submitCid$id" onclick="editCompanyCid('companyCid$id', this, 'editCid$id')">edit</button><button type="button" class="btn btn-danger" id="editCid$id" style="display: none;" onclick="closeCompanyCid('submitCid$id', this, 'companyCid$id')">close</button></td>
            <td><input type="text" defaultValue="$Description" value="$Description" id="company$id" readonly="readonly"><button type="button" class="btn btn-info" id="submit$id" onclick="editCompany('company$id', this, 'edit$id')">edit</button><button type="button" class="btn btn-danger" id="edit$id" style="display: none;" onclick="closeCompany('submit$id', this, 'company$id')">close</button></td>
            <td onclick="deleteCompany(this)" id="$id"><button type="button" class="btn btn-danger"><i class="material-icons">clear</i></button></td>
        </tr>
lable;
        echo $tag.PHP_EOL;
    }
    
}

function writeSys() {
    global $conn;
    $companies = [];
    $sql = "SELECT * FROM `SystemIDMapping` ORDER BY `SystemIDMapping`.`ID` ASC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    foreach($users as &$user) {
        $id = $user['ID'];
        $code = $user['Code'];
        $Description = $user['Description'];
        $tag = <<< lable
        <tr>
            <td>$id</td>
            <td><input type="text" defaultValue="$code" value="$code" id="sysCid$id" readonly="readonly"><button type="button" class="btn btn-info" id="submitsysCid$id" onclick="editSysCid('sysCid$id', this, 'editsysCid$id')">edit</button><button type="button" class="btn btn-danger" id="editsysCid$id" style="display: none;" onclick="closeSysCid('submitsysCid$id', this, 'sysCid$id')">close</button></td>
            <td><input type="text" defaultValue="$Description" value="$Description" id="sys$id" readonly="readonly"><button type="button" class="btn btn-info" id="submitsys$id" onclick="editSys('sys$id', this, 'editsys$id')">edit</button><button type="button" class="btn btn-danger" id="editsys$id" style="display: none;" onclick="closeSys('submitsys$id', this, 'sys$id')">close</button></td>
            <td onclick="deleteCompany(this)" id="$id"><button type="button" class="btn btn-danger"><i class="material-icons">clear</i></button></td>
        </tr>
lable;
        echo $tag.PHP_EOL;
    }
}

function writeSystemID() {
    global $conn;
    $sql = "SELECT DISTINCT Description FROM `SystemIDMapping`";
    $res = $conn->query($sql);
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $des = $row['Description'];
            echo "<option>$des</option>".PHP_EOL;
        }
    }
}

function writeCompanyID() {
    global $conn;
    $sql = "SELECT DISTINCT Description FROM `CompanyIDMapping`";
    $res = $conn->query($sql);
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $des = $row['Description'];
            echo "<option>$des</option>".PHP_EOL;
        }
    }
}

function writeStates() {
    global $conn;
    $sql = "SELECT DISTINCT State FROM `CameraInformation`";
    $res = $conn->query($sql);
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $des = $row['State'];
            echo "<option>$des</option>".PHP_EOL;
        }
    }
}
