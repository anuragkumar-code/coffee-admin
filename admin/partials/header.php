<?php include('config/db.php'); ?>

<!DOCTYPE html>
<html lang="en">	
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title>Big Apple Roaster</title>

		<link rel="icon" href="assets/itriangle_fav.webp" type="image/x-icon">
		<link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" id="style">

		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/plugins.css" rel="stylesheet">	

		<link href="assets/css/icons.css" rel="stylesheet">

		<link href="assets/css/animate.css" rel="stylesheet">
		<script src="assets/plugins/jquery/jquery.min.js"></script>

		<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>

		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap4.min.css">
	    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">
		
		<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	</head>

	<body class="main-body app sidebar-mini ltr">
		<div id="global-loader">
			<img src="assets/img/loaders/loader-4.svg" class="loader-img" alt="Loader">
		</div>
	   <div class="page custom-index">
			<div class="main-header side-header sticky nav nav-item">
				<div class="container-fluid main-container ">
					<div class="main-header-left ">
						<div class="app-sidebar__toggle mobile-toggle" data-bs-toggle="sidebar">
							<a class="open-toggle"   href="javascript:void(0);"><i class="header-icons" data-eva="menu-outline"></i></a>
							<a class="close-toggle"   href="javascript:void(0);"><i class="header-icons" data-eva="close-outline"></i></a>
						</div>
						<div class="responsive-logo">
							<a href="javascript:void(0)" class="header-logo"><img src="assets/itriangle_logo.png" class="logo-11" alt="logo"></a>
							<a href="javascript:void(0)" class="header-logo"><img src="assets/img/brand/logo-white.png" class="logo-1" alt="logo"></a>
						</div>
					</div>
					<button class="navbar-toggler nav-link icon navresponsive-toggler vertical-icon ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
						<i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
					</button>
					<div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0  mg-lg-s-auto">
						<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
							<div class="main-header-right">
								<div class="nav nav-item  navbar-nav-right mg-lg-s-auto">
									<div class="dropdown main-profile-menu nav nav-item nav-link" style="background:white">
										<a class="profile-user d-flex" href="javascript:void(0)"><img src="assets/img/users/sample.png" alt="user-img" class="rounded-circle mCS_img_loaded"><span></span></a>

										<div class="dropdown-menu">
											<div class="main-header-profile header-img rounded-top-5 p-3" style="background-color:#e17b76">
													<h6>Admin</h6>
											</div>
 											<a class="dropdown-item" href="functions/logout.php"><i class="fa fa-sign-out-alt"></i> Sign Out</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
