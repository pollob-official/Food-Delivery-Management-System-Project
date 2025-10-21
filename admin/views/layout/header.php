<?php session_start();
  require_once("configs/config.php");
  require_once("helpers/helper.php");
  require_once("libraries/library.php");
  require_once("models/model.php");
  require_once("controllers/controller.php");
  
  if(!isset($_SESSION["uid"])) header("location:$base_url");
  $uid=$_SESSION["uid"];
  

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from themes.pixelstrap.net/zomo/landing/backend/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Sep 2025 05:58:52 GMT -->
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Zomo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template,Zomo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?php echo  $base_url?>/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo  $base_url?>/assets/images/favicon.png" type="image/x-icon">
    <title>Zomo - Dashboard</title>

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Linear Icon css -->
    <link rel="stylesheet" href="<?php echo  $base_url?>/assets/css/linearicon.css">

    <!-- fontawesome css -->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vendors/font-awesome.css">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vendors/themify.css">

    <!-- ratio css -->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/ratio.css">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/remixicon.css">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vendors/feather-icon.css">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vendors/animate.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vendors/bootstrap.css">

    <!-- vector map css -->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vector-map.css">

    <!-- swiper slider -->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/vendors/swiper-bundle.min.css">

    <!-- Slick Slider Css -->
    <link rel="stylesheet" href="<?php echo  $base_url?>/assets/css/vendors/slick.css">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="<?php echo  $base_url?>/assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <i class="ri-arrow-up-double-fill"></i>
    </div>
    <!-- tap on tap end -->

    <!-- loader start -->
    <!-- <div class="loader-wrapper"> 
        <img src="<?php echo  $base_url?>/assets/images/loader.gif" alt="">
    </div> -->
    <!-- loader end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper m-0">
                <div class="header-logo-wrapper p-0">
                    <div class="logo-wrapper">
                        <a href="index.html">
                            <img class="img-fluid main-logo" src="<?php echo  $base_url?>/assets/images/logo/1.png" alt="logo">
                            <img class="img-fluid white-logo" src="<?php echo  $base_url?>/assets/images/logo/1-white.png" alt="logo">
                        </a>
                    </div>
                     <div class="toggle-sidebar">
                        <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                        <a href="index.html">
                            <img class="img-fluid for-light" src="<?php echo  $base_url?>/assets/images/logo/1.png" alt="logo">
                            <img class="img-fluid for-dark" src="<?php echo  $base_url?>/assets/images/logo/1-white.png" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="welcome-title">
                    <h5>
                        Food that's you loved!
                        <img src="<?php echo  $base_url?>/assets/images/header.gif" alt="">
                    </h5>
                    <span>
                        Delight your taste with our most famous food !!
                    </span>
                </div>
                <div class="nav-right col-xl-6 col-5 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="search-icon">
                            <span class="header-search">
                                <i class="ri-search-line"></i>
                            </span>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <i class="ri-notification-line"></i>
                                <span class="badge rounded-pill badge-theme">4</span>
                            </div>
                            <ul class="notification-dropdown onhover-show-div">
                                <li>
                                    <i class="ri-notification-line"></i>
                                    <h4 class="mb-0">Notitications</h4>
                                </li>
                                <li>
                                    <p>
                                        <i class="fa fa-circle me-2 font-primary"></i>Delivery processing <span
                                            class="pull-right">10 min.</span>
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <i class="fa fa-circle me-2 font-success"></i>Order Complete<span
                                            class="pull-right">1 hr</span>
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <i class="fa fa-circle me-2 font-info"></i>Tickets Generated<span
                                            class="pull-right">3 hr</span>
                                    </p>
                                </li>
                                <li>
                                    <p>
                                        <i class="fa fa-circle me-2 font-danger"></i>Delivery Complete<span
                                            class="pull-right">6 hr</span>
                                    </p>
                                </li>
                                <li>
                                    <a class="btn btn-primary" href="javascript:void(0)">Check all notification</a>
                                </li>
                            </ul>
                        </li>
                        <li class="onhover-dropdown">
                            <div class="messages-box">
                                <i class="ri-message-3-line"></i>
                            </div>
                            <ul class="messages-dropdown onhover-show-div">
                                <li>
                                    <i class="ri-message-3-line"></i>
                                    <h4 class="mb-0">Messages</h4>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?php echo  $base_url?>/assets/images/user/1.jpg" alt="">
                                        <div>
                                            <h5>
                                                Nullam tempor
                                            </h5>
                                            <p>Curabitur facilisis erat viverra.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?php echo  $base_url?>/assets/images/user/2.jpg" alt="">
                                        <div>
                                            <h5>
                                                Nullam tempor
                                            </h5>
                                            <p>Curabitur facilisis erat viverra.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?php echo  $base_url?>/assets/images/user/3.jpg" alt="">
                                        <div>
                                            <h5>
                                                Nullam tempor
                                            </h5>
                                            <p>Curabitur facilisis erat viverra.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?php echo  $base_url?>/assets/images/user/4.jpg" alt="">
                                        <div>
                                            <h5>
                                                Nullam tempor 
                                            </h5>
                                            <p>Curabitur facilisis erat viverra.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a class="btn btn-primary" href="javascript:void(0)">Go to Inbox</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="mode">
                                <i class="ri-moon-line"></i>
                            </div>
                        </li>
                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                            <div class="media profile-media">
                                <img width="50px" class="user-profile rounded-circle" src="<?php echo  $base_url?>/assets/images/users/11.jpg" alt="">
                                <div class="user-name-hide media-body">
                                    <span>Pollob Ahmed Sagor </span>
                                    <p class="mb-0 font-roboto">Admin<i class="middle ri-arrow-down-s-line"></i></p>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li>
                                    <a href="all-users.html">
                                        <i data-feather="users"></i>
                                        <span>Users</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $base_url?>/order">
                                        <i data-feather="archive"></i>
                                        <span>Orders</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="support-ticket.html">
                                        <i data-feather="phone"></i>
                                        <span>Spports Tickets</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="profile-setting.html">
                                        <i data-feather="settings"></i>
                                        <span>Settings</span>
                                    </a>
                                </li>
                                <li>
                     <a href="#"
                            class="d-flex align-items-center text-danger px-1"
                            onclick="if(confirm('Are you sure you want to logout?')) window.location.href='<?php echo $base_url; ?>/logout.php';">
                            <i class="bi bi-power me-1" style="font-size: 1.2rem;"></i>
                            <span>Logout</span>
                        </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="input-box">
                    <i class="ri-search-line"></i>
                    <input class="search-box" type="search" placeholder="What are you looking for?">
                    <i class="close-icon" data-feather="x"></i>
                </div>
            </div>
        </div> 
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
       

            <?php include "main_sidebar.php"?>
            <!-- Page Sidebar Ends-->

            <!-- index body start -->
            <div class="page-body">
                <div class="container-fluid">