<?php 
/**
 * 
 */
class Janamat extends Database
{
	public function __construct(){
	
		Database::__construct();
	
		$this->table('janamat');
	
	}

	public function addJanamat($data){
	
		return $this->insert($data);
	
	}

	public function updateJanamat($data, $id, $is_die = false){
	
		$args = array(
	
			'where' => array(
	
				'id' => $id
	
			),
	
		);
	
		return $this->update($data, $args, $is_die);
	
	}

	public function getAllJanamat(){
	
		return $this->select();
	
	}

	public function getJanamatById($id){
	
		$args = array(
	
			'where'	=> array(
	
				'id'	=> $id
	
			)
	
		);
	
		return $this->select($args);
	
	}

	public function deleteJanamat($id){
	
		$args = array(
	
			'where'	=> array(
	
				'id'	=> $id
	
			)
	
		);
	
		return $this->delete($args);
	
	}
	
	public function getOneJanamat(){
	
		$args = array(
		    
		    'limit' => 0,1
		    
		    );
	
		return $this->select($args);
	
	}

}