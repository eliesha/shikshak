<?php 
require '../config/init.php';
require 'inc/header.php';

require CLASS_PATH.'profile.php';

$profiles = new Profile();

$act = "थप्नुहोस";

?>

<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php 
          if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
          $id = (int)$_GET['id'];
          $action = $_GET['act'];
          
         
          if($action != substr(md5("edit_profile-".$id.$session->getSessionByKey('session_token')), 3, 15)){
              $_SESSION['error'] = "Token mismatch.";
              @header('location: profile');
              exit;
          }
          
          
          $profile_info = $profiles->getProfileById($id);
          if(!$profile_info){
              $_SESSION['error'] = "Profile not found.";
              @header('location: profile');
              exit;
          }
          $act = "अद्यावधिक गर्नुहोस्";
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
                    <h2>प्रोफाइल <?php echo $act ;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/profile" method="post" enctype="multipart/form-data">
                      
                        <div class="form-group" style="padding-left: 440px;">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>मिति:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <input type="text" class="bod-picker date" name="added_date" value="<?php echo @$profile_info[0]->added_date ?>" min="" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>नाम :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <input type="text" name="title" class="form-control" placeholder="शैक्षिक संसारमा ज्ञात व्यक्तिको नाम प्रविष्ट गर्नुहोस्" value="<?php echo @$profile_info[0]->title ?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>सारांश: <em>(एक लाइनमा समाचार संक्षेप गर्नुहोस्)</em></label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control" rows="2" name="summary" id="summary" placeholder="प्रोफाइल  शीर्षक प्रविष्ट गर्नुहोस्" style="resize: none"><?php echo @$profile_info[0]->summary ?></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>कथा:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control summernote" rows="5" name="story" id="summernote" placeholder="Enter your main content" style="resize: none"><?php echo @$profile_info[0]->story ?></textarea>
                          </div>
                        </div>          
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>थपकर्ता :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <select class="form-control" name="added_by">
                              <option disabled selected hidden>--कुनै एक छान्नुहोस--</option>
                                <?php 
                                  if ($_SESSION['roles'] == 'Admin') {
                                    $userlist = $user->getAllUserList();
                                      if ($userlist) {
                                        foreach ($userlist as $userList) {
                                ?>
                                          <option value="<?php echo $userList->id ?>"><?php echo $userList->full_name ?></option>
                                      <?php
                                    }
                                  }
                              } else {
                                ?>
                                  <option selected value="<?php echo $_SESSION['user_id'] ?>"><?php echo $_SESSION['full_name'] ?></option>
                                <?php
                              }
                             ?>
                             </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>स्थिति:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <select name="status" class="form-control" id="status">
                           	<option selected disabled hidden>-- कुनै एक छान्नुहोस --</option>
                           	<option value="सक्रिय" <?php echo (isset($profile_info[0]->status) && $profile_info[0]->status == "सक्रिय") ? "selected" : '' ?>>सक्रिय</option>
                           	<option value="निष्क्रिय" <?php echo (isset($profile_info[0]->status) && $profile_info[0]->status == "निष्क्रिय") ? "selected" : '' ?>>निष्क्रिय</option>
                           </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>विशेष चित्र :</label>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12">
                           <input type="file" accept="image/*" name="image" id="image">
                          </div>
                          <?php 

                          if ($act == 'अद्यावधिक गर्नुहोस्') {
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-12" style="float: right">
                            <?php 
                            $image = basename(@$profile_info[0]->image);
                              if (isset($profile_info[0]->image) && file_exists(UPLOAD_DIR.'profile/'.$image)) {
                                $thumbnail = UPLOAD_URL.'profile/'.$image;
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

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label></label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                          	<input type="hidden" name="profile_id" value="<?php echo isset($profile_info[0]->id) ? $profile_info[0]->id : ''; ?>">
                           <button class="btn btn-danger" type="reset"><i class="fas fa-trash"></i> रद्द गर्नुहोस्</button>
                           <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> <?php echo "प्रोफाइल"." ".$act ;?></button>
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