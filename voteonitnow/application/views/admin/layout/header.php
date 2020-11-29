<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />

	<title>Admin - Dashboard</title>

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Arimo:400,700,400italic">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/xenon-core.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/xenon-components.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/custom.css">
	<script src="<?php echo BASE_URL; ?>/assets/js/jquery-1.11.1.min.js"></script>

</head>

<body class="page-body">	
	<div class="page-container">
        <?php require_once (BASE_DIR . "/application/views/admin/layout/sidebar.php"); ?>

		<div class="main-content">
			<nav class="navbar user-info-navbar"  role="navigation">

				<ul class="user-info-menu left-links list-inline list-unstyled">
					<li class="hidden-sm hidden-xs">
						<a href="#" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
					</li>
				</ul>			
			
				
				<ul class="user-info-menu right-links list-inline list-unstyled">		
					<li class="dropdown user-profile">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php if($image=$this->getSession('adminimage')){echo BASE_URL.'/public/assets/images/admin/'.$image;}else{echo BASE_URL.'/assets/images/user-4.png';}?>" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								<?php if($username=$this->getSession('adminname')){echo $username;}?>
								<i class="fa-angle-down"></i>
							</span>
						</a>

						<ul class="dropdown-menu user-profile-menu list-unstyled">
							<li>
								<a href="<?php echo BASE_URL.'/admin/profile/adminprofile'?>">
									<i class="fa-user"></i>
									Profile
								</a>
							</li>
							
							<li class="last">
								<a href="<?php echo BASE_URL.'/admin/users/logout'?>">
									<i class="fa-lock"></i>
									Logout
								</a>
							</li>
						</ul>
					</li>
			
					<li>
						<a href="" data-toggle="chat">
							
						</a>
					</li>
			
				</ul>
			
			</nav>