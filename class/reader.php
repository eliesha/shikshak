<?php 
class Reader extends Database{
	public function __construct(){
		Database::__construct();
		$this->table('reader');
	}
	public function addReader($data){
		return $this->insert($data);
	}
}