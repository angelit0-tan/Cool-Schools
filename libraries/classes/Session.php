<?php
/******************************************************************
	ABOUT THE AUTHOR
	WRITTEN and DEVELOPED by : Tan, Angelito S.
	EMAIL ADDRESS: angelito.tan23@yahoo.com
	
	OPEN SOURCE FRAMEWORK
	PHP VERSION: Written in PHP 5.3.5
	
	PURPOSE: To help other's who want to create there own framework
	
	YEAR CREATION: 2011
*******************************************************************/

Class Session{

	public function __construct(){
		session_start();
	}
	
	public function setdata( $session = array() ){
		if (is_array( $session )){
			foreach ( $session as $sess_name => $sess_data ){
				$_SESSION[$sess_name] = $sess_data;
			}
		}
	}
	
	public function destroy(){
		session_destroy();
	}
	
	public function _unset($session_name){
		unset($_SESSION[$session_name]);
	}
}
?>