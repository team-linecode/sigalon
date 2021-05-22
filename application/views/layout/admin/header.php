<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SIGALON - <?= $title ?? 'No title' ?></title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Plugins CSS -->
	<link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
	<link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">

	<!-- Sweetalert -->
	<script src="<?= base_url('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js') ?>"></script>

	<script type="text/javascript">
		var BASE_URL = "<?= base_url(); ?>";
	</script>
</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-text mx-3">SIGALON</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<?php if (user()->level == 'Admin') : ?>
				<!-- Nav Item - Dashboard -->
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('dashboard') ?>">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Dashboard</span></a>
				</li>

				<!-- Heading -->
				<div class="sidebar-heading">
					Admin Menu
				</div>

				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('user') ?>">
						<i class="fas fa-fw fa-users"></i>
						<span>Users</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('product') ?>">
						<i class="fas fa-fw fa-boxes"></i>
						<span>Product</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('supplier') ?>">
						<i class="fas fa-fw fa-user-friends"></i>
						<span>Suplier</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('payment_method') ?>">
						<i class="fas fa-fw fa-dollar-sign"></i>
						<span>Metode Pembayaran</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('site') ?>">
						<i class="fas fa-fw fa-globe"></i>
						<span>Sites</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('transaction') ?>">
						<i class="fas fa-fw fa-cash-register"></i>
						<span>Transaksi</span>
					</a>
				</li>
			<?php else : ?>
				<!-- Heading -->
				<div class="sidebar-heading">
					Customer Menu
				</div>

				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('order') ?>">
						<i class="fas fa-fw fa-shopping-cart"></i>
						<span>Pesanan Saya</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('transaction/create') ?>">
						<i class="fas fa-fw fa-plus-circle"></i>
						<span>Buat Pesanan</span>
					</a>
				</li>
			<?php endif ?>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= user()->name ?></span>
								<img class="img-profile rounded-circle" src="img/undraw_profile.svg">
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
									Activity Log
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<h1 class="h3 mb-4 text-gray-800"><?= $title ?? 'No title' ?></h1>