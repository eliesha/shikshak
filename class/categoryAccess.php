<?php 


/**
 * 
 */
class CategoryAccess extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('category_permitted');
	
	}

	public function addCategoryAccess($data, $is_die = false){
	
		return $this->insert($data, $is_die);
	
	}

	public function updateCategoryAccess($data, $id, $is_die = false){

		$args = array(
			'where' => array('user_id' => $id),
		);
	
		return $this->update($data, $args, true);
	
	}

	public function deleteCategoryAccess($id) {

		$args = array(

			'where'	=> array('user_id' => $id)

		);

		return $this->delete($args);

	}

	public function getCategoriesByUserId($id){
		
		$args = array(
			
			'fields' => array(

				'category_permitted.category_id AS id',
				'category_permitted.user_id AS user_id',
				'categories.title AS title',
				'(SELECT categories.is_pod FROM categories WHERE id = category_permitted.category_id) as is_pod'

			),
			
			'where' => ' user_id = "'.$id.'" ',

			'join'   => "LEFT JOIN categories on category_permitted.category_id = categories.id"
		
		);
		
		return $this->select($args);
	}

}