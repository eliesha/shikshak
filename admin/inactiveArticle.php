<?php 
require '../config/init.php';
require 'inc/header.php';

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
                    <h2>अस्वीकृत लेखहरुका सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>S.N</th>
                          <th>Title</th>
                          <th>Author</th>
                          <th>Added date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php 
                          
                          $article_info = $news->getActiveNewsMannKaaKura();

                          if ($article_info) {
                          
                             foreach ($article_info as $key => $articleList) {
                                 $writer = $postWriter->getAuthorById($articleList->id);
                               ?>
                               <tr>
                                 <td><?php echo $key+1 ?></td>
                                 <?php 
                                    $edit = substr(md5("edit_news-".$articleList->id.$session->getSessionByKey('session_token')), 3, 15);
                                 ?>
                                  <td><a href="addNews?id=<?php echo $articleList->id ?>&amp;act=<?php echo $edit;?>"><?php echo $articleList->title;?></a></td>
                                 <td>
                                     <?php
                                        foreach($writer as $writerList){
                                           ?>
                                           <li><?php echo $writerList->author ?></li>
                                           <?php
                                        }
                                        ?>
                                 </td>
                                 <td><?php echo $articleList->added_date ?></td>
                                 <td><?php echo $articleList->status ?></td>
                                 <td>
                                  <?php 
                                    $delete = substr(md5("delete_news-".$articleList->id.$session->getSessionByKey('session_token')), 3, 15);
                                  ?>
                                   <a href="process/news?id=<?php echo $articleList->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाईं यो लेख मेटाउन निश्चित हुनुहुन्छ?')">रद्द गर्नुहोस्</a></td>
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