<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Download File</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Download File</li>
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
                    <form action="<?= $action ?>" method="post" id="formDownload" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- ID Download File -->
                                <input type="hidden" name="id_download" id="id_download" value="<?= (isset($download['id_download'])) ? $download['id_download'] : '' ?>">
                                <!-- Nama File -->
                                <div class="form-group">
                                    <label for="nama_file" class="pl-1">Nama File</label>
                                    <input type="text" id="nama_file" name="nama_file" placeholder="Nama File" class="form-control" autocomplete="off" value="<?= (isset($download['nama_file'])) ? $download['nama_file'] : '' ?>" required>
                                </div>
                                <!-- Deskripsi File -->
                                <div class="form-group">
                                    <label for="deskripsi_file" class="pl-1">Deskripsi File</label>
                                    <textarea id="deskripsi_file" name="deskripsi_file" placeholder="Nama File" class="form-control" required><?= (isset($download['deskripsi_file'])) ? $download['deskripsi_file'] : '' ?></textarea>
                                </div>
                                <!-- Kategori Download -->
                                <div class="form-group">
                                    <label for="kategori_file" class="pl-1">Kategori File</label>
                                    <select name="kategori_file" id="kategori_file" class="custom-select select2bs4" style="width: 100%;" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategori as $kat) : ?>
                                            <option value="<?= $kat['id_category'] ?>"><?= $kat['category'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <!-- Path File -->
                                <input type="hidden" name="path_file" id="path_file">
                                <input type="hidden" name="tipe_file" id="tipe_file">
                                <input type="hidden" name="size_file" id="size_file">
                            </div>
                            <div class="col-lg-3 col-md-5">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Thumbnail -->
                                        <label for="thumbnails" class="pl-1">Thumbnails Postingan</label>
                                        <label for="thumbnails" class="d-block">
                                            <img src="<?= base_url('assets/img/nophoto.png') ?>" id="thumbnail-show" alt="thumbnail" class="w-100" style="cursor: pointer;">
                                        </label>
                                        <input type="file" name="thumbnails" id="thumbnails" class="invisible d-none">

                                        <!-- Kategori -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <label for="file" class="pl-1">File</label>
                    <div>
                        <form action="<?= base_url('admin/upload_download_file') ?>" class="dropzone" id="dropzoneForm"></form>
                        <button type="submit" form="dropzoneForm" class="btn btn-success mt-3 float-right" id="submit">Submit File</button>
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
</script>

<script type="text/javascript">
    // Dropzone.autoDiscover = false;
    Dropzone.options.dropzoneForm = {
        autoProcessQueue: false,
        acceptedFiles: ".pdf, .doc, .docx, .pptx, .xls, .xlsx, .jpg, .jpeg, .png, .gif, .zip, .rar, .mp4, .mkv, .mp3",
        addRemoveLinks: true,
        dictDefaultMessage: "<button type='button' class='btn btn-outline-secondary'><i class='fa fa-upload mr-2'></i>Drop Files / Click Here</button>",
        dictRemoveFile: '<i class="fa fa-times text-danger mt-2" style="cursor: pointer"><i>',
        maxFiles: 1,
        init: function() {
            // Create event listener
            var submit = document.querySelector('#dropzoneForm');
            submit.addEventListener('submit', function(e) {
                e.preventDefault();
                myDropzone.processQueue();
            });
            // Complete handling
            myDropzone = this;
            this.on('complete', function() {
                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    var myDropzone = this;
                    myDropzone.removeAllFiles();
                }
            });
        },
        success: function(file, response) {
            console.log(file);
            console.log(response);
            $('#path_file').val(response.file_name);
            $('#tipe_file').val(response.tipe);
            $('#size_file').val(file.size);
            $('#formDownload').submit();
        }
    }

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