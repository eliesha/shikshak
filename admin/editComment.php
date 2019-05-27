<?php 

require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'comments.php';

$comments = new Comments;

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
          if($action != substr(md5("edit_comment-".$id.$session->getSessionByKey('session_token')), 3, 15)){
              $_SESSION['error'] = "Token mismatch.";
              @header('location: comments');
              exit;
          }
        
          $comment_info = $comments->getCommentById($id);
          
          if(!$comment_info){
              $_SESSION['error'] = "Comment not found.";
              @header('location: comments');
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
                    <h2>प्रतिक्रिया <?php echo $act;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/comments.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>प्रतिक्रिया :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control summernote" rows="5" name="comment" id="summernote" placeholder="Enter your main content" style="resize: none"><?php echo @$comment_info[0]->comment;?></textarea>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>स्थिति :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <select name="status" class="form-control" id="status">
                            <option disabled selected hidden>--कुनै एक छार्नुहोस्--</option>
                            <option value="Active" <?php echo (isset($comment_info[0]->status) && $comment_info[0]->status == "Active") ? "selected" : '' ?>>एक्टटि</option>
                            <option value="Inactive" <?php echo (isset($comment_info[0]->status) && $comment_info[0]->status == "Inactive") ? "selected" : '' ?>>इनएक्टटि</option>
                           </select>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label></label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="hidden" name="id" value="<?php echo isset($comment_info[0]->id) ? $comment_info[0]->id : ''; ?>">
                           <button class="btn btn-danger" type="reset"><i class="fas fa-trash"></i> रद्द गर्नुहोस्</button>
                           <button class="btn btn-success" type="submit"><i class="fas fa-paper-plane"></i> प्रतिक्रिया <?php echo $act;?></button>
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

