<div class="row">
    <div class="col-md-12">
        <button onclick="history.back()" class="btn btn-sm btn-danger"><i class="uil-angle-left"></i> Kembali</button>
    </div>
    <div class="col-md-10 align-self-center">
        <h4><?= $dealer['nama_dealer'] ?></h4>
        <p>Kacab : <?= $pic_dealer['nama'] ?> | Telp/Wa : <?= $pic_dealer['nohp'] ?></p>
    </div>
    <div class="col-md-2">
        <div class="card border border-primary">
            <div class="card-body text-center">
                <h3 class="mt-0 text-primary">98%</h3>
                <p class="card-text">Target Hasil <strong><?= $target_nos['nama_target'] ?></strong></p>
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
                <form method="post" id="edit" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="id_nos_audit" id="id_nos_audit" value="<?= $edit['id_nos_audit'] ?>">
                    <input type="hidden" name="id_nos" value="<?= $nos['id_nos'] ?>">
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
                                        id="formRadios1" value="1" <?php if($edit['nilai'] == '1'){ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="formRadios1">
                                        Exist, Good
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="nilai"
                                        id="formRadios2" value="-1" <?php if($edit['nilai'] == '-1'){ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="formRadios2">
                                        Exist, Not Good
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="nilai"
                                        id="formRadios3" value="0" <?php if($edit['nilai'] == '0'){ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="formRadios3">
                                        Not Exist
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="nilai"
                                        id="formRadios4" value="empty" <?php if($edit['nilai'] == NULL){ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="formRadios4">
                                        N/A
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">To Be Improve</label>
                                <textarea name="improve" id="" cols="30" rows="3" class="form-control"><?= $edit['improve'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="">People in Charge (PIC) <span class="text-danger">*</span></label>
                                <select name="pic" id="" class="form-control select2">
                                    <?php foreach($pic_nos as $row) { ?>
                                        <option value="<?= $row['id_user'] ?>" <?php if($row['id_user'] == $edit['pic']){ echo 'selected'; } ?>><?= $row['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Due Date <span class="text-danger">*</span></label>
                                <input type="date" name="due_date" class="form-control" value="<?= $edit['due_date'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Penjelasan <span class="text-danger">*</span></label>
                                <input type="text" name="penjelasan" class="form-control" value="<?= $edit['penjelasan'] ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control mb-3">
                                <?php if($edit['foto'] != 'default.jpg') { ?>
                                    <a href="<?= base_url('upload/audit/'.$edit['foto'].''); ?>" target="_blank">Lihat Gambar</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="button" id="submit">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var id = $('#id_nos_audit').val();
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
                        url: '<?= base_url() ?>nos/edit_audit/'+id,
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
                                $("#edit")[0].reset();
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