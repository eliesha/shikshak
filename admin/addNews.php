<?php 

require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'category.php';

$category = new Category();

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
          $authorinfo = $postWriter->getAuthorById($news_info[0]->id);
          $news_info[0]->userDetail = $authorinfo;
          $countAuthor = count($authorinfo);
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
                    <h2>समाचार <?php echo $act;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/news" method="post" enctype="multipart/form-data">
                       
                        <div class="form-group" style="padding-left: 440px;">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>मिति:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <input type="text" class="date" name="date" value="<?php echo @$news_info[0]->added_date ?>">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>शीर्षक :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="title" id="title" placeholder="समाचार शीर्षक प्रविष्ट गर्नुहोस्" value="<?php echo @$news_info[0]->title;?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>सारांश <em>(एक लाइनमा समाचार संक्षेप गर्नुहोस्)</em> :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <textarea class="form-control" rows="1" name="summary" placeholder="एक लाइनमा समाचार संक्षेप गर्नुहोसहोस्।" style="resize: none"><?php echo @$news_info[0]->summary;?></textarea>
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>कथा :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control summernote" rows="5" name="story" id="summernote" placeholder="Enter your main content" style="resize: none"><?php echo @$news_info[0]->story;?></textarea>
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <?php 
                            if ($session->getSessionByKey('roles') == 'Admin') {
                            
                            $newsCategories = $category->getNewsCategory();
                              
                            } else {

                              $newsCategories = $category_permitted->getCategoriesByUserId($session->getSessionByKey('user_id'));
                            }
                            
                          ?>
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>कोटि :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <select class="form-control" name="news_category" id="news_category">
                            <option disabled selected hidden>--कुनै एक छान्नुहोस--</option>
                            <?php
                            
                              foreach ($newsCategories as $categoryList) {
                                $class = "";
                                if ($categoryList->podcast == 1) {
                                  $class = "hidden";
                                }
                                ?>
                                <option class="<?php echo $class ?>" value="<?php echo @$categoryList->id?>" <?php echo (isset($news_info) && $news_info[0]->news_category == $categoryList->id) ? 'selected' : '' ?>><?php echo @$categoryList->title;?></option>
                                <?php
                              }
                            ?>
                            <option value="<?php echo @$newsCategories['id']?>"><?php @$newsCategories['title'] ?></option>
                           </select>
                          </div>
                        </div>
                        <?php //debugger($news_info) ;?>
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>थपकर्ता :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <select class="form-control" id="multipleSelect" name="added_by[]" multiple="multiple">
                                <?php 
                                  if ($_SESSION['roles'] == 'Admin') {
                                      for($i=0; $i<2; $i++){
                                          ?>
                                          <option value="<?php echo $news_info[0]->userDetail[$i]->user_id ?>" <?php echo (isset($news_info[0]->userDetail->user_id) == $userList->id) ? "selected" : '' ?>><?php echo $news_info[0]->userDetail[$i]->author ?></option>
                                          <?php
                                      } 
                                    
                                    $exceptUser = $user->getAllUserExceptUserId($news_info[0]->author_id);
                                    
                                      if ($exceptUser) {
                                        foreach ($exceptUser as $exceptList) {
                                ?>
                                          <option value="<?php echo $exceptList->id ?>"  ><?php echo $exceptList->full_name ?></option>
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
                           <label>स्थिति :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <select name="status" class="form-control" id="status">
                            <option disabled selected hidden>--कुनै एक छान्नुहोस--</option>
                            <option value="Active" <?php echo (isset($news_info[0]->status) && $news_info[0]->status == "Active") ? "selected" : '' ?>>एक्टटि</option>
                            <option value="Inactive" <?php echo (isset($news_info[0]->status) && $news_info[0]->status == "Inactive") ? "selected" : '' ?>>इनएक्टटि</option>
                           </select>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>संग्रह कोटि :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <select name="archieveCategory" class="form-control" id="status">
                            <option disabled selected hidden>--कुनै एक छान्नुहोस--</option>
                            <option value="magazine" <?php echo (isset($news_info[0]->archieveCategory) && $news_info[0]->archieveCategory == "magazine") ? "selected" : '' ?>>पत्रिका</option>
                            <option value="website" <?php echo (isset($news_info[0]->archieveCategory) && $news_info[0]->archieveCategory == "website") ? "selected" : '' ?>>वेबसाइट</option>
                           </select>
                          </div>
                        </div>
                
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>गृह :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <input type="checkbox" name="griha" value="1" <?php echo (isset($news_info[0]) && $news_info[0]->griha == 1 ) ? 'checked' : '' ?>>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>सूचित गर्नुहोस् :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <input type="checkbox" name="push" value="checked">
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

                          if ($act == 'अद्यावधिक गर्नुहोस') {
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-12" style="float: right">
                            <?php 
                            $image = basename(@$news_info[0]->image);
                              if (isset($news_info[0]->image) && file_exists(UPLOAD_DIR.'news/'.$image)) {
                                $thumbnail = UPLOAD_URL.'news/'.$image;
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
                            <input type="hidden" name="news_id" value="<?php echo isset($news_info[0]->id) ? $news_info[0]->id : ''; ?>">
                           <button class="btn btn-danger" type="reset"><i class="fas fa-trash"></i> रद्द गर्नुहोस्</button>
                           <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> समाचार <?php echo $act;?></button>
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

$("#multipleSelect").select2({
    placeholder: '--लेखक (हरू)  छान्नुहोस--'
});

</script>
