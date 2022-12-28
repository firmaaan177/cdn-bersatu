<!-- NOTIFICATION -->
<?php if ($this->session->flashdata('message')) { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			toastr.options.timeOut = 3500;
			toastr.options.progressBar = true;
			toastr.options.positionClass = "toast-top-right";
			toastr.success('<?= $this->session->flashdata('message') ?>');
		});
	</script>
<?php } ?>

<?php if(in_array($this->session->userdata('id_user'),  explode(",",LEVEL_AKSES_ADMIN))) { ?>
<div class="row mb-4">
	<div class="col-md-3">
		<div class="input-group">
			<select class="form-select select2" name="id_dealer" id="id_dealer">
				<option value="">Semua Dealer</option>
				<?php foreach($dealer as $row){ ?>
					<option value="<?= $row['id_dealer'] ?>"><?= $row['nama_dealer'] ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>
<?php } ?>

<div class="row" id="load">
	<?php foreach($powerbi as $row) { ?>
		<div class="col-lg-4">
			<div class="card card-body">
				<a href="<?= base_url() ?>dashboard/powerbi/<?= encrypt_url($row['id_powerbi']) ?> "><h4 class="card-title"><i class="uil-chart-bar text-primary me-2"></i><?= $row['nama_kategori'] ?> <span class="badge rounded-pill bg-primary font-size-12"><?= $row['nama_regional'] ?></span></h4></a> 
				<p class="card-text"><?= word_limiter($row['deskripsi'], 20) ?></p>
			</div>
		</div>
	<?php } ?>
</div>

<script>
    $(document).ready(function() {
		$('#id_dealer').on('change', function() {
			$.ajax({
				url: '<?= base_url() ?>dashboard/filter/' + this.value,
				type: "POST",
                // dataType: 'json',
				data: {
					id_dealer : this.value
				},
				success: function(data) {
					console.log(data);
					$('#load').html(data);
				}
			});
		});
	});
</script>