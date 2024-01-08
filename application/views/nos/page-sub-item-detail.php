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
                <h3 class="mt-0 text-primary"><?= number_format($persentase, 2) ?>%</h3>
                <p class="card-text">Target Hasil <strong><?= $nos['nama_target'] ?></strong></p>
            </div>
        </div>
        
    </div>
    <hr>
    <div class="col-md-10 mb-2">
        <h4><?= $sub_panel['nama_panel_sub'] ?> <i class="uil-angle-double-right"></i> <?= $nos_data['item'] ?> <i class="uil-angle-double-right"></i> <?= $nos_data['sub_item_2'] ?> <span class="badge rounded-pill bg-primary"><?= $nos_data['mandatory'] ?></span></h4>
    </div>
    <div class="col-md-10">
        <div class="card">
            <div class="card-body">
                <form method="post" id="insert" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="id_nos" value="<?= $nos['id_nos'] ?>">
                    <input type="hidden" name="id_dealer" value="<?= $nos['id_dealer'] ?>">
                    <input type="hidden" name="id_nos_data" value="<?= $nos_data['id_nos_data'] ?>">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <h5 class="mb-3">Panduan Audit untuk “<?= $nos_data['sub_item_2'] ?>”</h5>
                            <p><?= $nos_data['indikator'] ?></p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h5 class="mb-4">Audit Form :</h5>
                            <label for="">Hasil Penilaian <span class="text-danger">*</span></label>
                            <div class="form-group">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="nilai"
                                        id="formRadios1" value="1">
                                    <label class="form-check-label" for="formRadios1">
                                        Exist, Good
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <?php 
                                     if(substr($sub_panel['nama_panel_sub'], 2) == ' People'){
                                        $nilai = 0.5;
                                     }else{
                                        $nilai = -1;
                                     }
                                    ?>
                                    <input class="form-check-input" type="radio" name="nilai"
                                        id="formRadios2" value="<?= $nilai ?>">
                                    <label class="form-check-label" for="formRadios2">
                                        Exist, Not Good
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="nilai"
                                        id="formRadios3" value="0">
                                    <label class="form-check-label" for="formRadios3">
                                        Not Exist
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="nilai"
                                        id="formRadios4" value="empty">
                                    <label class="form-check-label" for="formRadios4">
                                        N/A
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">To Be Improve</label>
                                <textarea name="improve" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="">People in Charge (PIC) <span class="text-danger">*</span></label>
                                <select name="pic" id="" class="form-control select2">
                                    <option value="" disabled selected>- Pilih PIC -</option>
                                    <?php foreach($pic_nos as $row) { ?>
                                        <option value="<?= $row['id_user'] ?>"><?= $row['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Due Date <span class="text-danger">*</span></label>
                                <input type="date" name="due_date" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Penjelasan <span class="text-danger">*</span></label>
                                <input type="text" name="penjelasan" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                                <p class="text-muted text-red mb-0 mt-3">(Kosongkan, jika tidak merubah foto)</p>
                                <p class="text-muted text-red">Format : jpg, png, jpeg <br> Maksimal size : <b>1 MB</b></p>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="button" id="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // SAVE
        $('#submit').click(function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Anda akan melakukan Audit pada data tersebut.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>nos/insert_audit',
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
                                toastr.warning(data.error);
                            }
                            if (data.success == true) {
                                $("#insert")[0].reset();
                                Swal.fire({
                                    icon: "success",
                                    title: "Berhasil",
                                    text: data.msg,
                                }).then((result) => {
                                    history.back(1);
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>