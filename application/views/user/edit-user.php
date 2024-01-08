<form method="post" id="insert" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="id_user" id="id_user" value="<?= $detail['id_user'] ?>">
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
							<img class="profile-user-img img-responsive img-circle" id="foto_img" src="<?= base_url() ?>assets/img/foto_anggota/<?= $detail['image'] ?>" alt="Logo" style="width:100%;object-fit: cover; height: 200px; border-radius:5px;">
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
								<input type="email" class="form-control" name="email" id="email" value="<?= $detail['email'] ?>" required>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group">
								<label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="nama" id="nama" value="<?= $detail['nama'] ?>" required>
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
									<option value="LAKI-LAKI" <?= $detail['jk'] == 'LAKI-LAKI' ? 'selected' : '' ?>>Laki-Laki</option>
									<option value="PEREMPUAN" <?= $detail['jk'] == 'PEREMPUAN' ? 'selected' : '' ?>>Perempuan</option>
								</select>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xl-6 mb-3">
							<div class="form-group">
								<label for="nohp">Nomor Handphone <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="nohp" id="nohp" value="<?= $detail['nohp'] ?>" required>
								<div class="invalid-feedback">
									Form tidak boleh kosong!
								</div>
							</div>
						</div>
						<div class="col-md-12 col-xl-12 mb-3">
							<div class="form-group">
								<label for="alamat">Alamat <span class="text-danger">*</span></label>
								<textarea class="form-control" name="alamat" id="alamat" rows="2" required><?= $detail['alamat'] ?></textarea>
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
										<option value="<?= $row['id_level'] ?>" <?= $row['id_level'] == $detail['level'] ? 'selected' : '' ?>><?= $row['nama_level'] ?></option>
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
										<option value="<?= $row['id_regional'] ?>" <?= $row['id_regional'] == $detail['id_regional'] ? 'selected' : '' ?>><?= $row['nama_regional'] ?></option>
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
									<option value="0" <?= $detail['id_dealer'] == 0 ? 'selected' : '' ?>>Tidak Ada</option>
									<?php foreach($dealer as $row) { ?>
										<option value="<?= $row['id_dealer'] ?>" <?= $row['id_dealer'] == $detail['id_dealer'] ? 'selected' : '' ?>><?= $row['nama_dealer'] ?></option>
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
								Update </button>
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
		var regional = <?= $detail['id_regional'] ?>;
		if(regional){
			$('#div_regional').show();
			$('#div_dealer').hide();
		}else{
			$('#div_dealer').show();
			$('#div_regional').hide();
		}
        var id_user = $('#id_user').val();
        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>user/update/' + id_user,
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
						window.location.replace(data.redirect);
                    }
                }
            });
        });
    });
</script>