<?php 


/**
 * 
 */
class Quizans extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('quizans');
	
	}
	
	public function insertQuizAnswer($data){
	    
	    return $this->insert($data);
	    
	}

	public function getAnswersByUser($id){

		$args = array(

			'where' => array(

				'user_id' => $id

			)

		);

		return $this->select($args);

	}

}

class QuizansUsers extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('answUsers');
	
	}
	
	public function insertUserDetail($data){
	    
	    return $this->insert($data);
	    
	}

	public function checkExistingUserInQuiz($id){

		$args = array(

			'where' => array(

				'user_id' => $id

			)

		);
	    
	    return $this->select($args);
	    
	}
	
	public function deleteDataLastMonth($date){

		$args = array(

			'where' => ' added_date < "'.$date.'" ',

		);
	    
	    return $this->delete($args);
	    
	}

}