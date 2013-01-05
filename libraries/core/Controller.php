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

Class _Controller {
	public function __construct(){
		$this->load = load_class('Loader',CORE_DIR);
		$this->set  = load_class('Set', CORE_DIR);
	}
}
?>