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
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Regional</th>
                                <th>Iframe</th>
                                <th>Sumber Data</th>
                                <th>Tanggal</th>
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
                                Judul <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Judul Power BI" required>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="id_powerbi_kategori" id="id_powerbi_kategori" class="form-control select2" required>
                                <option value="" selected disabled>- Pilih Kategori -</option>
                                <?php foreach($kategori as $row){ ?>
                                    <option value="<?= $row['id_powerbi_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-control-label">
                                Tanggal <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-control-label">
                                Regional <span class="text-danger">*</span>
                            </label>
                            <select name="id_regional" id="id_regional" class="form-control select2" placeholder="Pilih Regional" required>
                                <option value=""></option>
                                <?php foreach($regional as $row){ ?>
                                    <option value="<?= $row['id_regional'] ?>"><?= $row['nama_regional'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Dealer
                            </label>
                            <select name="id_dealer[]" id="id_dealer" class="form-control select2" multiple='multiple' required>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                User
                            </label>
                            <select name="id_user[]" id="id_user" class="form-control select2" required multiple='multiple'>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Sumber Data <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="sumber_data" id="sumber_data" placeholder="Sumber Data" required>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Link Iframe <span class="text-danger">*</span>
                            </label>
                            <textarea name="iframe" id="iframe" cols="30" rows="3" class="form-control" placeholder="Link Iframe Power BI"></textarea>
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
                    <input type="hidden" name="id_powerbi" id="id_powerbi">
                    <div class="row">
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Judul <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="title" id="title2" placeholder="Judul Power BI" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-control-label">
                                Tanggal <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal2" required>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label class="form-control-label">
                                Regional <span class="text-danger">*</span>
                            </label>
                            <select name="id_regional" id="id_regional2" class="form-control select2" required>
                                <option value="" selected disabled>- Pilih Regional -</option>
                                <?php foreach($regional as $row){ ?>
                                    <option value="<?= $row['id_regional'] ?>"><?= $row['nama_regional'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Dealer
                            </label>
                            <input type="hidden" id="temp_id_dealer">
                            <select name="id_dealer[]" id="id_dealer2" class="form-control select2" multiple='multiple' required>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                User
                            </label>
                            <input type="hidden" id="temp_id_user">
                            <select name="id_user[]" id="id_user2" class="form-control select2" required multiple='multiple'>
                            </select>
                        </div>

                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select name="id_powerbi_kategori" id="id_powerbi_kategori2" class="form-control select2" required>
                                <option value="" selected disabled>- Pilih Kategori -</option>
                                <?php foreach($kategori as $row){ ?>
                                    <option value="<?= $row['id_powerbi_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Sumber Data <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="sumber_data" id="sumber_data2" placeholder="Sumber Data" required>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Link Iframe <span class="text-danger">*</span>
                            </label>
                            <textarea name="iframe" id="iframe2" cols="30" rows="3" class="form-control" placeholder="Link Iframe Power BI"></textarea>
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
                "url": "<?php echo site_url('powerbi/get') ?>",
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
        $('#id_dealer').prop("disabled", true);
        $('#id_user').prop("disabled", true);
        $('#id_regional').on('change', function() {
            $.ajax({
                url: '<?= base_url() ?>powerbi/getDealerByRegional/' + this.value ,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#id_dealer').prop("disabled", false);
                    $("#id_dealer").empty().trigger('change');
                    var selOpts = "";
                    for (i=0;i<data.length;i++)
                    {
                        var id = data[i]['id_dealer'];
                        var val = data[i]['nama_dealer'];
                        selOpts += "<option value='"+id+"'>"+val+"</option>";
                    }
                    $('#id_dealer').append(selOpts);
                }
            });

            $.ajax({
                url: '<?= base_url() ?>powerbi/getUserByRegional/' + this.value ,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#id_user').prop("disabled", false);
                    $("#id_user").empty().trigger('change');
                    var selOpts = "";
                    for (i=0;i<data.length;i++)
                    {
                        var id = data[i]['id_user'];
                        var val = data[i]['nama'];
                        selOpts += "<option value='"+id+"'>"+val+"</option>";
                    }
                    $('#id_user').append(selOpts);
                }
            });
        });

        // SAVE
        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>powerbi/insert',
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

        // EDIT

        $("tbody").on("click", '.edit', function() {
            $("#id_powerbi").val($(this).attr('id_powerbi'));
            $("#title2").val($(this).attr('title'));
            $("#iframe2").val($(this).attr('iframe'));
            $("#tanggal2").val($(this).attr('tanggal'));
            $("#sumber_data2").val($(this).attr('sumber_data'));
            $("#temp_id_dealer").val($(this).attr('id_dealer'));
            $("#temp_id_user").val($(this).attr('id_user'));
            $("#id_regional2").val($(this).attr('id_regional')).trigger('change');
            $("#id_powerbi_kategori2").val($(this).attr('id_powerbi_kategori')).trigger('change');
        });

        
        $('#id_regional2').on('change', function() {
            var temp_id_dealer = $("#temp_id_dealer").val();
            var temp_id_user = $("#temp_id_user").val();
            var id_dealer = temp_id_dealer.split(",");
            var id_user = temp_id_user.split(",");
            console.log(temp_id_user);
            $.ajax({
                url: '<?= base_url() ?>powerbi/getDealerByRegional/' + this.value ,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#id_dealer2').prop("disabled", false);
                    $("#id_dealer2").empty().trigger('change');
                    var selOpts = "";
                    for (i=0;i<data.length;i++)
                    {
                        var id = data[i]['id_dealer'];
                        var val = data[i]['nama_dealer'];
                        selOpts += "<option value='"+id+"'>"+val+"</option>";
                    }
                    $('#id_dealer2').append(selOpts);
                    $("#id_dealer2").val(id_dealer).trigger('change');
                }
            });
            
            $.ajax({
                url: '<?= base_url() ?>powerbi/getUserByRegional/' + this.value ,
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#id_user2').prop("disabled", false);
                    $("#id_user2").empty().trigger('change');
                    var selOpts = "";
                    for (i=0;i<data.length;i++)
                    {
                        var id = data[i]['id_user'];
                        var val = data[i]['nama'];
                        selOpts += "<option value='"+id+"'>"+val+"</option>";
                    }
                    $('#id_user2').append(selOpts);
                    $("#id_user2").val(id_user).trigger('change');
                }
            });
        });

        $('#edit').click(function() {
            $.ajax({
                url: '<?= base_url() ?>powerbi/update',
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
            var id_powerbi = $(this).attr('id_powerbi');
            var status = $(this).attr('status');
            Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Anda akan memperbarui status powerbi.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>powerbi/updatestatus/',
                        type: "POST",
                        dataType: 'json',
                        data : {
                            id_powerbi : id_powerbi,
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
            var id_powerbi = $(this).data('id');
            Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Data akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>powerbi/delete/' + id_powerbi,
                        type: "POST",
                        dataType: 'json',
                        data : {
                            id_powerbi : id_powerbi,
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
    });
</script>