<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'user.php';

require CLASS_PATH.'quizans.php';

require CLASS_PATH.'quizusers.php';

require CLASS_PATH.'quiz.php';

$user = new User();

$quizans = new Quizans();

$ansUser = new QuizansUsers();

$quiz = new Quiz();

$quizWinners =  new QuizUsers();

$getresult = $quizans->getAnswersByUser($_POST['user_id']);

$user_id = $_POST['user_id'];

header('Content-Type: application/json; charset=utf-8');

        $countThird = count($getresult);
       
        if($countThird == 4){
            
            $getresult = $quizans->getAnswersByUser($_POST['user_id']);
            
            $counts = 0;
    
            if($getresult){
                
                $count = count($getresult);
    
                for ($x = 0; $x < $count; $x++) {
                    
                    $match = $quiz->matchAnswer($getresult[$x]->question_id, $getresult[$x]->answer);
                    
                    if($match){
                    
                        $counts += 1;
                    
                    }
                
                }
    
            }
            
            if($counts == 4){
                
                $allWinner = $quizWinners->checkUser($_POST['user_id']);
                
                if(!$allWinner){
                    
                    $detail = array(
    
                    'user_id' => $user_id,
    
                    'correct_answer' => $counts
    
                );
                
                $insertWinner = $quizWinners->insertWinner($detail);
                    
                }
    
            }
    
            $data = array('user_id' => $_POST['user_id']);
            
            if($insertAns){
                
                $insertUser = $ansUser->insertUserDetail($data);
                
                $result['success'] = 1;
                
                $result['message'] = "तपाइँका जवाफहरू सफलतापूर्वक सबमिट गरिएको छ।";
                
                json_encode($result);
                
                die;
                
            } 
            
            
        }