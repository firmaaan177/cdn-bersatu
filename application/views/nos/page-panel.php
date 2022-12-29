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
    <?= $this->session->userdata('id_dealer') ?>
	<?php foreach($sub_panel as $row) { ?>
		<div class="col-lg-4">
			<div class="card card-body">
				<a href="<?= base_url() ?>nos/item/<?= encrypt_url($nos['id_nos']) ?>/<?= encrypt_url($row['id_panel_sub']) ?>"><h4 class="card-title mb-0"><i class="uil-chart-bar text-primary me-2"></i><?= $row['nama_panel_sub'] ?></h4></a>
			</div>
		</div>
	<?php } ?>
</div>