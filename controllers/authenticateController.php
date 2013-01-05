<?php
Class AuthenticateController extends _Controller {
	public function verifyAction(){
		$username = sanitize($this->set->post('username'));
		$password = sanitize($this->set->post('password'));
		$model = $this->load->model('AuthenticateModel');
		if( !EMPTY($username) && !EMPTY($password) ){
			$result = $model->login( $username, $password );
		}
		
		if ( isset($result[0]) > 0){
			$_SESSION['user'] = $username;
			$_SESSION['user_id'] = $result[0]['user_id'];
			$_SESSION['school_id'] = $result[0]['school_id'];
			header("Location:" . BASE_URL);
		}else{
			header("Location:" . BASE_URL . '/Authenticate/failed');
		}
	}
	
	public function failedAction(){
		$menu = $this->load->model('LayoutModel');
		$result['menu'] = $menu->Menu();
		if ( isset($_SESSION['user']) ){
			$result['right_menu'] = $menu->users_menu();
		}else{
			$result['right_menu'] = $this->load->tmpl_view('/scripts/authenticate/login-failed');
		}
		$result['home'] = $this->load->tmpl_view('/scripts/Home/index');
		$this->load->view('MainLayouts/layouts', $result);
	}
	
	public function logoutAction(){
		unset($_SESSION['user']);
		unset($_SESSION['user_id']);
		unset($_SESSION['school_id']);
		header("Location:" . BASE_URL);
	}
}
?>