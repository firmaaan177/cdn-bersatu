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
    <div class="col-md-12">
        <h4><?= $sub_panel['nama_panel_sub'] ?></h4>
        <p>Terdiri dari <?= count($nos_data) ?> item NOS</p>
    </div>
	<?php foreach($nos_data as $row) { 
    $item = $this->db->where('item', $row['item'])->group_by('sub_item_2')->get('nos_data')->result_array();
    $total_item = count($item);
    $total_audit = 0;
    foreach($item as $rows){
        $check_audit = $this->db->where('id_nos_data', $rows['id_nos_data'])->where('YEAR(due_date)', $year)->where('id_nos', $id_nos)->get('nos_audit')->result_array();
        foreach($check_audit as $count){
            $total_audit++;
        }
    }
    $persentase = $total_audit/$total_item * 100;
    ?>
		<div class="col-lg-6 col-6">
			<div class="card card-body p-3">
				<a href="<?= base_url() ?>nos/sub_item/<?= encrypt_url($nos['id_nos']) ?>/<?= encrypt_url($row['id_panel_sub']) ?>/<?= $row['item'] ?>">
                    <div class="row">
                        <div class="col-md-2 align-self-center">
                            <div class="mb-0 pb-0" dir="ltr">
                                <input class="knob" data-width="100%" data-height="100%" data-linecap=round
                                data-fgColor="#5b73e8" value="<?= number_format($persentase, 0) ?>" data-skin="tron" data-angleOffset="180"
                                data-readOnly=true data-thickness=".2"/>
                            </div>
                        </div>
                        <div class="col-md-10 align-self-center">
                            <h4 class="card-title mb-0"><?= $row['item'] ?></h4>
                            <p class="mb-0 text-muted"><?= $total_audit ?> dari <?= $total_item ?> sudah di audit</p>
                        </div>
                    </div>
                </a>
			</div>
		</div>
	<?php } ?>
</div>

<script src="<?= base_url(); ?>assets/libs/jquery-knob/jquery.knob.min.js"></script> 
<script src="<?= base_url(); ?>assets/js/pages/jquery-knob.init.js"></script> 