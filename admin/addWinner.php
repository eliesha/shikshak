<?php 

require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'category.php';

$category = new Category;

$act = "थप्नुहोस्";

?>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php 
          if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
          $id = (int)$_GET['id'];
          $action = $_GET['act'];
          if($action != substr(md5("edit_news-".$id.$session->getSessionByKey('session_token')), 3, 15)){
              $_SESSION['error'] = "Token mismatch.";
              @header('location: news');
              exit;
          }

          $news_info = $news->getNewsById($id);
          
          if(!$news_info){
              $_SESSION['error'] = "News not found.";
              @header('location: news');
              exit;
          }
          $act = "अद्यावधिक गर्नुहोस";
      }
        
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
                    <h2>विजेता <?php echo $act;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/winner" method="post" enctype="multipart/form-data">
                       
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>पूरा नाम :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="name" id="title" placeholder="समाचार शीर्षक प्रविष्ट गर्नुहोस्" value="<?php echo @$news_info[0]->title;?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>महिना :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="month" id="title" placeholder="बिजयी भएको महिना" value="<?php echo @$news_info[0]->month;?>">
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>ठेगाना :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control summernote" rows="3" name="address" id="summernote" placeholder="Enter your main content" style="resize: none"><?php echo @$news_info[0]->story;?></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input type="hidden" name="winner_id" value="<?php echo isset($cat_info[0]->id) ? $cat_info[0]->id : ''; ?>">
						              <button class="btn btn-danger" type="reset"><i class="fas fa-trash"></i> रद्द गर्नुहोस्</button>
                          <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> विजेता <?php echo $act ?></button>
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
<script>
  $('select option')
.filter(function() {
    return !this.value || $.trim(this.value).length == 0 || $.trim(this.text).length == 0;
})
.remove();
</script>
