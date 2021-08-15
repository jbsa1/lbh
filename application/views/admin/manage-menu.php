<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Kelola Menu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Kelola Menu</li>
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
                <div class="card-header">
                    <button class="add_single_menu btn btn-sm btn-dark">
                        <i class="fa fa-plus-circle mr-1"></i>
                        Add single menu
                    </button>
                    <button class="addDropMenu btn btn-sm btn-warning">
                        <i class="fa fa-plus-circle mr-1"></i>
                        Add dropdown menu
                    </button>
                    <button class="saveMenu btn btn-sm btn-success float-right">
                        <i class="fa fa-save mr-1"></i>
                        Simpan Menu
                    </button>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('status') ?>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-theme" id="navbar-showcase">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul id="sortable" class="navbar-nav ml-auto">
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($m['tipe'] == 'single') : ?>
                                        <li class="nav-item" id="<?= $m['id_menu'] ?>">
                                            <a class="nav-link" data-target="<?= $m['id_menu'] ?>" href="<?= base_url('admin/get_menu/') . $m['id_menu'] ?>"><?= $m['label'] ?></a>
                                        </li>
                                    <?php elseif ($m['tipe'] == 'dropdown') : ?>
                                        <li class="nav-item dropdown" id="<?= $m['id_menu'] ?>">
                                            <a class="nav-link dropdown-toggle" data-target="<?= $m['id_menu'] ?>" href="<?= base_url('admin/get_menu/') . $m['id_menu'] ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?= $m['label'] ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </nav>
                    <p class="mt-3 mb-0 text-secondary pl-1"><i class="fa fa-info-circle mr-2"></i>Geser menu untuk mengubah urutan</p>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- Modal single menu -->
<div class="modal fade" id="singleMenuModal" tabindex="-1" aria-labelledby="singleMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="singleMenuModalLabel">Single Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/add_single_menu') ?>" method="POST" id="formSingleMenu">
                    <input type="hidden" name="id_menu_single" id="id_menu_single" value="">
                    <div class="form-group">
                        <label for="label_single">Label</label>
                        <input type="text" name="label_single" id="label_single" class="form-control" placeholder="Label" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="link_single">Link</label>
                        <input type="text" name="link_single" id="link_single" class="form-control" placeholder="Link" autocomplete="off" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="" class="delete_menu delete btn btn-danger">Hapus</a>
                <button type="submit" form="formSingleMenu" class="btn btn-secondary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal drop menu -->
<div class="modal fade" id="dropMenuModal" tabindex="-1" aria-labelledby="dropMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dropMenuModalLabel">Dropdown Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/add_drop_menu') ?>" method="POST" id="formDropMenu">
                    <input type="hidden" name="id_menu_drop" id="id_menu_drop" value="">
                    <div class="form-group">
                        <label for="label_drop">Label</label>
                        <input type="text" name="label_drop" id="label_drop" class="form-control" placeholder="Label" autocomplete="off" required>
                    </div>
                    <hr>
                    <label for="">Submenu</label>
                    <table class="table table-sm border mb-2">
                        <thead class="bg-secondary">
                            <tr class="text-center text-white font-weight-bold">
                                <th>Label</th>
                                <th>Link</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="submenu-field">
                            <tr class="submenu">
                                <td>
                                    <input type="text" class="submenu_label form-control" placeholder="Label" autocomplete="off" required>
                                </td>
                                <td>
                                    <input type="text" class="submenu_link form-control" placeholder="Link" autocomplete="off" required>
                                </td>
                                <td>
                                    <button type="button" class="delete_submenu btn btn-sm btn-danger mt-1"><i class="fa fa-times-circle"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center">
                        <button type="button" class="add_submenu btn btn-sm text-dark"><i class="fa fa-plus-circle mr-1"></i> Tambah Submenu</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="" class="delete_menu delete btn btn-danger">Hapus</a>
                <button type="submit" form="formDropMenu" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>


<script type='text/javascript'>
    // Activate menu
    $('#manage-menu a').addClass('active');

    // Datatable
    $('dataTable').dataTable();

    // Save menu
    $('.saveMenu').click(function() {
        var menu = $('#sortable')[0].children;
        var urutanMenu = [];
        for (let i = 0; i < menu.length; i++) {
            const item = menu[i];
            urutanMenu.push(item.id);
        }
        $.ajax({
            type: 'post',
            url: '<?= base_url('admin/save_sort_menu') ?>',
            data: {
                urutanMenu
            },
            success: function(data) {
                console.log(data);
                document.location.href = '';
            }
        });
    });

    // Add single menu
    $('.add_single_menu').click(function(e) {
        e.preventDefault();
        $('#formSingleMenu').attr('action', '<?= base_url('admin/add_single_menu') ?>');
        $('#singleMenuModal').modal('show');
    });

    // Add dropdown menu
    $('.addDropMenu').click(function(e) {
        e.preventDefault();
        $('#formDropMenu').attr('action', '<?= base_url('admin/add_drop_menu') ?>');
        $('#dropMenuModal').modal('show');
    });

    // Add submenu
    $('.add_submenu').click(function() {
        $('.submenu-field').append(`
            <tr class="submenu">
                <td>
                    <input type="text" class="submenu_label form-control" placeholder="Label" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" class="submenu_link form-control" placeholder="Link" autocomplete="off" required>
                </td>
                <td>
                    <button type="button" class="delete_submenu btn btn-sm btn-danger mt-1"><i class="fa fa-times-circle"></i></button>
                </td>
            </tr>
        `)
    });

    // Delete submenu
    $(document).on('click', '.delete_submenu', function() {
        $(this).parents()[1].remove();
    });

    // Form drop submit
    $('#formDropMenu').submit(function(e) {
        e.preventDefault();
        var submenuEl = $('.submenu');
        var submenuArray = [];
        for (let i = 0; i < submenuEl.length; i++) {
            const item = submenuEl[i];
            var itemSubmenu = {
                'label': item.children[0].children[0].value,
                'link': item.children[1].children[0].value
            }
            submenuArray.push(itemSubmenu);
        }
        var dataDropMenu = {
            'id_menu': $('#id_menu_drop').val(),
            'label': $('#label_drop').val(),
            'submenu': submenuArray
        }
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: dataDropMenu,
            success: function(data) {
                document.location.href = '<?= base_url('admin/manage_menu') ?>';
            }
        });
    });

    // Opsi edit delete menu
    $('#navbar-showcase .nav-link').click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('dropdown-toggle')) {
            $('#formDropMenu').attr('action', '<?= base_url('admin/edit_drop_menu') ?>');
            $('#dropMenuModal').modal('show');
            $('#dropMenuModal .delete_menu').show();
            $('#dropMenuModal .delete_menu').attr('href', '<?= base_url('admin/delete_menu/') ?>' + $(this).data('target'));
            $.get($(this).attr('href'), function(data) {
                $('#id_menu_drop').val(data.id_menu);
                $('#label_drop').val(data.label);
                $('.submenu-field').html('');
                for (let i = 0; i < data.submenu.length; i++) {
                    const sub = data.submenu[i];
                    $('.submenu-field').append(`
                        <tr class="submenu">
                            <td>
                                <input type="text" class="submenu_label form-control" placeholder="Label" autocomplete="off" value="${sub.label}" required>
                            </td>
                            <td>
                                <input type="text" class="submenu_link form-control" placeholder="Link" autocomplete="off" value="${sub.link}" required>
                            </td>
                            <td>
                                <button type="button" class="delete_submenu btn btn-sm btn-danger mt-1"><i class="fa fa-times-circle"></i></button>
                            </td>
                        </tr>
                    `);
                }
            });
        } else {
            $('#formSingleMenu').attr('action', '<?= base_url('admin/edit_single_menu') ?>');
            $('#singleMenuModal').modal('show');
            $('#singleMenuModal .delete_menu').show();
            $('#singleMenuModal .delete_menu').attr('href', '<?= base_url('admin/delete_menu/') ?>' + $(this).data('target'));
            $.get($(this).attr('href'), function(data) {
                $('#id_menu_single').val(data.id_menu);
                $('#label_single').val(data.label);
                $('#link_single').val(data.url);
            });
        }
    });

    /* Modal menu dropdown config */
    $('.delete_menu').hide();
    $('#dropMenuModal').on('hidden.bs.modal', function() {
        $('#label_drop').val('');
        $('#id_menu_drop').val('');
        $('.submenu-field').html(`
            <tr class="submenu">
                <td>
                    <input type="text" class="submenu_label form-control" placeholder="Label" autocomplete="off" required>
                </td>
                <td>
                    <input type="text" class="submenu_link form-control" placeholder="Link" autocomplete="off" required>
                </td>
                <td>
                    <button type="button" class="delete_submenu btn btn-sm btn-danger mt-1"><i class="fa fa-times-circle"></i></button>
                </td>
            </tr>
        `);
        $('#dropMenuModal .delete_menu').hide();
    });
    /* Modal menu dropdown config */
    $('#singleMenuModal').on('hidden.bs.modal', function() {
        $('#label_single').val('');
        $('#id_menu_single').val('');
        $('#link_single').val('');
        $('#singleMenuModal .delete_menu').hide();
    });
</script>