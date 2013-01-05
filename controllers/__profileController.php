<?php
Class __profileController extends _Controller {
	public function profileAction(){
		$menu = $this->load->model('ProfileModel');
		$result['menu'] = $menu->Menu();
		if ( isset($_SESSION['user']) ){
			if ( isset($_SESSION['user_id']) ){
				$model = $this->load->model('ProfileModel');
				$result['user_info'] = $model->check_exist($this->set->get('id'));
				//print_r ($result['user_info']);
				if ( $_SESSION['user_id'] == $this->set->get('id') ){
					$this->load->view('/scripts/user_profile/my_profile', $result);
				}else{
					if ( is_array($result['user_info']) ) {
						$result['user_info'] = $model->check_exist($_SESSION['user_id']);
						$result['friend_id'] =  $this->set->get('id');
						$result['add_friend'] = $model->check_list( $_SESSION['user_id'], $result['friend_id'] );
						$result['friend_name'] = $model->check_exist( $result['friend_id'] );
						//echo ( $result['add_friend'] );
						$this->load->view('/scripts/user_view_profile/view_profile', $result);
					}else{
						echo 'sorry page doesnt found';
					}
				}
			}else{
				header("Location:" . BASE_URL . '/Authenticate/logout');
			}
		}else{
			//$result['right_menu'] = $this->load->tmpl_view('/scripts/authenticate/index');
			//header("Location:" . BASE_URL . '/scripts/authenticate/index');
		}
	}
	
	public function add_friendAction(){
		$model = $this->load->model('ProfileModel');
		$model->add_friend( $_SESSION['user_id'], $this->set->post('id') );
	}
	
	//user
	public function uprepend_postAction(){
		$post = $this->set->get('m_i_stat');
		$model = $this->load->model('ProfileModel');
		$model->uprepend_post( $_SESSION['user_id'], $post, date('Y-m-d H:i:s'));
	}
	
	public function u_wallAction(){
		$user_id = $_SESSION['user_id'];
		$model = $this->load->model('ProfileModel');
		$result['wall'] = $model->uwall($user_id);
		$this->load->view('/scripts/user_profile/my_data', $result);
	}
	
	//view prepend
	public function vprepend_postAction(){
		$post = $this->set->get('m_i_stat');
		$friend_id =  $this->set->get('id');
		//$friend_id = 19;
		$model = $this->load->model('ProfileModel');
		$model->vprepend_post( $_SESSION['user_id'], $friend_id , $post, date('Y-m-d H:i:s') );
	}
	
	public function v_wallAction(){
		$friend_id =  $this->set->get('id');
		$model = $this->load->model('ProfileModel');
		$result['wall'] = $model->uwall($friend_id);
		$this->load->view('/scripts/user_view_profile/view_data', $result);
	}
	// comment sent
	public function u_sent_cmntAction(){
		$user_id = $_SESSION['user_id'];
		$wall_id = explode('_', $this->set->post('xid'));
		$wall_comment = $this->set->post('c');
		$model = $this->load->model('ProfileModel');
		$model->u_sent_cmnt( $wall_id, $user_id, $wall_comment, date('Y-m-d H:i') );
	}
	//delete comment
	public function u_del_cmntAction(){
		$id = $this->set->post('comment_id');
		$model = $this->load->model('ProfileModel');
		$model->u_del_cmnt( $id );
	}
	//personal info
	public function u_infoAction(){
		$user_id = $_SESSION['user_id'];
		//$model = $this->load->model('ProfileModel');
		$this->load->view('/scripts/user_profile/my_info');
	}
	
	//delete wall
	public function u_del_wallAction(){
		$id = $this->set->get('wall_id');
		$model = $this->load->model('ProfileModel');
		$model->u_del_wall( $id );
	}
	
	//friends list with pending request
	public function u_friendlistAction(){
		$model = $this->load->model('ProfileModel');
		$result = $model->u_friendlist($_SESSION['user_id']);
		$this->load->view('/scripts/user_profile/my_friendlist', $result);
	}
	//view friends, friends list
	public function v_friendlistAction(){
		$model = $this->load->model('ProfileModel');
		$result = $model->u_friendlist( $this->set->get('id') );
		$this->load->view('/scripts/user_view_profile/view_friendlist', $result);
			
	}
	public function s_listAction(){
		$model = $this->load->model('ProfileModel');
		$model->s_list($this->set->get('id'));
	}
	//confirm friend request
	public function c_friendAction(){
		$model= $this->load->model('ProfileModel');
		$id= explode('_',$this->set->post('rr'));
		$model->c_friend( $id[0], $id[1], $id[2] );
	}
}
?>