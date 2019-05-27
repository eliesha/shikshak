<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'book.php';
$book = new Book;
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
                    <h2>पुस्तक सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>एस.एन</th>
                          <th>शीर्षक</th>
                          <th>लेखक</th>
                          <th>मूल्य</th>
                          <th>कार्य</th>
                        </thead>
                        <tbody>
                            <?php 
                            
                            $bookList = $book->getAllBook();
                            
                            if($bookList){
                                
                                foreach($bookList as $key => $list){
                                    ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <?php 
                                              $edit = substr(md5("edit_book-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                            ?>
                                          <td><a href="addBook?id=<?php echo $list->id ?>&amp;act=<?php echo $edit;?>"><?php echo $list->title;?></a></td>
                                        <td><?php echo $list->writer ?></td>
                                        <td><?php echo $list->price ?></td>
                                        <td>
                                            <?php 
                                              $delete = substr(md5("delete_book-".$list->id.$session->getSessionByKey('session_token')), 3, 15);
                                             ?>
                                              <a href="process/book?id=<?php echo $list->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('के तपाइँ यो पुस्तक मेटाउन चाहनुहुन्छ?')">मेटाउनुहोस्</a></td>
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