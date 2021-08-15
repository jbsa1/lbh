<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fa fa-cog text-theme"></i> Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="text-purple">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="user-settings-tab" data-toggle="tab" href="#user-settings" role="tab" aria-controls="user-settings" aria-selected="false">User Settings</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="password-settings-tab" data-toggle="tab" href="#password-settings" role="tab" aria-controls="password-settings" aria-selected="true">Ubah Password</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-white border-left border-right border-bottom p-3" id="myTabContent">
                        <?= $this->session->flashdata('status'); ?>
                        <!-- User settings -->
                        <div class="tab-pane fade show active" id="user-settings" role="tabpanel" aria-labelledby="user-settings-tab">
                            <div class="card">
                                <div class="card-header bg-theme">
                                    <button type="submit" id="btnSubmitUser" form="formUser" class="btn btn-sm btn-outline-light float-right">Simpan</button>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('admin/settings_edit_user') ?>" method="post" id="formUser">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="hidden" name="id_author" id="id_author1" value="<?= (isset($user['id_author'])) ? $user['id_author'] : '' ?>">
                                                <div class="form-group">
                                                    <label for="name" class="pl-1">Nama user</label>
                                                    <input type="text" id="name" name="name" placeholder="Nama user" class="form-control" autocomplete="off" value="<?= (isset($user['name'])) ? $user['name'] : '' ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="pl-1">Username</label>
                                                    <input type="text" id="username" name="username" placeholder="Username" class="form-control" autocomplete="off" data-username="<?= (isset($user['username'])) ? $user['username'] : '' ?>" value="<?= (isset($user['username'])) ? $user['username'] : '' ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Password Settings -->
                        <div class="tab-pane fade" id="password-settings" role="tabpanel" aria-labelledby="password-settings-tab">
                            <div class="card">
                                <div class="card-header bg-theme">
                                    <button type="submit" id="btnSubmitPassword" form="formPassword" class="btn btn-sm btn-outline-light float-right">Simpan</button>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('admin/settings_edit_password') ?>" method="post" id="formPassword">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="hidden" name="id_author" id="id_author2" value="<?= (isset($user['id_author'])) ? $user['id_author'] : '' ?>">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="password" class="pl-1">Password baru</label>
                                                        <input type="password" id="password" name="password" placeholder="New password" class="form-control" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_confirm" class="pl-1">Ketik ulang password</label>
                                                        <input type="password" id="password_confirm" name="password_confirm" placeholder="Ketik ulang password" class="form-control" autocomplete="off" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password_old" class="pl-1">Sandi saat ini</label>
                                                        <input type="password" id="password_old" name="password_old" placeholder="Ketik sandi saat ini" class="form-control" autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type='text/javascript'>
    $('#settings a').addClass('active');

    /* Edit password config */
    $('#formPassword').submit(function(e) {
        e.preventDefault();
        console.log($('#password').val());
        console.log($('#password_confirm').val());
        if ($('#password').val() == $('#password_confirm').val()) {
            $('#password_confirm').removeClass('is-invalid');
            $('#password_confirm').addClass('is-valid');
            $('#password-error').remove();
            $('#formPassword').unbind().submit();
        } else {
            $('#password_confirm').removeClass('is-valid');
            $('#password_confirm').addClass('is-invalid');
            $('#password-error').remove();
            $('#password_confirm').parent().append(`
                <small id="password-error" class="text-danger">Konfirmasi password tidak sesuai</small>
            `);
        }
    });

    /* Edit user config */
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
        e.preventDefault();
        if (status == 'true') {
            $('#formUser').unbind().submit();
        }
    });
</script>