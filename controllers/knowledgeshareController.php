<?php
Class knowledgeshareController extends _Controller {
	public function knowledgeAction(){
		$this->load->view('/scripts/_SHARED_MODULE/knowledgeshare/index');
	}
	#show discussion knowledgeshare
	public function discussionAction(){
		$school_id = $_SESSION['school_id'];
		$knowledgetype = $this->set->get('category');
		$model = $this->load->model('KnowledgeShareModel');
		$result = $model->loadKnowledge( $school_id, $knowledgetype );
		$this->load->view('/scripts/_SHARED_MODULE/knowledgeshare/discussion', $result);
	}
	#show ideas knowledgeshare
	public function ideaAction(){
		$school_id = $_SESSION['school_id'];
		$knowledgetype = $this->set->get('category');
		$model = $this->load->model('KnowledgeShareModel');
		$result = $model->loadKnowledge( $school_id, $knowledgetype );
		$this->load->view('/scripts/_SHARED_MODULE/knowledgeshare/ideas', $result);
	}
	
	#show question knowledgeshare
	public function questionAction(){
		$school_id = $_SESSION['school_id'];
		$knowledgetype = $this->set->get('category');
		$model = $this->load->model('KnowledgeShareModel');
		$result = $model->loadKnowledge( $school_id, $knowledgetype );
		$this->load->view('/scripts/_SHARED_MODULE/knowledgeshare/question', $result);
	}
	
	#view the posting
	public function createAction(){
		$this->load->view('/scripts/_SHARED_MODULE/knowledgeshare/post_new');
	}
	
	# post a New knowledge
	public function postnewAction(){
		$model = $this->load->model('KnowledgeShareModel');
		$knowledgetype = $this->set->post('category');
		$share_type = $this->set->post('share_type');
		$subject = sanitize ( $this->set->post('subject') );
		$message = sanitize ( $this->set->post('message') );
		$user_id = $_SESSION['user_id'];
		$school_id = $_SESSION['school_id'];
		
		$model->knowledgepost($user_id, $knowledgetype, $subject, $message, $share_type, $school_id );
	}
	
	#for viewing
	public function viewAction(){
		$knowledgetype = $this->set->get('sharetype');
		$id 	       = $this->set->get('id');
		$model = $this->load->model('KnowledgeShareModel');
		$result = $model->knowledgeview( $knowledgetype, $id );
		$this->load->view( '/scripts/_SHARED_MODULE/knowledgeshare/view', $result );
	}
	
	#post new comment
	public function newCommentAction(){
		$share_type = $this->set->post('share_type');
		$comment    = sanitize ( $this->set->post('comment') );
		$knowledge_id = $this->set->post('knowledge_id');
		$user_id	= $_SESSION['user_id'];
		$model = $this->load->model('KnowledgeShareModel');
		$model->postcomment ( $user_id , $knowledge_id, $share_type, $comment );
	}
	
	#delete comment
	public function deleteCommentAction(){
		$comment_id = $this->set->post('comment_id');
		$model = $this->load->model('KnowledgeShareModel');
		$model->deleteComment( $comment_id );
	}
}
?>