<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Running Text</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Running Text</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="<?= base_url('admin/edit_running_text') ?>" method="post">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-right py-2">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save mr-2"></i>Simpan</button>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('status') ?>
                                <!-- Isi -->
                                <label for="running_text" class="pl-1">Running Text</label>
                                <textarea name="running_text" id="running_text" class="form-control" placeholder="Ketikkan sesuatu..." required><?= $running_text['running_text'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    // Activate menu
    $('#announcement').addClass('menu-open');
    $('#running-text a').addClass('active');
</script>