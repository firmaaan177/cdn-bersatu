<style>
    table{
        border-color: #e9e9e9 !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <button onclick="history.back()" class="btn btn-sm btn-danger"><i class="uil-angle-left"></i> Kembali</button>
    </div>
    <div class="col-md-10 align-self-center">
        <h4><?= $nos['nama_dealer'] ?></h4>
        <p>Kacab : <?= $nos['nama'] ?> | Telp/Wa : <?= $nos['nohp'] ?></p>
    </div>
    <div class="col-md-2">
        <div class="card border border-primary">
            <div class="card-body text-center">
                <h3 class="mt-0 text-primary">98%</h3>
                <p class="card-text">Target Hasil <strong><?= $nos['nama_target'] ?></strong></p>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="col-md-12 mt-2">
                    <h4><?= str_replace("%20"," ",$this->uri->segment('4')) ?></h4>
                    <p class="mb-0">Hanya menampilkan item Nos yang memiliki nilai Not Exist/Exist, Not Good</p>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Perbaikan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($nos_data as $row) { 
                            $panel = $this->db->where('id_panel_sub', $row['id_panel_sub'])->get('panel_sub')->row_array();    
                            $perbaikan = $this->db->where('id_nos_audit', $row['id_nos_audit'])->get('nos_perbaikan')->row_array();    
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td width="500" class="text-start">
                                    <h5><?= $panel['nama_panel_sub'] ?></h5>
                                    <p class="mb-0"><?= $row['item']?></p>
                                    <p class="mb-0"><?= !empty($row['sub_item_2']) ? $row['sub_item_2'] : $row['sub_item'] ?> <span class="badge bg-pill bg-soft-success">
                                    <?php 
                                    if($row['nilai'] == '1'){
                                        echo 'Exist Good';
                                    }else if($row['nilai'] == '-1'){
                                        echo 'Exist Not Good';
                                    }else if($row['nilai'] == '0'){
                                        echo 'Not Exist';
                                    }
                                    ?>
                                    </span>
                                </p>
                                    <p class="mb-0"><b>Note</b> : <?= $row['penjelasan']?></p>
                                </td>
                                <td>
                                    <?php if($row['is_perbaikan'] == 1) { ?>
                                        <span class="text-danger"><i>Wajib Perbaikan</i></span>
                                    <?php }else if($row['is_perbaikan'] == 2 || !empty($perbaikan)){ ?>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalPerbaikan">Lihat Perbaikan</a>
                                        <p class="text-success"><i>Perbaikan telah dikirim (Dealer)</i></p>
                                    <?php } ?>
                                    
                            </td>
                                <td>
                                    <?php if($row['status'] == 'approve') { ?>
                                        <span class="badge rounded-pill bg-success text-uppercase" style="font-size:90%"><?= $row['status'] ?></span>
                                    <?php }else{ ?>
                                        <span class="badge rounded-pill bg-warning text-uppercase" style="font-size:90%"><?= $row['status'] ?></span>
                                    <?php } ?>
                                </td>
                                <td width="100" class="text-center">
                                    <?php if($this->session->userdata('level') != 5){ ?>
                                        <?php if($row['status'] != 'approve') { ?>
                                            <button type="button" class="btn btn-success btn-round btn-sm approve" id_nos_audit="<?= $row['id_nos_audit']?>"><i class="uil-check"></i></button>
                                            <button type="button" class="btn btn-danger btn-round btn-sm fix" id_nos_audit="<?= $row['id_nos_audit']?>"><i class="uil-times"></i></button>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php if($row['status'] != 'approve') { ?>
                                            <?php if($row['is_perbaikan'] == 2) { ?>
                                                <button class="btn btn-primary waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpload" data-id='<?= $perbaikan['id_nos_perbaikan'] ?>' data-id-audit='<?= $row['id_nos_audit'] ?>'  data-foto='<?= $perbaikan['foto'] ?>'><i class="uil-image mr-1"></i> Perbaikan</button>
                                            <?php }else if($row['is_perbaikan'] != 0){ ?>
                                                <button class="btn btn-primary waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpload" data-id-audit='<?= $row['id_nos_audit'] ?>'><i class="uil-image mr-1"></i> Perbaikan</button>
                                            <?php } ?>
                                        <?php }else if($row['is_lock'] == 1 || $row['status'] == 'approve'){ ?>
                                            <button class="btn btn-primary waves-effect waves-light btn-sm" disabled><i class="uil-image mr-1"></i> Perbaikan</button>
                                        <?php } ?>
                                    <?php } ?>
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

<div id="modalPerbaikan" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <?php if(!empty($perbaikan)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Keterangan</h5>
                            <p><?= $perbaikan['keterangan'] ?></p>
                        </div>
                        <div class="col-md-12">
                            <h5>Foto Perbaikan</h5>
                            <a class="image-popup-vertical-fit" href="<?= base_url(); ?>upload/perbaikan/<?= $perbaikan['foto'] ?>" ><img class="img-fluid" alt="" src="<?= base_url(); ?>upload/perbaikan/<?= $perbaikan['foto'] ?>" width="145"></a>
                            <p>Klik gambar untuk zoom</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modalUpload" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Form Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <input type="hidden" id="id_nos_audit" name="id_nos_audit">
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Keterangan/Link <span class="text-danger">*</span>
                            </label>
                            <textarea name="keterangan" id="" cols="30" rows="5" id="keterangan" class="form-control"></textarea>
                        </div>
                        <div class="form-group mb-3 col-md-12">
                            <label class="form-control-label">
                                Foto
                            </label>
                            <input type="file" name="foto" id="foto" class="form-control mb-3">
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

<script>
    $('#modalUpload').on('show.bs.modal', function (event) {
        var id_audit = $(event.relatedTarget).data('id-audit');
        $('#id_nos_audit').val(id_audit)
    });

    $('#modalPerbaikan').on('show.bs.modal', function (event) {
        // var id_audit = $(event.relatedTarget).data('id-audit');
        // $('#id_nos_audit').val(id_audit)
    });
</script>

<script>
    $(document).ready(function() {
        // SAVE
        $("tbody").on("click", '.approve', function() {
            var id_nos_audit = $(this).attr('id_nos_audit');
            var status = 'approve';
            var is_perbaikan = 0;
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan melakukan "Approve" pada data tersebut.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>nos/approve',
                        type: "POST",
                        data : {
                            id_nos_audit : id_nos_audit,
                            status : status,
                            is_perbaikan : is_perbaikan,
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
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#datatables').DataTable();
        // SAVE
        $("tbody").on("click", '.fix', function() {
            var id_nos_audit = $(this).attr('id_nos_audit');
            var is_perbaikan = 1;
            var status = 'pending';
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan mengirim "Wajib Perbaikan" pada data tersebut.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>nos/perbaikan',
                        type: "POST",
                        data : {
                            id_nos_audit : id_nos_audit,
                            is_perbaikan : is_perbaikan,
                            status : status,
                            keterangan : keterangan,
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
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // SAVE
        $('#save').click(function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan mengirim Perbaikan pada data tersebut.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>nos/insert_perbaikan',
                        type: "POST",
                        data: new FormData($("#insert")[0]),
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            if (data.success == false) {
                                toastr.options.progressBar = true;
                                toastr.options.positionClass = "toast-top-right";
                                toastr.warning(data.error);
                            }
                            if (data.success == true) {
                                $("#insert")[0].reset();
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: data.msg,
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>