<style>
    table {
        border-color: #e9e9e9 !important;
    }

    .box-comment {
        padding: 15px;
        background-color: rgba(91, 115, 232, .1);
        border-radius: 0 10px 10px 10px;
        color: #74788d;
        position: relative;
        margin-bottom: 20px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <button onclick="history.back()" class="btn btn-sm btn-danger"><i class="uil-angle-left"></i> Kembali</button>
    </div>
    <div class="col-md-10 align-self-center">
        <h4><?= $nos['nama_dealer'] ?></h4>
        <p class="mb-2">Kacab : <?= $nos['nama'] ?> | Telp/Wa : <?= $nos['nohp'] ?></p>
        <a href="<?= base_url(); ?>nos/report_nos" target="_blank" class="btn btn-success btn-sm">Download Excel</a>
    </div>

    <div class="col-md-2">
        <div class="card border border-primary">
            <div class="card-body text-center">
                <h3 class="mt-0 text-primary"><?= number_format($persentase, 2) ?>%</h3>
                <p class="card-text">Target Hasil <strong><?= $nos['nama_target'] ?></strong></p>
            </div>
        </div>
    </div>

    <?php foreach ($sub_panel as $row) {
        if (substr($row['nama_panel_sub'], 2) == ' People') {
            $nilai_custom = 0.5;
        } else {
            $nilai_custom = -1;
        }
        $total_exist_good = 0;
        $total_not_exist_good = 0;
        $total_not_exist = 0;
        $total_audit = 0;
        $master_nos = $this->db->where('id_panel_sub', $row['id_panel_sub'])->get('nos_data')->result_array();
        $exist_good = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', 1)->get('nos_audit')->result_array();
        $not_exist_good = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', $nilai_custom)->get('nos_audit')->result_array();
        $not_exist = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', 0)->get('nos_audit')->result_array();
        $audit = $this->db->where('id_panel_sub', $row['id_panel_sub'])->get('nos_audit')->result_array();
        foreach ($audit as $rows) {
            if ($rows['nilai'] == 1) {
                $total_exist_good = count($exist_good) * 1;
            } else if ($rows['nilai'] == -1) {
                $total_not_exist_good = count($not_exist_good) * $nilai_custom;
            } else if ($rows['nilai'] == 0) {
                $total_not_exist = count($not_exist) * 0;
            } else {
                $na = NULL;
            }
        }
        if (count($audit) > 0) {
            $total = ($total_exist_good + $total_not_exist_good + $total_not_exist) / count($master_nos) * 100;
        } else {
            $total = 0;
        }
    ?>
        <div class="col-md-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4 class="mb-1 mt-1"><?= number_format($total, 2) ?>%</h4>
                        <p class="text-muted mb-0"><?= $row['nama_panel_sub'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="datatables">
                        <thead>
                            <tr>
                                <th colspan="2" class="bg-secondary text-white">PANEL</th>
                                <th colspan="2" class="bg-success text-white">PERBAIKAN</th>
                            </tr>
                            <tr>
                                <th class="text-start">Item</th>
                                <th>Nilai</th>
                                <th>Komentar</th>
                                <?php if ($this->session->userdata('level') != 5) { ?>
                                    <th>Approve</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($nos_data)) { ?>
                                <?php foreach ($nos_data as $row) {
                                    $mot = str_replace("dan", "&", $row['mot']);
                                    $url = urldecode($mot);
                                    $master_nos = $this->db->where('mot', $url)->get('nos_data')->result_array();

                                    foreach ($master_nos as $rows) {
                                        $exist_good = $this->db->where('id_nos_data', $rows['id_nos_data'])->where('nilai', 1)->get('nos_audit')->result_array();
                                        $not_exist_good = $this->db->where('id_nos_data', $rows['id_nos_data'])->where('nilai', $nilai_custom)->get('nos_audit')->result_array();
                                        $not_exist = $this->db->where('id_nos_data', $rows['id_nos_data'])->where('nilai', 0)->get('nos_audit')->result_array();
                                        $audit = $this->db->where('id_nos_data', $rows['id_nos_data'])->get('nos_audit')->result_array();

                                        foreach ($audit as $rows) {
                                            if ($rows['nilai'] == 1) {
                                                $total_exist_good = count($exist_good) * 1;
                                            } else if ($rows['nilai'] == -1) {
                                                $total_not_exist_good = count($not_exist_good) * -1;
                                            } else if ($rows['nilai'] == 0) {
                                                $total_not_exist = count($not_exist) * 0;
                                            } else {
                                                $na = NULL;
                                            }
                                        }
                                        if ($audit > 0) {
                                            $total = ($total_exist_good + $total_not_exist_good + $total_not_exist) / count($master_nos) * 100;
                                        } else {
                                            $total = 0;
                                        }
                                    }

                                ?>
                                    <tr>
                                        <td width="500" class="text-start"><a href="<?= base_url() ?>nos/detail_panel/<?= encrypt_url($nos['id_nos']) ?>/<?= $row['id_panel_sub'] ?>"><?= $row['nama_panel_sub'] ?></a></td>
                                        <td><?= number_format($total, 2) ?>%</td>
                                        <td>
                                            <?php if (!empty($row['komentar'])) { ?>
                                                <p class="mb-0"><?= word_limiter($row['komentar'], 50) ?></p>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('level') != 5) { ?>
                                                    <button class="btn btn-primary waves-effect waves-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd" data-mot="<?= $row['mot'] ?>"><i class="uil-plus mr-1"></i> Tambah Komentar</button>
                                                <?php } else { ?>
                                                    <span>-</span>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td width="10" align="center">
                                            <?php if ($row['is_lock'] == 1) { ?>
                                                <span style="font-size:20px;" class="fas fa-lock text-danger"></span>
                                            <?php } else { ?>
                                                <?php if ($this->session->userdata('level') != 5) { ?>
                                                    <button type="button" class="btn btn-success btn-round btn-sm lock" mot="<?= $row['mot'] ?>" id_dealer="<?= $row['id_audit_dealer'] ?>"><i class="fas fa-lock"></i></button>
                                                <?php } else { ?>
                                                    <span style="font-size:20px;" class="uil-times-circle text-danger"></span>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="4" class="text-center">Data tidak ditemukan.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Approval</h4>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start mb-4">
                    <img class="d-flex me-3 rounded-circle avatar-sm" src="<?= base_url(); ?>assets/img/foto_anggota/<?= $nos['image'] ?>">
                    <div class="flex-1">
                        <h5 class="font-size-14 my-1"><?= $nos['nama'] ?></h5>
                        <small class="text-muted"><?= $nos['nama_level'] ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Masukkan Perbaikan</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form method="post" id="insert" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="id_nos" value="<?= $nos['id_nos'] ?>">
                        <div class="form-group mb-3">
                            <textarea name="komentar" id="" cols="30" rows="5" class="form-control" placeholder="Masukan perbaikan.."></textarea>
                        </div>
                        <div class="form-group mb-5">
                            <button type="button" class="btn btn-primary" id="send">Kirim <i class="uil-arrow-right mr-1"></i></button>
                        </div>
                    </form>
                    <?php foreach ($komentar_nos as $row) { ?>
                        <div class="d-flex align-items-start mb-2">
                            <img class="d-flex me-3 rounded-circle avatar-sm" src="<?= base_url(); ?>assets/img/foto_anggota/<?= $row['image'] ?>">
                            <div class="flex-1">
                                <h5 class="font-size-14 my-1"><?= $row['nama'] ?> - <?= $row['nama_level'] ?></h5>
                                <small class="text-muted"><?= date('d/m/Y - H:i', strtotime($row['tgl_komentar'])) ?></small>
                            </div>
                        </div>
                        <div class="box-comment">
                            <p class="mb-0"><?= $row['komentar'] ?></p>
                            <!-- <a href="">Reply</a> -->
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_comment_nos" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="mot" id="mot">
                    <input type="hidden" name="id_dealer" id="id_dealer" value="<?= $id_dealer ?>">
                    <div class="row">
                        <div class="form-group mb-3 col-md-12">
                            <label for="">Komentar <span class="text-danger">*</span></label>
                            <textarea name="komentar" id="" cols="30" rows="5" class="form-control" placeholder="Tulis Komentar..."></textarea>
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
    $(document).ready(function() {
        $('#datatables').DataTable();

        // SAVE
        $("tbody").on("click", '.lock', function() {
            var mot = $(this).attr('mot');
            var id_dealer = $(this).attr('id_dealer');
            var is_lock = 1;
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan mengunci pada semua data MOT tersebut.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>nos/lock_nos/' + id_dealer,
                        type: "POST",
                        data: {
                            mot: mot,
                            id_dealer: id_dealer,
                            is_lock: is_lock
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
    $('#modalAdd').on('show.bs.modal', function(event) {
        var mot = $(event.relatedTarget).data('mot');
        $('#mot').val(mot)
    });
</script>

<script>
    $(document).ready(function() {
        // SAVE
        $('#save').click(function() {
            $.ajax({
                url: '<?= base_url() ?>nos/add_comment',
                type: "POST",
                data: new FormData($("#insert_comment_nos")[0]),
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                async: false,
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
        });
    });
</script>

<script>
    $(document).ready(function() {
        // SAVE
        $('#send').click(function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan menambahkan komentar pada data nos tersebut.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>nos/add_comment_nos',
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