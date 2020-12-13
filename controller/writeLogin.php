<?php
function writeLogin($flag = true) {
    if ($flag)
        echo <<< label
        
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title>ورود به سامانه</title>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/custom-rtl.css">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="../pr/app-assets/images/pages/login.png" alt="branding logo">
                                    <p class="auto-in">سامانه مانیتورینگ و تجمیع داده</p>
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header my-head pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">ورود به سامانه</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form action="index.php" method="POST">
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input name="username" type="text" class="form-control" id="user-name" placeholder=" نام کاربری" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name"> نام کاربری</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" name="password" class="form-control" id="user-password" placeholder="رمز عبور" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">رمز عبور</label>
                                                    </fieldset>
                                                    <!-- <div class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <fieldset class="checkbox">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">مرا به خاطر بسپار </span>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-center">
                                                            <p class="text-danger">نام کاربری با رمز عبور تطابق ندارد</p>
                                                        </div>
                                                    </div> -->
                                                    <button type="submit" class="btn btn-primary float-right btn-inline logbtn">ورود</button>
                                                </form>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->



</body>
<!-- END: Body-->

</html>
        
label;
    else {
        echo <<< label
        
        <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="PIXINVENT">
    <title>ورود به سامانه</title>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="../pr/app-assets/css-rtl/custom-rtl.css">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="../pr/app-assets/images/pages/login.png" alt="branding logo">
                                    <p class="auto-in">سامانه مانیتورینگ و تجمیع داده</p>
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header my-head pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">ورود به سامانه</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form action="index.php" method="POST">
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input name="username" type="text" class="form-control" id="user-name" placeholder=" نام کاربری" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name"> نام کاربری</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" name="password" class="form-control" id="user-password" placeholder="رمز عبور" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">رمز عبور</label>
                                                    </fieldset>
                                                    <!-- <div class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <fieldset class="checkbox">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">مرا به خاطر بسپار </span>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div> -->
                                                    <div class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-center">
                                                            <p class="text-danger">نام کاربری با رمز عبور تطابق ندارد</p>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary float-right btn-inline logbtn">ورود</button>
                                                </form>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->



</body>
<!-- END: Body-->

</html>
        
label;
    }
}