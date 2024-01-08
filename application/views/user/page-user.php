<div class="row">
	<div class="col-md-12 col-xl-12">
		<div class="card">
			<div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="mb-0">Daftar <?= $title; ?></h5>
                    </div>
                    <div class="col-md-8">
                        <a href="<?= base_url(); ?>user/tambah" class="btn btn-success btn-sm float-end"><i class="uil uil-plus"></i> Tambah Data </a>
                    </div>
                </div>
            </div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 col-xl-12 mb-3">
						<div class="table-responsive">
							<table id="datatables" class="table">
								<thead>
									<tr>
										<th class="text-center" width="1">No</th>
										<th width="50">Aksi</th>
										<th class="text-center">Foto</th>
										<th>Nama</th>
										<th>E-mail</th>
										<th>Hak Akses</th>
										<th>Regional</th>
										<th>Dealer</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- NOTIFICATION -->
<?php if ($this->session->flashdata('message')) { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.options.timeOut = 3000;
            toastr.options.progressBar = true;
            toastr.options.positionClass = "toast-top-right";
            toastr.success('<?= $this->session->flashdata('message') ?>');
        });
    </script>
<?php } ?>
<!-- END NOTIFICATION -->

<script>
    //datatables
    function tampil() {
        $('#datatables').DataTable().clear();
        $('#datatables').DataTable().destroy();
        $('#datatables').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo site_url('user/get') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0,1],
                "orderable": false,
            }, ],
        });
    }
</script>

<script>
    $(document).ready(function() {
        tampil();

        // SAVE
        $("tbody").on("click", '.edit-status', function() {
            var id_user = $(this).attr('id_user');
            var status = $(this).attr('status');
            if(status == 1){
                var msg = 'Aktifkan';
            }else{
                var msg = 'Non Aktifkan';
            }
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan "'+ msg +'" pada data user tersebut.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>user/changeStatus',
                        type: "POST",
                        data : {
                            id_user : id_user,
                            status : status
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.success == false) {
                                toastr.options.progressBar = true;
                                toastr.options.positionClass = "toast-top-right";
                                toastr.warning(data.error);
                            }
                            if (data.success == true) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: data.msg,
                                }).then((result) => {
                                    tampil();
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>