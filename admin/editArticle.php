<?php 
require '../config/init.php';
require 'inc/header.php';

?>
<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php 
          if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
          $id = (int)$_GET['id'];
          $action = $_GET['act'];
          if($action != substr(md5("edit_article-".$id.$session->getSessionByKey('session_token')), 3, 15)){
              $_SESSION['error'] = "Token mismatch.";
              @header('location: articles');
              exit;
          }

          $article_info = $article->getArticleById($id);
          //debugger($article_info, true);
          if(!$article_info){
              $_SESSION['error'] = "Article not found.";
              @header('location: articles');
              exit;
          }
          $act = "update";
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
                    <h2>लेख सम्पादन गर्नुहोस्</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/article" method="post" enctype="multipart/form-data">
                        <?php //debugger($article_info, true) ?>
                        <div class="form-group" style="padding-left: 440px;">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>मिति:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <input type="text" class="bod-picker" name="date" value="<?php echo @$article_info[0]->added_date ?>" min="" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>Title:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <input type="text" name="title" class="form-control" placeholder="Enter news title" value="<?php echo @$article_info[0]->title;?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>Summary:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control" rows="5" name="summary" id="summary" placeholder="Enter short description" style="resize: none"><?php echo @$article_info[0]->summary;?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>Story:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control" rows="5" name="story" id="story" placeholder="Enter your main content" style="resize: none"><?php echo @$article_info[0]->story;?></textarea>
                          </div>
                        </div> 
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>Status:</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <select name="status" class="form-control" id="status">
                           	<option selected disabled>--कुनै एक छार्नुहोस्--</option>
                           	<option value="स्वीकृत" <?php echo (isset($article_info[0]->status) && $article_info[0]->status == "स्वीकृत") ? "selected" : '' ?>>स्वीकृत</option>
                           	<option value="अस्वीकृत" <?php echo (isset($article_info[0]->status) && $article_info[0]->status == "अस्वीकृत") ? "selected" : '' ?>>अस्वीकृत</option>
                           </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>Image:</label>
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12">
                           <input type="file" accept="image/*" name="image" id="image">
                          </div>
                          <div class="col-lg-4 col-md-4 col-sm-12" style="float: right">
                            <?php 
                            $image = basename(@$article_info[0]->image);
                              if (isset($article_info[0]->image) && file_exists(UPLOAD_DIR.'news/'.$image)) {
                                $thumbnail = UPLOAD_URL.'news/'.$image;
                              } else {
                                $thumbnail = FRONT_IMAGES_URL.'noImage.png';
                              }
                            ?>
                           <img src="<?php echo $thumbnail ?>" alt="image" style="width: 200px;"> <br>
                           <input type="checkbox" name="del_image"> Delete 
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label></label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                          	<input type="hidden" name="article_id" value="<?php echo isset($article_info[0]->id) ? $article_info[0]->id : ''; ?>">
                           <button class="btn btn-danger" type="reset">रद्द गर्नुहोस्</button>
                           <button class="btn btn-success" type="submit">लेख सम्पादन गर्नुहोस्</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
          $('#is_parent').on('change', function(){
            var is_parent = $('#is_parent').prop('checked');
            if (is_parent) {
              $('#parent_id').removeClass('hidden');
            } else {
              $('#parent_id').addClass('hidden');
            }
          })
        </script>
        <!-- /page content -->
<?php require 'inc/footer.php';?>