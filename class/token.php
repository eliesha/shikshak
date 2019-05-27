<?php 
/**
 * 
 */
class Token extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('push_token');
    }

    public function getAllTokens(){

		return $this->select($args);
    
    }
    
    public function insertToken($data){

		return $this->insert($data);
    
    }
    
    public function existingToken($token){
        
        $args = array(
            
            'where' => ' token = "'.$token.'" '
            
            );

		return $this->select($args);
    
    }
    
}