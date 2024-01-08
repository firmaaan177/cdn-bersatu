<form method="post" id="insert" enctype="multipart/form-data" novalidate>
	<div class="row">
		<div class="col-md-12">
			<a href="<?= base_url(); ?>user" class="btn btn-danger btn-sm mb-3"><i class="fa fa-angle-left"></i>
				Kembali</a>
		</div>
		<div class="col-md-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="box-body text-center">
							<img class="profile-user-img img-responsive img-circle" width="200" id="foto_img" src="<?= base_url() ?>assets/img/foto_anggota/default.jpg" alt="Logo">
							<br>
							<p class="text-muted text-center text-red mb-0 mt-3">(Kosongkan, jika tidak merubah foto)</p>
							<p class="text-muted text-center text-red">Format : jpg, png, jpeg <br> Maksimal size <b>1 MB</b></p>
							<br>
							<div class="form-group">
								<input class="form-control" type="file" id="image" name="image">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group"> 
								<label for="email">Email <span class="text-danger">*</span></label>
								<input type="email" class="form-control" name="email" id="email" required>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group"> 
								<label for="">Password <span class="text-danger">*</span> <small>(Password Default)</small></label>
								<input type="text" class="form-control" name="password" id="password" value="cdn123" required readonly>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group">
								<label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="nama" id="nama" required>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group">
								<label for="jk">Jenis Kelamin <span class="text-danger">*</span></label>
								<select class="form-control select2" name="jk" id="jk" required>
									<option value="">-- Jenis Kelamin --</option>
									<option value="LAKI-LAKI">Laki-Laki</option>
									<option value="PEREMPUAN">Perempuan</option>
								</select>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group">
								<label for="nohp">Nomor Handphone <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="nohp" id="nohp" required>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xl-12 mb-3">
							<div class="form-group">
								<label for="alamat">Alamat <span class="text-danger">*</span></label>
								<textarea class="form-control" name="alamat" id="alamat" rows="2" required></textarea>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group">
								<label for="level">Hak Akses <span class="text-danger">*</span></label>
								<select class="form-control select2" name="level" id="level" required>
									<option value="" selected disabled>- Pilih Hak Akses -</option>
									<?php foreach($level as $row) { ?>
										<option value="<?= $row['id_level'] ?>"><?= $row['nama_level'] ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>

						<div class="col-md-6 col-xl-6 mb-3" id="div_regional">
							<div class="form-group">
								<label for="level">Regional <span class="text-danger">*</span></label>
								<select class="form-control select2" name="id_regional" id="id_regional" required>
									<option value="" selected disabled>- Pilih Regional -</option>
									<?php foreach($regional as $row) { ?>
										<option value="<?= $row['id_regional'] ?>"><?= $row['nama_regional'] ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						
						<div class="col-md-6 col-xl-6 mb-3" id="div_dealer">
							<div class="form-group">
								<label for="level">Dealer <span class="text-danger">*</span></label>
								<select class="form-control select2" name="id_dealer" id="id_dealer" required>
									<option value="" selected disabled>- Pilih Dealer -</option>
									<?php foreach($dealer as $row) { ?>
										<option value="<?= $row['id_dealer'] ?>"><?= $row['nama_dealer'] ?></option>
									<?php } ?>
								</select>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<input type="hidden" name="status" value="1">
						<div class="col-md-12 col-xl-12">
							<button type="button" id="save" class="btn btn-primary"><i class="bx bx-save"></i>
								Simpan </button>
							<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>
								Batal</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$('#level').on('change', function() {
		if(this.value == 5){
			$('#div_dealer').show();
			$('#div_regional').hide();
		}else{
			$('#div_regional').show();
			$('#div_dealer').hide();
		}
	});
</script>
<script>
    $(document).ready(function() {
		$('#div_dealer').hide();
		$('#div_regional').hide();

        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>user/insert',
                type: "POST",
                dataType: 'json',
                data: new FormData($("form").get(0)),
				cache: false,
				contentType: false,
				processData: false,
                success: function(data) {
                    if (data.success == false) {
                        toastr.options.progressBar = true;
                        toastr.options.positionClass = "toast-top-right";
                        toastr.warning(data.msg);
                    }if (data.success == true) {
						console.log(data);
						window.location.replace(data.redirect);
                    }
                }
            });
        });
    });
</script>