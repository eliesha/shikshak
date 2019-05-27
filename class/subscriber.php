<?php
class Subscriber extends Database{
    
    function __construct(){
		Database::__construct();
		$this->table('subscribers');
	}
	
	public function addSubscriber($data){

		return $this->insert($data);

	}
    
    public function checkSubscribers($id){
	    
	    $args = array(

			'where' => ' uid = "'.$id.'" '
			
		);

		return $this->select($args);
	    
	}
	
	public function updateSubscriber($data, $id, $is_die = false){
	
		$args = array(
		    
		    'where' => ' uid = "'.$id.'" ', 
	
		);
	
		return $this->update($data, $args);
	
	}
	
	public function getAllSubscriber(){
	
		$args = array(
		    
		    'fields' => array(
		        
		        'subscribers.id',
		        
		        'subscribers.name',
		        
		        'subscribers.address',
		        
		        'subscribers.phone',
		        
		        'users.email as email'
		        
		        ), 
		  'join'   => "LEFT JOIN users on subscribers.uid = users.id"
	
		);
	
		return $this->select($args);
	
	}
	
	public function getSubscriberById($id){

		$args = array(
		    
		    'where' => ' uid = "'.$id.'" ',

		);

		return $this->select($args);

	}
    
}