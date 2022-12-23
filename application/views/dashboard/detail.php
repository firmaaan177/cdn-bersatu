<!-- NOTIFICATION -->
<?php if ($this->session->flashdata('message')) { ?>
	<script type="text/javascript">
		$(document).ready(function() {
			toastr.options.timeOut = 3500;
			toastr.options.progressBar = true;
			toastr.options.positionClass = "toast-top-right";
			toastr.success('<?= $this->session->flashdata('message') ?>');
		});
	</script>
<?php } ?>

<div class="row">
	<div class="col-md-12 mb-3">
		<?php if(!empty($powerbi)){ ?>
            <div class="row mb-2">
                <div class="col-md-12 mb-2">
                    <h4><?= $kategori['nama_kategori'] ?></h4>
                </div>
                <div class="col-md-6 col-6">
                    <a href="<?= base_url(); ?>dashboard" class="btn btn-sm btn-danger"><i class="uil-angle-left"></i> Kembali</a>
                </div>
                <div class="col-md-6 col-6">
                    <h5 class="mb-3 text-end">Last Update : <?= date('d/m/Y', strtotime($powerbi['created_date'])) ?></h5>
                </div>
            </div>

            <div class="col-md-12 mb-3">
			    <iframe title="<?= $powerbi['title'] ?>" width="100%" height="550" src="<?= $powerbi['iframe'] ?>" frameborder="0" allowFullScreen="true"></iframe>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6>Author : <?= $author['nama'] ?></h6>
                        </div>
                        <div class="col-md-6 mb-3 text-end">
                            <h6>Sumber Data : <?= $powerbi['sumber_data'] ?></h6>
                        </div>
                        <div class="col-md-8">
                            <h6>Deskripsi : <p class="mt-2"><?= $kategori['deskripsi'] ?></p></h6>
                        </div>
                    </div>
                </div>
            </div>

		<?php }else{ ?>
			<div class="col-md-4 mx-auto text-center">
				<img src="<?= base_url(); ?>assets/images/404-error.png" class="img-responsive" width="100%" alt="">
				<h5 class="mt-2">Data tidak ditemukan.</h5>
                <a href="<?= base_url(); ?>dashboard"><i class="uil-angle-left"></i> Kembali ke Dashboard</a>
			</div>
		<?php } ?>
	</div>
</div>