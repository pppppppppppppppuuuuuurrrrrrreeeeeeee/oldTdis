<?php $username = filter_input(INPUT_POST, "username");
$password = filter_input(INPUT_POST, "password");
$usergrup = filter_input(INPUT_POST, "usergrup");

  if (!isset($_POST['username'])) {
       die('Access denied! You are not login!');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./views/imgs/logo.png">
  <link rel="icon" type="image/png" href="./views/imgs/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    configuration
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="./lib/css.css" />
  <link rel="stylesheet" href="./lib/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./views/styles/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./views/styles/demo.css" rel="stylesheet" />

  <!-- leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
  integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
  integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
  crossorigin=""></script>
  <style>
    table {
      background-color: wheat;
    }

  </style>

  <!-- post to display-edit -->
  <script>
    function submitDisplay() {
      document.getElementById('displayForm').submit();
    }
    function submitIND() {
      document.getElementById('indForm').submit();
    }
    function submitSta() {
          document.getElementById('staForm').submit();
        }
  </script>

  <!-- charts-->
<!-- Include fusioncharts core library -->
<script type="text/javascript" src="./lib/fusioncharts.js"></script>
<!-- Include fusion theme -->
<script type="text/javascript" src="./lib/fusioncharts.theme.fusion.js"></script>
</head>

<body>
    <form id="displayForm" method="POST" action="display.php" target="_blank">
       <input name="username" style="display: none;" value="<?php echo $username; ?>" />
        <input name="password" style="display: none;" value="<?php echo $password; ?>" />
        <input name="usergrup" style="display: none;" value="<?php echo $usergrup; ?>" />
    </form>



    <form id="indForm" method="POST" action="index.php">
        <input name="username" style="display: none;" value="<?php echo $username; ?>" />
        <input name="password" style="display: none;" value="<?php echo $password; ?>" />
        <input name="usergrup" style="display: none;" value="<?php echo $usergrup; ?>" />
    </form>

    <form id="staForm" method="POST" action="statistics.php">
        <input name="username" style="display: none;" value="<?php echo $username; ?>" />
        <input name="password" style="display: none;" value="<?php echo $password; ?>" />
        <input name="usergrup" style="display: none;" value="<?php echo $usergrup; ?>" />
    </form>


  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo" style="text-align: center;">
        <a>
          <img src="./views/imgs/logo.png" width="100" height="100">
        </a>
    </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" onclick="submitIND()">
            <i class="material-icons">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                  </i>              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" onclick="submitDisplay()" target="_blank">
            <i class="material-icons">
                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
                </i>  
              <p>Display/ Edit</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="./statistics/" target="_blank">
            <i class="material-icons">
            
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-5h2v5zm4 0h-2v-3h2v3zm0-5h-2v-2h2v2zm4 5h-2V7h2v10z"/></svg>
            </i>   
              <p>statistics</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="./report/" target="_blank">
            <i class="material-icons">
            
            
<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.73 3H8.27L3 8.27v7.46L8.27 21h7.46L21 15.73V8.27L15.73 3zM12 17.3c-.72 0-1.3-.58-1.3-1.3 0-.72.58-1.3 1.3-1.3.72 0 1.3.58 1.3 1.3 0 .72-.58 1.3-1.3 1.3zm1-4.3h-2V7h2v6z"/></svg>
            </i>           
 <p>report</p>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link">
            <i class="material-icons">
          
          <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><g><rect fill="none" height="24" width="24" x="0"/></g><g><g><g><path d="M22,10V6c0-1.11-0.9-2-2-2H4C2.9,4,2.01,4.89,2.01,6v4C3.11,10,4,10.9,4,12s-0.89,2-2,2v4c0,1.1,0.9,2,2,2h16 c1.1,0,2-0.9,2-2v-4c-1.1,0-2-0.9-2-2S20.9,10,22,10z M13,17.5h-2v-2h2V17.5z M13,13h-2v-2h2V13z M13,8.5h-2v-2h2V8.5z"/></g></g></g></svg>
          </i>   
              <p>configuration</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <!--
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand">Configuration</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">

    
          <ul class="navbar-nav">
                  <li class="nav-item dropdown">
                    <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="material-icons">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 5v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.11 0-2 .9-2 2zm12 4c0 1.66-1.34 3-3 3s-3-1.34-3-3 1.34-3 3-3 3 1.34 3 3zm-9 8c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1H6v-1z"/></svg>
                      </i>
                      <p class="d-lg-none d-md-block">
                        Account
                      </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                      <a class="dropdown-item" id="username">$uname</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="index.php">Log out</a>
                    </div>
                  </li>
                </ul>
          </div>
        </div>
      </nav>-->
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">

          <div class="row">

            <div class="col-sm-12" style="background-color: white;">
              <h3>Add users</h3>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Username" id="usernameInp" required>
                  <input type="password" class="form-control" placeholder="Password" id="passInp" required>
                </div>

                <label>Select the usergroup</label>
                <div class="col-sm-2">
                  <input type="radio" class="form-check-input" name="userGroup" value="User" id="userPRV" checked>User
                </div>
                <div class="col-sm-2">
                  <input type="radio" class="form-check-input" name="userGroup" value="Adminstrator" id="adminstratorPRV">Adminstrator
                </div>
                <div class="col-sm-12">
                  <button onclick="insertInto()" type="submit" class="btn btn-success" style="width: 100%;">Submit</button>
                </div>

            </div>
          </div>

        <br />
        

          <div class="row">
            <div class="col-sm-12" style="background-color: white;">
              <h3>Delete users</h3>

              <table class="table table-dark table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>UserGroup</th>
                    <th>Created Time</th>
                    <th>Last Login</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  require_once('./controller/writeFunctionsForConfig.php');
                  writeUsersForRoot();
                  ?>
                </tbody>
              </table>

            </div>
          </div>

          <br />

          <!-- add Company id -->
          <div class="row">
            <div class="col-sm-12" style="background-color: white;">
              <h3>Add Company</h3>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Name" id="NameInpCompanyID" required>
                <input type="text" class="form-control" placeholder="Code" id="numberInpCompanyID" required>
              </div>
              <div class="col-sm-12">
                <button onclick="insertIntoCompanyId()" type="submit" class="btn btn-success" style="width: 100%;">Submit</button>
              </div>
            </div>
          </div>

          <br/ >

           <div class="row">
            <div class="col-sm-12" style="background-color: white;">
              <h3>Delete & Edit Companies</h3>

              <table class="table table-dark table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th style="width: 240px;">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  writeCompanies();
                  ?>
                </tbody>
              </table>

            </div>
          </div>

          <br />
          <!-- add system id -->
          <div class="row">
            <div class="col-sm-12" style="background-color: white;">
              <h3>Add System</h3>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Name" id="NameInpSystemID" required>
                <input type="text" class="form-control" placeholder="Code" id="CodeInpSystemID" required>
              </div>
              <div class="col-sm-12">
                <button onclick="insertIntoSysId()" type="submit" class="btn btn-success" style="width: 100%;">Submit</button>
              </div>
            </div>
          </div>

          <br />

          <div class="row">
            <div class="col-sm-12" style="background-color: white;">
              <h3>Delete & Edit Systems</h3>

              <table class="table table-dark table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th style="width: 240px;">Remove</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  writeSys();
                  ?>
                </tbody>
              </table>

            </div>
          </div>

          <br />
          <!-- add camera -->
          <div class="row">
            <div class="col-sm-12" style="background-color: white;">
              <h3>Add Camera</h3>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Name" id="NameInpCamera" required>
                <input type="text" class="form-control" placeholder="ID" id="IDInpCamera" required>
                <input type="text" class="form-control" placeholder="Location" id="LocationInpCamera" required>
                <input type="text" class="form-control" placeholder="Police Code" id="PoliceInpCamera" required>
              </div>


              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="latitude" id="LatitudeInpCamera" required>
                <input type="text" class="form-control" placeholder="longitude" id="LongitudeInpCamera" required>
              </div>

              <div class="input-group mb-3">
                <label>System IDs</label>
                <select class="form-control" id="SysInpCamera">
                  <?php writeSystemID(); ?>
                </select>

                <label>Company IDs</label>
                <select class="form-control" id="CompanyInpCamera">
                  <?php writeCompanyID(); ?>
                </select>

                <label>State</label>
                <select class="form-control" id="StateInpCamera">
                  <?php writeStates(); ?>
                </select>
              </div>



              <div class="col-sm-12">
                <button onclick="insertIntoCameras()" type="submit" class="btn btn-success" style="width: 100%;">Submit</button>
              </div>
            </div>
          </div>
          

      </div>
    </div>
  </div>
  </div>

  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="./views/scripts/configuration.js"></script>






</body>

</html>