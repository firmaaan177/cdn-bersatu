<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
                <form method="POST" id="export">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="">Tahun</label>
                            <select name="year" id="" class="form-control select2">
                                <?php for($i=date('Y'); $i>=date('Y')-20; $i-=1) { ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Dealer</label>
                            <select name="id_dealer" id="" class="form-control select2">
                                <?php if($this->session->userdata('level') != '5'){ ?>
                                    <option value="">Semua Dealer</option>
                                <?php } ?>
                                <?php foreach($dealer as $row) { ?>
                                    <option value="<?= $row['id_dealer'] ?>"><?= $row['nama_dealer'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 form-group d-flex align-items-end mb-1">
                            <button type="button" class="btn btn-primary" id="submit">Submit</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>

    <div class="col-md-12" id="view_report">
        <div class="card">
			<div class="card-body" id="table_view">
                <div class="spinner-border text-primary m-1">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
		</div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#view_report').hide();
    });

    $('#submit').click(function() {
        $('#view_report').show();
        $.ajax({
            url: '<?= base_url() ?>laporan/filter',
            type: "POST",
            data: $("#export").serialize(),
            success: function(data) {
                $('#table_view').html(data);
            }
        });
    });
</script>