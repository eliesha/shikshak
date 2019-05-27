<?php 


/**
 * 
 */
class QuizOptions extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('quizoptions');
	
	}
	
	public function addQuiz($data, $is_die = false){
	
		return $this->insert($data);
	
	}
	
	public function addQuizOptions($data, $is_die = false){
	
		return $this->insert($data);
	
	}
	
	public function getOptionsById($id){
	
		$args = array(
	
			'where'	=> array(
	
				'question_id'	=> $id
	
			)
	
		);
	
		return $this->select($args);
	
	}
	
	public function deleteOptionsById($id){
	
		$args = array(
	
			'where'	=> array(
	
				'question_id'	=> $id
	
			)
	
		);
	
		return $this->delete($args, true);
	
	}
	
	public function matchAnswer($id, $answer){
	
		$args = array(
		    
		    'where' => ' question_id = "'.$id.'" AND answers = "'.$answer.'"',
	
		);
	
		return $this->select($args, true);
	
	}
	
	public function getAnswerByAnswerId($id){
	
		$args = array(
	
			'where'	=> array(
	
				'id'	=> $id
	
			)
	
		);
	
		return $this->select($args);
	
	}
	
}