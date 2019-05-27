<?php 


/**
 * 
 */
class Reset extends Database
{
	
	public function __construct(){
		
		Database::__construct();
		
		$this->table('passwordReset');
	
    }
    
    public function deletePassword($email) {

        $args = array(

            'where' => array('email' == $email)

        );

        return $this->delete($args);

    }

    public function insertData($data) {


        return $this->insert($data);

    }

    public function isValidToken($selector, $expiryDate) {

        $args = array(

            'where' => array(

                'selector' => $selector,

                'expires'  < $expiryDate

            )

        );

        return $this->select($args);

    }

    public function deleteToken($email) {

        $args = array(

            'where' => array(

                'email' => $email

            )

        );

        return $this->delete($args);

    }
    
    public function checkToken($token) {

        $args = array(

            'where' => array(

                'token' => $token

            )

        );

        return $this->delete($args);

    }

    public function deleteEmail($email) {

        $args = array(

            'where' => array(

                'email' => $email

            )

        );

        return $this->delete($args);

    }

}
