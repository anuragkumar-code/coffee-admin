<?php session_start();
include ('functions/generic_function.php');

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);

if($current_page != 'dashboard.php'){
	if (!hasAccess($current_page)) {
		header("Location: functions/logout.php");
		exit();
	}
}


$admin_roles = $_SESSION['admin_role'];

?>

<!-- main-sidebar -->
<style type="text/css">
	.logo-span {
	  width: 75px; 
	  height: 73px; 
	  background-color: #1F497D; 
	  color: white; 
	  font-size: 35px;
	  text-align: center;
	  line-height: 75px; 
	  display: inline-block;
	}

</style>

<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
	<div class="sticky">
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="javascript:void(0)"><img src="assets/logo.jpg" class="main-logo" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="javascript:void(0)"><img src="assets/logo.jpg" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="main-sidebar-loggedin">
					<div class="app-sidebar__user d-none">
						<div class="dropdown user-pro-body text-center">
							<div class="user-pic">
								<span class="rounded-circle mCS_img_loaded logo-span"><?php echo strtoupper(mb_substr("Big Apple", 0, 2)); ?></span>
							</div>
							<div class="user-info mb-4">
								<h6 class=" mb-0 text-dark">Admin</h6>
							</div>
						</div>
					</div>
				</div>
				<div class="slide-left disabled" id="slide-left">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
						<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/>
					</svg>
				</div>
				<ul class="side-menu ">
					<li class="slide">
						<a class="side-menu__item" data-bs-toggle="slide" href="dashboard.php"><i class="side-menu__icon fas fa-chart-line"></i><span class="side-menu__label">Dashboard</span></a>
					</li>

					<?php if (hasRole($admin_roles, 'superadmin') || hasRole($admin_roles, 'coffeebeansmanagement')) { ?>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="coffee-beans-management.php"><i class="side-menu__icon fas fa-coffee"></i><span class="side-menu__label">Coffee Beans Management</span></a>
						</li>
					<?php } ?>

					<?php if (hasRole($admin_roles, 'superadmin') || hasRole($admin_roles, 'customermanagement')) { ?>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="customer-management.php"><i class="side-menu__icon fas fa-user-cog"></i><span class="side-menu__label">Customer Management</span></a>
						</li>
					<?php } ?>

					<?php if (hasRole($admin_roles, 'superadmin') || hasRole($admin_roles, 'businessmanagement')) { ?>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="business-management.php"><i class="side-menu__icon fas fa-users-cog"></i><span class="side-menu__label">Business Management</span></a>
						</li>
					<?php } ?>

					<?php if (hasRole($admin_roles, 'superadmin') || hasRole($admin_roles, 'ordersmanagement')) { ?>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="orders-management.php"><i class="side-menu__icon fas fa-shopping-bag"></i><span class="side-menu__label">Order Management</span></a>
						</li>
					<?php } ?>

					<?php if (hasRole($admin_roles, 'superadmin') || hasRole($admin_roles, 'offermanagement')) { ?>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="offer-management.php"><i class="side-menu__icon fas fa-rocket"></i><span class="side-menu__label">Offer Management</span></a>
						</li>
					<?php } ?>

					<?php if (hasRole($admin_roles, 'superadmin')) { ?>
						<li class="slide">
							<a class="side-menu__item" data-bs-toggle="slide" href="admin-management.php"><i class="side-menu__icon fas fa-user-tie"></i><span class="side-menu__label">Admin Management</span></a>
						</li>
					<?php } ?>
				</ul>
				<div class="slide-right" id="slide-right">
					<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
						<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/>
					</svg>
				</div>
			</div>
		</aside>
	</div>
<!-- main-sidebar -->


