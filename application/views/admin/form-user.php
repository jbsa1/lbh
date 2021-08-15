<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add user</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add user</li>
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
                                <input type="hidden" name="id_author" id="id_author" value="<?= (isset($user['id_author'])) ? $user['id_author'] : '' ?>">
                                <div class="form-group">
                                    <label for="name" class="pl-1">Nama user</label>
                                    <input type="text" id="name" name="name" placeholder="Nama user" class="form-control" autocomplete="off" value="<?= (isset($user['name'])) ? $user['name'] : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="pl-1">Username</label>
                                    <input type="text" id="username" name="username" placeholder="Username" class="form-control" autocomplete="off" data-username="<?= (isset($user['username'])) ? $user['username'] : '' ?>" value="<?= (isset($user['username'])) ? $user['username'] : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="role" class="pl-1">Role</label>
                                    <select id="role" name="role" class="custom-select" required>
                                        <option value="">Pilih role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Author">Author</option>
                                    </select>
                                </div>
                                <?php if (isset($user['role'])) : ?>
                                    <script type='text/javascript'>
                                        $('#role').val('<?= $user['role'] ?>');
                                    </script>
                                <?php endif; ?>
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
    $('#manage-user a').addClass('active');

    // Check username
    var status = false;
    if ($('#username').data('username') == '') {
        $('#username').keyup(function() {
            $.get('<?= base_url('admin/check_username/') ?>' + $('#username').val(), function(data) {
                if (data == 'true') {
                    $('#username').removeClass('is-invalid');
                    status = true;
                } else {
                    $('#username').addClass('is-invalid');
                    status = false;
                }
            });
        });
    } else {
        $('#username').keyup(function() {
            if ($('#username').val() == $('#username').data('username')) {
                $('#username').removeClass('is-invalid');
                status = true;
            } else {
                $.get('<?= base_url('admin/check_username/') ?>' + $('#username').val(), function(data) {
                    if (data == 'true') {
                        $('#username').removeClass('is-invalid');
                        status = true;
                    } else {
                        $('#username').addClass('is-invalid');
                        status = false;
                    }
                });
            }
        });
    }

    $(document).ready(function() {
        if ($('#username').val() == $('#username').data('username')) {
            $('#username').removeClass('is-invalid');
            status = true;
        }
    });

    // Submit validation
    $('#formUser').submit(function(e) {
        console.log(status);
        e.preventDefault();
        if (status == 'true') {
            $('#formUser').unbind().submit();
        }
    })
</script>