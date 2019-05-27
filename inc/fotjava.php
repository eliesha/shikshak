<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script>
    if (typeof jQuery == 'undefined') {
        document.write(unescape("%3Cscript src='<?php echo FRONT_JS_URL ?>jquery-3.3.1.min.js' type='text/javascript'%3E%3C/script%3E"));
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>

<script>
    if (typeof (Popper) === 'undefined') {
        document.write('<script src="<?php echo FRONT_JS_URL ?>popper.min.js"><\/script>')
    }
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

<script>
    if (typeof ($.fn.modal) === 'undefined') {
        document.write('<script src="<?php echo FRONT_JS_URL ?>bootstrap.min.js"><\/script>')
    }
</script>
<script src="<?php echo FRONT_JS_URL ?>owl.carousel.js"></script>
<!-- Bootstrap CSS local fallback -->
<div id="bootstrapCssTest" class="hidden"></div>
<script>
    $(function () {
        if ($('#bootstrapCssTest').is(':visible')) {
            $("head").prepend('<link rel="stylesheet" href="<?php echo FRONT_CSS_URL ?>bootstrap.min.css">');
        }
    });
</script>
  
    <script type="text/javascript" src="<?php echo FRONT_JS_URL ?>slick.min.js"></script>

    <script src="<?php echo FRONT_JS_URL ?>main.js"></script>
    <script type="text/javascript" src="https://unpkg.com/nepali-date-picker@2.0.0/dist/jquery.nepaliDatePicker.min.js" integrity="sha384-bBN6UZ/L0DswJczUYcUXb9lwIfAnJSGWjU3S0W5+IlyrjK0geKO+7chJ7RlOtrrF" crossorigin="anonymous"></script>
    <script>
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
    </script>
    <script>
        $(document).ready(function () {
            $('#memberModal').modal('show');
        });
        
        $('.your-class').slick({
            dots: true,
            infinite: false,
            
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 4,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 800,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
      
        //Date 
        
      var currentDate = new Date();
      var currentNepaliDate = calendarFunctions.getBsDateByAdDate(currentDate.getFullYear(), currentDate.getMonth() + 1, currentDate.getDate());
      var formatedNepaliDate = calendarFunctions.bsDateFormat("%M %d, %y", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        
      var formatedNepaliYear = calendarFunctions.bsDateFormat("%y", currentNepaliDate.bsYear, currentNepaliDate.bsMonth, currentNepaliDate.bsDate);
        
        document.getElementById('uniquedate').innerHTML = formatedNepaliDate;
        document.getElementById('currentYear').innerHTML = formatedNepaliYear;
        
    </script>