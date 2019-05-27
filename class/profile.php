<?php 


class Profile extends Database
{
	public function __construct(){
		Database::__construct();
		$this->table('profile');
	}

	public function addProfile($data, $is_die = false){
		return $this->insert($data, $is_die);
	}

	public function updateProfile($data, $id, $is_die = false){
		$args = array(
			'where' => array(
				'id' => $id
			),
		);
		return $this->update($data, $args, $is_die);
	}

	public function deleteProfile($id){
		$args = array(
			'where' => array(
				'id' => $id
			)
		);
		return $this->delete($args);
	}

	public function getProfileById($id){
		$args = array(
		    
		    'fields' => array(

						'profile.id', 

						'profile.title',
						
						'profile.summary',

						'profile.story', 

						'profile.image',
						
						'profile.added_by',

						'profile.status',

						'profile.added_date',

						'(SELECT users.full_name FROM users WHERE id = profile.added_by) as author',

					),

			'where' => array(

				'id' => $id

			),

		);
		return $this->select($args);
	}
	
	public function getAllProfile(){
		$args = array(
			'where' => array(
				'status' => "सक्रिय"
			),
		);
		return $this->select($args);
	}
}