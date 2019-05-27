<?php 
require '../config/init.php';
require 'inc/header.php';

require CLASS_PATH.'janamat.php';
$janamat = new Janamat;

$act = "थपनुहोस";



?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <!-- page content -->
        <?php 
          if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
          $id = (int)$_GET['id'];
          $action = $_GET['act'];
          if($action != substr(md5("edit_janamat-".$id.$session->getSessionByKey('session_token')), 3, 15)){ 
            
            redirect('janamat', 'error', 'टोकन बेमेल।');
          
          }

          $janamat_info = $janamat->getJanamatById($id);
          
          if(!$janamat_info){
            
            redirect('janamat', 'error', 'जनमत फेला परेन।');
          
          }
          
          $act = "अद्यावधिक गर्नुहोस्";
      }
         ?>
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><?php echo 'प्रश्न'. ' '. $act;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="process/janamat" method="post">
                      <div class="date" style="padding-left: 510px;">
                            <label for="date">मिति:</label>
                            <input type="text" class="bod-picker date" name="date" value="<?php echo @$janamat_info[0]->added_date ?>" min="" required>
                            </time></p>
                        </div>
                        <div class="form-group ">
                            <label for="प्रश्न शीर्षक">प्रश्न शीर्षक</label>
                            <input type="text" name="title" placeholder="प्रश्न शीर्षक प्रविष्ट" class="form-control" value="<?php echo @$janamat_info[0]->title ?>">
                        </div>
                        <div class="form-group">
                            <label for="प्रश्न शीर्षक">स्थिति</label>
                            <select class="form-control">
                              <option selected disabled hidden>--कुनै एक छान्नुहोस--</option>
                              <option value="सक्रिय" <?php echo (isset($janamat_info[0]->status) && $news_info[0]->status == "सक्रिय") ? "selected" : '' ?>>सक्रिय</option>
                              <option value="निष्क्रिय" <?php echo (isset($janamat_info[0]->status) && $news_info[0]->status == "निष्क्रिय") ? "selected" : '' ?>>निष्क्रिय</option>
                            </select>
                        </div>
                        <div class="form-group my-4 mx-4 text-right">
                            <label for="content"></label>
                            <input type="hidden" name="janamat_id" value="<?php echo isset($janamat_info[0]->id) ? $janamat_info[0]->id : ''; ?>">
                            <button class="btn btn-success"><i class="fas fa-paper-plane"></i> <?php echo 'प्रश्न'. ' '. $act;?></button>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i> मेटाउनुहोस्</button>
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