<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <title>Statistics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./lib/bootstrap.min.css">
  <link rel="stylesheet" href="./lib/kamadatepicker.css">
  <script src="./lib/jquery.min.js"></script>
  <script src="./lib/popper.min.js"></script>
  <script src="./lib/bootstrap.min.js"></script>
  <script src="./lib/Chart.bundle.js"></script>
  <script src="./lib/kamadatepicker.js"></script>
  <link rel="stylesheet" href="./lib/style.css?<?php echo rand(1, 1000); ?>" />
</head>
<body>
  


<div class="container" style="margin-top: 2%;">
    <div class="form-group row">
        <div class="col-12" style="text-align: center;">

            <div class="form-check-inline">
                <label class="form-check-label slabel">
                  <input type="radio" class="form-check-input" name="cat" id="radioMap" onclick="mod(this)" checked>نقشه ایران
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label slabel">
                  <input type="radio" class="form-check-input" name="cat" id="radioCam" onclick="mod(this)">دوربین ها
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label slabel">
                  <input type="radio" class="form-check-input" name="cat" id="radioUsr" onclick="mod(this)">کاربران
                </label>
            </div>

        </div>
    </div>

    <!---start date & time -->
    <div class="form-group row">
        <label for="startDate" class="col-2 col-form-label slabel">تاریخ شروع</label>
        <div class="col-4">
          <input class="form-control" type="text" id="startDate" name="startDate" autocomplete="off">
        </div>
        <label for="startTime" class="col-2 col-form-label slabel">ساعت شروع</label>
        <div class="col-4">
          <input class="form-control" type="text" id="startTime" name="startTime" autocomplete="off">
        </div>
    </div>

    <!-- End Time -->
    <div class="form-group row">
        <label for="endDate" class="col-2 col-form-label slabel">تاریخ پایان</label>
        <div class="col-4">
          <input class="form-control" type="text" id="endDate" name="endDate" autocomplete="off">
        </div>
        <label for="endTime" class="col-2 col-form-label slabel">زمان پایان</label>
        <div class="col-4">
          <input class="form-control" type="text" id="endTime" name="endTime" autocomplete="off">
        </div>
    </div>

    <div class="form-group row">
      <div class="col-sm-6">
        <button type="button" class="btn btn-success btn-block" onclick="query()">جست و جو</button>
      </div>
      <div class="col-sm-6">
        <button type="button" class="btn btn-secondary btn-block" onclick="htmlExport()">خروجی HTML</button>
      </div>
    </div>

</div>



<div class="container">

  <div class="row">
    <div class="col-sm-12" style="display: none;" id="mapLoader">
        <!--preloder -->
        <div class="d-flex justify-content-center">
          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <!--------------->
      </div>
  </div>

  <div class="row" id="mapTab" style="display: none; margin-bottom: 2%;">
    <!---map--->
    <div class="col-sm-12" style="margin-top: 2%; text-align: center;"><label style="font-size: 36px;">آمار به تفکیک استان</label></div>
    <div class="col-sm-12" style="background-color: wheat;text-align: center" id="svgPost">
      <?php echo file_get_contents('./templates/ir.svg'); ?>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12" style="display: none;" id="usrLoader">
        <!--preloder -->
        <div class="d-flex justify-content-center">
          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <!--------------->
      </div>
  </div>

  <div class="row" id="usersTab" style="display: none">
    <div class="col-sm-12" style="margin-top: 2%; text-align: center;"><label style="font-size: 36px;">آمار کاربران</label></div>

      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>مشاهدات</h3>
          <canvas id="observes" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>ویرایشات</h3>
          <canvas id="edits" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>ارسال به پلیس</h3>
          <canvas id="sendToPolice" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>گزارشات</h3>
          <canvas id="reports" width="400" height="400"></canvas>
      </div>

  </div>

  <div class="row">
    <div class="col-sm-12" style="display: none;" id="camLoader">
        <!--preloder -->
        <div class="d-flex justify-content-center">
          <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
        <!--------------->
      </div>
  </div>

  <div class="row" id="camTab"  style="display: none; margin-bottom: 2%;">

    <div class="col-sm-12" style="margin-top: 2%; text-align: center"><label style="font-size: 36px;">آمار دوربین ها</label></div>
      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>ارسال شده به پلیس</h3>
          <canvas id="CamSent" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>ارسال نشده پلیس</h3>
          <canvas id="CamUnsent" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>مشاهده شده</h3>
          <canvas id="CamObs" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-3 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>مشاهده نشده</h3>
          <canvas id="CamUnseen" width="400" height="400"></canvas>
      </div>

      <div class="col-sm-4 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>گزارشات</h3>
          <canvas id="CamRep" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-4 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>تمامی دریافت ها</h3>
          <canvas id="CamRec" width="400" height="400"></canvas>
      </div>
      <div class="col-sm-4 usr" style="background-color: whitesmoke; text-align: center;">
          <h3>ویرایشات</h3>
          <canvas id="CamEdi" width="400" height="400"></canvas>
      </div>

  </div>

</div>

        
<script src="./client.js?<?php echo rand(1, 1000); ?>"></script>
<script src="./exp.js?<?php echo rand(1, 1000); ?>"></script>

</body>
</html>
