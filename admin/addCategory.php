<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'category.php';
$category = new Category;
$act = "थप्नुहोस् ";

?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';
          if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
              $id = (int)$_GET['id'];
              $action = $_GET['act'];
              if($action != substr(md5("edit_category-".$id.$session->getSessionByKey('session_token')), 3, 15)){
                  $_SESSION['error'] = "Token mismatch.";
                  @header('location: category-list');
                  exit;
              }

              $cat_info = $category->getCategoryById($id);
                
              if(!$cat_info){
                  $_SESSION['error'] = "Category not found.";
                  @header('location: category-list');
                  exit;
              }
              $act = "अद्यावधिक";
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
                    <h2>कोटि <?php echo $act ?></h2> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php //debugger($cat_info) ?>
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/category" method="post" enctype="multipart/form-data">
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>शीर्षक:</label> 
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <input type="text" name="title" placeholder="शीर्षक प्रविष्ट गर्नुहोस्" class="form-control" value="<?php echo @$cat_info[0]->title ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>विवरण:</label> 
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <textarea class="form-control" name="description" placeholder="श्रेणी को लागि विवरण थप गर्नुहोस्" rows="3" style="resize: none"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>मुख्य कोटि:</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <input type="checkbox" name="is_parent" id="is_parent" value="1" <?php echo (isset($cat_info[0]) && $cat_info[0]->is_parent == 1 ) ? 'checked' : '' ?>>
                        </div>
                      </div>
                      <?php
                        if (isset($cat_info[0]->is_parent) && $cat_info[0]->is_parent == 1) {
                          $class = 'hidden';
                        }
                      ?>
                      <div class="form-group <?php echo $class;?>" id="cat_div">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>उप कोटी:</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <select name="parent_id" class="form-control">
                            <option selected disabled hidden>--कुनै एक छान्नुहोस--</option>
                            <?php
                            $parentCategories = $category->getAllActiveParents();
                              if ($parentCategories) {
                                foreach ($parentCategories as $mainCategories) {
                                ?>
                                <option value="<?php echo @$mainCategories->id?>" <?php echo (isset($cat_info[0]) && $cat_info[0]->parent_id == $mainCategories->id) ? 'selected' : '' ?>><?php echo @$mainCategories->title;?></option>
                                <?php
                              }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>पोडकास्ट कोटी:</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <input type="checkbox" name="is_pod" id="is_pod" value="1" <?php echo (isset($cat_info[0]) && $cat_info[0]->is_pod == 1 ) ? 'checked' : '' ?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>मेनुमा देखाउनुहोस्:</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <input type="checkbox" name="show_in_menu" id="show_in_menu" value="1" <?php echo (isset($cat_info[0]) && $cat_info[0]->show_in_menu == 1 ) ? 'checked' : '' ?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>स्थिति:</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <select name="status" id="status" class="form-control">
                            <option selected disabled hidden>--कुनै एक छान्नुहोस--</option>
                            <option value="Active" <?php echo (isset($cat_info[0]->status) && $cat_info[0]->status == "Active") ? "selected" : '' ?>>एक्टटिव</option>
                            <option value="Inactive"<?php echo (isset($cat_info[0]->status) && $cat_info[0]->status == "Inactive") ? "selected" : '' ?>>इनएक्टटिव</option>
                          </select>
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
                            $image = basename(@$cat_info[0]->image);
                              if (isset($cat_info[0]->image) && file_exists(UPLOAD_DIR.'category/'.$image)) {
                                $thumbnail = UPLOAD_URL.'category/'.$image;
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
                          <input type="hidden" name="cat_id" value="<?php echo isset($cat_info[0]->id) ? $cat_info[0]->id : ''; ?>">
						              <button class="btn btn-danger" type="reset"><i class="fas fa-trash"></i> रद्द गर्नुहोस्</button>
                          <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> कोटि <?php echo $act ?></button>
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

