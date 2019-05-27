<?php 

    require 'inc/header.php';

?>
<div class="main container">
    <div class="row">
        <div class="col-md-9">
            <div class="slider py-4" id="archiveScroll">
                <div class="col-lg-12">
                    <h1 class="profile-des-title btm-border" style="text-decoration: underline">
                        शिक्षकका पुराना अंक 
                    </h1>
                </div>
                <div class="col-lg-12">
                    <div id="carouselExampleControls-archive" class="carousel slide" data-interval="false">
                        <div class="carousel-item active">
                                    <div id="wrap"></div>
                                </div>
                        <div id ="wrap"></div>
                        <a href="#carouselExampleControls-archive" role="button" data-slide="prev">
                        <span id="prev" class="carousel-control-prev-icon" aria-hidden="true" style="display:none"></span>
                        <span class="sr-only">Previous</span>
                        </a>
                        <a href="#carouselExampleControls-archive" role="button" data-slide="next">
                        <span id="next" class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
                <div class="row">
                    <div class="hover-effect trending-headlines">
                        <ul class="tabheader" style="list-style: none;">
                            <li style="margin-bottom: 0px">शिक्षा
                                खबर
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <ul class="trending list-group">
                                <?php 
                                    $khabar = $news->getNewsByCatId(30 ,8);
                                    if($khabar){
                                        foreach($khabar as $khabarList){
                                            $act = explode(' ', html_entity_decode($khabarList->title));
                                            $act = implode('-', $act);
                                            $categoryAct = explode(' ', html_entity_decode($khabarList->news_category));
                                            $categoryAct = implode('-', $categoryAct);
                                            ?>
                                <li class="list-group-item">
                                    <a href="/<?php echo $khabarList->id;?>/<?php echo $act ?>"><?php echo $khabarList->title ?></a>
                                </li>
                                <?php
                                    }
                                    }
                                    ?>
                            </ul>
                            <ul class="more2 titletype2" style="list-style: none">
                                <a href="/category/<?php echo $khabarList->category_id ?>/<?php echo $categoryAct ?>">
                                    <li style="margin-bottom: 0px;height: 25px">
                                        अन्य विषय
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>
<script>

    $(document).ready(function() {
        
        var year = <?php echo date('Y'); ?>;
        $.ajax({
              url: '/process/archiveFull1.php',
              type: 'POST',
              data: {
                id: year,
              },
              success: function(response){
                if (typeof(response) != 'object') {
                  response = $.parseJSON(response);
                }console.log(response);
                if (response.status.status == true) {
                  var html_option = "<div class='top-with-controls-archive text-center'><h4>"+ year +"</h4></div><div class='carousel-inner'><div class='carousel-item active'><div class='row py-2'>"
                  $.each(response.body, function(key, value) {
                    var datetimestamp = value.added_date;
                    var dateTruncated = datetimestamp.slice(0, 10);
                    var myStr = value.month;
                    var strArray = myStr.replace(/\s/gi, "-");
                    html_option += "<div class='col-md-3 col-sm-6'><div class='body-archive'><a href='/sangraha/" + dateTruncated + "/"+strArray+"'><img src='" + value.image + "' class='img-fluid'></a></div></div>";
                  });
                  html_option += "</div>";
                  $('#wrap').html(html_option);
                } 
              }
        
            });
        
        $('#next').click(function(){
            year = year-1;
            $('#prev').show();
            $.ajax({
              url: '/process/archiveFull1.php',
              type: 'POST',
              data: {
                id: year,
              },
              success: function(response){
                if (typeof(response) != 'object') {
                  response = $.parseJSON(response);
                }
                if (response.status.status == true) {
                  var html_option = "<div class='top-with-controls-archive text-center'><h4>"+ year +"</h4></div><div class='carousel-inner'><div class='carousel-item active'><div class='row py-2'>"
                  $.each(response.body, function(key, value) {
                    var datetimestamp = value.added_date;
                    var dateTruncated = datetimestamp.slice(0, 10);
                    var myStr = value.month;
                    var strArray = myStr.replace(/\s/gi, "-");
                    html_option += "<div class='col-md-3 col-sm-6'><div class='body-archive'><a href='/sangraha/" + dateTruncated + "/"+strArray+"'><img src='" + value.image + "' class='img-fluid'></a></div></div>";
                  });
                  html_option += "</div>";
                  $('#wrap').html(html_option);
                } else if(response.status.status == false){
                    $('#next').hide();
                    $('#wrap').html('<div class="container text-center" id="c404"><div class="row"><div class="col-md-6 col-sm-12 offset-md-3 c404"><h1>समाप्त</h1><h5 style="color: #DB4729"><strong>तपाईं हाम्रो सङ्ग्रहको अन्तमा आइपुग्नुभयो।</strong></h5></div></div></div>');
                }
              }
        
            });
            
        });
        
        $('#prev').click(function(){
            $('#next').show();
            year++;
            $.ajax({
              url: '/process/archiveFull1.php',
              type: 'POST',
              data: {
                id: year,
              },
              success: function(response){
                if (typeof(response) != 'object') {
                  response = $.parseJSON(response);
                }
                if (response.status.status == true) {
                  var html_option = "<div class='top-with-controls-archive text-center'><h4>"+ year +"</h4></div><div class='carousel-inner'><div class='carousel-item active'><div class='row py-2'>"
                  $.each(response.body, function(key, value) {
                    var datetimestamp = value.added_date;
                    var dateTruncated = datetimestamp.slice(0, 10);
                    var myStr = value.month;
                    var strArray = myStr.replace(/\s/gi, "-");
                    html_option += "<div class='col-md-3 col-sm-6'><div class='body-archive'><a href='/sangraha/" + dateTruncated + "/"+strArray+"'><img src='" + value.image + "' class='img-fluid'></a></div></div>";
                  });
                  html_option += "</div>";
                  $('#wrap').html(html_option);
                } else if(response.status.status == false){
                    $('#prev').hide();
                    $('#wrap').html('<div class="container text-center" id="c404"><div class="row"><div class="col-md-6 col-sm-12 offset-md-3 c404"><h1>समाप्त</h1><h5 style="color:#DB4729"><strong>माफ गर्नुहोस्! '+year+' पछिको अभिलेखालय छैन।</strong></h5></div></div></div>');
                }
              }
        
            });
            
        });
        
    });
        
</script>