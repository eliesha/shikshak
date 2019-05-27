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

if(isset($_POST) && !empty($_POST)) {
   
    $user_id = $_POST['user_id'];

    $question_id = $_POST['question_id'];
    
    $countOne = count($question_id);

    $checkIfexists = $ansUser->checkExistingUserInQuiz($user_id);
    
    $countTwo = count($checkIfexists); 
    
    if($countTwo == 0){

        if($countOne == 4){
        
            for($i=0; $i < $countOne; $i++){
                
                $data = array(
                
                'question_id' => $_POST['question_id'][$i],
                
                'answer' => $_POST['answer'][$_POST['question_id'][$i]],
                
                'user_id' => $_POST['user_id']
                
                );
                
                $insertAns = $quizans->insertQuizAnswer($data);
                    
                } 

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
                    
                    $detail = array(

                        'user_id' => $user_id,
    
                        'correct_answer' => $counts
    
                    );
                    
                    $insertWinner = $quizWinners->insertWinner($detail);

                }

                $data = array('user_id' => $_POST['user_id']);
                
                if($insertAns){
                    
                    $insertUser = $ansUser->insertUserDetail($data);

                    redirect('/quiz.php', 'error', 'तपाइँका जवाफहरू सफलतापूर्वक सबमिट गरिएको छ।');
                    
                } else {
                    
                    redirect('/quiz.php', 'error', 'केहि गलत भयो। फेरी प्रयास गर्नु होला।');
                    
                }
                
            } else {
                
                redirect('/quiz.php', 'error', 'कृपया सबै प्रश्नहरूको उत्तर दिनुहोस्।');
                
            }

    } else {

        redirect('/quiz.php', 'error', 'तपाईंले पहिले नै यस महिनाको लागि प्रश्नोत्तरी खेल्नु भइसक्यो।');

    }
    
}