<?php 
/**
 * 
 */
class Bookmark extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('bookmark');
    }

    public function checkBookmarkDetails($id, $post_id){
    
        $args = array(
            
        'join'   => "INNER JOIN news on bookmark.post_id = news.id",

        'where' => ' bookmark.user_id = "'.$id.'" AND post_id = "'.$post_id.'"',

		);

		return $this->select($args);
    
    }
    
    public function insertBookmarkDetails($data){

		return $this->insert($data);
    
    }
    
    public function deleteBookmarkDetails($id, $post_id){
        
        $args = array(
            
            'where' => array(
                
                'user_id' => $id,
                
                'post_id' => $post_id
                
                )
            
            );

		return $this->delete($args);
    
    }
    
     public function getBookmarkByUserId($id){
        
        $args = array(
            
                'fields' => array(
                    
                        'news.id', 

						'news.title', 

						'news.story',
						
						'news.summary',

						'news.image',

						'news.added_date',
						
						'(SELECT categories.title FROM categories WHERE id = news.news_category) as news_category'
                    
                    ),
            
                'join'   => "INNER JOIN news on bookmark.post_id = news.id",
                
                'where' => array(
                    
                    'bookmark.user_id' => $id
                    
                    )
            
            );

		return $this->select($args);
    
    }
    
    public function getBookmarkByUserIdLimit($id, $offset, $limit){
        
        $args = array(
            
                'fields' => array(
                    
                        'news.id', 

						'news.title', 

						'news.story',
						
						'news.summary',

						'news.image',

						'news.added_date',
						
						'(SELECT categories.title FROM categories WHERE id = news.news_category) as news_category'
                    
                    ),
            
                'join'   => "INNER JOIN news on bookmark.post_id = news.id",
                
                'where' => array(
                    
                    'bookmark.user_id' => $id
                    
                    ),
                'limit' => [$offset, $limit]
            
            );

		return $this->select($args);
    
    }

}