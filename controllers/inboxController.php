<?php
Class inboxController extends _Controller {
	#inbox / messages
	public function inbox_msgAction(){
		$user_id = $_SESSION['user_id'];
		$model = $this->load->model('InboxModel');
		$result = $model->load_inbox( $user_id );
		$this->load->view('/scripts/_SHARED_MODULE/inbox_msg/index', $result);
	}
	
	public function inbox_archieveAction(){
		$inbox_id = $this->set->get('id');
		$model = $this->load->model('InboxModel');
		$result = $model->load_msgs ( $inbox_id );
		$this->load->view('/scripts/_SHARED_MODULE/inbox_msg/view_archieve', $result);
	}
	
	public function sendReplyAction(){
		$inbox_id = $this->set->post('inboxid');
		$user_id = $_SESSION['user_id'];
		$reply_msg = sanitize( $this->set->post('replymsg') );
		$model = $this->load->model('InboxModel');
		$model->reply_msg( $inbox_id, $user_id, $reply_msg );
	}
}