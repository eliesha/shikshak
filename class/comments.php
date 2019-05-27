<?php 
/**
 * 
 */
class Comments extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('comments');
    }

    public function checkCommentskDetails($id, $post_id){
    
        $args = array(
            
            'where' => ' user_id = "'.$id.'" AND post_id = "'.$post_id.'"',

		);

		return $this->select($args);
    
    }
    
    public function insertCommentsDetails($data){

		return $this->insert($data);
    
    }
    
    public function updateCommentsDetails($id, $data){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );

		return $this->update($data, $args);
    
    }
    
    public function deleteCommentsDetails($id){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );

		return $this->delete($args);
    
    }
    
    public function getAllComments(){
        
        $args = array(
            
            'fields' => array(
                    
                    'comments.id', 

					'comments.comment',
					
					'comments.status',
					
					'(SELECT news.title FROM news WHERE post_id = news.id) as comment_title',
					
					'(SELECT users.full_name FROM users WHERE id = comments.user_id) as commentator'
                
                ),
            
            );
        
        return $this->select($args);
        
    }
    
     public function getCommentsByUserId($id){
        
        $args = array(
            
                'fields' => array(

						'comments.comment', 
						
						'news.title as post_title'
                    
                    ),
                
                'where' => array(
                    
                    'comments.user_id' => $id
                    
                    ),
                'join'   => "LEFT JOIN news on comments.post_id = news.id"
            
            );

		return $this->select($args);
    
    }
    
    public function getCommentById($id){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );

		return $this->select($args);
    
    }
    
    public function getCommentPostById($id, $limit = false){
        
        $args = array(
            
            'fields' => array(
                
                'comments.id',
                'comments.comment',
                'users.image as profile',
                '(SELECT users.full_name FROM users WHERE id = comments.user_id) as commentator',
                
                ),
                
            'where' => ' comments.status = "Active" AND comments.post_id = "'.$id.'"',
            'join'   => "LEFT JOIN users on comments.user_id = users.id"
            
            );
            
        if($limit > 0){
            
            $args['limit'] = [0, $limit];
            
        }

		return $this->select($args);
    
    }

}