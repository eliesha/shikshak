<?php 
/**
 * 
 */
class Ads extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('ads');
    }

    public function addAds($data, $is_die = false){
    
        return $this->insert($data);
    
    }
    
    public function updateAds($data, $id, $is_die = false){
        
        $args = array(
        
            'where' => array(
        
                'id' => $id
        
            ),
        
        );
        
        return $this->update($data, $args, $is_die);
    }
    
    public function getAllAds(){
	
		return $this->select();
	
    }
    
    public function deleteAd($id){

		$args = array(

			'where' => array('id' => $id)

		);

		return $this->delete($args);

	}

	public function getAdById($cat_id){

		$args = array(

			'where' => array('id' => $cat_id),

		);

		return $this->select($args);

	}
	
	public function getFrontAds(){

		$args = array(
		    
		    'where' => ' size = "३१३ X २३६ अगाडि" ',

		);

		return $this->select($args);

	}
	
	public function getInnerAds(){

		$args = array(
		    
		    'where' => ' size = "३१३ X २३६ भित्री" ',

		);

		return $this->select($args);

	}
	
	public function getLongAdsFirst(){

		$args = array(
		    
		    'where' => ' size = "९०० X १०० पहिलो" ',

		);

		return $this->select($args);

	}
	
	public function getLongAdsSecond(){

		$args = array(
		    
		    'where' => ' size = "९०० X १०० दोस्रो" ',

		);

		return $this->select($args);

	}
	
	public function getLongAdsThird(){

		$args = array(
		    
		    'where' => ' size = "९०० X १०० तेस्रो" ',

		);

		return $this->select($args);

	}
	
	public function getLongAdsFourth(){

		$args = array(
		    
		    'where' => ' size = "९०० X १०० चौथो" ',

		);

		return $this->select($args);

	}

}