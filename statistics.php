<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title>صفحه امار</title>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css-rtl/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../app-assets/css-rtl/custom-rtl.css">
    <link type="text/css" rel="stylesheet" href="../app-assets/css-rtl/datetimepicker.min.css" />
<style>
    .tabchart ul{
        display: flex;
    width: 100%;
    justify-content: space-around;
    }
    .tabchart ul li {
    text-align: center;
    font-size: 1.3em;
    border: 3px solid #7367f1;
 
    margin-bottom: 20px;
    border-radius: 5px;
    padding: 1em 1.3em;
    width: 30%;
    }
    .tabchart ul li a{
        color: #000;
        width: 100%;
        display: block;
    }
    .showme{
        border: 3px solid #179cab  !important; 
    }
    .nav li {
        cursor: pointer;
    }
</style>
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static  todo-application"
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                        class="ficon feather icon-menu"></i></a></li>
                            <li>
                                <span>آمار</span>
                            </li>
                        </ul>




                    </div>
                    <ul class="nav navbar-nav float-right">

                        <li class="dropdown dropdown-user nav-item"><a href=""
                                class="dropdown-toggle nav-link dropdown-user-link" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none">
                                    <span class="user-name">نام کاربر
                                    </span>
                                </div>
                                <div class="user-icon">
                                    <i class="feather icon-user"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <p class="dropdown-item">
                                    <i class="feather icon-clock
                                    "></i>

                                    6:15 زمان ورود به سیستم
                                </p>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="auth-login.html"><i class="feather icon-power"></i> خروج
                                    از سیستم</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="/">
                        <img src="../app-assets/images/logo/logo.png" alt="">
                        <h2 class="brand-text mb-0">سامانه مانیتورینگ و تجمیع داده</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                            class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


                <li class=" nav-item "><a href="index.html"><i class="feather  icon-home"></i><span class="menu-title"
                            data-i18n="Email">داشبورد</span></a>
                </li>
                <li class=" nav-item "><a href="edit.html"><i class="feather icon-edit-1"></i><span class="menu-title"
                            data-i18n="Chat">ویرایش</span></a>
                </li>
                <li class=" nav-item active"><a href="statistics.html"><i class="feather icon-bar-chart-2"></i><span
                            class="menu-title" data-i18n="Todo">آمار</span></a>
                </li>
                <li class=" nav-item "><a href="report.html"><i class="feather icon-clipboard"></i><span
                            class="menu-title" data-i18n="Calender">گزارش</span></a>
                </li>
                <li class=" nav-item"><a href="setting.html"><i class="feather icon-settings"></i><span
                            class="menu-title" data-i18n="Calender">تنظیمات</span></a>
                </li>


            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Start -->
                <section id="edit-page">

                    <div class="row">
                        <div class="col-lg-12">
                            <span class="title">
                                فیلتر
                            </span>
                            <div class="card p-2">

                                <div class="col-lg-6 col-md-10 col-sm-12 float-right mcenter" id="">
                                
                                    <div class="tabchart">
                                        <ul class="nav nav-tabs nav-flex" id="modulesLi">
                                            <li class="showme" onclick="change('map', this)">
                                                <a data-toggle="tab">نقشه ایران</a>
                                            </li>
                                            <li class="" onclick="change('camera', this)">
                                                <a data-toggle="tab">جدول دوربین ها</a>
                                            </li>
                                            <li class="" onclick="change('user', this)">
                                                <a data-toggle="tab"> جدول کاربران</a>
                                            </li>
                                        </ul>
                                    </div>
                                   
                                </div>
                                    <div class="form-group statis mtime">

                                        <div class="col-lg-7 col-md-10 col-sm-12 float-right dflex mb-0 mt-1">
                                            <div class="card mb-0">

                                                <div class="card-content mheight">
                                                    <div class="col-lg-6 col-md-6 col-sm-12 float-left p-0 pr-1">
                                                        <div class="card-inner dflex">
                                                            <label for="first-name-vertical"> از تاریخ :</label>
                                                            <input type="text" id="startDate" class="pCalender">
                                                        </div>


                                                        <div class="card-inner dflex">
                                                            <label for="first-name-vertical">تا تاریخ :</label>
                                                            <input type="text" id="endDate" class="pCalender">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12 float-left p-0">
                                                        <div class="card-inner dflex">
                                                            <label for="first-name-vertical">از ساعت :</label>
                                                            <input class="form-control" type="text" id="startTime"
                                                                name="timepicker" placeholder="زمان را وارد کنید " />
                                                        </div>


                                                        <div class="card-inner dflex">
                                                            <label for="first-name-vertical">تا ساعت :</label>
                                                            <input class="form-control" type="text" id="endTime"
                                                                name="timepicker" placeholder="زمان را وارد کنید " />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class=" col-lg-9 col-md-9 col-sm-12 center mcenter">
                                        <button onclick="query()" class="fyekan btn bg-gradient-success mr-1 mb-1 waves-effect waves-light w1">اعمال فیلتر</button>
                                        <!-- <button type="submit"
                                            class="fyekan btn bg-gradient-warning mr-1 mb-1 waves-effect waves-light w1">
                                            خروجی HTML</button> -->

                                    </div>


                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="modules">
                        <div id="map" class="tab-pane fade active">
                            <div class="row" id="chartjs-charts">
                                <div class="col-lg-12">
                                    <span class="title">
                                        نتایج
                                    </span>
                                    <div class="card">
                                        <div class="card-body" style="text-align: center;">
                                            <?php echo file_get_contents('./views/html/ir.svg'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        <div id="camera" class="tab-pane fade">
                            <div class="row" id="chartjs-charts">
                                <div class="col-lg-12">
                                    <span class="title">
                                        نتایج
                                    </span>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-lg-4 col-md-6 col-sm-12 float-left ">
                                                <div class="form-groupj">
                                                    <label for="first-name-vertical">دوربین ها :</label>
                                                    <div class="clr"></div>
                                                        <div class=" list-group-filters font-medium-1 mt-2">
                                                            <a tag="CameraEdits"
                                                                class="camTags btn-outline-primary list-group-item list-group-item-action">
                                                                ویرایش ها</a>
                                                            <a tag="CameraReports"
                                                                class="camTags btn-outline-primary list-group-item list-group-item-action">
                                                                گزارش ها</a>
                                                            <a tag="CameraObserves"
                                                                class="camTags btn-outline-primary list-group-item list-group-item-action">
                                                                مشاهده شده</a>
                                                            <a tag="CameraUnseen"
                                                                class="camTags btn-outline-primary list-group-item list-group-item-action">
                                                                مشاهده نشده</a>
                                                            <a tag="CameraSendToPolice"
                                                                class="camTags btn-outline-primary list-group-item list-group-item-action">
                                                                ارسال شده</a>
                                                            <a tag="CameraDIDNTSendToPolice"
                                                                class="camTags btn-outline-primary list-group-item list-group-item-action">
                                                                ارسال نشده</a>
                                                            <a tag="CameraAllRecives"
                                                                class="camTags active w100 btn-outline-primary list-group-item list-group-item-action">
                                                                تمام دریافت ها</a>
                                                            <button onclick="camContent()"
                                                                class="m5 w100 fyekan btn bg-gradient-success  waves-effect waves-light ">
                                                                اعمال فیلتر </button>
                                                        </div>

                                                    <div class="clr"></div>
                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-12 float-left ">
                                                <label for="first-name-vertical">نمودار:</label>
                                                <div class="card-content">
                                                    <div class="card-body pl-0">
                                                        <div class="height-400" id="cameraCanvasParent">
                                                            <canvas id="cameraCanvas" height="100"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="user" class="tab-pane fade">
                            <div class="row" id="chartjs-k">
                                <div class="col-lg-12">
                                    <span class="title">
                                        نتایج
                                    </span>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-lg-4 col-md-6 col-sm-12 float-left ">
                                                <div class="form-groupj">
                                                    <label for="first-name-vertical">کاربران :</label>
                                                    <div class="clr"></div>
                                                         <div class=" list-group-filters font-medium-1 mt-2">
                                                        <a tag="observes" class="active usrTags btn-outline-primary list-group-item list-group-item-action active">
                                                           مشاهدات</a>
                                                        <a tag="reports" class="usrTags btn-outline-primary list-group-item list-group-item-action">
                                                            گزارش ها</a>
                                                        <a tag="sendToPolice" class="usrTags btn-outline-primary list-group-item list-group-item-action">
                                                             ارسال به پلیس</a>
                                                        <a tag="edits" class="usrTags btn-outline-primary list-group-item list-group-item-action">
                                                            ویرایش شده ها</a>
                                                            
                                                                     <button onclick="usrContent()" class="m5 w100 fyekan btn bg-gradient-success  waves-effect waves-light ">
                                                                        اعمال فیلتر </button>
                                                    </div>
                                                  
                                                 <div class="clr"></div>
                                                </div>
                                                <div class="clr"></div>
                                            </div>
                                            <div class="col-lg-8 col-md-6 col-sm-12 float-left ">
                                                <label for="first-name-vertical">نمودار:</label>
                                                <div class="card-content">
                                                    <div class="card-body pl-0">
                                                        <div class="height-400" id="userCanvasParent">
                                                            <canvas id="userCanvas"  height="100"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span
                class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a
                    class="text-bold-800 grey darken-2" href="#" target="_blank">Konect,</a>All rights Reserved</span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i
                    class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->

    <script src="./views/scripts/statisticsClient.js"></script>
    <script>
        var radio = 'map';
        function change(id, li) {
            let mods = document.getElementById('modulesLi').children;
            for(let i = 0; i < mods.length; i++) {
                mods[i].className = '';
            }
            
            let modules = document.getElementById('modules').children;
            for(let i = 0; i < modules.length; i++) {
                modules[i].classList.remove('active');
            }
            document.getElementById(id).classList.add('active');
            radio = id;
            li.className = 'showme';
        }


        function query() {
            if(radio == 'map') {
                map();
            } else if(radio == 'user') {
                usr();
            } else if(radio == 'camera') {
                cam();
            }
        }
        

    </script>
    <script src="../app-assets/js/scripts/vendors.min.js"></script>
    <script src="../app-assets/js/scripts/app-menu.js"></script>
    <script src="../app-assets/js/scripts/app.js"></script>
    <script src="../app-assets/js/scripts/dashboard-analytics.js"></script>
  
    <script src="../app-assets/js/scripts/chart.min.js"></script>
    <script>
        $(".todo-application .list-group-filters a").on('click', function () {
            if ($('.todo-application .list-group-filters a').hasClass('active')) {
                $('.todo-application .list-group-filters a').removeClass('active');
            }
            $(this).addClass("active");
        });
        
    </script>
 <!-- calander -->
 <script src="../app-assets/js/scripts/kamadatepicker.js"></script>
 <script>

    function gregorian_to_jalali(gy, gm, gd) {
        let g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
        let jy;
        if (gy > 1600) {
            jy = 979;
            gy -= 1600;
        } else {
            jy = 0;
            gy -= 621;
        }
        let gy2 = (gm > 2) ? (gy + 1) : gy;
        let days = (365 * gy) + (parseInt((gy2 + 3) / 4)) - (parseInt((gy2 + 99) / 100)) + (parseInt((gy2 + 399) / 400)) - 80 + gd + g_d_m[gm - 1];
        jy += 33 * (parseInt(days / 12053));
        days %= 12053;
        jy += 4 * (parseInt(days / 1461));
        days %= 1461;
        if (days > 365) {
            jy += parseInt((days - 1) / 365);
            days = (days - 1) % 365;
        }
        let jm = (days < 186) ? 1 + parseInt(days / 31) : 7 + parseInt((days - 186) / 30);
        let jd = 1 + ((days < 186) ? (days % 31) : ((days - 186) % 30));
        let resultY = jy;
        let resultM = jm < 10 ? "0" + jm.toString() : jm.toString();
        let resultD = jd < 10 ? "0" + jd.toString() : jd.toString();
        var today = resultY + '/' + resultM + '/' + resultD;
        return today;
    }

    function getNPassedDate(n) {
        var today = new Date();
        today.setDate(today.getDate() - n);
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        return gregorian_to_jalali(yyyy, mm, dd);
    }

    function getCurrentDate() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        return gregorian_to_jalali(yyyy, mm, dd);
    }

    function getCurrentTime() {
        var today = new Date();
        var hh = today.getHours();
        var mm = today.getMinutes();
        var ss = today.getSeconds();
        if (hh < 10)
            hh = '0' + hh;
        if (mm < 10)
            mm = '0' + mm;
        if (ss < 10)
            ss = '0' + ss;
        return hh + ':' + mm + ':' + ss;
    }

     var customOptions = {
            placeholder: "روز / ماه / سال",
            twodigit: false,
            closeAfterSelect: false,
            nextButtonIcon: "fa fa-arrow-circle-right",
            previousButtonIcon: "fa fa-arrow-circle-left",
            buttonsColor: "blue",
            forceFarsiDigits: true,
            markToday: true,
            markHolidays: true,
            highlightSelectedDay: true,
            sync: true,
            gotoToday: true,
            closeAfterSelect: true
        }
        kamaDatepicker('startDate', customOptions);
        kamaDatepicker('endDate', customOptions);

        var startDate = getNPassedDate(1);
        var stopDate = getCurrentDate();
        var startTime = getCurrentTime();
        var stopTime = getCurrentTime();
        document.getElementById("startDate").value = startDate;
        document.getElementById("endDate").value = stopDate;
        document.getElementById("startTime").value = startTime;
        document.getElementById("endTime").value = stopTime;
 </script>

 <!-- time -->
 <script src="../app-assets/js/scripts/moment.min.js"></script>
 <script type="text/javascript" src="../app-assets/js/scripts/datetimepicker.min.js">

 </script>

 <script>
     $(function () {


         /* setting time */
         $("#startTime").datetimepicker({
             format: "HH:mm"

         });
         $("#endTime").datetimepicker({
             format: "HH:mm"

         });

     });
 </script>

</script>
<script>

map();
usr();
cam();
</script>

</body>


</html>