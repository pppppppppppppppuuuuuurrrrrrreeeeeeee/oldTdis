<?php header_remove('Set-Cookie'); ?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <title>Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./lib/bootstrap.min.css">
  <link rel="stylesheet" href="./lib/kamadatepicker.css">
  <script src="./lib/jquery.min.js"></script>
  <script src="./lib/popper.min.js"></script>
  <script src="./lib/bootstrap.min.js"></script>
  <script src="./lib/kamadatepicker.js"></script>
  <link rel="stylesheet" href="./lib/style.css?<?php echo rand(1, 1000); ?>" />
  <link rel="stylesheet" href="./lib/fonts.css?<?php echo rand(1, 1000); ?>" />

  <!-- select 2 -->
  <link href="./lib/select2.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container" style="margin-top: 2%;">
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

  </div>

  <div class="container" style="direction: ltr;">
    <div class="row">

    <div class="col-sm-4">
        <div class="card card border border-danger mb-3">
          <div class="card-header">
              <svg class="svg-inline--fa fa-video fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="video" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M336.2 64H47.8C21.4 64 0 85.4 0 111.8v288.4C0 426.6 21.4 448 47.8 448h288.4c26.4 0 47.8-21.4 47.8-47.8V111.8c0-26.4-21.4-47.8-47.8-47.8zm189.4 37.7L416 177.3v157.4l109.6 75.5c21.2 14.6 50.4-.3 50.4-25.8V127.5c0-25.4-29.1-40.4-50.4-25.8z"></path></svg><!-- <i class="fas fa-video"></i> -->
              Camera
          </div>
          <div class="card-body">
              <div class="form-group mb-0">
                <label class="form-control-label">Camera Names</label><br />
                <label class="matter-checkbox matter-info mr-2">
                  <input type="checkbox" id="allNames" onchange="allCamerasCheck()" checked/>
                  <span style="color: gray; font-size:14px">Select All Camera Names</span>
                </label>
                <select id="cameraNames" multiple="multiple" style="width: 100%;">
                </select>
              </div>
              <hr>
              <div class="form-group mb-0">
                <label class="form-control-label">Camera IDs</label><br />
                <label class="matter-checkbox matter-info mr-2">
                  <input type="checkbox" id="allIDS" onchange="allCamerasIDS()"  checked/>
                  <span style="color: gray; font-size:14px">Select All Camera IDs</span>
                </label>
                <select id="cameraIds" multiple="multiple" style="width: 100%;">
                </select>
              </div>
          </div>
        </div>
      </div>
    
      <div class="col-sm-4">
        <div class="card card border border-success mb-3">
            <div class="card-header">
            <svg class="svg-inline--fa fa-crosshairs fa-w-16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="crosshairs" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M500 224h-30.364C455.724 130.325 381.675 56.276 288 42.364V12c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v30.364C130.325 56.276 56.276 130.325 42.364 224H12c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h30.364C56.276 381.675 130.325 455.724 224 469.636V500c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-30.364C381.675 455.724 455.724 381.675 469.636 288H500c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12zM288 404.634V364c0-6.627-5.373-12-12-12h-40c-6.627 0-12 5.373-12 12v40.634C165.826 392.232 119.783 346.243 107.366 288H148c6.627 0 12-5.373 12-12v-40c0-6.627-5.373-12-12-12h-40.634C119.768 165.826 165.757 119.783 224 107.366V148c0 6.627 5.373 12 12 12h40c6.627 0 12-5.373 12-12v-40.634C346.174 119.768 392.217 165.757 404.634 224H364c-6.627 0-12 5.373-12 12v40c0 6.627 5.373 12 12 12h40.634C392.232 346.174 346.243 392.217 288 404.634zM288 256c0 17.673-14.327 32-32 32s-32-14.327-32-32c0-17.673 14.327-32 32-32s32 14.327 32 32z"></path></svg>
                <!-- <i class="fas fa-crosshairs"></i> -->
                Accuracy
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <label class="form-control-label">Minimum</label>
                    <input class="form-control" id="minAccuracy" type="text" placeholder="0">
                    <hr>
                    <label class="form-control-label">Maximum</label>
                    <input class="form-control" id="maxAccuracy" type="text" placeholder="100">
                </div>
            </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="card card border border-success mb-3">
            <div class="card-header ">
            <svg class="svg-inline--fa fa-tachometer-alt fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tachometer-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M288 32C128.94 32 0 160.94 0 320c0 52.8 14.25 102.26 39.06 144.8 5.61 9.62 16.3 15.2 27.44 15.2h443c11.14 0 21.83-5.58 27.44-15.2C561.75 422.26 576 372.8 576 320c0-159.06-128.94-288-288-288zm0 64c14.71 0 26.58 10.13 30.32 23.65-1.11 2.26-2.64 4.23-3.45 6.67l-9.22 27.67c-5.13 3.49-10.97 6.01-17.64 6.01-17.67 0-32-14.33-32-32S270.33 96 288 96zM96 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm48-160c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32zm246.77-72.41l-61.33 184C343.13 347.33 352 364.54 352 384c0 11.72-3.38 22.55-8.88 32H232.88c-5.5-9.45-8.88-20.28-8.88-32 0-33.94 26.5-61.43 59.9-63.59l61.34-184.01c4.17-12.56 17.73-19.45 30.36-15.17 12.57 4.19 19.35 17.79 15.17 30.36zm14.66 57.2l15.52-46.55c3.47-1.29 7.13-2.23 11.05-2.23 17.67 0 32 14.33 32 32s-14.33 32-32 32c-11.38-.01-20.89-6.28-26.57-15.22zM480 384c-17.67 0-32-14.33-32-32s14.33-32 32-32 32 14.33 32 32-14.33 32-32 32z"></path></svg>
                <!-- <i class="fas fa-tachometer-alt "></i> -->
                Speed
            </div>
            <div class="card-body">
                <div class="form-group mb-0">
                    <label class="form-control-label">Minimum</label>
                    <input class="form-control" id="minSpeed" type="text" placeholder="0">
                    <hr>
                    <label class="form-control-label">Maximum</label>
                    <input class="form-control" id="maxSpeed" type="text" placeholder="250">
                </div>
            </div>
        </div>
      </div>


      <div class="col-sm-3">
        <div class="card card border border-info mb-3">
          <div class="card-header">
            <svg class="svg-inline--fa fa-road fa-w-18" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="road" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M573.19 402.67l-139.79-320C428.43 71.29 417.6 64 405.68 64h-97.59l2.45 23.16c.5 4.72-3.21 8.84-7.96 8.84h-29.16c-4.75 0-8.46-4.12-7.96-8.84L267.91 64h-97.59c-11.93 0-22.76 7.29-27.73 18.67L2.8 402.67C-6.45 423.86 8.31 448 30.54 448h196.84l10.31-97.68c.86-8.14 7.72-14.32 15.91-14.32h68.8c8.19 0 15.05 6.18 15.91 14.32L348.62 448h196.84c22.23 0 36.99-24.14 27.73-45.33zM260.4 135.16a8 8 0 0 1 7.96-7.16h39.29c4.09 0 7.53 3.09 7.96 7.16l4.6 43.58c.75 7.09-4.81 13.26-11.93 13.26h-40.54c-7.13 0-12.68-6.17-11.93-13.26l4.59-43.58zM315.64 304h-55.29c-9.5 0-16.91-8.23-15.91-17.68l5.07-48c.86-8.14 7.72-14.32 15.91-14.32h45.15c8.19 0 15.05 6.18 15.91 14.32l5.07 48c1 9.45-6.41 17.68-15.91 17.68z"></path></svg><!-- <i class="fas fa-road"></i> -->
            Lane Number
          </div>
          <div class="card-body text-center">
            <label class="matter-checkbox matter-info mr-2">
              <input id="lane1" type="checkbox" checked="">
              <span>1</span>
            </label>
            <label class="matter-checkbox matter-info mr-2">
              <input id="lane2" type="checkbox" checked="">
              <span>2</span>
            </label>
            <label class="matter-checkbox matter-info mr-2">
              <input id="lane3" type="checkbox" checked="">
              <span>3</span>
            </label>
            <label class="matter-checkbox matter-info mr-2">
              <input id="lane4" type="checkbox" checked="">
              <span>4</span>
            </label>
            <label class="matter-checkbox matter-info">
              <input id="lane5" type="checkbox" checked="">
              <span>5</span>
            </label>
          </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="card card border border-info mb-3">
            <div class="card-header ">
                  <svg class="svg-inline--fa fa-exchange-alt fa-w-16 fa-fw" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exchange-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M0 168v-16c0-13.255 10.745-24 24-24h360V80c0-21.367 25.899-32.042 40.971-16.971l80 80c9.372 9.373 9.372 24.569 0 33.941l-80 80C409.956 271.982 384 261.456 384 240v-48H24c-13.255 0-24-10.745-24-24zm488 152H128v-48c0-21.314-25.862-32.08-40.971-16.971l-80 80c-9.372 9.373-9.372 24.569 0 33.941l80 80C102.057 463.997 128 453.437 128 432v-48h360c13.255 0 24-10.745 24-24v-16c0-13.255-10.745-24-24-24z"></path></svg><!-- <i class="fas fa-fw fa-exchange-alt"></i> -->
                  Direction
            </div>
            <div class="card-body text-center">
              <label class="matter-checkbox matter-info mr-4">
                <input id="upToDown" type="checkbox" checked="">
                <span><svg class="svg-inline--fa fa-arrow-down fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M413.1 222.5l22.2 22.2c9.4 9.4 9.4 24.6 0 33.9L241 473c-9.4 9.4-24.6 9.4-33.9 0L12.7 278.6c-9.4-9.4-9.4-24.6 0-33.9l22.2-22.2c9.5-9.5 25-9.3 34.3.4L184 343.4V56c0-13.3 10.7-24 24-24h32c13.3 0 24 10.7 24 24v287.4l114.8-120.5c9.3-9.8 24.8-10 34.3-.4z"></path></svg><!-- <i class="fas fa-arrow-down"></i> --></span>
              </label>
              <label class="matter-checkbox matter-info mr-2">
                <input id="downToUp" type="checkbox" checked="">
                <span><svg class="svg-inline--fa fa-arrow-up fa-w-14" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-up" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M34.9 289.5l-22.2-22.2c-9.4-9.4-9.4-24.6 0-33.9L207 39c9.4-9.4 24.6-9.4 33.9 0l194.3 194.3c9.4 9.4 9.4 24.6 0 33.9L413 289.4c-9.5 9.5-25 9.3-34.3-.4L264 168.6V456c0 13.3-10.7 24-24 24h-32c-13.3 0-24-10.7-24-24V168.6L69.2 289.1c-9.3 9.8-24.8 10-34.3.4z"></path></svg><!-- <i class="fas fa-arrow-up"></i> --></span>
              </label>
            </div>
        </div>
      </div>

      <div class="col-sm-3">
        <div class="card card border border-success mb-3">
            <div class="card-header ">
            <svg class="svg-inline--fa fa-car-side fa-w-20" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="car-side" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M544 192h-16L419.22 56.02A64.025 64.025 0 0 0 369.24 32H155.33c-26.17 0-49.7 15.93-59.42 40.23L48 194.26C20.44 201.4 0 226.21 0 256v112c0 8.84 7.16 16 16 16h48c0 53.02 42.98 96 96 96s96-42.98 96-96h128c0 53.02 42.98 96 96 96s96-42.98 96-96h48c8.84 0 16-7.16 16-16v-80c0-53.02-42.98-96-96-96zM160 432c-26.47 0-48-21.53-48-48s21.53-48 48-48 48 21.53 48 48-21.53 48-48 48zm72-240H116.93l38.4-96H232v96zm48 0V96h89.24l76.8 96H280zm200 240c-26.47 0-48-21.53-48-48s21.53-48 48-48 48 21.53 48 48-21.53 48-48 48z"></path></svg>
                <!-- <i class="fas fa-car-side"></i> -->
                Vehicle
            </div>
            <div class="card-body">
                <label class="matter-checkbox matter-success ">
                    <input id="vehicleLight" type="checkbox" checked>
                    <span>Light</span>
                </label>
                <label class="matter-checkbox matter-success ">
                    <input id="vehicleHeavy" type="checkbox" checked>
                    <span>Heavy</span>
                </label>
                <label class="matter-checkbox matter-success ">
                    <input id="vehicleUnkown" type="checkbox" checked>
                    <span>Unknown</span>
                </label>
            </div>
        </div>
      </div>



      <div class="col-sm-3" style="padding: 0;">
          <div class="card card border border-info mb-3">
          <div class="card-header ">
                  <i class="fas fa-tasks"></i>Custom Plate
              </div>
              <div class="card-body">
                  <div class="plateBox plateWhite" ondragstart="return false;" ondrop="return false;">
                      <div class="box1">
                          <input class="boxNumber1" placeholder="--" name="plate" id="boxNumber1" type="text" maxlength="2" onkeyup="checkPlateInputs(id,'numberWithOut0',this)">
                      </div>
                      <div class="box2">
                          <input class="boxNumber2" placeholder="-" name="plate" id="boxNumber2" type="text" maxlength="1" onkeyup="checkPlateInputs(id,'alphabet',this)">
                      </div>
                      <div class="box3">
                          <input class="boxNumber3" placeholder="---" name="plate" id="boxNumber3" type="text" maxlength="3" onkeyup="checkPlateInputs(id,'numberWithOut0',this)">
                      </div>
                      <div class="box4">
                          <input class="boxNumber4" placeholder="--" name="plate" id="boxNumber4" type="text" maxlength="2" onkeyup="checkPlateInputs(id,'numberWith0',this)">
                      </div>
                  </div>
              </div>

          </div>
      </div>

      <div class="col-sm-12" id="colsDiv" style="padding-right: 0;">
        <div class="card card border border-success mb-3">
          <div class="card-header">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 18h5V5h-5v13zm-6 0h5V5H4v13zM16 5v13h5V5h-5z"/></svg>
            Camera Columns
          </div>
          <select id="cols" multiple="multiple" style="width: 100%;">
          </select>
        </div>
      </div>


      <!-- inner join -->
      <div class="col-sm-12" style="text-align: center;">
        <label class="matter-switch matter-info">
            <input id="join" type="checkbox" role="switch" onclick="innerJoinShow()">
            <span>INNER JOIN WITH‌ USERS</span>
        </label>
      </div>

      <div class="col-sm-3" id="usrObs" style="display: none;">
        <div class="card card border border-primary mb-3">
          <div class="card-header">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="eye" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-eye fa-w-18"><path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z" class=""></path></svg><!-- <i class="fas fa-video"></i> -->
              Observes
          </div>
          <div class="card-body">
              <div class="form-group mb-0">
                <label class="form-control-label">Users</label><br />
                <label class="matter-checkbox matter-info mr-2">
                  <input type="checkbox" id="allUsrsObs" onchange="allUsrsObs()" checked/>
                  <span style="color: gray; font-size:14px">Select All Users</span>
                </label>

                <select id="UserOBS" multiple="multiple" style="width: 100%;">
                </select>
              </div>
          </div>
        </div>
      </div>

      <div class="col-sm-3" id="usrEdi" style="display: none;">
        <div class="card card border border-info mb-3">
          <div class="card-header">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="pen" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-pen fa-w-16"><path fill="currentColor" d="M290.74 93.24l128.02 128.02-277.99 277.99-114.14 12.6C11.35 513.54-1.56 500.62.14 485.34l12.7-114.22 277.9-277.88zm207.2-19.06l-60.11-60.11c-18.75-18.75-49.16-18.75-67.91 0l-56.55 56.55 128.02 128.02 56.55-56.55c18.75-18.76 18.75-49.16 0-67.91z" class=""></path></svg><!-- <i class="fas fa-video"></i> -->
            Edits
          </div>
          <div class="card-body">
              <div class="form-group mb-0">
                <label class="form-control-label">Users</label><br/>

                <label class="matter-checkbox matter-info mr-2">
                  <input type="checkbox" id="allUsrsEdi" onchange="allUsrsEdi()" checked/>
                  <span style="color: gray; font-size:14px">Select All Users</span>
                </label>

                <select id="usrEDIT" multiple="multiple" style="width: 100%;">
                </select>
              </div>
          </div>
        </div>
      </div>

      <div class="col-sm-3" id="usrDel" style="display: none;">
        <div class="card card border border-danger mb-3">
          <div class="card-header">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" class="svg-inline--fa fa-times fa-w-11"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" class=""></path></svg><!-- <i class="fas fa-video"></i> -->
            Deletes
          </div>
          <div class="card-body">
              <div class="form-group mb-0">
                <label class="form-control-label">Users</label><br />
                <label class="matter-checkbox matter-info mr-2">
                  <input type="checkbox" id="allusrDEL" onchange="allusrDEL()" checked/>
                  <span style="color: gray; font-size:14px">Select All Users</span>
                </label>

                <select id="usrDEL" multiple="multiple" style="width: 100%;">
                </select>
              </div>
          </div>
        </div>
      </div>

      <div class="col-sm-3" id="usrSen" style="display: none;">
        <div class="card card border border-success mb-3">
          <div class="card-header">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-check fa-w-16"><path fill="currentColor" d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z" class=""></path></svg><!-- <i class="fas fa-video"></i> -->
            Sent To Police
          </div>
          <div class="card-body">
              <div class="form-group mb-0">
                <label class="form-control-label">Users</label><br />
                <label class="matter-checkbox matter-info mr-2">
                  <input type="checkbox" id="allustSENT" onchange="allustSENT()" checked/>
                  <span style="color: gray; font-size:14px">Select All Users</span>
                </label>
                <select id="ustSENT" multiple="multiple" style="width: 100%;">
                </select>
              </div>
          </div>
        </div>
      </div>


      <div class="col-sm-12" id="UsrcolsDiv" style="display: none; padding-right: 0;">
        <div class="card card border border-success mb-3">
          <div class="card-header">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 18h5V5h-5v13zm-6 0h5V5H4v13zM16 5v13h5V5h-5z"/></svg>
            User Columns
          </div>
          <select id="Usrcols" multiple="multiple" style="width: 100%;">
          </select>
        </div>
      </div>

      <!--preloder -->
      <div class="col-sm-12 d-flex justify-content-center hide" id="spinner">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!--------------->

      <div class="col-sm-4" style="margin: 2% 0 3% 0; direction: rtl;">
        <button type="button" class="btn btn-primary btn-block" onclick="zip()">خروجی ZIP</button>
      </div>
      <div class="col-sm-4" style="margin: 2% 0 3% 0; direction: rtl;">
        <button type="button" class="btn btn-info btn-block" onclick="submit('true')">خروجی HTML</button>
      </div>
      <div class="col-sm-4" style="margin: 2% 0 3% 0;">
        <button type="button" class="btn btn-success btn-block" onclick="submit('false')">تعداد کل</button>
      </div>


    </div>

  </div>

  <script src="./lib/select2.min.js"></script>
  <script src="client.js?<?php echo rand(1, 1000); ?>"></script>
</body>
</html>
