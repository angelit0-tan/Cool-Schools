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

Class Router{
	#load URI
	public function __construct(){
		$this->uri = load_class('URI', CORE_DIR);
	}
	
	public function urlRoute(){
		return $this->segments = $this->uri->getURI();
	}
	
	public function urlParams(){
	
	}
}
?>