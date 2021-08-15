<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Halaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Halaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <form action="<?= base_url('admin/edit_page') ?>" method="post" enctype="multipart/form-data" id="formEditPage">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-right py-2">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save mr-2"></i>Simpan</button>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('status') ?>
                                <input type="hidden" name="id_page" id="id_page" value="<?= (isset($page['id_page'])) ? $page['id_page'] : '' ?>">
                                <!-- Judul -->
                                <label for="title" class="pl-1">Judul Halaman</label>
                                <input type="text" name="title" id="title" class="form-control mb-3" placeholder="Judul Halaman" autocomplete="off" value="<?= (isset($page['title'])) ? $page['title'] : '' ?>" required>
                                <!-- URL -->
                                <label for="url" class="pl-1">URL Halaman</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text px-4"><?= base_url() ?>page/</div>
                                    </div>
                                    <input type="text" name="url" id="url" class="form-control" placeholder="url halaman" autocomplete="off" data-url="<?= (isset($page['url'])) ? $page['url'] : '' ?>" value="<?= (isset($page['url'])) ? $page['url'] : '' ?>" required>
                                </div>
                                <!-- Isi -->
                                <label for="content" class="pl-1 mt-3">Isi Halaman</label>
                                <textarea name="content" id="content" class="editor w-100" required><?= (isset($page['content'])) ? $page['content'] : '' ?></textarea>
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
    $('#page').addClass('menu-open');
    $('#create-page a').addClass('active');

    // Cek url
    var status = false;
    $(document).ready(function() {
        if ($('#url').val() == $('#url').data('url')) {
            status = true;
        } else {
            $.get('<?= base_url('admin/check_url/') ?>' + $('#url').val(), function(data) {
                if (data == 'true') {
                    $('#url').removeClass('is-invalid');
                    status = true;
                } else {
                    $('#url').addClass('is-invalid');
                    status = false;
                }
            });
        }
    });
    $('#url').keyup(function() {
        if ($(this).val() != '') {
            if ($('#url').val() == $('#url').data('url')) {
                status = true;
            } else {
                $.get('<?= base_url('admin/check_url/') ?>' + $('#url').val(), function(data) {
                    if (data == 'true') {
                        $('#url').removeClass('is-invalid');
                        status = true;
                    } else {
                        $('#url').addClass('is-invalid');
                        status = false;
                    }
                });
            }
        }
    });
    $('#formEditPage').submit(function(e) {
        e.preventDefault();
        if (status == 'true') {
            console.log(status);
            $('#formEditPage').unbind().submit();
        } else {
            $('#url').focus();
        }
    })

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