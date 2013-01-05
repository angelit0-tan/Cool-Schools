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

Class URI{
	var $uri;
	var $segments = array();
	var $params   = array();
	
	public function __construct(){
		$this->uri = $_SERVER['QUERY_STRING'];
	}
	
	public function getURI(){
		if ( isset($this->uri) ){
			//echo $this->validate_URI($this->uri);
			//$this->uri = $this->validate_URI( $this->uri );
			foreach ( explode('/', $this->validate_URI( $this->uri )) as $val )
			{
				if ( $val != '' )
				{
						$var = explode('&', $val);
						$this->segments[] = $var[0];
				}
			}
			return $this->segments;
		}
	}
	
	public function validate_URI( $URI ){
		if (!EMPTY ( $URI )){
			//$find = array("'",";","@","*","(",")","^");
			$find = array("'",";","*","(",")","^","%");
			return str_replace($find ,"/", $URI);
		}
	}
	
	
	public function getParams( $segments ){
	
	}
	
}
?>