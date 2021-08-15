<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="theme-color" content="#044215">

    <title><?= $title ?></title>
    <meta content="LBH Surabaya" name="description">
    <meta content="LBH, Surabaya, Bantuan hukum surabaya, lembaga bantuan hukum,LBH Surabaya" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url() ?>assets/img/logo.png" rel="icon">
    <link href="<?= base_url() ?>assets/theme/front/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>assets/theme/front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/fontawesome-free/css/all.min.css">
    <link href="<?= base_url() ?>assets/theme/front/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/theme/front/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link href="<?= base_url() ?>assets/theme/front/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/theme/plugins/animatecss/animate.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/theme/front/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/theme/dist/app.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>assets/theme/front/css/style.css" rel="stylesheet">

    <!-- Script JQuery -->
    <script src="<?= base_url() ?>assets/theme/front/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/theme/front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <!-- ======= Loader ======= -->
    <div class="div-loader text-center">
        <div class="loader">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ======= End Loader ======= -->

    <!-- ======= Header ======= -->
    <div class="fixed-top">
        <?php $running_text = $this->db->get('websetting')->row_array(); ?>
        <div class="px-2 bg-dark text-white d-lg-block d-md-block d-sm-none d-none">
            <marquee class="pt-1" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="8"> <?= $running_text['running_text'] ?></marquee>
        </div>

        <header id="header" class="d-flex align-items-center bg-theme">

            <div class="container d-flex align-items-center">

                <div class="logo mr-auto">
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/logo.png') ?>" alt="" class="img-fluid"></a>
                </div>

                <nav class="nav-menu d-none d-lg-block">
                    <ul>
                        <?php foreach (MENU as $menu) : ?>
                            <?php if ($menu['tipe'] == 'single') : ?>
                                <li><a href="<?= $menu['url'] ?>"><?= $menu['label'] ?></a></li>
                            <?php else : ?>
                                <li class="drop-down"><a href="<?= $menu['url'] ?>"><?= $menu['label'] ?></a>
                                    <ul>
                                        <?php foreach ($menu['submenu'] as $submenu) : ?>
                                            <li><a href="<?= $submenu['link'] ?>"><?= $submenu['label'] ?></a></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        



                    </ul>
                </nav><!-- .nav-menu -->
                <div class="header-social-links">
                    <a href="https://twitter.com/LBH_surabaya" class="twitter"><i class="icofont-twitter"></i></a>
                    <a href="https://www.facebook.com/lbh.surabaya.5" class="facebook"><i class="icofont-facebook"></i></a>
                    <a href="https://www.instagram.com/ylbhi_lbhsurabaya/" class="instagram"><i class="icofont-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UCUjVZibQyU8Kv--Z0dTqXkw" class="youtube"><i class="icofont-youtube"></i></i></a>
                </div>

            </div>
        </header>
    </div>
    <!-- End Header -->