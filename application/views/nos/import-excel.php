<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-3">
				<?php if(!empty($this->session->flashdata('status'))){ ?>
				<div class="alert alert-info" role="alert"><?= $this->session->flashdata('status'); ?></div>
				<?php } ?>
				<form action="<?= base_url('nos/import_excel'); ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>File Excel</label>
						<input class="form-control" type="file" id="fileExcel" name="fileExcel">
					</div>
					<div class="form-group mt-2">
						<a href="">Download File</a>
					</div>
					<div class="form-group mt-3">
						<button class='btn btn-success btn-sm' type="submit"><span class="fa fa-upload" aria-hidden="true"></span>
							Import		
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>