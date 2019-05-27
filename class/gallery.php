<?php 

/**
 * 
 */
class Gallery extends Database
{
	public function __construct(){
		
		Database::__construct();
		
		$this->table('gallery');
	
	}

	public function addGallery($data, $is_die = false){
	
		return $this->insert($data, $is_die);
	
	}

	public function getAllGallery(){
	
		return $this->select();
	
	}
	
	public function getSingleGalleryById($id){
	
		$args = array(
	
			'where' => array(
	
				'id' => $id
	
			)
	
		);
	
		return $this->select($args);
	
	}

	public function deleteImageFolder($id){
	
		$args = array(
	
			'where' => array(
	
				'id' => $id
	
			)
	
		);
	
		return $this->delete($args);
	
	}

}