<?php 

/**
 * 
 */
class GalleryImages extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('gallery_images');
	}
	public function addGalleryImages($data, $is_die = false){
		return $this->insert($data, $is_die);
	}
	public function getGalleriesById($id){
		$args = array(
			'where'	=> array(
				'gallery_id'  => $id
			)
		);
		return $this->select($args);
	}
	public function getGalleryById($id){
		$args = array(
			'where' => array(
				'id' => $id
			)
		);
		return $this->select($args);
	}

	public function deleteData($id){
		$args = array(
			'where' => array(
				'id' => $id
			)
		);
		return $this->delete($args);
	}
}