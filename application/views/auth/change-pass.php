
<div class="col-md-5 ">
<?php if($this->session->flashdata('message') == true){ ?>
    <?php echo $this->session->flashdata('message'); ?>
<?php } ?>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo base_url(); ?>auth/changepass" method="post">
                <div class="row">
                    <div class="form-group mb-3 col-md-12">
                        <label for="">Password Lama</label>
                        <input type="password" name="old_password" class="form-control" placeholder="Password Lama"/>
                    </div>
                    <div class="form-group mb-3 col-md-12">
                        <label for="">Password Baru</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Password Baru"/>
                    </div>
                    <div class="form-group mb-3 mb-0 col-md-12">
                        <button type="submit" class="btn btn-primary btn-block"> Ganti Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
