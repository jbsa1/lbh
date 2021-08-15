    <div class="main">

        <div class="container pb-5">
            <h1 class="font-weight-bold">Artikel</h1>
            <hr>

            <div class="row">
                <?php if (count($post) == 0) : ?>
                    <div class="col-12">
                        <h3 class="text-center">Belum ada file</h3>
                    </div>
                <?php else : ?>
                    


                    <div class="col-lg-9">

                        <div class="tab-content" id="nav-tabContent">
                            <?php foreach ($post as $key => $d) : ?>
                                <div class="tab-pane fade show <?= ($key == 2) ? 'active' : '' ?>" id="list-<?= $key ?>"  >
                                    <div class="card">
                                        <div class="card-body">
                                            <?php foreach ($d['body'] as $key => $item) : ?>
                                                <section id="info" class="info portfolio py-4">
                                                    <div class="row">
                                                        <div class="col-lg-8">

                                                            <div class="row portfolio-  container">
                                                                <div class="col-lg-6 col-md-6 portfolio-item filter-app">
                                                                    <a href="<?= base_url('article/') . $item['id_post'] ?>">
                                                                        <div class="portfolio-wrap border border-dark ">
                                                                            <figure>
                                                                                <?php if ($item['thumbnail'] != NULL) : ?>
                                                                                    <img src="<?= base_url('assets/img/thumbnails/') . $item['thumbnail'] ?>" class="img-fluid" alt="">
                                                                                <?php else : ?>
                                                                                    <img src="<?= base_url('assets/img/nophoto.png') ?>" class="img-fluid" alt="">
                                                                                <?php endif; ?>
                                                                            </figure>
                                                                            <div class="portfolio-info bg-white">
                                                                                <h4 class="text-dark"><?= substr($item['title'], 0, 25) ?></h4>
                                                                                <p><?= substr($item['description'], 0, 25) ?>....</p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </section>

                                            <?php endforeach; ?>

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











    