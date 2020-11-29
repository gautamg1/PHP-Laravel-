
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dirto - Listing & Directory Template</title>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo BASE_URL; ?>/assets/images/favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:100,200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Template CSS Files -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="css/font-awesome.css">-->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/line-awesome.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/animated-headline.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/daterangepicker.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/jquery.filer.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/jquery.filer-dragdropbox-theme.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
    <script src="<?php echo BASE_URL; ?>/assets/js/modernizr.js"></script> <!-- Modernizr -->
    <style>.error{ color: red; }</style>
</head>
<body>

<div class="loader-container">
    <div class="lds-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<!-- end per-loader -->

<!-- ================================
            START HEADER AREA
================================= -->
<header class="header-area">
    <div class="header-menu-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="menu-full-width">
                        <div class="logo">
                            <a href=""><img src="images/logo.png" alt="logo"></a>
                        </div><!-- end logo -->
                        <div class="main-menu-content">
                            <nav>
                                <ul>
                                    <li>
                                        <a href="<?php echo BASE_URL;?>">home</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL;?>">Polls <span class="fa fa-angle-down"></span></a>
                                        <ul class="dropdown-menu-item">
                                            <li><a href="<?php echo BASE_URL;?>">Poll List</a></li>
                                            <li><a href="<?php echo BASE_URL;?>/poll">New Poll</a></li>
                                        </ul>
                                    </li>
                                    <?php if(!isset($_SESSION['userId'])) : ?>
                                        <li>
                                            <a href="<?php echo BASE_URL;?>/user/login">login</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo BASE_URL;?>/user/signup">sign up</a>
                                        </li>
                                    <?php else: ?>


                                        <li>
                                            <a href=""><?php echo $_SESSION['userName']; ?> <span class="fa fa-angle-down"></span></a>
                                            <ul class="dropdown-menu-item">
                                                <li><a href="<?php echo BASE_URL;?>/user/logout">logout</a></li>
                                            </ul>
                                        </li>
                                    <li>
                                        <a href="#" class="author-img-box">
                                            <img src="<?php echo BASE_URL; ?>/assets/images/users/<?php echo $_SESSION['image']; ?>" class=" img-circle" height="50" width="50" alt="author-img">
                                        </a>
                                    <li>

                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div><!-- end main-menu-content -->

                    </div><!-- end menu-full-width -->
                </div><!-- end col-md-12 -->
            </div><!-- end row -->
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-wrapper -->
</header>
<!-- ================================
         END HEADER AREA
================================= -->

<!-- ================================
    START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area">
    <div class="bread-svg">
        <svg viewBox="0 0 500 150" preserveAspectRatio="none">
            <path d="M-4.22,89.30 C280.19,26.14 324.21,125.81 511.00,41.94 L500.00,150.00 L0.00,150.00 Z"></path>
        </svg>
    </div><!-- end bread-svg -->
</section><!-- end breadcrumb-area -->
<!-- ================================
    END BREADCRUMB AREA
================================= -->