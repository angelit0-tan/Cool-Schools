<?php
Class usersController extends _Controller {
	public function my_wallAction(){
		$this->load->view('/scripts/user_profile/my_wall');
	}
}
?>