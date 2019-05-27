<?php 

require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'book.php';

$book = new Book;

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
          if($action != substr(md5("edit_book-".$id.$session->getSessionByKey('session_token')), 3, 15)){
              redirect('book', 'error', 'Token mismatch.');
          }

          $book_info = $book->getBookById($id);
          
          if(!$book_info){
              redirect('book', 'error', 'book not found.');
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
                    <h2>पुस्तक <?php echo $act;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="process/book" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>शीर्षक :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="title" id="title" placeholder="पुस्तकको शीर्षक प्रविष्ट गर्नुहोस्" value="<?php echo @$book_info[0]->title;?>">
                          </div>
                        </div>
                       
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>कथा :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <textarea class="form-control summernote" rows="5" name="story" id="summernote" placeholder="" style="resize: none"><?php echo @$book_info[0]->story;?></textarea>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>लेखक :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="writer" id="title" placeholder="पुस्तकको लेखक प्रविष्ट गर्नुहोस्" value="<?php echo @$book_info[0]->writer;?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>प्रकाशक :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="publication" id="title" placeholder="पुस्तकको प्रकाशक प्रविष्ट गर्नुहोस्" value="<?php echo @$book_info[0]->title;?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>मूल्य :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="price" id="title" placeholder="पुस्तकको मूल्य प्रविष्ट गर्नुहोस्" value="<?php echo @$book_info[0]->price;?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                           <label>लिङ्क :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                            <input type="text" class="form-control" name="link" id="link" placeholder="पुस्तक किन्नका लागि लिङ्क प्रविष्ट गर्नुहोस्" value="<?php echo @$book_info[0]->link;?>">
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
                           <label>स्थिति :</label>
                          </div>
                          <div class="col-lg-8 col-md-8 col-sm-12">
                           <select name="status" class="form-control" id="status">
                            <option disabled selected hidden>--कुनै एक छान्नुहोस--</option>
                            <option value="Active" <?php echo (isset($book_info[0]->status) && $book_info[0]->status == "Active") ? "selected" : '' ?>>एक्टटि</option>
                            <option value="Inactive" <?php echo (isset($book_info[0]->status) && $book_info[0]->status == "Inactive") ? "selected" : '' ?>>इनएक्टटि</option>
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

                          if ($act == 'अद्यावधिक गर्नुहोस') {
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-12" style="float: right">
                            <?php 
                            $image = basename(@$book_info[0]->image);
                              if (isset($book_info[0]->image) && file_exists(UPLOAD_DIR.'book/'.$image)) {
                                $thumbnail = UPLOAD_URL.'book/'.$image;
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
                            <input type="hidden" name="book_id" value="<?php echo isset($book_info[0]->id) ? $book_info[0]->id : ''; ?>">
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
</script>
