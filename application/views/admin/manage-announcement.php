<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola Pengumuman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Pengumuman</li>
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
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th>Created</th>
                                    <th class="text-center" style="width: 130px;">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($announcement as $key => $a) : ?>
                                    <tr>
                                        <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                        <td><?= $a['title'] ?></td>
                                        <td><?= $a['name'] ?></td>
                                        <td><?= $a['category'] ?></td>
                                        <td><?= $a['date_created'] ?></td>
                                        <td class="text-center" style="width: 150px;">
                                            <a href="<?= base_url('announcement/') . $a['id_announcement'] ?>" target="_blank" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Lihat pengumuman"><i class="fa fa-eye"></i></a>
                                            <a href="<?= base_url('admin/edit_announcement/') . $a['id_announcement'] ?>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Edit pengumuman"><i class="fa fa-pen"></i></a>
                                            <a href="<?= base_url('admin/delete_announcement/') . $a['id_announcement'] ?>" class="delete btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete pengumuman"><i class="fa fa-trash"></i></a>
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
    $('#announcement').addClass('menu-open');
    $('#manage-announcement a').addClass('active');

    // Datatable
    $('dataTable').dataTable();
</script>