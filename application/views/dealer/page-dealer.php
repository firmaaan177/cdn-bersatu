<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="mb-0">Daftar <?= $title; ?></h5>
                    </div>
                    <div class="col-md-8">
                        <button type="button" class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="uil-plus mr-1"></i> Tambah Data</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatables" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th width="10"></th>
                                <th>Kode Dealer</th>
                                <th>Nama Dealer</th>
                                <th>Jenis Dealer</th>
                                <th>Regional</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Kode Dealer <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="kode_dealer" id="kode_dealer" placeholder="Kode Dealer" require>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Nama Dealer <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama_dealer" id="nama_dealer" placeholder="Nama Dealer" required>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Jenis Dealer <span class="text-danger">*</span>
                            </label>
                            <select name="id_panel" id="id_panel" class="form-control select2" required>
                                <option value="" disabled selected>- Pilih Panel -</option>
                                <?php foreach($panel as $row){ ?>
                                    <option value="<?= $row['id_panel'] ?>"><?= $row['nama_panel'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Regional <span class="text-danger">*</span>
                            </label>
                            <select name="id_regional" id="id_regional" class="form-control select2" required>
                                <option value="" disabled selected>- Pilih Regional -</option>
                                <?php foreach($regional as $row){ ?>
                                    <option value="<?= $row['id_regional'] ?>"><?= $row['nama_regional'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Status <span class="text-danger">*</span>
                            </label>
                            <select name="status" id="status_1" class="form-control select2">
                                <option value="" disabled selected>- Pilih Status -</option>
                                <option value="0">Tidak Aktif</option>
                                <option value="1">Aktif</option>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="save"><i class="fa fa-save mr-1"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i> Batal</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="update" enctype="multipart/form-data">
                    <input type="hidden" name="id_dealer" id="id_dealer">
                    <div class="row">
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Kode Dealer <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="kode_dealer" id="kode_dealer2" placeholder="Kode Dealer" require>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Nama Dealer <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama_dealer" id="nama_dealer2">
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Jenis Dealer <span class="text-danger">*</span>
                            </label>
                            <select name="id_panel" id="id_panel2" class="form-control select2" required>
                                <?php foreach($panel as $row){ ?>
                                    <option value="<?= $row['id_panel'] ?>"><?= $row['nama_panel'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Regional <span class="text-danger">*</span>
                            </label>
                            <select name="id_regional" id="id_regional2" class="form-control select2" required>
                                <?php foreach($regional as $row){ ?>
                                    <option value="<?= $row['id_regional'] ?>"><?= $row['nama_regional'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="edit"><i class="fa fa-save mr-1"></i> Edit</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times mr-1"></i> Batal</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    //datatables
    function tampil() {
        
        $('#datatables').DataTable().clear();
        $('#datatables').DataTable().destroy();
        $('#datatables').DataTable({
            processing : true,
            serverSide: true,
            order: [],
            ajax : {
                "url": "<?php echo site_url('dealer/get') ?>",
                "type": "POST"
            },
            columnDefs: [{
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
        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>dealer/insert',
                type: "POST",
                data: $("#insert").serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.success == false) {
                        toastr.options.progressBar = true;
                        toastr.options.positionClass = "toast-top-right";
                        toastr.warning(data.error);
                    }
                    if (data.success == true) {
                        toastr.options.progressBar = true;
                        toastr.options.positionClass = "toast-top-right";
                        toastr.success(data.msg);
                        $('#modalAdd').modal('toggle');
                        $("#insert")[0].reset();
                        tampil();
                    }
                }
            });
        });

        $("tbody").on("click", '.edit', function() {
            $("#id_dealer").val($(this).attr('id_dealer'));
            $("#kode_dealer2").val($(this).attr('kode_dealer'));
            $("#nama_dealer2").val($(this).attr('nama_dealer'));
            $("#jenis_dealer2").val($(this).attr('jenis_dealer'));
            $("#id_regional2").val($(this).attr('id_regional')).trigger('change');
            $("#id_panel2").val($(this).attr('id_panel')).trigger('change');
            $("#status_2").val($(this).attr('status')).trigger('change');
        });

        $('#edit').click(function() {
            $.ajax({
                url: '<?= base_url() ?>dealer/update',
                type: "POST",
                dataType: 'json',
                data: $("#update").serialize(),
                success: function(data) {
                    console.log(data.success);
                    if (data.success == false) {
                        toastr.options.progressBar = true;
                        toastr.options.positionClass = "toast-top-right";
                        toastr.warning(data.error);
                    }
                    if (data.success == true) {
                        toastr.options.progressBar = true;
                        toastr.options.positionClass = "toast-top-right";
                        toastr.success(data.msg);
                        $('#modalEdit').modal('toggle');
                        $("#update")[0].reset();
                        tampil();
                    }
                }
            });
        });

        $("tbody").on("click", '.update-status', function() {
            var id_dealer = $(this).attr('id_dealer');
            var status = $(this).attr('status');
            Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Anda akan memperbarui status Dealer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>dealer/updatestatus/',
                        type: "POST",
                        dataType: 'json',
                        data : {
                            id_dealer : id_dealer,
                            status : status,
                        },
                        success:function(data) {
                            toastr.options.progressBar = true;
                            toastr.options.positionClass = "toast-top-right";
                            toastr.success(data.msg);
                            tampil();
                        }    
                    });
                }
            });
        });

        $("tbody").on("click", '.hapus', function() {
            if (confirm("Apakah anda yakin ingin menghapus data tersebut?")) {
                var id_kamar = $(this).data('id');
                $.ajax({
                    url: '<?= base_url() ?>dealer/delete/' + id_kamar,
                    type: "POST",
                    data: {
                        id_kamar: id_kamar
                    },
                    success: function(response) {
                        toastr.options.progressBar = true;
                        toastr.options.positionClass = "toast-top-right";
                        toastr.success('Data berhasil dihapus!');
                        tampil();
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>