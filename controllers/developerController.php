<?php
Class developerController extends _Controller {
	public function indexAction(){
		$menu = $this->load->model('LayoutModel');
		$result['menu'] = $menu->Menu();
		if ( isset($_SESSION['user']) ){
			$result['right_menu'] = $menu->users_menu( $_SESSION['user_id'] );
			$result['userinfo'] = $menu->userinfo ( $_SESSION['user_id'] );
		}else{
			$result['right_menu'] = $this->load->tmpl_view('/scripts/authenticate/index');
		}
		$result['home'] = $this->load->tmpl_view('/scripts/developer/index');
		$this->load->view('MainLayouts/layouts', $result);
	}
}
?>