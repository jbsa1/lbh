<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center bg-theme">
    <div class="container text-center wow fadeInDown" data-wow-delay="0.8s" data-wow-duration="1s" data data-aos="fade-up">
        <h1 class="announcement-title"><?= $announcement['title'] ?></h1>
        <h2 class="announcement-date"><i class="bx bx-user mr-1 pt-1"></i> <?= $announcement['name'] ?> | <i class="bx bx-calendar mr-1 pt-1"></i> <?= $announcement['date_created_formated'] ?></h2>
    </div>
</section><!-- End Hero -->

<div id="main">

    <div class="container-fluid pb-5 pt-4">

        <div class="row">
            <!-- Content -->
            <div class="col-lg-9">
                <h1 class="font-weight-bold"><?= $announcement['title'] ?></h1>
                <hr>
                <?= $announcement['content'] ?>
            </div>
            <!-- Pengumuman lain -->
            <div class="col-lg-3">

                <div>
                    <h3 class="font-weight-bold">Pengumuman Lain</h3>
                    <hr style="border-bottom: solid 2px #ffc107">
                </div>

                <div class="list-group">
                    <?php foreach ($others as $o) : ?>
                        <a href="<?= base_url('announcement/') . $o['id_announcement'] ?>" class="list-group-item list-group-item-action border mb-2 border-warning mb-3" data-wow-delay="0.8s" data-wow-duration="1s">
                            <div class="d-flex w-100">
                                <h5 class="mb-2 font-weight-bold text-truncate"><?= $o['title'] ?></h5>
                            </div>
                            <!-- <p class="mb-1">Lorem ipsum dolor sit amet consectetur adipisicing.</p> -->
                            <small><i class="bx bx-user mr-1"></i><?= $o['name'] ?> | <i class="bx bx-calendar mr-1"></i><?= $o['date_created'] ?></small>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>