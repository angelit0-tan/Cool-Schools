<?php
Class LayoutModel extends _Db{
	public function Menu(){
		$result = $this->query("SELECT * FROM cool_menu");
		return $result;
	}
	
	public function users_menu( $user_id ){
		$result = $this->query("SELECT * 
								FROM cool_users_menu 
								INNER JOIN cool_school_module ON cool_users_menu.module_id = cool_school_module.module_id
								WHERE cool_users_menu.user_id = $user_id");
								
		return $result;
	}
	
	public function userinfo( $user_id ){
		$result = $this->query("SELECT * FROM cool_users WHERE user_id = $user_id");
		return $result;
	}
	
}
?>