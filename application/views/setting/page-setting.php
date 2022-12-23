<form ecntype="multipart/form-data">
	<div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="box-body text-center">
							<img class="profile-user-img img-responsive img-circle" id="logo_img" src="" alt="Logo" width="100">
							<br>
							<p class="text-center text-bold">Lambang</p>
							<p class="text-muted text-center text-red">(Kosongkan, jika logo tidak berubah)</p>
							<br>
							<div class="form-group">
								<input class="form-control" type="file" id="logo" name="logo">
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
						<div class="col-md-12 col-xl-12 mb-3">
							<div class="form-group">
								<label for="nama_website">Nama Website</label>
								<input type="text" class="form-control" name="nama_website" id="nama_website">
							</div>
						</div>
						<div class="col-md-12 col-xl-12 mb-3">
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<textarea class="form-control" name="alamat" id="alamat" rows="2"></textarea>
							</div>
						</div>
						<div class="col-md-12 col-xl-4 mb-3">
							<div class="form-group">
								<label for="email">E-mail</label>
								<input type="text" class="form-control" name="email" id="email">
							</div>
						</div>
						<div class="col-md-12 col-xl-4 mb-3">
							<div class="form-group">
								<label for="telepon">Telepon</label>
								<input type="text" class="form-control" name="telepon" id="telepon">
							</div>
						</div>
						<div class="col-md-12 col-xl-4 mb-3">
							<div class="form-group">
								<label for="website">Website</label>
								<input type="text" class="form-control" name="website" id="website" readonly>
							</div>
						</div>
						<div class="col-md-12 col-xl-12 mb-3">
							<div class="form-group">
								<label for="tentang">Tentang</label>
								<textarea class="form-control" name="tentang" id="tentang" rows="2"></textarea>
							</div>
						</div>
						<div class="col-md-12 col-xl-12 mb-3">
							<div class="form-group">
								<label for="maps">Link Google Maps</label>
								<input type="text" class="form-control" name="maps" id="maps">
							</div>
						</div>
						<div class="col-md-12 col-xl-12">
							<button type="button" id="btnBatal" class="btn btn-danger"><i class="fa fa-times"></i> Batal</button>
							<button type="button" id="btnSimpan" class="btn btn-primary"><i class="bx bx-save"></i> Simpan </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$(document).ready(function() {
		get_dataSetting();

		//button action
		$("#btnSimpan").click(function() {
			if (confirm('Anda yakin ingin perbarui data?')) {
				save()
			}
		})
		$("#btnBatal").click(function() {
			if (confirm('Batal mengedit?')) {
				get_dataSetting();
			}
		})
	});

	//function
	function save() {
		$.ajax({
			url: base_url + 'setting/simpan/Edit/1',
			type: "POST",
			data: new FormData($("form").get(0)),
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function(res) {
				if (res.res) {
					a_ok('Berhasil! ' + res.msg);
					get_dataSetting();
				} else {
					a_error('Gagal! ' + res.msg);
				}
			}
		});
	}

	function get_dataSetting() {
		$.ajax({
			url: base_url + 'setting/dataSetting',
			method: "POST",
			dataType: "json",
			success: function(data) {
				if (data) {
					$("#logo_img").attr("src", base_url + "assets/img/" + data.logo);
					$("#nama_website").val(data.nama_website);
					$("#alamat").val(data.alamat);
					$("#email").val(data.email);
					$("#telepon").val(data.telepon);
					$("#website").val(data.website);
					$("#tentang").val(data.tentang);
					$("#maps").val(data.maps);
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}
</script>