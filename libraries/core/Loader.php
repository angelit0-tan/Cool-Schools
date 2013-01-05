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

Class Loader{
	public function model( $model_name ){
		$model_name = load_class( $model_name , MODEL_DIR );
		return $model_name;
	}
	
	public function view( $view_file , $data = array() ){
		if ( !file_exists(VIEW_DIR . $view_file. EXT) ) { errorHandler404(); }
		ob_start();
		include( VIEW_DIR . $view_file . EXT );
		ob_end_flush();
	}
	
	public function library ( $lib_name, $lib_directory ){
		$library = load_class( $lib_name, $lib_directory );
		return $library;
	}
	
	public function tmpl_view( $template, $data = array() ) {
		ob_start();
		include( VIEW_DIR . $template . EXT );
		$result = ob_get_contents();
		ob_end_clean();
		return $result;
	}
}
?>