<?php 


/**
 * 
 */
class Winner extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('winner');
	
	}
	
	public function getWinner($limit = false){
		
		if ($limit > 0) {
		    
		      $args['limit'] = [0, $limit];
		      
		   }
	
		return $this->select($args);
	
	}
	
	public function getOneWinner($limit = false){
		
		if ($limit > 0) {
		    
		      $args['limit'] = [0, $limit];
		      
		   }
	
		return $this->select($args);
	
	}
	
	public function addWinner($data){
		
		return $this->insert($data);
	
	}
}