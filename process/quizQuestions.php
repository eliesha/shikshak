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

header('Content-Type: application/json; charset=utf-8');

if(isset($_REQUEST) && !empty($_REQUEST['auth']) && $_REQUEST['auth'] == 'Az4FK3OoaCWTxdHgGhCk'){
                            
    $date = date('Y-m-01');
    
    $quizList = $quiz->getQuizThisMonth($date, 4);
    
    if(is_array($quizList) || is_object($quizList)){  

    for($i = 0; $i <= 4; $i++){

        foreach($quizList as $list){

            $getOptions = $quizoptions->getOptionsById($list->id);
    
            $json[] = array(

                'question_title' => $list->title,

                'ans_id' => $list->ans_id,
        
                'options' => $getOptions

            );
    
        }
        
        echo json_encode($json);
        
        die;
        
    }
     
    }

} 

?>