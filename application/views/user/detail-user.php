<div class="row">
    <div class="col-md-12">
        <a href="<?= base_url(); ?>user" class="btn btn-danger btn-sm mb-3"><i class="fa fa-angle-left"></i>
            Kembali</a>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="profile-head mb-4">
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img src="<?= base_url(); ?>assets/img/foto_anggota/<?= $detail['image'] ?>" class="img-fluid" alt="" style="width:100%;object-fit: cover; height: 200px; border-radius:5px;">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h4 class="text-primary"><?= $detail['nama'] ?></h4>
                    <p class="mb-1"><?= $detail['nama_level'] ?></p>
                    <?php 
                        if($detail['status'] == '1') { ?>
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
                <div class="row">
                    <div class="col-md-6 col-xl-6 mb-3">
                        <div class="form-group"> 
                            <label for="email">Email</label>
                            <p><?= $detail['email'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-3">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <p><?= $detail['nama'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-3">
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <p><?= $detail['jk'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-3">
                        <div class="form-group">
                            <label for="nohp">Nomor Handphone</label>
                            <p><?= $detail['nohp'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-12 mb-3">
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <p><?= $detail['alamat'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 mb-3">
                        <div class="form-group">
                            <label for="level">Hak Akses</label>
                            <p><?= $detail['nama_level'] ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-xl-6 mb-3">
                        <div class="form-group">
                            <label for="level">Dealer</label>
                            <p><?= $detail['nama_dealer'] ?></p>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="1">
                </div>
            </div>
        </div>
    </div>
</div>