<div class="main">

    <div class="container pb-5">
        <h1 class="font-weight-bold">Download Files</h1>
        <hr>

        <div class="row">
            <?php if (count($download) == 0) : ?>
                <div class="col-12">
                    <h3 class="text-center">Belum ada file</h3>
                </div>
            <?php else : ?>
                <div class="col-lg-3 mb-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <?php foreach ($download as $key => $d) : ?>
                            <a class="list-group-item list-group-item-action <?= ($key == 0) ? 'active' : '' ?>" id="list-<?= $key ?>-list" data-toggle="list" href="#list-<?= $key ?>" role="tab" aria-controls="<?= $key ?>">
                                <?= $d['header']['category'] ?>
                                <span class="badge badge-danger badge-pill float-right"><?= $d['header']['jumlah'] ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="nav-tabContent">
                        <?php foreach ($download as $key => $d) : ?>
                            <div class="tab-pane fade show <?= ($key == 0) ? 'active' : '' ?>" id="list-<?= $key ?>" role="tabpanel" aria-labelledby="list-<?= $key ?>-list">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover border dataTable">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 30px; text-align: center;">No</th>
                                                        <th>Nama File</th>
                                                        <th>Thumbnail</th>
                                                        <th>Tanggal</th>
                                                        <th>Deskripsi</th>
                                                        <th class="text-center" style="width: 130px;">Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($d['body'] as $key => $item) : ?>
                                                        <tr>
                                                            <td style="width: 30px; text-align: center;"><?= $key + 1 ?></td>
                                                            <td><?php
                                                                $tipe = explode('/', $item['tipe_file']);
                                                                $tipe = end($tipe);
                                                                if ($tipe == 'pdf') {
                                                                    echo "<i class='fa fa-file-pdf mr-2 text-danger'></i>";
                                                                } elseif ($tipe == 'docx' | $tipe == 'doc') {
                                                                    echo "<i class='fa fa-file-word mr-2 text-primary'></i>";
                                                                } elseif ($tipe == 'pptx' | $tipe == 'ppt') {
                                                                    echo "<i class='fa fa-file-powerpoint mr-2 text-warning'></i>";
                                                                } elseif ($tipe == 'xlsx' | $tipe == 'xls') {
                                                                    echo "<i class='fa fa-file-excel mr-2 text-success'></i>";
                                                                } elseif ($tipe == 'zip' | $tipe == 'rar') {
                                                                    echo "<i class='fa fa-file-archive mr-2 text-secondary'></i>";
                                                                } elseif ($tipe == 'jpg' | $tipe == 'png' | $tipe == 'jpeg' | $tipe == 'gif' | $tipe == 'svg') {
                                                                    echo "<i class='fa fa-image mr-2 text-info'></i>";
                                                                } else {
                                                                    echo "<i class='fa fa-file mr-2 text-secondary'></i>";
                                                                }
                                                                echo $item['nama_file'] . '.' . $tipe;
                                                                ?></td>
                                                            <td>

                                                                <figure>
                                                                    <?php if ($item['thumbnail'] != NULL) : ?>
                                                                        <img src="<?= base_url('assets/img/thumbnails2/') . $item['thumbnail'] ?>" class="img-fluid" alt="">
                                                                    <?php else : ?>
                                                                        <img src="<?= base_url('assets/img/nophoto.png') ?>" class="img-fluid" alt="">
                                                                    <?php endif; ?>
                                                                </figure>

                                                            </td>
                                                            <td><?= $item['date_created'] ?></td>
                                                            <td><?= $item['deskripsi_file'] ?> </td>
                                                            <td class="text-center" style="width: 150px;">
                                                                <a href="<?= base_url('page/download_proses/') . $item['id_download'] ?>" class="delete btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Download file"><i class="fa fa-download"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>