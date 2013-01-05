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

	function load_class( $class, $directory = '' ){
		if( file_exists( $directory . $class . EXT ) )
		{
			include_once( $directory . $class . EXT );
			if( class_exists( $class ) ) {
				return new $class;
			}
		}
	}

	function include_class_method( $class, $method ){
		$class = load_class( $class.'Controller', CONTROLLER_DIR );
		if( method_exists($class, $method) ){
			$class->$method();
		}else{
			redirect_home();
		}
	}
	
	function sanitize( $string ){
		$replace = array ("'",";","/","%");
		return str_replace( $replace, "", $string );
	}
	
	function _unset( $unset ){
		foreach( explode(',',$unset) as $var ){
			unset($var);
		}
	}
	
	function limit_str ( $data, $num ){
		$char = '';
		$char_complete = $data;
		$char = substr($data, 0 , $num);
		return array($char, $char_complete);
	}
	
	function format_time ( $time ){
		//$time = "12:00 AM";
		if ( strlen($time) > 0 ) {
			list($hour , $min) = explode(':' , $time);
			$state = explode(' ' , $min);
			$var['PM'] = array('12=12', '1=13', '2=14', '3=15','4=16','5=17','6=18','7=19','8=20','9=21','10=22','11=23');
			$var['AM'] = array('12=24', '1=1', '2=2', '3=3','4=4','5=5','6=6','7=7','8=8','9=9','10=10','11=11');
			
			$vT = count($var[$state[1]]);
			for ( $i = 0; $i < $vT; $i++){
				list ( $variable , $value ) = explode('=', $var[$state[1]][$i]);
				if ( $variable == $hour ){
					$sethr = $value * 3600;
					$setmin = $min * 60;
					$hm = $sethr + $setmin;
				}
			}
			return $hm;
		}
	}
	
	function errorHandler($err){
		
		echo " 404! Not found";
		/*
		switch ( $err_no ){
			case 404:
				echo " ERROR 404 NOT FOUND, CONTACT THE ADMINISTRATOR FOR THIS !!";
				break;
			case 403: 
			break;	
		}*/
	}
	
	function redirect_home(){
		header("Location:" . BASE_URL );
	}

?>