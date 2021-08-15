<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Buat Artikel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Buat Artikel</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="<?= base_url('admin/add_post') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-9 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <?= $this->session->flashdata('status') ?>
                                <!-- Judul -->
                                <label for="title" class="pl-1">Judul Postingan</label>
                                <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Judul Post" autocomplete="off" required>
                                <!-- Isi -->
                                <label for="content" class="pl-1">Isi Postingan</label>
                                <textarea name="content" id="content" class="editor w-100"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Thumbnail -->
                                <label for="thumbnails" class="pl-1">Thumbnails Postingan</label>
                                <label for="thumbnails" class="d-block">
                                    <img src="<?= base_url('assets/img/nophoto.png') ?>" id="thumbnail-show" alt="thumbnail" class="w-100" style="cursor: pointer;">
                                </label>
                                <input type="file" name="thumbnails" id="thumbnails" class="invisible d-none">
                                <!-- Deskripsi -->
                                <label for="description" class="pl-1">Deskripsi Postingan</label>
                                <textarea name="description" id="description" class="form-control mb-3" placeholder="Dekripsi Post" required></textarea>
                                <!-- Kategori -->
                                <div class="form-group">
                                    <label>Kategori Postingan</label>
                                    <div class="select2-warning">
                                        <select class="select2" name="category[]" id="category" data-placeholder="Pilih kategori" data-dropdown-css-class="select2-warning" style="width: 100%;" required>
                                            <option value="">Pilih kategori</option>
                                            <?php foreach ($kategori as $kat) : ?>
                                                <option value="<?= $kat['id_category'] ?>"><?= $kat['category'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Author -->
                                <input type="hidden" name="id_author" id="id_author" value="<?= $_SESSION['id_user'] ?>">
                                <!-- Submit -->
                                <button type="submit" class="btn btn-success mt-2"><i class="fa fa-save mr-2"></i>Simpan</button>
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
    $('#post').addClass('menu-open');
    $('#create-post a').addClass('active');

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

    // Read Image
    function readImg(input, showTarget) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(showTarget).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('input[type=file]').change(function() {
        readImg(this, '#thumbnail-show');
    });
</script>