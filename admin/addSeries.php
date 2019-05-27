<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'series.php';
$series = new Series;
$act = "थप्नुहोस् ";

?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';
         
        ?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>अंक <?php echo $act ?></h2> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php 
                      if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
                      $id = (int)$_GET['id'];
                      $action = $_GET['act'];
                      if($action != substr(md5("edit_ad-".$id.$session->getSessionByKey('session_token')), 3, 15)){
                      $_SESSION['error'] = "Token mismatch.";
                      @header('location: ads');
                      exit;
                      }

                      $series_info = $series->getSeriesById($id);

                      if(!$series_info){
                      $_SESSION['error'] = "Ad not found.";
                      @header('location: ads');
                      exit;
                      }
                      $act = "अद्यावधिक";
                      }
                    ?>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/series.php" method="post" enctype="multipart/form-data">
                      
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>मिति :</label> 
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <input type="text" name="month" placeholder="मासिक अंक प्रविष्ट गर्नुहोस्" class="date form-control"">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>मासिक अंक :</label> 
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <input type="text" name="month" placeholder="मासिक अंक प्रविष्ट गर्नुहोस्" class="form-control" value="<?php echo @$series_info[0]->month ?>">
                        </div>
                      </div>

                      <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>विशेष चित्र:</label>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12">
                           <input type="file" accept="image/*" name="image" id="image">
                          </div>
                          <?php 

                          if ($act == 'अद्यावधिक') {
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-12" style="float: right">
                            <?php 
                            $image = basename(@$series_info[0]->image);
                              if (isset($series_info[0]->image) && file_exists(UPLOAD_DIR.'series/'.$image)) {
                                $thumbnail = UPLOAD_URL.'series/'.$image;
                              } else {
                                $thumbnail = FRONT_IMAGES_URL.'noImage.png';
                              }
                            ?>
                           <img src="<?php echo $thumbnail ?>" alt="image" style="width: 200px;"> <br>
                           <input type="checkbox" name="del_image" value="<?php echo $thumbnail ?>"> अघिल्लो तस्वीर मेटाउनुहोस् 
                          </div>
                            <?php
                          } else {
                            echo "";
                          }

                           ?>
                        </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input type="hidden" name="series_id" value="<?php echo isset($series_info[0]->id) ? $series_info[0]->id : ''; ?>">
						              <button class="btn btn-danger" type="reset"><i class="fas fa-trash"></i> रद्द गर्नुहोस्</button>
                          <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> अंक <?php echo $act ?></button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- /page content -->
<?php require 'inc/footer.php';?>
<script type="text/javascript">
  $('#is_parent').on('change', function(){
  var is_parent = $('#is_parent').prop('checked');
    if (is_parent) {
        $('#cat_div').addClass('hidden');
    } else {
        $('#cat_div').removeClass('hidden');
  }
 })
</script>

