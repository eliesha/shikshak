// ========================================================================= //

window.ga = function () {
    ga.q.push(arguments)
};
ga.q = [];
ga.l = +new Date;
ga('create', 'UA-XXXXX-Y', 'auto');
ga('send', 'pageview')

// ========================================================================= //

$(document).ready(function () {
    // executes when HTML-Document is loaded and DOM is ready

    // breakpoint and up  
    $(window).resize(function () {
        if ($(window).width() >= 980) {

            // when you hover a toggle show its dropdown menu
            $(".navbar .dropdown-toggle").hover(function () {
                $(this).parent().toggleClass("show");
                $(this).parent().find(".dropdown-menu").toggleClass("show");
            });

            // hide the menu when the mouse leaves the dropdown
            $(".navbar .dropdown-menu").mouseleave(function () {
                $(this).removeClass("show");
            });

            // do something here
        }
    });



    // document ready  
});

// ========================================================================= //

$('.owl-one').owlCarousel({
    stagePadding: 50,
    loop: true,
    margin: 10,
    dots: false,
    nav: true,
    navText: [
        '<i class="fas fa-angle-left" aria-hidden="true"></i>',
        '<i class="fas fa-angle-right" aria-hidden="true"></i>'
    ],
    navContainer: '.owl-content .custom-nav',
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
});

// ========================================================================= //

$('.owl-two').owlCarousel({
    stagePadding: 50,
    loop: true,
    margin: 10,
    dots: false,
    nav: true,
    navText: [
        '<i class="fas fa-angle-left" aria-hidden="true"></i>',
        '<i class="fas fa-angle-right" aria-hidden="true"></i>'
    ],
    navContainer: '.owl-content2 .custom-nav',
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
});

// ========================================================================= //


$(document).ready(function () {

    var clickEvent = false;
    $('#myCarousel').carousel({
        interval: 4000
    }).on('click', '.list-group li', function () {
        clickEvent = true;
        $('.list-group li').removeClass('active');
        $(this).addClass('active');
    }).on('slid.bs.carousel', function (e) {
        if (!clickEvent) {
            var count = $('.list-group').children().length - 1;
            var current = $('.list-group li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if (count == id) {
                $('.list-group li').first().addClass('active');
            }
        }
        clickEvent = false;
    });
})

$(window).load(function () {
    var boxheight = $('#myCarousel .carousel-inner').innerHeight();
    var itemlength = $('#myCarousel .item').length;
    var triggerheight = Math.round(boxheight / itemlength + 1);
    $('#myCarousel .list-group-item').outerHeight(triggerheight);
});


// ========================================================================= //

$(document).ready(function () {

    var clickEvent = false;
    $('#myCarousel-two').carousel({
        interval: 4000
    }).on('click', '.list-group li', function () {
        clickEvent = true;
        $('.list-group li').removeClass('active');
        $(this).addClass('active');
    }).on('slid.bs.carousel', function (e) {
        if (!clickEvent) {
            var count = $('.list-group').children().length - 1;
            var current = $('.list-group li.active');
            current.removeClass('active').next().addClass('active');
            var id = parseInt(current.data('slide-to'));
            if (count == id) {
                $('.list-group li').first().addClass('active');
            }
        }
        clickEvent = false;
    });
})

$(window).load(function () {
    var boxheight = $('#myCarousel-two .carousel-inner').innerHeight();
    var itemlength = $('#myCarousel-two .item').length;
    var triggerheight = Math.round(boxheight / itemlength + 1);
    $('#myCarousel-two .list-group-item').outerHeight(triggerheight);
});




//==========================================//
 
$(document).ready(function() {
    $('.dropdown').on('click', function() {
        $('nav ul').slideToggle();
    });
});

//=============================//

