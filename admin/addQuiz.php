<?php 
require '../config/init.php';
require 'inc/header.php';
require CLASS_PATH.'category.php';
require CLASS_PATH.'quiz.php';
require CLASS_PATH.'quizOptions.php';
$category = new Category;
$quizAns = new QuizOptions();
$quiz = new Quiz;
$act = "थपनुहोस";

?>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php require 'inc/menu.php';?>
        <?php 
          if(isset($_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
            $id = (int)$_GET['id'];
            $action = $_GET['act'];

            if($action != substr(md5("edit_question-".$id.$session->getSessionByKey('session_token')), 3, 15)){
                $_SESSION['error'] = "Token mismatch.";
                @header('location: quiz');
                exit;
            }

            $quiz_info = $quiz->getQuizById($id);
            
            $quizAnswers = $quizAns->getOptionsById($id);
            
            $correctAnswer  = $quizAns->getAnswerByAnswerId($quiz_info[0]->ans_id);
            
            if(!$quiz_info){

                $_SESSION['error'] = "Quiz not found.";
                @header('location: quiz');
                exit;
            }
            
            $act = "अद्यावधिक गर्नुहोस्";
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
                    <h2><?php echo 'प्रश्न'. ' '. $act;?></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form action="process/quiz" method="post">
                      <div class="date" style="padding-left: 510px;">
                            <label for="date">मिति:</label>
                            <input type="text" class="bod-picker date" name="date" value="<?php echo @$quiz_info[0]->added_date ?>" min="" required>
                            </time></p>
                        </div>
                        <div class="form-group ">
                            <label for="प्रश्न शीर्षक">प्रश्न शीर्षक</label>
                            <input type="text" name="title" placeholder="सामान्य ज्ञानको शीर्षक प्रविष्ट गर्नुहोस्" class="form-control" value="<?php echo @$quiz_info[0]->title ?>">
                        </div>
                        <div class="form-group">
                          <div class="col-12">
                            <label>विकल्पहरू</label>
                          </div>
                          <div class="col-12">
                            <div class="col-md-3">
                            <input type="text" name="answers[]" class="form-control" placeholder="विकल्प 'क' " value="<?php echo @$quizAnswers[3]->answers ?>">
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="answers[]" class="form-control" placeholder="विकल्प 'ख'" value="<?php echo @$quizAnswers[2]->answers ?>">
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="answers[]" class="form-control" placeholder="विकल्प 'ग'" value="<?php echo @$quizAnswers[1]->answers ?>">
                            </div>
                            <div class="col-md-3">
                            <input type="text" name="answers[]" class="form-control" placeholder="विकल्प 'घ'" value="<?php echo @$quizAnswers[0]->answers ?>">
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="form-group">
                          <div class="col-12">
                            <label>सही जवाफ</label>
                          </div>
                          <div>
                            <input type="text" name="correct_answer" class="form-control" placeholder="सही जवाफ" value="<?php echo $correctAnswer[0]->answers ?>">
                          </div>
                        </div>
                        <div class="form-group my-4 mx-4 text-right">
                            <label for="content"></label>
                            <input type="hidden" name="quiz_id" value="<?php echo isset($quiz_info[0]->id) ? $quiz_info[0]->id : ''; ?>">
                            <button class="btn btn-success"><i class="fas fa-paper-plane"></i> <?php echo 'प्रश्न'. ' '. $act;?></button>
                            <button class="btn btn-danger"><i class="fas fa-trash"></i> मेटाउनुहोस्</button>
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