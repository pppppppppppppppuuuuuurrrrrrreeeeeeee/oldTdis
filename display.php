<?php exec('node multiUser.js'); ?>
<?php $username = filter_input(INPUT_POST, "username");
  if (!isset($_POST['username'])) {
    die('Access denied! You are not login!');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Display/ Edit</title>
  <meta charset="utf-8">
  <link rel="apple-touch-icon" sizes="76x76" href="./views/imgs/logo.png">
  <link rel="icon" type="image/png" href="./views/imgs/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- boot strap 4-->
  <link rel="stylesheet" href="./lib/bootstrap.min.css">
  <script src="./lib/jquery.min.js"></script>
  <script src="./lib/popper.min.js"></script>
  <script src="./lib/bootstrap.min.js"></script>
  <script src="./lib/sweetalert2@10.js"></script>
  <!-- google icons -->
  <link href="./lib/icon.css" rel="stylesheet" />
  <!-- main style -->
  <link rel="stylesheet" href="./views/styles/mainDisplay.css?<?php echo rand(1, 1000); ?>" />
  <link rel="stylesheet" href="./views/styles/editStyle.css" />
  <link rel="stylesheet" href="./views/styles/kamadatepicker.css" />

</head>
<body>


<div class="sidenav">
  <div style="text-align: center;">
   <button onclick="cameraStatus()" type="button" class="btn btn-primary"><i class="material-icons icon">refresh</i>وضعیت دوربین ها</button>
  </div>

  <a onclick="changeCameraText(this)">تمام دوربین ها</a>
</div>
  
<div class="container">
  <!-- <form action="display.php" method="POST"> -->

      <!-- user -->
      <div class="form-group row">
        <label for="speed" class="col-2 col-form-label">User</label>
        <div class="col-10">
          <input class="form-control" type="text" readonly="readonly" value="<?php echo $username ?>" id="user" name="user">
        </div>
      </div>

      <!-- camera -->
      <div class="form-group row">
        <label for="speed" class="col-2 col-form-label">Camera</label>
        <div class="col-10">
          <input class="form-control" type="text" readonly="readonly" value=" قاسم آباد" id="camera" name="camera">
        </div>
      </div>

      <!-- All / not sended -->
      <div class="form-group row">
        <label for="speed" class="col-2 col-form-label">Status</label>
        <div class="col-10">
            <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="status" value="all">All
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="status" value="notSended" checked id="notSendedsta">Not sended
                </label>
            </div>
        </div>
    </div>


    <!-- Start Time -->
    <div class="form-group row">
        <label for="startTime" class="col-2 col-form-label">Start Date</label>
        <div class="col-4">
          <input class="form-control" type="text" id="startDate" name="startDate" autocomplete="off">
        </div>
        <label for="startTime" class="col-2 col-form-label">Start Time</label>
        <div class="col-4">
          <input class="form-control" type="time" value="08:00"  id="startTime" name="startTime">
        </div>
    </div>

    <!-- End Time -->
    <div class="form-group row">
        <label for="startTime" class="col-2 col-form-label">End Date</label>
        <div class="col-4">
          <input class="form-control" type="text"  id="endDate" name="endDate" autocomplete="off">
        </div>
        <label for="startTime" class="col-2 col-form-label">End Time</label>
        <div class="col-4">
          <input class="form-control" type="time" value="14:44" id="endTime" name="endTime">
        </div>
    </div>

    <!-- Speed -->
    <div class="form-group row">
        <label for="speed" class="col-2 col-form-label">Speed</label>
        <div class="col-10">
          <input class="form-control" type="number" value="70" id="speed" name="speed">
        </div>
    </div>

    <!-- Accuracy -->
    <div class="form-group row">
        <label for="speed" class="col-2 col-form-label">Accuracy</label>
        <div class="col-10">
          <input class="form-control" type="number" value="85" id="accuracy" name="accuracy">
        </div>
    </div>

    <!-- Car Class -->
    <div class="form-group row">
        <label for="speed" class="col-2 col-form-label">Car Class</label>
        <div class="col-10">
            <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" id="lightVehicle" name="lightVehicle" checked>Light Vehicle
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" id="heavyVehicle" name="heavyVehicle" checked>Heavy Vehicle
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" id="unkownVehicle" name="unkownVehicle" checked>Unkown Vehicle
                </label>
            </div>
        </div>
    </div>
    
    <!-- Lane and  -->
    <div class="form-group row">
        <label for="speed" class="col-2 col-form-label">Lanes:</label>
        <div class="col-4" style="padding-left: 100px;">
            0<input type="checkbox" id="lane0" checked>
            1<input type="checkbox" id="lane1" checked>
            2<input type="checkbox" id="lane2" checked>
            3<input type="checkbox" id="lane3" checked>
        </div>

        <div class="col-4" style="padding-left: 100px;">
            Wanted <input type="checkbox" id="wanted" name="wanted" value="1">
        </div>
    </div>

    <div class="form-group row">
      <div class="col-2 col-form-label"></div>
      <div class="col-10">
        <input class="form-control btn-success" type="submit" value="Submit" id="submit" onclick="submit()">
      </div>
    </div>



    <!--- loaded data -->
    <div class="row">

      <div class="col-sm-12 disSpinner" id="loader">
        <!--preloder -->
        <div class="d-flex justify-content-center">
          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <!--------------->
      </div>

      <div class="col-sm-9 transParent" style="text-align: center;">
        <img id="primaryImg" alt="none" style="width: 700px; height: 500px;" src="./views/imgs/No Image.png" />
      </div>
      

      <div class="col-sm-3 transParent">
           <p style="font-size: 24px;" id="counterOf">0 / 0</p>
          <div class="btn-group btn-group-lg">
              <button type="button" class="btn btn-danger" onclick="change('p')">Previous</button>
              <button type="button" class="btn btn-primary" onclick="change('n')">Next</button>
            </div>
            <br />
            <div class="btn-group btn-group-lg" style="margin-top: 2%;">
              <button type="button" class="btn btn-info" onclick="reportRec(this)">Report Record</button>
              <br>
            </div>
            <div id="reportRecords" style="display: none;">
              <table>
                <tr>
                  <td>تصویر پر نور</td>
                  <td><input checked name="reposrtStatus" type="radio" value="تصویر پر نور" /> <br/></td>
                </tr>
                <tr>
                  <td>تصویر کم نور</td>
                  <td><input name="reposrtStatus" type="radio" value="تصویر کم نور" /> <br/></td>
                </tr>
                <tr>
                  <td>پلاک پر نور</td>
                  <td><input name="reposrtStatus" type="radio" value="پلاک پر نور" /> <br/></td>
                </tr>
                <tr>
                  <td>پلاک کم نور</td>
                  <td><input name="reposrtStatus" type="radio" value="پلاک کم نور" /> <br/></td>
                </tr>
                <tr>
                  <td>پلاک ناواضح</td>
                  <td><input name="reposrtStatus" type="radio" value="پلاک ناواضح" /> <br/></td>
                </tr>
                <tr>
                  <td>سایر ...</td>
                  <td><input name="reposrtStatus" type="radio" value="سایر ..." /> <br/></td>
                </tr>
              </table>

            </div>
      </div>
    </div>

    <div class="row transParent">
      <div class="col-sm-3" style="margin-top: 2%; text-align: center;">
          <img id="pelakImg" alt="none" style="width: 200px; height: 60px;" src="./views/imgs/No Tag.png" />
      </div>

      <div class="col-sm-3" style="margin-top: 2%; text-align: center;">
          <div class="plateBox plateWhite">
              <div class="box1">
                  <input class="boxNumber1" readonly="readonly" name="plate" id="boxNumber1" type="text" maxlength="2">
              </div>
              <div class="box2">
                  <input class="boxNumber2" readonly="readonly" name="plate" id="boxNumber2" type="text" maxlength="1">
              </div>
              <div class="box3">
                  <input class="boxNumber3" readonly="readonly" name="plate" id="boxNumber3" type="text" maxlength="3">
              </div>
              <div class="box4">
                  <input class="boxNumber4" readonly="readonly" name="plate" id="boxNumber4" type="text" maxlength="2">
              </div>
          </div>
      </div>

      <div class="col-sm-6" style="margin-top: 2%;">
          <div class="btn-group btn-group-lg">
              <button type="button" class="btn btn-danger" onclick="deleteRec()">Delete</button>
              <button type="button" class="btn btn-warning" onclick="edit()" id="eSubmit" style="display: none">Submit</button>
              <button type="button" class="btn btn-info" onclick="reject()" id="eReject" style="display: none">Reject</button>
              <button type="button" class="btn btn-primary" onclick="readonly()" id="eEdit">Edit</button>
              <button id="btnPolice" type="button" class="btn btn-success" onclick="question()">Send To Police</button>
            </div>
      </div>
    </div>

    <div class="row transParent">
      <div class="col-sm-12" style="margin-top: 1%;">
          <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Record Id</th>
                  <th>Camera Id</th>
                  <th>Recorded Plate</th>
                  <th>Passed Time</th>
                  <th>Lane</th>
                  <th>Speed</th>
                  <th>Accuracy</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td id="TDrecordID">none</td>
                  <td id="TDcameraID">none</td>
                  <td id="TDrecordPlate">none</td>
                  <td id="TDpassedTime">none</td>
                  <td id="TDlane">none</td>
                  <td id="TDspeed">none</td>
                  <td id="TDacc">none</td>
                </tr>
              </tbody>
      </div>
    </div>

    

 <!-- </form> -->

</div>
<!-- socket.io -->
<script src="./lib/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="./lib/jquery.min3.5.js"></script>
<!--index script -->
<script src="./views/scripts/displayScript.js?<?php echo rand(1, 1000); ?>"></script>
<script src="./views/scripts/cameraRefresh.js"></script>
<script src="./views/scripts/kamadatepicker.js"></script>
<script>

    kamaDatepicker('startDate',  {
		buttonsColor: "red",
		markToday: true,
		markHolidays: true,
		sync: true
	});
    kamaDatepicker('endDate',  {
		buttonsColor: "red",
		markToday: true,
		markHolidays: true,
		sync: true
	});

    var startDate = getNPassedDate(1);
		var stopDate = getCurrentDate();
		var startTime = getCurrentTime();
		var stopTime = getCurrentTime();
		document.getElementById("startDate").value = startDate;
		document.getElementById("endDate").value = stopDate;
		document.getElementById("startTime").value = startTime;
		document.getElementById("endTime").value = stopTime;
  </script>
</body>
</html>

<?php
global $conn;
$conn->close();
?>
