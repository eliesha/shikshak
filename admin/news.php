<?php 
require '../config/init.php';

require 'inc/header.php';

require CLASS_PATH.'category.php';

$category = new Category();
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
                    <h2>समाचार सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>S.N</th>
                          <th>Title</th>
                          <th>News Category</th>
                          <th>Author</th>
                          <th>Added date</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php 
                            if ($_SESSION['roles'] == 'Admin') {
                                
                                $allNews = $news->getAllNews();
                                
                                  if ($allNews) {
                                    foreach ($allNews as $key => $newsList) {
                                      $allcategory = $category->getAllCategory();
                                      $writer = $postWriter->getAuthorById($newsList->id);
                                      ?>
                                      <tr>
                                          <td><?php echo $key+1 ;?></td>
                                          <?php 
                                              $edit = substr(md5("edit_news-".$newsList->id.$session->getSessionByKey('session_token')), 3, 15);
                                            ?>
                                          <td><a href="addNews?id=<?php echo $newsList->id ?>&amp;act=<?php echo $edit;?>"><?php echo $newsList->title;?></a></td>
                                          <td>
                                            <?php 
                                            if ($allcategory) {
                                              
                                              foreach ($allcategory as $categories) {
                                                ?>
                                                <?php echo ($newsList->news_category == $categories->title) ? $categories->title : ''?>
                                                <?php
                                              }
                                            }
                                             ?>
                                          </td>
                                          <td>
                                            <ul>
                                                <?php
                                                foreach($writer as $writerList){
                                                   ?>
                                                   <li><?php echo $writerList->author ?></li>
                                                   <?php
                                                }
                                                ?>
                                            </ul>
                                          </td>
                                          <td><?php echo $newsList->added_date;?></td>
                                          <td>
                                            <?php 
                                              $delete = substr(md5("delete_news-".$newsList->id.$session->getSessionByKey('session_token')), 3, 15);
                                             ?>
                                              <a href="process/news?id=<?php echo $newsList->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('Are you sure you want to delete this news?')">Delete</a></td>
                                      </tr>
                                      <?php
                                    }
                                  }
                                  } else {
                                    $allNews = $news->getNewsByUserId($_SESSION['user_id']);
                                    if ($allNews) {
                                    foreach ($allNews as $key => $newsList) {
                                      
                                      $allcategory = $category->getAllCategory();
                                      ?>
                                      <tr>
                                          <td><?php echo $key+1 ;?></td>
                                          <?php 
                                              $edit = substr(md5("edit_news-".$newsList->id.$session->getSessionByKey('session_token')), 3, 15);
                                            ?>
                                          <td><a href="addNews?id=<?php echo $newsList->id ?>&amp;act=<?php echo $edit;?>"><?php echo $newsList->title;?></a></td>
                                          <td>
                                            <?php 
                                            if ($allcategory) {
                                              foreach ($allcategory as $categories) {
                                                
                                                ?>
                                                <?php echo ($newsList->news_category == $categories->title) ? $categories->title : ''?>
                                                <?php
                                              }
                                            }
                                             ?>
                                          </td>
                                          <td><?php echo $newsList->added_date;?></td>
                                          <td>
                                            <?php 
                                              $delete = substr(md5("delete_news-".$newsList->id.$session->getSessionByKey('session_token')), 3, 15);
                                             ?>
                                              <a href="process/news?id=<?php echo $newsList->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('Are you sure you want to delete this news?')">Delete</a></td>
                                      </tr>
                                      <?php
                                    }
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