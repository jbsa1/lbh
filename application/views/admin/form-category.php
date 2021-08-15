<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Kategori</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Kategori</li>
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
                    <form action="<?= $action ?>" method="post" id="formUser">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="hidden" name="id_category" id="id_category" value="<?= (isset($category['id_category'])) ? $category['id_category'] : '' ?>">
                                <div class="form-group">
                                    <label for="category" class="pl-1">Nama Kategori</label>
                                    <input type="text" id="category" name="category" placeholder="Nama Kategori" class="form-control" autocomplete="off" value="<?= (isset($category['category'])) ? $category['category'] : '' ?>" required>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
</script>