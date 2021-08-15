<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex flex-column justify-content-center align-items-center" style="height:90vh; background: url('<?= base_url() ?>assets/img/ttg.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
  <div class="container text-center wow fadeInDown" data-wow-delay="0.8s" data-wow-duration="1s" data data-aos="fade-up">
    <h1>Selamat datang di <span>LBH Surabaya</span></h1>
    <h2>Lembaga Bantuan Hukum - Surabaya</h2>
    <a href="#contact" class="btn-get-started bg-dark text-white scrollto">Get Started</a>
  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= Fast menu ======= -->
  <section id="fast-menu" class="fast-menu bg-theme portfolio">
    <div class="container">

      <div class="row justify-content-center">

        <div class="col-lg-6 col-md-8 col-10">
          <div class="input-group rounded">
            <div class="input-group-prepend mr-2">
              <span class="input-group-text bg-transparent border-0" id="back-search" style="cursor: pointer;"><i class="bx bx-arrow-back text-white"></i></span>
            </div>
            <input type="text" class="form-control" name="search" id="search" placeholder="Cari artikel" autocomplete="off" required>
            <div class="input-group-append">
              <span class="input-group-text"><i class="bx bx-search"></i></span>
            </div>
          </div>
        </div>

      </div>

      <div class="row" id="search-result">
        <!-- Load content here -->
      </div>

    </div>
  </section><!-- End Fast menu -->

  <!-- ======= Information Section ======= -->
  <section id="info" class="info portfolio py-4">
    <div class="container">

      <div class="row">
        <div class="col-lg-8">

          <div>
            <h3 class="font-weight-bold">Informasi Terbaru</h3>
            <hr style="border-bottom: solid 2px #044215">
          </div>

          <div class="row portfolio-  container">
            <?php foreach ($post as $p) : ?>
              <div class="col-lg-6 col-md-6 portfolio-item filter-app">
                <a href="<?= base_url('article/') . $p['id_post'] ?>">
                  <div class="portfolio-wrap border border-dark wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                    <figure>
                      <?php if ($p['thumbnail'] != NULL) : ?>
                        <img src="<?= base_url('assets/img/thumbnails/') . $p['thumbnail'] ?>" class="img-fluid" alt="">
                      <?php else : ?>
                        <img src="<?= base_url('assets/img/nophoto.png') ?>" class="img-fluid" alt="">
                      <?php endif; ?>
                    </figure>
                    <div class="portfolio-info bg-white">
                      <h4 class="text-dark"><?= substr($p['title'], 0, 25) ?></h4>
                      <p><?= substr($p['description'], 0, 25) ?>....</p>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>


          <div>
            <h3 class="font-weight-bold">Publikasi terbaru</h3>
            <hr style="border-bottom: solid 2px #044215">
          </div>

          <div class="row portfolio-  container">
            <?php foreach ($download as $d) : ?>
              <div class="col-lg-6 col-md-6 portfolio-item filter-app">
                <a href="<?= base_url('page/download_proses/') . $d['id_download'] ?>">
                  <div class="portfolio-wrap border border-dark wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
                    <figure>
                      <?php if ($d['thumbnail'] != NULL) : ?>
                        <img src="<?= base_url('assets/img/thumbnails2/') . $d['thumbnail'] ?>" class="img-fluid" alt="">
                      <?php else : ?>
                        <img src="<?= base_url('assets/img/nophoto.png') ?>" class="img-fluid" alt="">
                      <?php endif; ?>
                    </figure>
                    <div class="portfolio-info bg-white">
                      <h4 class="text-dark"><?= substr($d['nama_file'], 0, 25) ?></h4>
                      <p><?= substr($d['deskripsi_file'], 0, 25) ?>....</p>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>


        </div>

        <div class="col-lg-4">

          <div>
            <h3 class="font-weight-bold">Pengumuman</h3>
            <hr style="border-bottom: solid 2px #044215">
          </div>

          <div class="list-group">
            <?php foreach ($announcement as $an) : ?>
              <a href="<?= base_url('announcement/') . $an['id_announcement'] ?>" class="list-group-item list-group-item-action border mb-2 border-dark mb-3" data-toggle="tooltip" data-placement="top" title="<?= $an['title'] ?>" data-wow-delay="0.8s" data-wow-duration="1s">
                <div class="d-flex w-100">
                  <h5 class="mb-2 font-weight-bold text-truncate"><?= $an['title'] ?></h5>
                </div>
                <small><i class="bx bx-user mr-1"></i><?= $an['name'] ?> | <i class="bx bx-calendar mr-1"></i><?= $an['date_created_formated'] ?></small>
              </a>
            <?php endforeach; ?>
          </div>
          <div class="row">
            <div class="col-12">
              <a href="<?= base_url('announcement') ?>" class="btn btn-secondary w-100">Lihat semua pengumuman</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Information Section -->

  <!-- ======= Videos Section =======
  <section id="videos" class="videos section-bg py-5 bg-theme">
    <div class="container pb-5">

      <div class="section-title">
        <h2 class="text-white">Video Channels</h2>
      </div>

      <div class="row">
        <div class="col-lg-8 mb-3">
          <div class="embed-responsive embed-responsive-16by9 wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/bRA51AmL1FU?rel=0" allowfullscreen></iframe>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-12 mb-3">
              <div class="embed-responsive embed-responsive-16by9 wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="1s">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/lA4C-tntQ8U?rel=0" allowfullscreen></iframe>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="embed-responsive embed-responsive-16by9 wow fadeInRight" data-wow-delay="0.8s" data-wow-duration="1s">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/cyUwtnIIkcw?rel=0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section> -->
  <!-- End Videos Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact section-bg py-4">
    <div class="container">

      <div class="section-title">
        <h2>Contact</h2>
      </div>

      <div class="row justify-content-center">

        <div class="col-lg-10">

          <div class="info-wrap bg">
            <div class="row">
              <div class="col-lg-4 info wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1s">
                <i class="icofont-google-map"></i>
                <h4>Lokasi :</h4>
                <p class="text-dark">Jl. Kidal No.6, Pacar Keling, Kec. Tambaksari, Kota SBY, Jawa Timur 60131</p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0 wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1s">
                <i class="icofont-envelope"></i>
                <h4>Email :</h4>
                <p><a href="mailto:lbhsurabayaonline@gmail.com" class="text-dark">lbhsurabayaonline@gmail.com</a></p>
              </div>

              <div class="col-lg-4 info mt-4 mt-lg-0 wow fadeInUp" data-wow-delay="0.5s" data-wow-duration="1s">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p class="text-dark">(031) 502 2273</p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>
  <!-- End Contact Section -->

  <!-- ======= Maps Section ======= -->
  <section id="maps" class="maps section-bg py-4 pb-5">
    <div class="container">

      <div class="section-title">
        <h2>Maps</h2>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1978.8989573613642!2d112.75483946796639!3d-7.263824899274877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f97c3389b175%3A0x435452c50ba12895!2sLegal%20Aid%20Institute%20(LBH)%20Surabaya!5e0!3m2!1sen!2sid!4v1626342689357!5m2!1sen!2sid" frameborder="0" style="width: 100%; height: 500px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" class="wow fadeInUp" data-wow-delay="0.3s" data-wow-duration="1s"></iframe>
        </div>
      </div>
  </section><!-- End Maps Section -->

</main>
<!-- End #main -->

<?php if ($infoTerkini != NULL) : ?>
  <!-- Modal -->
  <div class="modal fade" id="infoTerkini" tabindex="-1" role="dialog" aria-labelledby="infoTerkiniLabel" aria-hidden="true" style="z-index: 10000;">
    <div class="modal-dialog modal-lg modal-dialog-centered animated zoomIn" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="infoTerkiniLabel"><?= $infoTerkini['title'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container" style="max-width: 100%; overflow-y: hidden;">
            <?= $infoTerkini['content'] ?>
          </div>
        </div>
        <div class="modal-footer">
          <p><i class="fa fa-user mr-2"></i> <?= $infoTerkini['name'] ?> | <i class="fa fa-calendar mr-2"></i> <?= $infoTerkini['date_created_formated'] ?></p>
        </div>
      </div>
    </div>
  </div>

  <script type='text/javascript'>
    $(document).ready(function() {
      setTimeout(() => {
        $('#infoTerkini').modal();
      }, 3000);
    });
  </script>
<?php endif; ?>