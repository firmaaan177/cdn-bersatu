<?php if(!empty($powerbi)){ ?>
    <?php foreach($powerbi as $row) { ?>
        <div class="col-lg-4">
            <div class="card card-body">
                <a href="<?= base_url() ?>dashboard/powerbi/<?= encrypt_url($row['id_powerbi']) ?> "><h4 class="card-title"><i class="uil-chart-bar text-primary me-2"></i><?= $row['nama_kategori'] ?> <span class="badge rounded-pill bg-primary font-size-12"><?= $row['nama_regional'] ?></span></h4></a> 
                <p class="card-text"><?= $row['deskripsi'] ?></p>
            </div>
        </div>
    <?php } ?>
<?php }else{ ?>
    <div class="col-md-4 mx-auto text-center">
        <img src="<?= base_url(); ?>assets/images/404-error.png" class="img-responsive" width="100%" alt="">
        <h5 class="mt-2">Data tidak ditemukan.</h5>
    </div>
<?php } ?>