<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?= $title ?></title>

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/img/logo.png" rel="icon">
    <link href="<?= base_url() ?>assets/theme/front/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/dist/') ?>app.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page bg-theme">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url() ?>" class="text-white"><b>Admin</b>LBH</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body rounded shadow py-5">
                <p class="login-box-msg">Sign in to start your session</p>

                <?= $this->session->flashdata('status') ?>

                <form action="<?= base_url('auth/proses_login') ?>" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" autocomplete="off" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning btn-block font-weight-bold">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/theme/admin/') ?>dist/js/adminlte.min.js"></script>

</body>

</html>