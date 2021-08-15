<div class="main">

    <div class="container pb-5">
        <h1 class="font-weight-bold">Arsip Pengumuman <?= $this->uri->segment(3) ?></h1>
        <hr class="mb-4">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover border-0 dataTable w-100">
                    <thead>
                        <tr>
                            <th>Data Pengumuman</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($arsip as $key => $ar) : ?>
                            <tr>
                                <td class="border-0">
                                    <a href="<?= base_url('announcement/') . $ar['id_announcement'] ?>" class="list-group-item list-group-item-action border border-warning" data-wow-delay="0.8s" data-wow-duration="1s">
                                        <div class="d-flex w-100">
                                            <h5 class="mb-2 font-weight-bold text-truncate"><?= $ar['title'] ?></h5>
                                        </div>
                                        <!-- <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
                                        <small><i class="bx bx-user mr-1"></i><?= $ar['name'] ?> | <i class="bx bx-calendar mr-1"></i><?= $ar['date_created_formated'] ?></small>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>