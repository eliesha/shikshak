<?php 
class News extends Database{
	
	public function __construct(){
	
		Database::__construct();
		
		$this->table('news');

	}

	public function getAllNews(){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

	   	                'news.story', 

						'news.image',
						
						'news.archieveCategory',
						
						'news.griha',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',

					),

			'where' => ' news.news_category != "14" AND news.status = "Active"',

			'join'   => "LEFT JOIN categories on news.news_category = categories.id"

		);

		return $this->select($args);

	}

	public function getMainNews(){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

	   	                'news.story', 
	   	                
	   	                'news.summary', 
	   	                
	   	                'news.archieveCategory',
	   	                
	   	                'news.griha',

						'news.image',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',

					),

			'where' => ' news.status = "Active" AND news.news_category != "14"',

			'join'   => "LEFT JOIN categories on news.news_category = categories.id",

			'limit'  => array(0, 3)

		);

		return $this->select($args);

	}

	public function addNews($data, $is_die = false){

		return $this->insert($data);

	}

	public function updateNews($data, $id, $is_die = false){

		$args = array(

			'where' => array(

				'id' => $id

			),

		);

		return $this->update($data, $args, $is_die);

	}

	public function deleteNews($id){

		$args = array(

			'where' => array(

				'id' => $id

			),

		);

		return $this->delete($args);

	}

	public function getNewsById($id){

		$args = array(
		    
		    'fields' => array(

						'news.id', 

						'news.title',
						
						'news.summary',

						'news.story', 
						
						'news.archieveCategory',

						'news.image',
						
						'news.griha',

						'news.status',

						'news.added_date',
						
						'news.news_category',

					),
					
					
			'where' => ' id = "'.$id.'" ',

		);

		return $this->select($args);

	}

	public function getNewsCategoryById($news_id){

		$args = array(
		    
		    'where' => ' news_category = "'.$news_id.'" ',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id'

		);

		return $this->select($args);

	}

    public function getNewsMannkaaKura($limit = false){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

						'news.story',
						
						'news.summary',
						
						'news.archieveCategory',

						'news.image',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',
					),
					
			'where' => ' news_category = "14"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id', 

		);

		if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }

		return $this->select($args);

	}
	
	public function getNewsMannkaaKuraOfUser($id, $limit = false){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

						'news.story',
						
						'news.summary',
						
						'news.archieveCategory',

						'news.image',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',

					),
					
			'where' => 'news_category = "14"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id', 

		);

		if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }

		return $this->select($args);

	}

	public function getNewsByCatId($id, $limit = false){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

						'news.story',
						
						'news.summary',
						
						'news.archieveCategory',

						'news.image',

						'news.status',

						'news.added_date',
						
						'news.news_category as category_id',

						'categories.title AS news_category',

					),
					
			'where' => ' news_category = "'.$id.'" AND news.status = "Active"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id', 

		);

		if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }

		return $this->select($args);

	}
	
	public function getNewsByCatIdLimit($id,$offset, $limit = false){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

						'news.story',
						
						'news.summary',
						
						'news.archieveCategory',

						'news.image',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',

					),
					
			'where' => ' news_category = "'.$id.'" AND news.status = "Active"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id', 

		);

		if ($limit > 0) {
		      $args['limit'] = [$offset, $limit];
		   }

		return $this->select($args);

	}

	public function getCategoryName($id){

			$args = array(

				'fields' => array(

						'categories.title AS news_category',

					),
					
			    'where' => ' news_category = "'.$id.'" ',

				'join'   => "LEFT JOIN categories on news.news_category = categories.id"

			);

			return $this->select($args);

	}

	public function getNewsByUserIdOffset($user_id, $offset = false, $limit = false){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title', 

						'news.story', 
						
						'news.summary',
						
						'news.archieveCategory',
						
						'news.status',

						'news.image',

						'news.added_date',

						'categories.title AS news_category',
						
						'(SELECT users.full_name FROM users WHERE id = postAuthor.user_id) as author',

					),
					
			'where' => ' postAuthor.user_id = "'.$user_id.'" AND news.status = "Active"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id LEFT JOIN postAuthor on news.id = postAuthor.post_id'

		);
		
		if ($limit > 0) {
		    
		      $args['limit'] = [$offset, $limit];
		   }


		return $this->select($args);

	}
	
	public function getNewsByUserId($user_id, $limit = false){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title', 

						'news.story', 
						
						'news.summary',
						
						'news.archieveCategory',
						
						'news.status',

						'news.image',

						'news.added_date',

						'categories.title AS news_category',
						
						'(SELECT users.full_name FROM users WHERE id = postAuthor.user_id) as author',

					),
					
			'where' => ' postAuthor.user_id = "'.$user_id.'" AND news.status = "Active"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id LEFT JOIN postAuthor on news.id = postAuthor.post_id'

		);
		
		if ($limit > 0) {
		    
		      $args['limit'] = [0, $limit];
		   }


		return $this->select($args);

	}

	public function getNewsGriha(){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title', 

						'news.story',
						
						'news.summary',
						
						'news.archieveCategory',

						'news.image',

						'news.added_date',

						'categories.title AS news_category',

					),
					
			'where' => ' griha = "1" AND news.status = "Active"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id'

		);

		return $this->select($args);

	}
	
	public function getTotalResult($args){
        return $this->count($args);
    }

    public function getSearchValue($search_param = array(), $is_die = false){
		$where = "news.status = 'Active'";
		if (isset($search_param['keyword']) && !empty($search_param['keyword'])) {
			$where .= " AND (
					news.title LIKE '%".$search_param['keyword']."%'
					OR news.summary LIKE '%".$search_param['keyword']."%'
					OR news.story LIKE '%".$search_param['keyword']."%'OR categories.title LIKE '%".$search_param['keyword']."%'
						)";
		}

		$args = array(
			'fields' => array(
						'news.id', 
						'news.title',  
	   	                'news.story', 
	   	                'news.summary', 
						'news.image',
						'news.status',
						'news.added_date',
						'categories.title AS news_category'
					),
			'where' 	=> $where,
			'join'   => "LEFT JOIN categories on news.news_category = categories.id"
		);
		$total = $this->getTotalResult($args);
		if (isset($search_param['limit'])) {
			$args['limit'] = $search_param['limit'];
		}
		$data['data'] = $this->select($args);
		$data['count'] = $total;
		return $data;
	}
	
	public function getNewsGrihaLimit($offset, $limit){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title', 

						'news.story',
						
						'news.summary',
						
						'news.archieveCategory',
						
						'news.status',

						'news.image',

						'news.added_date',

						'categories.title AS news_category',

					),
					
			'where' => ' griha = "1" AND news.status = "Active"',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id',
			
			'limit' => array($offset, $limit)

		);

		return $this->select($args);

	}
	
	public function getRecentNewsCategory($id) {

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

						'news.story', 
						
						'news.summary',
						
						'news.archieveCategory',

						'news.image',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',

					),
					
			'where' => ' news_category = "'.$id.'" ',

			'join'	=> 'LEFT JOIN categories on news.news_category = categories.id',
			
			'limit' => array(0, 1)

		);

		return $this->select($args);

	}
	
	public function getRelatedNews($id, $news_id) {
    
    $args = array(
    
        'fields' => array(
    
            'news.id', 
    
            'news.title',  
    
            'news.story',
            
            'news.summary',
            
            'news.archieveCategory',
    
            'news.image',
    
            'news.status',
    
            'news.added_date',
    
            'categories.title AS news_category',
    
        ),
    
        'where' => array(
    
            'news_category' => $id,
    
            'news.id'       => array('value' => $news_id, 'operator' => '!=', ), 
        ),
    
        'join'  => 'LEFT JOIN categories on news.news_category = categories.id',
    
        'limit' => array(0, 2)
    
    );
    
    return $this->select($args);

	}
	
	public function getNewsByDate($date, $lastdate, $offset = false, $limit = false){

		$args = array(
		    
		    'fields' => array(

						'news.id', 

						'news.title',
						
						'news.summary',

						'news.story', 

						'news.image',

						'news.status',
						
						'news.archieveCategory',

						'news.added_date',
						
						'news.news_category',

					),
		    
		    'where' => '( date BETWEEN "'.$date.'" AND "'.$lastdate.'") AND ( archieveCategory = "magazine" )',

		);
		
		if ($limit > 0) {
		      $args['limit'] = [$offset, $limit];
		   }

		return $this->select($args);

	}
	
	public function countInactiveNewsMannKaaKura(){
		$args = array(

			'fields' => array(
				'news.id',
				'news.title',
				'news.summary',
				'news.story',
				'news.image',
				'news.added_date',
			)
		);
		return $this->select($args);
	}

	public function getInactiveNewsMannKaaKura() {

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

	   	                'news.story', 
	   	                
	   	                'news.summary', 

						'news.image',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',

					),

			'where' => ' news.status = "Active" AND news.news_category = "14"',

			'join'   => "LEFT JOIN categories on news.news_category = categories.id"

		);

		return $this->select($args);

	}
	
	public function getActiveNewsMannKaaKura() {

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title',  

	   	                'news.story', 
	   	                
	   	                'news.summary', 

						'news.image',

						'news.status',

						'news.added_date',

						'categories.title AS news_category',

					),

			'where' => 'news.news_category = "14"',

			'join'   => "LEFT JOIN categories on news.news_category = categories.id"

		);

		return $this->select($args);

	}
	
	public function listInactiveNewsMannKaaKura() {

		$args = array(

			'where' => array(
				'status' => 'Inactive'
			)
			
		);

		return $this->select($args);

	}
	
	public function getNavInfo($id, $limit = false){

		$args = array(

			'fields' => array(

						'news.id', 

						'news.title', 

						'categories.image AS cat_image'

					),

			'where' => ' news.news_category = "'.$id.'" AND news.status = "Active"',

			'join'   => "LEFT JOIN categories on news.news_category = categories.id"

		);
		
		if ($limit > 0) {
		      $args['limit'] = [0, $limit];
		   }

		return $this->select($args);

	}

}

class postAuthor extends Database{
	
	public function __construct(){
	
		Database::__construct();
		
		$this->table('postAuthor');

	}
	
	public function addAuthor($data, $is_die = false){

		return $this->insert($data);

	}
	
	public function getAuthorById($id){

		$args = array(
		    
		    'fields' => array(
		        
		        'postAuthor.user_id',
		        
		        'users.full_name as author',
		        
		        'users.id as user_id',
		        
		        'users.userInfo as user_info',
		        
		        'users.image as profile_picture',
		        
		        ),
		        
		    'join'   => "LEFT JOIN users on postAuthor.user_id = users.id",
					
			'where' => ' post_id = "'.$id.'" ',

		);

		return $this->select($args);

	}
	
	public function deleteAuthor($id){

		$args = array(

			'where' => array(

				'post_id' => $id

			),

		);

		return $this->delete($args);

	}
	
}