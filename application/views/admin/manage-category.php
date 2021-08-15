<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Kategori</li>
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
                                    <th>Nama Kategori</th>
                                    <th class="text-center" style="width: 130px;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($category as $key => $c) : ?>
                                    <tr>
                                        <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                        <td><?= $c['category'] ?></td>
                                        <td class="text-center" style="width: 150px;">
                                            <a href="<?= base_url('admin/edit_category/') . $c['id_category'] ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit kategori"><i class="fa fa-pen"></i></a>
                                            <a href="<?= base_url('admin/delete_category/') . $c['id_category'] ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete kategori"><i class="fa fa-trash"></i></a>
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
    $('#manage-category a').addClass('active');

    // Datatable
    $('dataTable').dataTable();
    $(document).ready(function() {
        // Remove length label
        $('.dataTables_length label span').remove();
        // Add tombol tambah category
        $('.dataTables_length label').append(`
            <a href="<?= base_url('admin/add_category') ?>" class="btn btn-sm btn-dark ml-1">Tambah Kategori</a>
        `);
    });
</script>