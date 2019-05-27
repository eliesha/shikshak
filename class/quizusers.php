<?php 


/**
 * 
 */
class QuizUsers extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('quizusers');
	
	}

	public function insertWinner($data){

		return $this->insert($data);

	}
	
	public function getAllWinnerList($date){
	    
	    $args = array(
	        
	        'where' =>  array(
	            
	            'added_date' <= $date
	            
	            )
	        
	        );
	
		return $this->select($args);
	
	}
	
	public function checkUser($id){
	    
	    $args = array(
	        
	        'user_id' => $id
	        
	        );

		return $this->select($args);

	}

}