<?php $this->load->view($header); ?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

	<div class="page-content">
		<div class="container-fluid">

			<!-- start page title -->
			<div class="row">
				<div class="col-12">
					<div class="page-title-box">
						<h3 class="mb-0"><?= $title; ?></h3>
						<div class="mt-3">
							<ol class="breadcrumb m-0">
								<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
								<li class="breadcrumb-item active"><?= $title; ?></li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<!-- end page title -->
			<?php $this->load->view($content); ?>

		</div> <!-- container-fluid -->
	</div>
	<!-- End Page-content -->


	<footer class="footer">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<script>
						document.write(new Date().getFullYear())
					</script> © PT. Capella Dinamik Nusantara.
				</div>
				<div class="col-sm-6">
					<div class="text-sm-end d-none d-sm-block">
						Created <i class="mdi mdi-heart text-danger"></i> by <a href="#" target="_blank" class="text-reset">Firman</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>
<!-- end main content-->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<script>
	$(document).ready(function() {
		$('.select2').select2({
			// placeholder: "Please select",
			allowClear: true
		});

		setTimeout(function(){
			$('body').addClass('preloader');
			$('h1').css('color','#222222');
		}, 3000);
		
	});

</script>

<!-- JAVASCRIPT -->
<script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
<!-- Required datatable js -->
<script src="<?= base_url(); ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url(); ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?= base_url(); ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- plugins -->
<script src="<?= base_url(); ?>assets/libs/select2/js/select2.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/chenfengyuan/datepicker/datepicker.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/toastr/build/toastr.min.js"></script>
<script src="<?= base_url(); ?>assets/js/pages/form-validation.init.js"></script>
<script src="<?= base_url(); ?>assets/libs/parsleyjs/parsley.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
<script src="<?= base_url(); ?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?= base_url(); ?>assets/js/sweetalert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- Magnific Popup-->
<script src="<?= base_url(); ?>assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- lightbox init js-->
<script src="<?= base_url(); ?>assets/js/pages/lightbox.init.js"></script>

<script src="<?= base_url(); ?>assets/js/app.js"></script>

</body>

</html>