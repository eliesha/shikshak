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

header('Content-Type: application/json; charset=utf-8');

if(isset($_POST) && !empty($_POST)) {
   
    $user_id = $_POST['user_id'];

    $question_id = $_POST['question_id'];
    
    $countOne = count($question_id);

    $checkIfexists = $ansUser->checkExistingUserInQuiz($user_id);
    
    $countTwo = count($checkIfexists); 
    
    if($countTwo == 0){
            
        $data = array(
        
        'question_id' => $_POST['question_id'],
        
        'answer' => $_POST['answer'],
        
        'user_id' => $_POST['user_id']
        
        );
        
        $insertAns = $quizans->insertQuizAnswer($data);
        
        if($insertAns){
            $result['success'] = 1;
        
            $result['message'] = 'Submitted';
            
            echo json_encode($result);
        } else {
            
            $result['success'] = 0;
        
            $result['message'] = 'Error';
            
            echo json_encode($result);
            
        }
        
        $getresult = $quizans->getAnswersByUser($_POST['user_id']);
        
        $countNumber = count($getresult);
        
        if($countNumber == 4){
            
            $data = array(
                
                'user_id' => $_POST['user_id']
                
                );
            
            $insertUser = $ansUser->insertUserDetail($data);
            
        }

    } else {
                
        $result['success'] = 0;
        
        $result['message'] = "You have already played quiz for this month.";
        
        echo json_encode($result);
        
        die;

    }
    
}