<?php 
/**
 * 
 */
class Book extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('book');
    }

    public function addBook($data, $is_die = false){
    
        return $this->insert($data);
    
    }
    
    public function updateBook($data, $id, $is_die = false){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );
    
        return $this->update($data, $args, $is_die);
    
    }
    
    public function getAllBook(){
    
        return $this->select();
    
    }
    
    public function getBookById($id){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );
    
        return $this->select($args);
    
    }
    
    public function deleteBook($id){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );
    
        return $this->delete($args);
    
    }
    
    public function getBookForNav($limit = false){
        
        $args = array();
        
        if ($limit !== null && $limit > 0) {
            
          $args['limit'] = [0, $limit];
          
       }
    
        return $this->select($args);
    
    }

}