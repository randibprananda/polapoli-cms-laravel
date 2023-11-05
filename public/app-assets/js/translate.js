function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        layout: google.translate.TranslateElement.FloatPosition.TOP_LEFT
    }, 'google_translate_element');
}
$('.lang-select').click(function () {
    var lang = jQuery(this).attr('data-lang');
    $('.goog-te-combo').val(lang);
    jQuery("html").attr("lang", lang);
    localStorage.setItem("lang", lang);
    window.location = $(this).attr('href');
    location.reload();
});

$(document).ready(function () {
    var lang = localStorage.getItem("lang")
    changeLang(lang);
});


function changeLang(value) {
    if (value == "en" || value == null) {
        document.documentElement.setAttribute("dir", "ltr");
        document.documentElement.setAttribute("lang", "en");
        owlcarousel();
        $('#lang-now i').removeClass("flag-id flag-ar");
        $('#lang-now i').addClass("flag-en");
        $('#lang-now span').text("EN");
    } else if (value == "id") {
        document.documentElement.setAttribute("dir", "ltr");
        document.documentElement.setAttribute("lang", "id");
        $('.nav-home').text('Beranda');
        owlcarousel();
        $('#lang-now i').removeClass("flag-en flag-ar");
        $('#lang-now i').addClass("flag-id");
        localStorage.setItem("lang", "id");
        $('#lang-now span').text("IDN");
        
    } else if (value == "ar") {
        document.documentElement.setAttribute("dir", "rtl");
        document.documentElement.setAttribute("lang", "ar");
        $('.nav-home').text('الصفحة الرئيسية');
        owlcarouselrtl();
        $('#lang-now i').removeClass("flag-en flag-id");
        $('#lang-now i').addClass("flag-ar");
        $('#lang-now span').text("عربى");
    } else {
        console.log("Error Change Language")
    }
}

function owlcarousel() {
    $('.owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
            items : $carousel.data("items"),
            slideBy : $carousel.data("slideby"),
            center : $carousel.data("center"),
            loop : true,
            margin : $carousel.data("margin"),
            dots : $carousel.data("dots"),
            nav : $carousel.data("nav"),      
            autoplay : $carousel.data("autoplay"),
            autoplayTimeout : $carousel.data("autoplay-timeout"),
            navText : [ '<span class="la la-angle-left"><span>', '<span class="la la-angle-right"></span>' ],
            responsive: {
            0:{items: $carousel.data('xs-items') ? $carousel.data('xs-items') : 1},
            576:{items: $carousel.data('sm-items')},
            768:{items: $carousel.data('md-items')},
            1024:{items: $carousel.data('lg-items')},
            1200:{items: $carousel.data("items")}
            },
        });
    });
};

function owlcarouselrtl() {
    $('.owl-carousel').each( function() {
        var $carousel = $(this);
        $carousel.owlCarousel({
            items : $carousel.data("items"),
            slideBy : $carousel.data("slideby"),
            center : $carousel.data("center"),
            loop : true,
            rtl : true,
            margin : $carousel.data("margin"),
            dots : $carousel.data("dots"),
            nav : $carousel.data("nav"),      
            autoplay : $carousel.data("autoplay"),
            autoplayTimeout : $carousel.data("autoplay-timeout"),
            navText : [ '<span class="la la-angle-left"><span>', '<span class="la la-angle-right"></span>' ],
            responsive: {
            0:{items: $carousel.data('xs-items') ? $carousel.data('xs-items') : 1},
            576:{items: $carousel.data('sm-items')},
            768:{items: $carousel.data('md-items')},
            1024:{items: $carousel.data('lg-items')},
            1200:{items: $carousel.data("items")}
            },
        });
    });
};