<?php
class Admin_interface extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	

	function login($username , $password){
		if($username == "" || $password == ""){
			return -3;
		}
		$this ->  load -> database();
		
		$query = $this -> db -> get_where('tiandi_admin_user' , array("name" => $username) , 0 , 1);
		$query = $query -> result();
		if(count($query) > 0){
			if($query[0] -> pwd == $password){
				return $query[0];
			}else{
				return -2;	
			}
		}else{
			return -1;
		}
	}

}
?>