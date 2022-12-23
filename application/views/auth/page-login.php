<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Admin </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <!-- Bootstrap Css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url(); ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="<?= base_url(); ?>" class="mb-5 d-block auth-logo">
                            <img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="40" class="logo logo-dark">
                            <img src="<?= base_url(); ?>assets/images/logo.png" alt="" height="40" class="logo logo-light">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Selamat Datang Kembali.</h5>
                                <p class="text-muted">Silahkan Login untuk masuk kembali.</p>
                            </div>
                            <?php if ($this->session->flashdata('message')) { ?>
                                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                    <?= $this->session->flashdata('message') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    </button>
                                </div>
                            <?php } ?>
                            <div class="p-2 mt-3">
                                <form action="<?= base_url(); ?>auth/login" method="post">
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Masukan Email" name="email" autofocus>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Masukan password" name="password">
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-100 w-sm waves-effect waves-light" type="submit">Masuk</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>© <script>
                                document.write(new Date().getFullYear())
                            </script> © <a href="http://trisoft.id/" target="_blank">Trisoft.id</a> - All Rights Reserved</p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <script src="<?= base_url(); ?>assets/js/app.js"></script>

</body>

</html>