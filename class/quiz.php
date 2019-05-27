<?php 


/**
 * 
 */
class Quiz extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('quiz');
	
	}
	
	public function addQuiz($data, $is_die = false){
	
		return $this->insert($data);
	
	}
	
	public function getAllQuiz(){
	
		return $this->select();
	
	}
	
	public function getQuizById($id){
	
		$args = array(
	
			'where'	=> array(
	
				'id'	=> $id
	
			)
	
		);
	
		return $this->select($args);
	
	}
	
	public function updateQuiz($data, $id, $is_die = false){
	
		$args = array(
		
			'where'	=> array(
		
				'id'	=> $id
		
			)
		
		);
		
		return $this->update($data, $args, $is_die);
	
	}
	
	public function deleteQuiz($id){
	
		$args = array(
	
			'where'	=> array(
	
				'id'	=> $id
	
			)
	
		);
	
		return $this->delete($args);
	
	}
	
	public function getQuizThisMonth($date, $limit = false){
	
		$args = array(
		    
		    'where' => ' added_date > "'.$date.'" ',
	
			'order_by'	=> 'added_date DESC'
	
		);
		
		if ($limit > 0) {
		    
		      $args['limit'] = [0, $limit];
		      
		   }
	
		return $this->select($args);
	
	}
	
	public function getLastMonthQuiz($date, $limit = false){
	
		$args = array(
	
			'where' => ' added_date <= "'.$date.'" '
	
		);
		
		if ($limit > 0) {
		    
		      $args['limit'] = [0, $limit];
		      
		   }
	
		return $this->select($args);
	
	}

	public function matchAnswer($qid, $aid){

		$args = array(

			'where' => array(

				'id' => $qid,

				'ans_id' => $aid

			)

		);

		return $this->select($args);

	}
	
	public function insertAnswerIdInQuestion($qid, $aid){

		$args = array(

			'where' => array(

				'id' => $qid

			)

		);

		return $this->update($aid, $args, true);

	}

}
