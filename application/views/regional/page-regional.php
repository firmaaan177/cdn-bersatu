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
                    <table id="datatables" class="table">
                        <thead>
                            <tr>
                                <th width="10">No.</th>
                                <th width="10"></th>
                                <th>Nama Regional</th>
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
                                Nama Regional <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama_regional" id="nama_regional">
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
                    <input type="hidden" name="id_regional" id="id_regional">
                    <div class="row">
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Nama Regional <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="nama_regional" id="nama_regional2">
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
                "url": "<?php echo site_url('regional/get') ?>",
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
        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>regional/insert',
                type: "POST",
                dataType: 'json',
                data: $("#insert").serialize(),
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
            $("#id_kamar").val($(this).attr('id_kamar'));
            $("#id_regional").val($(this).attr('id_regional'));
            $("#nama_regional2").val($(this).attr('nama_regional'));
        });

        $('#edit').click(function() {
            $.ajax({
                url: '<?= base_url() ?>regional/update',
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

        $("tbody").on("click", '.hapus', function() {
            if (confirm("Apakah anda yakin ingin menghapus data tersebut?")) {
                var id_kamar = $(this).data('id');
                $.ajax({
                    url: '<?= base_url() ?>regional/delete/' + id_kamar,
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