<div class="col-md-4 mx-auto text-center">
    <img src="<?= base_url(); ?>assets/images/404-error.png" class="img-responsive" width="100%" alt="">
    <h5 class="mt-2">Anda tidak memiliki Akses untuk halaman ini. <?= $this->session->userdata('id_dealer') ?></h5>
    <a href="#" onclick="history.back()"><i class="uil-angle-left"></i> Kembali</a>
</div>