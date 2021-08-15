<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#8e44ad">
    <!-- Title -->
    <title><?= $title ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo.png') ?>" />
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/sweetalert2/sweetalert2.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>plugins/dropzone/dropzone.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/admin/') ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme/dist/') ?>app.css">
    <!-- JS -->
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
    </script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/sweetalert2/sweetalert2.js"></script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/select2/js/select2.full.min.js"></script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/dropzone/dropzone.js"></script>
    <script src="<?= base_url('assets/theme/admin/') ?>plugins/summernote/summernote-bs4.js"></script>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-theme navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="logout nav-link"><i class="fa fa-sign-out-alt"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-warning elevation-4 sidebar-no-expand">

            <!-- Brand Logo -->
            <a href="<?= base_url('admin') ?>" class="brand-link">
                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-bold ml-3"><?= strtoupper(USER['role']) ?> LBH</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('assets/img/user.png') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= base_url('admin/settings') ?>" class="d-block"><?= strtoupper(USER['name']) ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview" id="post">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-file-alt"></i>
                                <p>
                                    Artikel
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="create-post">
                                    <a href="<?= base_url('admin/add_post') ?>" class="nav-link">
                                        <i class="nav-icon fa fa-angle-right"></i>
                                        <p>
                                            Buat Artikel
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item" id="manage-post">
                                    <a href="<?= base_url('admin/manage_post') ?>" class="nav-link">
                                        <i class="nav-icon fa fa-angle-right"></i>
                                        <p>
                                            List Artikel
                                            <?php if (POSTCOUNT > 0) : ?>
                                                <span class="ml-1 badge badge-danger right"><?= POSTCOUNT ?></span>
                                            <?php endif; ?>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php if (USER['role'] == 'Admin') : ?>
                            <li class="nav-item has-treeview" id="announcement">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-bullhorn"></i>
                                    <p>
                                        Pengumuman
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item" id="create-announcement">
                                        <a href="<?= base_url('admin/add_announcement') ?>" class="nav-link">
                                            <i class="nav-icon fa fa-angle-right"></i>
                                            <p>
                                                Buat Pengumuman
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item" id="manage-announcement">
                                        <a href="<?= base_url('admin/manage_announcement') ?>" class="nav-link">
                                            <i class="nav-icon fa fa-angle-right"></i>
                                            <p>
                                                List Pengumuman
                                                <?php if (ANNCOUNT > 0) : ?>
                                                    <span class="ml-1 badge badge-danger right"><?= ANNCOUNT ?></span>
                                                <?php endif; ?>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item" id="running-text">
                                        <a href="<?= base_url('admin/running_text') ?>" class="nav-link">
                                            <i class="nav-icon fa fa-angle-right"></i>
                                            <p>
                                                Running Text
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview" id="page">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-file"></i>
                                    <p>
                                        Halaman
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item" id="create-page">
                                        <a href="<?= base_url('admin/add_page') ?>" class="nav-link">
                                            <i class="nav-icon fa fa-angle-right"></i>
                                            <p>
                                                Buat halaman
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item" id="manage-page">
                                        <a href="<?= base_url('admin/manage_page') ?>" class="nav-link">
                                            <i class="nav-icon fa fa-angle-right"></i>
                                            <p>
                                                List halaman
                                                <?php if (PAGECOUNT > 0) : ?>
                                                    <span class="ml-1 badge badge-danger right"><?= PAGECOUNT ?></span>
                                                <?php endif; ?>
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            

                            <li class="nav-item" id="manage-category">
                                <a href="<?= base_url('admin/manage_category') ?>" class="nav-link">
                                    <i class="nav-icon fa fa-tag"></i>
                                    <p>
                                        Kelola Kategori
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" id="manage-menu">
                                <a href="<?= base_url('admin/manage_menu') ?>" class="nav-link">
                                    <i class="nav-icon fa fa-list"></i>
                                    <p>
                                        Kelola Menu
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" id="manage-download">
                                <a href="<?= base_url('admin/manage_download') ?>" class="nav-link">
                                    <i class="nav-icon fa fa-download"></i>
                                    <p>
                                        Kelola File
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item" id="manage-user">
                                <a href="<?= base_url('admin/manage_user') ?>" class="nav-link">
                                    <i class="nav-icon fa fa-users"></i>
                                    <p>
                                        Kelola users
                                    </p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item" id="settings">
                            <a href="<?= base_url('admin/settings') ?>" class="nav-link">
                                <i class="nav-icon fa fa-cog"></i>
                                <p>
                                    Settings
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>