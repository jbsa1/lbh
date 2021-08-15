<!-- ======= Footer ======= -->
<footer id="footer" class="bg-theme">

    <div class="container py-4">
        <div class="text-center text-black pt-2">
            &copy; Copyright <strong><span>LBH Surabaya</span></strong>. All Rights Reserved
        </div>
        <div class="text-center text-black pt-2">
            created by <a href="https://www.instagram.com/develops.it/" target="_blank"><strong><span>Develops.it</span></strong></a>.
        </div>

</footer><!-- End Footer -->

<a href="" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->

<script src="<?= base_url('assets/theme/admin/') ?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/theme/admin/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>assets/theme/front/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= base_url() ?>assets/theme/front/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url() ?>assets/theme/front/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= base_url() ?>assets/theme/front/vendor/counterup/counterup.min.js"></script>
<script src="<?= base_url() ?>assets/theme/front/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>assets/theme/front/vendor/venobox/venobox.min.js"></script>
<script src="<?= base_url() ?>assets/theme/front/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/theme/plugins/wowjs/wow.js"></script>

<script>
    // Init wowjs
    new WOW().init();

    // Bootstrap INIT
    $(function() {
        $('.dropdown-toggle').dropdown();
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Loader
    if ($('.div-loader').length > 0) {
        $(document).ready(function() {
            $('.div-loader').delay(800).fadeOut('fast');
        });
    }

    /* SEARCH */
    $('#back-search').hide();
    $('#search').focus(function() {
        $('body').addClass('no-scroll');
        $('.fast-menu').addClass('search-dialog');
        $('#back-search').fadeIn('fast');
    });
    $('#back-search').click(function() {
        $('body').removeClass('no-scroll');
        $('.fast-menu').removeClass('search-dialog');
        $('#back-search').hide();
        $('#search-result').html('');
        $('#search').val('');
    });
    $('#search').keyup(function(e) {
        if ($(this).val() != '') {
            $('#search-result').html(`
                    <div class="col-12 mt-4">
                        <div class="alert bg-theme text-white text-center font-weight-bold" role="alert">
                            Memuat...
                        </div>
                    </div>
                `);
            $.get('<?= base_url('post/cari_post/') ?>' + $(this).val(), function(data) {
                $('#search-result').html('');
                if (data.length > 0) {
                    for (let i = 0; i < data.length; i++) {
                        const item = data[i];
                        console.log(item);
                        $('#search-result').append(`
                            <div class="col-lg-4 col-md-6 mt-4 portfolio-item filter-app">
                                <a href="<?= base_url('article/') ?>${item.id_post}">
                                    <div class="portfolio-wrap animated fadeInUp">
                                        <figure>
                                            <img src="${
                                                (item.thumbnail != null) ? "<?= base_url('assets/img/thumbnails/') ?>"+item.thumbnail : "<?= base_url('assets/img/nophoto.png') ?>"
                                            }" class="img-fluid" alt="thumbnails">
                                        </figure>
                                        <div class="portfolio-info bg-warning">
                                            <h4 class="text-dark">${item.title.substring(0, 25)}</h4>
                                            <p>${item.description.substring(0, 25)}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `);
                    }
                } else {
                    $('#search-result').html(`
                        <div class="col-12 mt-4">
                            <div class="alert bg-theme text-white text-center font-weight-bold" role="alert">
                                Tidak ada hasil
                            </div>
                        </div>
                    `);
                }
            });
        } else {
            $('#search-result').html('');
        }
    });

    $('.dataTable').dataTable({
        info: false
    });
</script>

<!-- Template Main JS File -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Zabdcnf7ANQmM5pB"></script>
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
<script src="<?= base_url() ?>assets/theme/front/js/main.js"></script>

</body>

</html>