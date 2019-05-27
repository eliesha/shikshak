<?php 
/**
 * 
 */
class Article extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('article');
    }
    
}