<div class="main">

    <div class="container pb-5">
        <h1 class="font-weight-bold">Pengumuman</h1>
        <hr class="mb-4">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <table class="table table-hover border-0 dataTable w-100">
                    <thead>
                        <tr>
                            <th>Data Pengumuman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($announcement as $key => $an) : ?>
                            <tr>
                                <td class="border-0">
                                    <a href="<?= base_url('announcement/') . $an['id_announcement'] ?>" class="list-group-item list-group-item-action border border-warning" data-wow-delay="0.8s" data-wow-duration="1s">
                                        <div class="d-flex w-100">
                                            <h5 class="mb-2 font-weight-bold text-truncate"><?= $an['title'] ?></h5>
                                        </div>
                                        <!-- <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
                                        <small><i class="bx bx-user mr-1"></i><?= $an['name'] ?> | <i class="bx bx-calendar mr-1"></i><?= $an['date_created_formated'] ?></small>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="list-group border">
                    <a href="#" class="list-group-item list-group-item-action font-weight-bold active">
                        ARSIP TAHUNAN
                    </a>
                    <?php foreach ($arsip as $ar) : ?>
                        <a href="<?= base_url('announcement/year/') . $ar['tahun'] ?>" class="list-group-item list-group-item-action"><?= $ar['tahun'] ?>
                            <span class="badge badge-danger badge-pill float-right mt-1"><?= $ar['jumlah'] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>