<?php
    require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
    
    require CLASS_PATH.'quiz.php';
    
    require CLASS_PATH.'quizOptions.php';
    
    require CLASS_PATH.'quizusers.php';
    
    require CLASS_PATH.'winner.php';
    
    $quiz = new Quiz;
    
    $winner = new QuizUsers;
    
    $winners = new Winner;
    
    $quizoptions = new QuizOptions;
    
        if(isset($_SESSION['fuser_id'])){
            
            require 'inc/header.php';
            
            ?>
<div class="main pt-4">
    <div class="container">
        <!-- End of top adspace -->
        <div class="row rowmargin">
            <div class="col-md-8">
                <h2 class="title">
                    सामान्य ज्ञान
                </h2>
                <?php 
                    if(@$_SESSION['error'] && !empty(@$_SESSION['error'])){
                        ?>
                <p class="front-error"><?php echo $_SESSION['error'] ?></p>
                <?php
                    unset($_SESSION['error']);
                    } else if(@$_SESSION['success'] && !empty(@$_SESSION['success'])){
                    ?>
                <p class="front-error"><?php echo $_SESSION['success'] ?></p>
                <?php
                    unset($_SESSION['success']);
                    }
                    
                    ?>
                <form method="post" action="process/quiz.php">
                    <?php 
                        $date = date('Y-m-01');
                        
                        $quizList = $quiz->getQuizThisMonth($date, 4);
                        
                        if(is_array($quizList) || is_object($quizList)){
                          
                           foreach($quizList as $list){
                               ?>
                    <div class="row rowpadding">
                        <div class="col-md-8 col-md-offset-2" id="panel1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <input type = "hidden" name="question_id[]" value="<?php echo $list->id?>">
                                        <?php echo $list->title ?>
                                    </h5>
                                </div>
                                <div class="panel-body two-col">
                                    <div class="row">
                                        <?php 
                                            $options = $quizoptions->getOptionsById($list->id);
                                            if ($options){
                                                
                                                foreach($options as $key => $ansList){
                                                   ?>
                                        <div class="col-md-6">
                                            <div class="frb frb-danger margin-bottom-none">
                                                <input type="radio" id="radio-button-5" name="answer[<?php echo $ansList->question_id ?>]" value="<?php echo $ansList->id ?>">
                                                <label for="radio-button-5">
                                                <span class="frb-title"><?php echo $ansList->answers ?></span>
                                                <span class="frb-description"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <?php
                                            }
                                            
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        
                        }
                        
                        ?>
                    <input type = "hidden" name="user_id" value="<?php echo $_SESSION['fuser_id'] ?>">
                    <div class="panel-footer rowpadding">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-sm btn-block orangebtn" style="margin-top:20px">
                                <span class="fa fa-send"></span>
                                पेश गर्नुहोस् </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="row">
                    <h2 class="title">
                        गत महिनाको प्रश्नहरू
                    </h2>
                    <div class="card" style="width:100%">
                        <ul class="list-group list-group-flush">
                            <?php 
                                $date = date('Y-m-01').' -1 months)';
                                
                                $lastMonth = $quiz->getLastMonthQuiz($date, 4);
                                //debugger($lastMonth, true);
                                if(is_array($lastMonth) || is_object($lastMonth)){
                                   
                                    foreach($lastMonth as $previous){
                                        $getansw = $quizoptions->getAnswerByAnswerId($previous->ans_id);
                                        
                                        foreach ($getansw as $ans){
                                        ?>
                            <li class="list-group-item">
                                <div class="questions">
                                    <h6 class="panel-title">
                                        <?php echo $previous->title ?>
                                    </h6>
                                    <p><strong>उत्तर:</strong><?php echo $ans->answers ; ?></p>
                                </div>
                            </li>
                            <?php
                                }}
                                
                                }
                                
                                ?>
                        </ul>
                    </div>
                </div>
                <div class="row pt-4">
                    <h2 class="title">
                        गत महिनाको विजेता
                    </h2>
                    <div class="winner" style="width: 100%">
                        <div class="row">
                            <?php 
                                $date = date('Y-m-01').' -1 months)';
                                
                                $winnerList = $winners->getWinner(1);
                                
                                $name = $winnerList[0]->name;
                                
                                $userDetail = $user->getUserByFullname($name);
                                
                                $base = basename($userDetail[0]->image);
                                
                                if(!empty($userDetail[0]->image) && file_exists(UPLOAD_DIR.'users/'.$base)){
                                   
                                    $profile = UPLOAD_URL.'users/'.$base;
                                    
                                } else {
                                    
                                     $profile = FRONT_IMAGES_URL.'defaultUser.png';
                                    
                                }
                                
                                ?>
                            <div class="col-md-5">
                                <img src="<?php echo $profile?>" alt="pic" class="img-fluid">
                                </div
                                <div class="col-md-7 pt-2">
                                    <h6 style="padding-top:30px;">
                                        <?php echo $winnerList[0]->name ?> 
                                        <p>ठेगाना: <?php echo $winnerList[0]->address ?></p>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->
<?php
    require 'inc/footer.php';
    require 'inc/fotjava.php';
    
    } else {
    
    redirect('./signup.php', 'success', 'प्रश्नोत्तरमा भाग लिनका लागी, शिक्षकमा एक खाता हुन जरुरी छ। खाता सिर्जना गर्नुहोस् या साइन इन गर्नुहोस् ।');
    
    }
    
    ?>