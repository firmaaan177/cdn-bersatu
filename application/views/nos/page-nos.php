<div class="row">
    <div class="col-md-12 mb-3">
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd"><i class="uil-plus mr-1"></i> Tambah Data</button>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="mb-1 mt-1">0</h4>
                    <p class="text-muted mb-0">Platinum</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="mb-1 mt-1">0</h4>
                    <p class="text-muted mb-0">Gold</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->
    
    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="mb-1 mt-1">0</h4>
                    <p class="text-muted mb-0">Silver</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div>
                    <h4 class="mb-1 mt-1">0</h4>
                    <p class="text-muted mb-0">Bronze</p>
                </div>
            </div>
        </div>
    </div> <!-- end col-->
</div> <!-- end row-->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-0">Daftar NOS</h5>
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
                                <th>Dealer</th>
                                <th>Regional</th>
                                <th>Nilai Nos Sebelumnya</th>
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

<!-- ADD NOS -->
<div id="modalAdd" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                                Dealer <span class="text-danger">*</span>
                            </label>
                            <select name="id_dealer" id="id_dealer" class="form-control select2" required>
                                <option value="">- Pilih Dealer -</option>
                                <?php foreach($dealer as $row){ ?>
                                    <option value="<?= $row['id_dealer'] ?>" id-user="<?= $row['id_user'] ?>" nama-user="<?= $row['nama'] ?>" no-hp="<?= $row['nohp'] ?>"><?= $row['nama_dealer'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                PIC Dealer <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_pic" class="form-control" readonly>
                            <input type="hidden" name="id_user" id="id_user" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                No HP/WA <span class="text-danger">*</span>
                            </label>
                            <input type="number" id="no_hp" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Target NOS <span class="text-danger">*</span>
                            </label>
                            <select name="id_nos_target" id="" class="form-control select2">
                                <option value="" selected disabled> - Pilih Target -</option>
                                <?php foreach($nos_target as $row) { ?>
                                    <option value="<?= $row['id_nos_target'] ?>"><?= $row['nama_target'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Hasil Nos Sebelumnya <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="hasil_sebelumnya" id="hasil_sebelumnya" class="form-control">
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
<!-- END NOS -->

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
                "url": "<?php echo site_url('nos/get') ?>",
                "type": "POST"
            },

            "columnDefs": [{
                "targets": [0,1,2,3],
                "orderable": false,
            }, ],
        });
    }
</script>

<script>
    $('#id_dealer').change(function () {
        var id_user = $('#id_dealer option:selected').attr("id-user");
        var nama_pic = $('#id_dealer option:selected').attr("nama-user");
        var no_hp = $('#id_dealer option:selected').attr("no-hp");
        if(id_user != ""){
            $('#nama_pic').val(nama_pic);
            $('#id_user').val(id_user);
            $('#no_hp').val(no_hp);
        }else{
            $("#insert")[0].reset();
            toastr.options.progressBar = true;
            toastr.options.positionClass = "toast-top-right";
            toastr.warning('Dealer tidak memiliki PIC!');
        }
    });
</script>

<script>
    $(document).ready(function() {
        tampil();
        // SAVE
        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>nos/insert',
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
            $("#id_nos").val($(this).attr('id_nos'));
            $("#id_level2").val($(this).attr('id_level')).trigger('change');

        });

        $('#edit').click(function() {
            $.ajax({
                url: '<?= base_url() ?>nos/update',
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
    });
</script>