<?php

/**
 *  
 */
class Category extends Database{
	
	public function __construct(){
	
		Database::__construct();
	
		$this->table('categories');
	
	}
	
	public function getAllCategory(){
	
		return $this->select();
	
	}
	
	public function getNewsCategory(){
	
		$args = array(
	
			'where'	=> array(
	
				'is_pod'	=> 0
	
			)
	
		);
	
		return $this->select($args);
	
	}
	public function getNewsCategoryWithoutStambha(){
	
		$args = array(
	
			'where'	=> array(
	
				'is_pod'	=> 0,
				
				'id'       => array('value' => 3, 'operator' => '!=', ),
	
			)
	
		);
	
		return $this->select($args);
	
	}
	public function getAllParent(){
		$args = array(
			'where' => array(
				'is_parent' => 1,
				'parent_id' => 0
			)
		);
		return $this->select($args);
	}
	
	public function addCategory($data, $is_die = false){
	
		return $this->insert($data);
	
	}

	public function updateCategory($data, $id, $is_die = false){

		$args = array(

			'where' => array('id' => $id),

		);

		return $this->update($data, $args, $is_die);		

	}

	public function deleteCategory($id){

		$args = array(

			'where' => array('id' => $id)

		);

		return $this->delete($args);

	}

	public function getCategoryById($cat_id){

		$args = array(

			'where' => array('id' => $cat_id),

		);

		return $this->select($args);

	}

	public function shiftChild($parent_id, $is_die = false){

		$data = array(

			'is_parent' => 1,

			'parent_id' => 0

		);

		$args = array(

			'where' => array(

				'parent_id' => $parent_id

			)

		);

		return $this->update($data, $args, $is_die);

	}

	public function getChildByParent($parent_id){

		$args = array(

			'where' => array(

				'is_parent' => 0,

				'parent_id' => $parent_id

			)

		);

		return $this->select($args);

	}

	public function getAllActiveParents(){

		$args = array(

			'where' => array(

				'status' => 'Active',

				'is_parent' => 1,

			),

			'order_by' => 'title ASC'

		);

		return $this->select($args);

	}

	public function getCategoryPodcast(){

		$args = array(

			'where' => array(

				'is_pod' => 1

			),

		);

		return $this->select($args);

	}

	public function getCategoriesToBeAssist(){

		$args = array(

			'fields' => array('id, title'),

			'where'  => array('status'=> 'Active')

		);

		return $this->select($args);

	}

	public function getCategoryPodcastWithEpi(){

		$args = array(

			'fields' => array(

		                  'categories.id', 

		                  'categories.title',  

		                  'categories.image',

		                  '(SELECT COUNT(*) FROM podcast WHERE categories.id = podcast.category) as episodes'

		              ),

			'where' => array(

				'is_pod' => 1

			),

		);

		return $this->select($args);

	}
	
	public function checkExistingCategory($name){
	    
	    $args = array(
	        
	   'where' => ' title = "'.$name.'"',     
	        
	   );
	   
	   return $this->select($args);
	    
	}

}