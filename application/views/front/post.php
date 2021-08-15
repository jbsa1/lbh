<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center" style="background: url('<?= base_url('assets/img/thumbnails/') . $post['thumbnail'] ?>'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="container text-center wow fadeInDown" data-wow-delay="0.8s" data-wow-duration="1s" data data-aos="fade-up">
        <h1 class="post-title"><?= $post['title'] ?></h1>
        <h2 class="post-date"><i class="bx bx-user mr-1 pt-1"></i> <?= $post['name'] ?> | <i class="bx bx-calendar mr-1 pt-1"></i> <?= $post['date_created_formated'] ?></h2>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Portfolio Section ======= -->
    <section id="info" class="info portfolio py-4">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-9">

                    <div class="post-body mt-4 mb-5">
                        <?= $post['content'] ?>
                    </div>

                </div>

                <div class="col-lg-3">

                    <div>
                        <h3 class="font-weight-bold">Pengumuman</h3>
                        <hr style="border-bottom: solid 2px #ffc107">
                    </div>

                    <div class="list-group">
                        <?php foreach ($announcement as $an) : ?>
                            <a href="<?= base_url('announcement/') . $an['id_announcement'] ?>" class="list-group-item list-group-item-action border mb-2 border-warning mb-3" data-wow-delay="0.8s" data-wow-duration="1s">
                                <div class="d-flex w-100">
                                    <h5 class="mb-2 font-weight-bold text-truncate"><?= $an['title'] ?></h5>
                                </div>
                                <!-- <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
                                <small><i class="bx bx-user mr-1"></i><?= $an['name'] ?> | <i class="bx bx-calendar mr-1"></i><?= $an['date_created_formated'] ?></small>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <div>
                        <a href="<?= base_url('announcement') ?>" class="btn btn-secondary w-100">Lihat semua pengumuman</a>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Other post -->
                    <div class="related-post mt-5">
                        <div>
                            <h3 class="font-weight-bold">Artikel lainnya</h3>
                            <hr style="border-bottom: solid 2px #ffc107">
                        </div>

                        <div class="row portfolio-container">
                            <?php foreach ($others as $key => $o) : ?>
                                <div class="col-lg-3 col-md-6 portfolio-item filter-app">
                                    <a href="<?= base_url('article/') . $o['id_post'] ?>">
                                        <div class="portfolio-wrap border border-dark wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                                            <figure>
                                                <?php if ($o['thumbnail'] != NULL) : ?>
                                                    <img src="<?= base_url('assets/img/thumbnails/') . $o['thumbnail'] ?>" class="img-fluid" alt="">
                                                <?php else : ?>
                                                    <img src="<?= base_url('assets/img/nophoto.png') ?>" class="img-fluid" alt="">
                                                <?php endif; ?>
                                            </figure>

                                            <div class="portfolio-info bg-white">
                                            <h4 class="text-dark"><?= substr($o['title'], 0, 25) ?></h4>
                                                <p><?= substr($o['description'], 0, 25) ?>...</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- End Other post -->
                </div>
            </div>

        </div>
    </section><!-- End Portfolio Section -->

</main>
<!-- End #main -->