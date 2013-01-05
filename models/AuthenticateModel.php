<?php
Class AuthenticateModel extends _Db{
	public function login( $username, $password ){
		$username = stripslashes($username);
		$password = stripslashes($password);
		$result = $this->query("SELECT * FROM cool_users WHERE user_name = '$username' AND user_pass = '$password'");
		return $result;
	}
}
?>