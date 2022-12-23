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
                <h3 class="mt-0 text-primary"><?= number_format($persentase, 2) ?>%</h3>
                <p class="card-text">Target Hasil <strong><?= $target_nos['nama_target'] ?></strong></p>
            </div>
        </div>
        
    </div>
    <hr>
    <div class="col-md-12">
        <h4><?= $sub_panel['nama_panel_sub'] ?> <i class="uil-angle-double-right"></i> <?= $nos_data[0]['item'] ?></h4>
        <p>Terdiri dari <?= count($nos_data) ?> Sub Item NOS</p>
    </div>
	<?php foreach($nos_data as $row) { 
    $check_audit = $this->db->where('id_nos_data', $row['id_nos_data'])->where('YEAR(due_date)', $year)->get('nos_audit')->row_array();
    ?>
		<div class="col-lg-6">
			<div class="card card-body p-3">
                <?php if(empty($check_audit)) { ?>
				    <a href="<?= base_url() ?>nos/sub_item_detail/<?= encrypt_url($nos['id_nos']) ?>/<?= encrypt_url($row['id_panel_sub']) ?>/<?= encrypt_url($row['id_nos_data']) ?>">
                <?php }else{ ?>
				    <a href="<?= base_url() ?>nos/sub_item_edit/<?= encrypt_url($nos['id_nos']) ?>/<?= encrypt_url($row['id_panel_sub']) ?>/<?= encrypt_url($row['id_nos_data']) ?>">
                <?php } ?>
                    <div class="row">
                        <div class="col-md-10 align-self-center">
                            <h4 class="card-title mb-2"><?= !empty($row['sub_item_2']) ? $row['sub_item_2'] : $row['sub_item'] ?></h4>
                            <?php if(!empty($check_audit)) { ?>
                                <p class="mb-0 text-success">Item ini telah diaduit oleh dealer <i class="text-danger">*Klik untuk edit Audit</i></p>
                            <?php }else{ ?>
                                <p class="mb-0 text-danger">Item ini belum diaduit oleh dealer</p>
                            <?php } ?>
                        </div>
                        <div class="col-md-2">
                            <h5><span class="badge rounded-pill bg-primary float-end"><?= $row['mandatory'] ?></span></h5>
                        </div>
                    </div>
                </a>
			</div>
		</div>
	<?php } ?>
</div>

<script src="<?= base_url(); ?>assets/libs/jquery-knob/jquery.knob.min.js"></script> 
<script src="<?= base_url(); ?>assets/js/pages/jquery-knob.init.js"></script> 