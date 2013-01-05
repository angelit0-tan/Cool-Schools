<?php
Class IndexController extends _Controller {
	public function MainAction(){
		$menu = $this->load->model('LayoutModel');
		$result['menu'] = $menu->Menu();
		if ( isset($_SESSION['user']) ){
			if ( isset($_SESSION['user_id']) ){
				$result['right_menu'] = $menu->users_menu( $_SESSION['user_id'] );
				$result['userinfo'] = $menu->userinfo ( $_SESSION['user_id'] );
			}else{
				header("Location:" . BASE_URL . '/Authenticate/logout');
			}
		}else{
			$result['right_menu'] = $this->load->tmpl_view('/scripts/authenticate/index');
		}
	
		$result['home'] = $this->load->tmpl_view('/scripts/Home/index');
		$this->load->view('MainLayouts/layouts', $result);
	}
}
?>