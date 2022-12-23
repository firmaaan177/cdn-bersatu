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
                                <th>Level</th>
                                <th>Menu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($roles as $row){ 
                                $id_menu = explode(',', $row['id_menu']);
                                $get_menu = $this->db->where_in('id_menu', $id_menu)->get('menu')->result_array();    
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div class='btn-group'>
                                            <button type='button' class='btn btn-info btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi <i class='mdi mdi-chevron-down'></i></button>
                                            <div class='dropdown-menu'>
                                                <a class='dropdown-item edit' href='#' data-bs-toggle='modal' data-bs-target='#modalEdit' id_roles='<?= $row['id_roles'] ?>'  id_level='<?= $row['id_level'] ?>' id_menu='<?= $row['id_menu'] ?>'><i class='uil-edit-alt mr-1'></i> Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?= $row['nama_level'] ?></td>
                                    <td>
                                        <?php foreach($get_menu as $data) {
                                            echo '<li>'.$data['nama_menu'].'</li>';
                                        } ?>
                                    </td>
                                </tr>
                            <?php } ?> 
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
                    <div class="form-group mb-4 col-md-12">
                        <label class="form-control-label">
                            Level User <span class="text-danger">*</span>
                        </label>
                        <select name="id_level" id="id_level" class="form-control select2" required>
                            <option value="">- Pilih Level -</option>
                            <?php foreach($level as $row) { 
                                $roles = $this->db->where('id_level', $row['id_level'])->get('roles')->row_array();
                                if(empty($roles)) {
                            ?>
                                <option value="<?= $row['id_level'] ?>"><?= $row['nama_level'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="row">
                            <label for="">Daftar Menu <span class="text-danger">*</span></label>
                        <?php foreach($menu as $row) { ?>
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="id_menu[]" class="form-check-input" id="formrow-customCheck<?= $row['id_menu'] ?>" value="<?= $row['id_menu'] ?>">
                                    <label class="form-check-label" for="formrow-customCheck<?= $row['id_menu'] ?>"><?= $row['nama_menu'] ?></label>
                                </div>
                            </div>
                        <?php } ?>
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
                    <input type="hidden" name="id_roles" id="id_roles">
                    <input type="hidden" name="id_menu" id="id_menu">
                    <div class="form-group mb-4 col-md-12">
                        <label class="form-control-label">
                            Level User <span class="text-danger">*</span>
                        </label>
                        <select name="id_level" id="id_level2" class="form-control select2" readonly required>
                            <option value="">- Pilih Level -</option>
                            <?php foreach($level as $row) { ?>
                                <option value="<?= $row['id_level'] ?>"><?= $row['nama_level'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="row">
                            <label for="">Daftar Menu <span class="text-danger">*</span></label>
                        <?php foreach($menu as $row) { ?>
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" name="id_menu[]" class="form-check-input edit-checked" id="formrow-customCheck2<?= $row['id_menu'] ?>" value="<?= $row['id_menu'] ?>">
                                    <label class="form-check-label" for="formrow-customCheck2<?= $row['id_menu'] ?>"><?= $row['nama_menu'] ?></label>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="result"></div>
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
        $('#datatables').DataTable();
    }
</script>

<script>
    $(document).ready(function() {
        tampil();
        // SAVE
        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>roles/insert',
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
            $("#id_level").val($(this).attr('id_level'));
            $("#id_roles").val($(this).attr('id_roles'));
            var id_menu = $(this).attr('id_menu').split(",");

            $(".edit-checked input[type=checkbox]").each(function () {
                temp.push(this.value);
            });
        });

        $('#edit').click(function() {
            $.ajax({
                url: '<?= base_url() ?>roles/update',
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
                    url: '<?= base_url() ?>roles/delete/' + id_kamar,
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