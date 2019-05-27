<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';

require CLASS_PATH.'quiz.php';

require CLASS_PATH.'quizans.php';

require CLASS_PATH.'quizOptions.php';

require CLASS_PATH.'session.php';

$quiz = new Quiz();

$quizAns = new QuizOptions();

$session = new Session();

if (isset($_POST) && !empty($_POST)) {

	$data = array(
		
		'title' => escapeString($_POST['title']),
	
	);

	$quiz_id = (isset($_POST['quiz_id']) && !empty($_POST['quiz_id'])) ? (int)$_POST['quiz_id'] : null;

		if ($quiz_id) {
	
			$act = "अद्यावधिक";
	
			$quiz_id = $quiz->updateQuiz($data, $quiz_id);
	
		} else {
		
			$act = "थप";
	
			$quiz_id = $quiz->addQuiz($data);
			
			for($i=0; $i<4; $i++){

				if($quiz_id){
					
					$array = array(
					
							'answers' => $_POST['answers'][$i],
					
							'question_id' => $quiz_id 
					
					);
					
					$option = $quizAns->addQuizOptions($array);
					
				}
			
			}
			
            if($option){
                $answerId = $quizAns->matchAnswer($quiz_id, $_POST['correct_answer']);
                $qid = $answerId[0]->question_id;
                $ans_id = $answerId[0]->id;
                $ansArray = array('ans_id'=>$ans_id);
                $addAnswerId = $quiz->insertAnswerIdInQuestion($qid, $ansArray);
            }
	
		}

	if ($option) {
	
			redirect('../quiz', 'success', 'प्रश्न सफलतापूर्वक '.$act.' भयो।');
	
	} else {
	
		redirect('../quiz', 'error', 'माफ गर्नुहोस्! प्रश्न '.$act.' गर्दा समस्या भयो।');
	
	}

} elseif (isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])) {

	$id  = (int)$_GET['id'];

	$act = escapeString($_GET['act']);

	if ($act == substr(md5("delete_question-".$id.$session->getSessionByKey('session_token')), 3, 15)) {

		$quiz_info = $quiz->getQuizById($id);

		if ($quiz_info) {
			
			$delete  = $quiz->deleteQuiz($id);
            
			if ($delete) {
			    
			    $deleteOptions = $quizAns->deleteOptionsById($id);

				redirect('../quiz', 'success', 'प्रश्न सफलतापूर्वक मेटाईयो।');
			
			} else {
			
				redirect('../quiz', 'error', 'माफ गर्नुहोस्! प्रश्न मेट्दा समस्या भयो।');
			
			}
		
		} else {
		
			redirect('../quiz', 'error', 'प्रश्न भेटिएन।.');
		
		}
	
	} else {
	
		redirect('../quiz', 'error', 'टोकन बेमेल।');
	
	}

} else {

	redirect('../', 'error', 'अनधिकृत पहुँच।');

}