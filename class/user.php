<?php 

class User extends Database{
	
	function __construct(){
		Database::__construct();
		$this->table('users');
	}

	public function getUserByUsername($username){
		
		$condition = array(
		    
			'fields' => array('id', 'first_name', 'last_name', 'username', 'email', 'image', 'roles', 'status', 'password', 'userInfo', 'full_name','phone_number','country'),
			
			'where' => ' username = "'.$username.'" ',
		
		);
		
		return $this->select($condition);
	
	}
	
	public function getUserByName($full_name){
		
		$condition = array(
		    
			'where' => ' full_name = "'.$full_name.'" ',
		
		);
		
		return $this->select($condition);
	
	}
	
	public function getUserByFullname($name){
	
		$condition = array(
		    
			'fields' => array('id', 'first_name', 'last_name', 'username', 'email', 'image', 'roles', 'status', 'password', 'userInfo', 'full_name','phone_number','country'),
			
			'where' => ' full_name = "'.$name.'" ',
		
		);
		
		return $this->select($condition);
	
	}
	
	public function getUserByEmail($email){
	
		$condition = array(
		    
			'fields' => array('id', 'first_name', 'last_name', 'username', 'email', 'image', 'roles', 'status', 'password', 'userInfo', 'phone_number'),
			
			'where' => ' email = "'.$email.'" ',
		
		);
		
		return $this->select($condition);
	
	}

	public function getUserByToken($token){
	    
		$condition = array(
		    
		    'where' => ' api_token = "'.$token.'" ',
		
		);
		
		return $this->select($condition);
	
	}

	public function updateUser($data, $id, $is_die = false){
	
		$args = array(
		    
		    'where' => ' id = "'.$id.'" ', 
	
		);
	
		return $this->update($data, $args);
	
	}

	public function addUser($data){

		return $this->insert($data);

	}

	public function getAllUser(){

		return $this->select();

	} 
	
	public function getAllUserExceptUserId($id){
	    
	    $args = array(
	        
	        'where' => ' id != "'.$id.'" ', 
	        
	        );

		return $this->select($args);

	} 

	public function getAllUserList(){

		$args = array(

			'fields' => array('full_name','id', 'image','userInfo'),

			'where' => array(
			    
			    'status' => 'Active',
			    
			    'roles'       => array('value' => 'Reader', 'operator' => '!=', ), 
			 
			   )
			 
			 );

		return $this->select($args);

	}

	public function getUserById($id){

		$args = array(
		    
		    'where' => ' id = "'.$id.'" ',

		);

		return $this->select($args);

	}
	
	public function getUserByActToken($token){

		$args = array(

				'where' => "token = ".token."",

		);

		return $this->select($args);

	}

	public function deleteUserById($id){

		$args = array(

			'where' => array('id' => $id)

		);

		return $this->delete($args);

	}

	public function getAllUserName(){

		$args = array(

			'fields'	=> 'full_name, username, image, id, userInfo',

		);

		return $this->select($args);

	}
	
	public function getAdminUsers($id, $limit = false){
	    
	    $args = array(
	        
	        'fields' => array(
				'users.id', 
				'users.image',
				'users.full_name', 
				'users.roles'
			),
			
			'where' => ' roles != "Reader" AND id !="'.$id.'"',
			
			);
	        
	        if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }
	  	
	  	return $this->select($args);
	
	}
	
	public function getAllAdminUsers($limit = false){
	    
	    $args = array(
	        
	        'fields' => array(
				'users.id', 
				'users.image',
				'users.full_name', 
				'users.roles'
			),
			
			'where' => ' roles != "Reader"',
			
			);
	        
	        if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }
	  	
	  	return $this->select($args);
	
	}
	
	public function updatePassword($data, $id, $is_die = false){

		$args = array(
		    
		    	'where' => "id = ".$id."",
			
		);

		return $this->update($data, $args);

	}
	
	public function updateStatus($data, $id, $is_die = false){

		$args = array(
		    
		    	'where' => "status = ".status."",
			
		);

		return $this->update($data, $args);

	}
	
	public function updateToken($data, $token, $is_die = false){

		$args = array(
		    
		    	'where' => "token = ".token."",
			
		);

		return $this->update($data, $args);

	}
	
	public function existingUsername($username){
	    
	    $args = array(

			'where' => ' username = "'.$username.'" '
			
		);

		return $this->select($args);
	    
	}
	
	public function existingEmail($email){
	    
	    $args = array(

			'where' => ' email = "'.$email.'" '
			
		);

		return $this->select($args);
	    
	}
	

}

class Payment extends Database{
    
    function __construct(){
		Database::__construct();
		$this->table('paymentSession');
	}
	
	public function insertPayementSession($data){

		return $this->insert($data);

	}
	
	public function deleteSessionById($id){

		$args = array(

			'where' => array('uid' => $id)

		);

		return $this->delete($args);

	}
	
	public function getPaymentSessionById($id){

		$args = array(
		    
		    'where' => 'uid = "'.$id.'" ',

		);

		return $this->select($args);

	}
    
}


