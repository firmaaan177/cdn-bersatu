<?php
$id = $this->session->userdata('id_user');
$user = $this->db->query("select * from user where id_user = '$id'")->row_array();
// HAK AKSES
$roles = $this->db->where('id_level', $this->session->userdata('level'))->get('roles')->row_array();
$id_menu = explode(',',$roles['id_menu']);

$menu = $this->db->where_in('id_menu', $id_menu)->get('menu')->result_array();

if($this->session->userdata('level') == 5){
	$this->db->join('nos_data', 'nos_data.id_nos_data = nos_audit.id_nos_data','left');
	$notifikasi = $this->db->where('id_dealer', $this->session->userdata('id_dealer'))->where('is_perbaikan', 1)->get('nos_audit')->result_array();
}else if($this->session->userdata('level') == 6){
	$this->db->join('nos_data', 'nos_data.id_nos_data = nos_audit.id_nos_data','left');
	$notifikasi = $this->db->where('id_dealer', $this->session->userdata('id_dealer'))->where('is_perbaikan', 2)->get('nos_audit')->result_array();
}else{
	$notifikasi = 0;
}
?>

<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<title><?= $title ?> - Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Simeulueinn" name="description" />
	<meta content="Simeulueinn" name="author" />
	<!-- App favicon -->
	<!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->

	<!-- Datatables -->
	<link href="<?= base_url(); ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url(); ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Responsive datatable examples -->
	<link href="<?= base_url(); ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Plugins -->
	<link href="<?= base_url(); ?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/libs/chenfengyuan/datepicker/datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/libs/toastr/build/toastr.min.css">
	<link href="<?= base_url(); ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Css -->
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
	<!-- Icons Css -->
	<link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<!-- App Css-->
	<script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/libs/select2/js/select2.min.js"></script>
	<style>
		.select2-container {
			width: 100% !important;
			padding: 0;
		}
	</style>
</head>


<body data-sidebar="dark">

	<!-- Begin page -->
	<div id="layout-wrapper">

		<header id="page-topbar">
			<div class="navbar-header">
				<div class="d-flex">
					<!-- LOGO -->
					<div class="navbar-brand-box">
						<a href="#" class="logo logo-dark">
							<span class="logo-sm">
								<img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="22">
							</span>
							<span class="logo-lg">
								<img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="20">
							</span>
						</a>

						<a href="#" class="logo logo-light">
							<span class="logo-sm">
								<img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="22">
							</span>
							<span class="logo-lg">
								<img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="20">
							</span>
						</a>
					</div>

					<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
						<i class="fa fa-fw fa-bars"></i>
					</button>
				</div>

				<div class="d-flex">

					<div class="dropdown d-none d-lg-inline-block ms-1">
						<button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
							<i class="uil-minus-path"></i>
						</button>
					</div>

					<div class="dropdown d-inline-block">
						<button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="uil-bell"></i>
							<span class="badge bg-danger rounded-pill"><?= !empty($notifikasi) ? count($notifikasi) : 0 ?></span>
						</button>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
							aria-labelledby="page-header-notifications-dropdown">
							<div class="p-3">
								<div class="row align-items-center">
									<div class="col">
										<h5 class="m-0 font-size-16"> Notifikasi </h5>
									</div>
								</div>
							</div>
							<div data-simplebar style="max-height: 230px;">
							<?php if(!empty($notifikasi)) { ?>
								<?php foreach($notifikasi as $row) { ?>
								<a href="<?= base_url(); ?>nos/detail_mot/<?= encrypt_url($row['id_nos']) ?>/<?= str_replace("&", "dan", $row['mot']); ?>" class="text-reset notification-item">
									<div class="d-flex align-items-start">
										<div class="avatar-xs me-3">
											<span class="avatar-title bg-primary rounded-circle font-size-16">
												<i class="uil-bell"></i>
											</span>
										</div>
										<div class="flex-1">
											<h6 class="mt-0 mb-1"><?= $row['item'] ?></h6>
											<div class="font-size-12 text-muted">
												<p class="mb-1"><?= $row['sub_item_2'] ?></p>
												<p class="mb-0"><i class="uil-edit"></i> <?= $row['is_perbaikan'] == 1 ? 'Perbaikan' : 'Telah Diperbaiki'; ?></p>
											</div>
										</div>
									</div>
								</a>
								<?php } ?>
							<?php }else{  ?>
								<p class="text-center">Tidak ada Notifikasi.</p>
							<?php } ?>
							</div>
							<?php if(!empty($notifikasi)) { ?>
							<div class="p-2 border-top d-grid">
								<a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
									<i class="uil-arrow-circle-right me-1"></i> View More..
								</a>
							</div>
							<?php } ?>
						</div>
					</div>

					<div class="dropdown d-inline-block">
						<button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img class="rounded-circle header-profile-user" src="<?= base_url(); ?>assets/img/foto_anggota/<?= $user['image'] ?>" alt="Header Avatar">
							<span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Halo, <?= $user['nama'] ?></span>
							<i class="uil-angle-down d-none d-xl-inline-block font-size-15"></i>
						</button>
						<div class="dropdown-menu dropdown-menu-end">
							<!-- item-->
							<a class="dropdown-item" href="<?= base_url(); ?>auth/changepass"><i class="uil uil-key-skeleton-alt font-size-18 align-middle text-muted me-1"></i>
								<span class="align-middle">Ganti Password</span></a>
							<a class="dropdown-item" href="<?= base_url(); ?>auth/profile"><i class="uil uil-user-circle font-size-18 align-middle text-muted me-1"></i> <span class="align-middle">Profil User</span></a>
							<a class="dropdown-item" href="<?= base_url(); ?>auth/logout"><i class="uil uil-sign-out-alt font-size-18 align-middle me-1 text-muted"></i> <span class="align-middle">Logout</span></a>
						</div>
					</div>

				</div>
			</div>
		</header>
		<!-- ========== Left Sidebar Start ========== -->
		<div class="vertical-menu">

			<!-- LOGO -->
			<div class="navbar-brand-box">
				<a href="#" class="logo logo-dark">
					<span class="logo-sm">
						<img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="32">
					</span>
					<span class="logo-lg">
						<img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="35">
					</span>
				</a>

				<a href="#" class="logo logo-light">
					<span class="logo-sm">
						<img src="<?= base_url(); ?>assets/images/logo-white.png" alt="" height="32">
					</span>
					<span class="logo-lg">
						<img src="<?= base_url(); ?>assets/images/logo-white.png" alt="" height="35">
					</span>
				</a>
			</div>

			<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
				<i class="fa fa-fw fa-bars"></i>
			</button>

			<div data-simplebar class="sidebar-menu-scroll">

				<!--- Sidemenu -->
				<div id="sidebar-menu">
					<!-- Left Menu Start -->
					<ul class="metismenu list-unstyled" id="side-menu">
						<li class="menu-title">Main Menu</li>

						<!-- MENU DINAMIS -->
						<?php 
							foreach($menu as $row) {
								if(empty($row['parent_id']) && !empty($row['path'])){ 
						?>
							<li>
								<a href="<?= base_url(); ?><?= $row['path'] ?>">
									<i class="<?= $row['icon'] ?>"></i>
									<span><?= $row['nama_menu'] ?></span>
								</a>
							</li>

						<?php }else if(empty($row['parent_id']) && empty($row['path'])){ 
							$menu_child = $this->db->where('parent_id', $row['id_menu'])->order_by('urutan','asc')->get('menu')->result_array();
						?>
							<li>
								<a href="javascript: void(0);" class="has-arrow waves-effect">
									<i class="uil-clipboard-notes"></i>
									<span><?= $row['nama_menu'] ?></span>
								</a>
								<ul class="sub-menu" aria-expanded="false">
									<?php foreach($menu_child as $sub) { ?>
										<li><a href="<?= base_url(); ?><?= $sub['path'] ?>"><?= $sub['nama_menu'] ?></a></li>
									<?php }?>
								</ul>
							</li>
							<?php }?>
						<?php } ?>
						<!-- END MENU DINAMIS -->
					</ul>
				</div>
				<!-- Sidebar -->
			</div>
		</div>
		<!-- Left Sidebar End -->