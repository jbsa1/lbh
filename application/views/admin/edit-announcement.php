<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Pengumuman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Pengumuman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="<?= base_url('admin/edit_announcement') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-right py-2">
                                <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-save mr-2"></i>Simpan</button>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('status') ?>
                                <!-- Id author -->
                                <input type="hidden" name="id_author" id="id_author" value="<?= $_SESSION['id_user'] ?>">
                                <!-- Id announcement -->
                                <input type="hidden" name="id_announcement" id="id_announcement" value="<?= (isset($announcement['id_announcement'])) ? $announcement['id_announcement'] : '' ?>">
                                <!-- Judul -->
                                <label for="title" class="pl-1">Judul Pengumuman</label>
                                <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Judul Pengumuman" autocomplete="off" value="<?= (isset($announcement['title'])) ? $announcement['title'] : '' ?>" required>
                                <!-- Kategori pengumuman -->
                                <div class="form-group">
                                    <label for="id_category" class="pl-1">Kategori Pengumuman</label>
                                    <select name="id_category" id="id_category" class="custom-select select2bs4" style="width: 100%;" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat['id_category'] ?>"><?= $kat['category'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php if ($announcement['id_category'] != NULL) : ?>
                                    <script type='text/javascript'>
                                        $('#id_category').val('<?= $announcement['id_category'] ?>');
                                    </script>
                                <?php endif; ?>
                                <!-- Isi -->
                                <label for="content" class="pl-1">Isi Pengumuman</label>
                                <textarea name="content" id="content" class="editor w-100" required><?= (isset($announcement['content'])) ? $announcement['content'] : '' ?></textarea>
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
    $('#create-announcement a').addClass('active');

    // Config editor
    $('.editor').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']],
        ],
        height: 400,
        placeholder: 'Ketikan sesuatu...',
        callbacks: {
            onImageUpload: function(image) {
                uploadImage(image[0]);
            },
            onMediaDelete: function(target) {
                deleteImage(target[0].src);
            }
        }
    });

    function uploadImage(image) {
        var data = new FormData();
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