<?php 
require '../config/init.php';
require 'inc/header.php';

require CLASS_PATH.'comments.php';

$comments = new Comments();

?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php flash(); ?>
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
                    <h2>प्रतिक्रिया  सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>S.N</th>
                          <th>समाचार शीर्षक</th>
                          <th>प्रतिक्रिया</th>
                          <th>प्रतिक्रियागर्ने व्यक्ति</th>
                          <th>स्थिति</th>
                          <th>काम</th>
                        </thead>
                        <tbody>
                          <?php
                          
                          $allComment = $comments->getAllComments();
                         
                          if($allComment){
                              
                              foreach($allComment as $key => $list){
                                  ?>
                                  <tr>
                                      <td><?php echo $key+1 ?></td>
                                      <?php 
                                              $edit = substr(md5("edit_comment-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                            ?>
                                          <td><a href="editComment?id=<?php echo $list->id ?>&amp;act=<?php echo $edit;?>"><?php echo $list->comment_title;?></a></td>
                                      <td><?php echo $list->comment ?></td>
                                      <td><?php echo $list->commentator ?></td>
                                      <td><?php echo $list->status ?></td>
                                      <td>
                                      <?php 
                                        $delete = substr(md5("delete_comment-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                             ?>
                                              <a href="process/comments?id=<?php echo $list->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('Are you sure you want to delete this comment?')">रद्दगर्नुहोस् </a>
                                      </td>
                                  </tr>
                                  <?php
                              }
                              
                          }
                          
                          ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
<?php require 'inc/footer.php';?>