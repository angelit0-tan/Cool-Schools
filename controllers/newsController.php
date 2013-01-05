<?php
Class newsController extends _Controller {
	public function indexAction(){
		$menu = $this->load->model('LayoutModel');
		$news = $this->load->model('NewsModel');
		$result['menu'] = $menu->Menu();
		if ( isset($_SESSION['user']) ){
			$result['right_menu'] = $menu->users_menu( $_SESSION['user_id'] );
			$result['news'] = $news->show_news( $_SESSION['user_id'] );
			$result['userinfo'] = $menu->userinfo ( $_SESSION['user_id'] );
		}else{
			$result['news'] = $news->show_news();
			$result['right_menu'] = $this->load->tmpl_view('/scripts/authenticate/index');
		}
		
		$result['home'] = $this->load->tmpl_view('/scripts/news/index', $result['news']);
		$this->load->view('MainLayouts/layouts', $result);
	}
}
?>