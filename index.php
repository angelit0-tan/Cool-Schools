<?php
include_once 'config.php';
class request_handler{
	public function request_handler(){
		//require_once (LIB_DIR . 'config' .EXT);
		$route = new Router;
		$session = new Session;
		$segments = $route->urlRoute();
		#check if controller/action exist
		#if not use default_controller / default_action
		if( count($segments) == 0 || count($segments) == 1 ){
			include_class_method( default_controller , default_action );
		}else{
		#if controller/action exist in the url
		#then check the controller if it's existed in the file
			if( file_exists( CONTROLLER_DIR . $segments[0] . CONT_EXT ) )
			{
				#check for segments[1] = actions
				#if segments[1] exist, logically segments[0] which is the controller is also exist!!
				//if( isset($segments[1]) ){
					include_class_method( $segments[0], $segments[1] . 'Action' );
				//}
			}else{
				errorHandler(CONTROLLER_DIR . $segments[0] . CONT_EXT);
			}
		}
	}
}
$rh = new request_handler;
?>

