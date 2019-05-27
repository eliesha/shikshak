<?php 


/**
 * 
 */
class Podcast extends Database
{
	
	public function __construct(){
		Database::__construct();
		$this->table('podcast');
	}
	public function getAllPodcast(){
		$args = array(
			'fields' => array(
						'podcast.id', 
						'podcast.title',  
	   	                'podcast.description', 
						'podcast.duration',
						'podcast.audio',
						'podcast.url',
						'podcast.added_date',
						'categories.title AS category',
						'(SELECT users.full_name FROM users WHERE id = podcast.added_by) as author',
					),
			'join'   => "LEFT JOIN categories on podcast.category = categories.id"
		);
		return $this->select($args);
	}
	public function addPodcast($data, $is_die = false){
		return $this->insert($data, $is_die);
	}
	public function updatePodcast($data, $id, $is_die = false){
		$args = array(
			'where' => array('id' => $id),
		);
		return $this->update($data, $args, $is_die);		
	}
	public function getPodcastById($id){
		$args = array(
			'where'	=> array(
				'id' => $id	
			),
		);
		return $this->select($args);
	}
	public function deletePodcast($id){
		$args = array(
			'where' => array('id' => $id)
		);
		return $this->delete($args);
	}
	public function getUserPodcast($userList){
		$args = array(
			'fields' => array(
						'podcast.id', 
						'podcast.title',  
	   	                'podcast.description', 
						'podcast.duration',
						'podcast.audio',
						'podcast.url',
						'podcast.added_by',
						'podcast.added_date',
						'categories.title AS category',
						'(SELECT users.full_name FROM users WHERE id = podcast.added_by) as author',
					),
			'join'   => "LEFT JOIN categories on podcast.category = categories.id",
			'where' => array('added_by' => $userList)
		);
		return $this->select($args);
	}
	public function getPodcastByCategoryId($catId, $limit = false){
		$args = array(
		      'fields' => array(
		                  'podcast.id', 
		                  'podcast.title',  
		                  'podcast.description', 
		                  'podcast.duration',
		                  'podcast.audio',
		                  'podcast.url',
		                  'podcast.category',
		                  'podcast.added_date',
		                  'categories.title AS category_title',
		                  '(SELECT users.full_name FROM users WHERE id = podcast.added_by) as author',
		                  '(SELECT COUNT(*) FROM podcast WHERE categories.id = podcast.category) as episodes'
		              ),
		      
		      'join'   => "LEFT JOIN categories on podcast.category = categories.id",
		      'where' => array(
		          'category' => $catId
		      ),
	
		  );
		  
		  if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }
		  
		return $this->select($args);
	}
	
	public function getPodcastForNav($limit = false){
		$args = array();
		  
		  if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }
		  
		return $this->select($args);
	}
}