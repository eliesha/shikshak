<?php 
/**
 * 
 */
class Series extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('series');
    }

    public function addSeries($data, $is_die = false){
    
        return $this->insert($data);
    
    }
    
    public function updateSeries($data, $id, $is_die = false){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );
    
        return $this->update($data, $args, $is_die);
    
    }
    
    public function getAllSeries(){
    
        return $this->select();
    
    }
    
    public function getSeriesById($id){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );
    
        return $this->select($args);
    
    }
    
    public function deleteSeries($id){
        
        $args = array(
            
            'where' => array(
                
                'id' => $id
                
                )
            
            );
    
        return $this->delete($args);
    
    }
    
    public function getSeriesForNav($limit = false){
        
        $args = array();
        
        if ($limit !== null && $limit > 0) {
            
          $args['limit'] = [0, $limit];
          
       }
    
        return $this->select($args);
    
    }
    
    public function getAnkaByDate($date, $lastdate){

		$args = array(
		    
		    'where' => ' added_date BETWEEN "'.$date.'" AND "'.$lastdate.'"' 

		);

		return $this->select($args);

	}
    
    public function getAnkaByYear($year){

		$args = array(
		    
		    'where' => ' YEAR(added_date) = "'.$year.'"'  

		);

		return $this->select($args);

	} 

}