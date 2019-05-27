<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'quiz.php';
$quiz = new Quiz;
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
                    <h2>प्रश्न सूची</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <table class="table table-bordered jambo_table">
                        <thead>
                          <th>क्रम</th>
                          <th>शीर्षक</th>
                          <th>सही_जवाफ</th>
                          <th>मिति</th>
                          <th>Action</th>
                        </thead>
                        <tbody>
                          <?php 
                            $allQuiz = $quiz->getAllQuiz();
                            //debugger($allQuiz, true);
                            if ($allQuiz) {
                                foreach ($allQuiz as $key => $quizList) {
                                  ?>
                                  <tr>
                                   <td><?php echo $key+1 ?></td>
                                   <?php 
                                        $edit = substr(md5("edit_question-".$quizList->id.$session->getSessionByKey('session_token')), 3, 15);
                                    ?> 
                                   <td><a href="addQuiz?id=<?php echo $quizList->id ?>&amp;act=<?php echo $edit;?>"><?php echo $quizList->title;?></a></td>
                                   <td><?php echo $quizList->correct_answer ?></td>
                                   <td><?php echo $quizList->added_date ?></td>
                                   <td>
                                   <?php 
                                      $delete = substr(md5("delete_question-".$quizList->id.$session->getSessionByKey('session_token')), 3, 15);
                                   ?>
                                      <a href="process/quiz?id=<?php echo $quizList->id;?>&amp;act=<?php echo $delete;?>" onclick="return confirm('Are you sure you want to delete this question?')">Delete</a>
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