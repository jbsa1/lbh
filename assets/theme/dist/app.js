/* 
==================================================================
BOOTSTRAP ENABLE FEATURE
==================================================================
*/
$(function() {
    $('.dropdown-toggle').dropdown();
    $('[data-toggle="tooltip"]').tooltip();
});


/* 
==================================================================
FRONT PAGE CONFIG
==================================================================
*/
if ($('#front').length != 0) {
    /* WOW JS */
    new WOW().init();

    /* CAROUSEL PROSES */
    $('.proses-carousel').flickity({
        cellAlign: 'left',
        contain: true,
        pageDots: false,
        autoPlay: 2500
    });

    /* PARALLAX */
    $('#scroll-btn').hide();
    $(window).scroll(function() {
        var winScroll = $(window).scrollTop();
        $('.banner').css({
            'background-position': 'center ' + winScroll / 2 + 'px'
        });
        if (winScroll >= 300) {
            $('#scroll-btn').fadeIn('fast');
        } else {
            $('#scroll-btn').fadeOut('fast');
        }
    });

    /* SCROLLSPY */
    $('.scrollspy .nav-link').click(function(e) {
        e.preventDefault();
        var target = $(this).attr('href');
        var scrollTop = $(target).offset().top;
        if (target != '#home') {
            scrollTop = scrollTop - 100;
        }
        $('html').animate({
            scrollTop: scrollTop
        }, 900, 'easeInOutExpo');
    });

    /* ON SCROLL */
    $(window).scroll(function() {
        var current = $(window).scrollTop() + 110;
        if (current >= $('#aboutus').offset().top & current < $('#proses').offset().top) {
            $('.scrollspy .nav-link').removeClass('active');
            $('[href="#aboutus"]').addClass('active');
        } else if (current >= $('#proses').offset().top & current < $('#kontak').offset().top) {
            $('.scrollspy .nav-link').removeClass('active');
            $('[href="#proses"]').addClass('active');
        } else if (current >= $('#kontak').offset().top) {
            $('.scrollspy .nav-link').removeClass('active');
            $('[href="#kontak"]').addClass('active');
        } else if (current < $('#aboutus').offset().top) {
            $('.scrollspy .nav-link').removeClass('active');
            $('[href="#banner"]').addClass('active');
        }
    });
}



/* 
==================================================================
CONFIG SIDENAV
==================================================================
*/
if ($('#sidenav').length > 0) {
    var ua = navigator.userAgent.toLowerCase();
    var isSafari = ua.indexOf('safari') > 0 && ua.indexOf('chrome') < 0;
    var isMobileSafari = isSafari && ua.indexOf('mobile') > 0;
    $('#sidenav').drawer({
        range: isMobileSafari ? [35, 30] : [0, 30],
        threshold: isSafari ? 0 : 10,
    }).on('transitioned.hy.drawer', function(e) {
        // console.log('Sidenav Status : ', e.detail);
    });
    // sidenav trigger 
    $('.sidenavTrigger').click(function(e) {
        e.preventDefault();
        $('#sidenav').drawer('toggle');
    });
}



/* 
==================================================================
INPUTMASK
==================================================================
*/
Inputmask.extendAliases({
    rupiah: {
        prefix: '',
        groupSeparator: ',',
        alias: 'numeric',
        placeholder: '',
        autoGroup: !0,
        digits: 0,
        digitsOptional: !1,
        clearMaskOnLostFocus: !1
    }
})
$('[data-mask="currency"]').inputmask({
    alias: 'rupiah'
});

$('[data-mask="phone"]').inputmask({
    mask: '+62999999999999',
    placeholder: ''
});

$('[data-mask="rekening"]').inputmask({
    mask: '999999999999999999999999999999',
    placeholder: ''
});



/* 
==================================================================
DATATABLE
==================================================================
*/
$('.dataTable').dataTable();



/* 
==================================================================
SELECT 2
==================================================================
*/

//Initialize Select2 Elements
$('.select2').select2();
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});



/* 
==================================================================
LIGHTBOX
==================================================================
*/
$(document).on("click", '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});



/*
==================================================================
SWEETALERT
==================================================================
*/

// Delete button
$('.delete').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Anda yakin ?',
        text: "Data akan dihapus permanen ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

// Reset password
$('.resetPass').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Reset Password ?',
        text: "Password user akan direset ke default",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});

// Logout button
$('.logout').click(function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Anda yakin ?',
        text: "Anda akan keluar dari sesi login saat ini",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            document.location.href = $(this).attr('href');
        }
    })
});