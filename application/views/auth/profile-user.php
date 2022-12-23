
<!-- NOTIFICATION -->
<?php if($this->session->flashdata('message')) { ?>
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
<!-- row -->
<div class="row">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="profile-head mb-4">
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="<?= base_url(); ?>assets/img/foto_anggota/<?= $getuser['image'] ?>" class="img-fluid" alt="" style="width:100%;object-fit: cover; height: 200px; border-radius:5px;">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h4 class="text-primary"><?= $getuser['nama'] ?></h4>
                    <p class="mb-1"><?= $getuser['nama_level'] ?></p>
                    <p class="mb-1"><?= $getuser['nama_dealer'] ?></p>
                    <?php 
                        if($getuser['status'] == '1') { ?>
                        <span class="badge rounded-pill bg-soft-success font-size-13">Aktif</span>
                    <?php }else{ ?>
                        <span class="badge rounded-pill bg-soft-success font-size-13">Tidak Aktif</span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informasi User</h5>
            </div>
            <div class="card-body">
                <?php echo form_open_multipart(base_url().'auth/edit_user') ?>
                    <input type="hidden" name="level" value="<?= $getuser['level'] ?>" class="form-control" readonly>
                    <div class="row">
                        <input type="hidden" name="id_user" value="<?= $getuser['id_user'] ?>">
                        <div class="form-group mb-3 col-md-6">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama" value="<?= $getuser['nama'] ?>" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="">Jenis Kelamin</label>
                            <select name="jk" id="" class="form-control">
                                <option value="Laki-Laki" <?php if($getuser['jk'] == 'Laki-Laki') echo 'selected' ?>>Laki-Laki</option>
                                <option value="Perempuan" <?php if($getuser['jk'] == 'Perempuan') echo 'selected' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="">No Handphone</label>
                            <input type="number" name="nohp" value="<?= $getuser['nohp'] ?>" class="form-control">
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="">Email</label>
                            <input type="text" name="email" value="<?= $getuser['email'] ?>" class="form-control">
                        </div>
                            
                        <div class="form-group mb-3 col-md-12">
                            <label for="">Alamat</label>
                            <textarea name="alamat" id="" cols="30" rows="3" class="form-control"><?= $getuser['alamat'] ?></textarea>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label>Foto</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto"
                                    aria-describedby="foto">
                                <label class="custom-file-label" for="foto"><?= $getuser['image']; ?></label>
                            </div>
                        </div>
                        <input type="hidden" value="<?= $getuser['status'] ?>" name="status">
                        <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Update</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
