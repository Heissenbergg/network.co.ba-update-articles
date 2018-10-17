<?php

class User{
	private $_pdo, $_query;
	public $_id, $_username, $_password, $_name, $_surname, $_doctor;
	public function __construct($username = null){
		$this->_pdo = DB::getInstance();
		$this->_query = $this->_pdo -> query("wp1x_users");
		if($username){
        	while($user = $this->_query -> fetch()){
        		if($user['user_login'] == $username){
        			$this->_id = $user['ID'];
        			$this->_username = $username;
        		}
        	}
		}else{

		}
	}

	public function id(){return $this->_id;}
	public function username(){return $this->_username;}
	public function get_name_and_surname(){
	    return $this->_username;
	}


	public function login($username, $password){

		$this->_query = $this->_pdo -> query("wp1x_users");
		while($user = $this->_query-> fetch()){
			if($user['user_login'] == $username and $user['user_pass'] == $password){
				$this->_username = $username;
				Session::setUsername($username);
                return true;
			}
		} return false;
	}
}