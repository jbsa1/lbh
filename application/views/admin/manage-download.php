<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola File</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Download</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <?= $this->session->flashdata('status') ?>
                    <div class="table-responsive">
                        <table class="table table-hover border dataTable">
                            <thead>
                                <tr>
                                    <th style="width: 30px; text-align: center;">No</th>
                                    <th>Nama File</th>
                                    <th>Tipe</th>
                                    <th>Size</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Upload</th>
                                    <th class="text-center" style="width: 130px;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($download as $key => $c) : ?>
                                    <tr>
                                        <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                        <td><?= $c['nama_file'] ?></td>
                                        <td><?php
                                            $tipe = explode('/', $c['tipe_file']);
                                            echo end($tipe);
                                            ?></td>
                                        <td><?= round($c['size_file'] / 1000000, 2) ?> MB</td>
                                        <td><?= $c['category'] ?></td>
                                        <td><?= $c['date_created'] ?></td>
                                        <td class="text-center" style="width: 150px;">
                                            <a href="<?= base_url('admin/delete_download_file/') . $c['id_download'] ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete file"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    // Activate menu
    $('#manage-download a').addClass('active');

    // Datatable
    $('dataTable').dataTable();
    $(document).ready(function() {
        // Remove length label
        $('.dataTables_length label span').remove();
        // Add tombol tambah download
        $('.dataTables_length label').append(`
            <a href="<?= base_url('admin/add_download') ?>" class="btn btn-sm btn-dark ml-1">Tambah File</a>
        `);
    });

    function uploadImage(image) {
        var x = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?php echo site_url('admin/upload_image_post') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                console.log(url);
                $('.editor').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {
                src: src
            },
            type: "POST",
            url: "<?php echo site_url('admin/delete_image_post') ?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }

    
</script>