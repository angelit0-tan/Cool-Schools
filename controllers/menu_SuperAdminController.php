<?php
Class menu_SuperAdminController extends _Controller {
	#controller for super admin
	public function new_school_profileAction(){
		$this->load->view('/scripts/_SUPER_ADMIN/new_profile');
	}
	
	public function school_listAction(){
		$model = $this->load->model('SuperAdminModel');
		$result['profile'] = $model->school_list();
		$result['type']    = $model->user_type();
		$this->load->view('/scripts/_SUPER_ADMIN/school_list', $result);
	}
	
	#save new school profile
	public function save_newProfileAction(){
		# verify image
		$image ='';
		if ( isset($_FILES['image']['tmp_name']) && !EMPTY($_FILES['image']['tmp_name']) ){
			$file  = $_FILES['image']['tmp_name'];
			$image = addslashes( file_get_contents($_FILES['image']['tmp_name']) );
		}
		
		$school_name =    sanitize( $this->set->post('school_name') );
		$school_country = sanitize( $this->set->post('school_country') );
		$school_address = sanitize( $this->set->post('school_address') );
		$school_description = sanitize ( $this->set->post('school_description') );
		$school_suffix = sanitize ( $this->set->post('school_suffix') );
		$school_contact = sanitize ( $this->set->post('school_contact') );
		$model = $this->load->model('SuperAdminModel');
		$model->save_new_profile( $school_name, $school_country, $school_address, $school_description, $school_suffix, $school_contact , $image );

		//header('Location:' . BASE_URL);	
	}
	
	#edit school profile
	public function _editprofileAction(){
		$school_id 	 = $this->set->post('school_id');
		$school_name =    sanitize( $this->set->post('school_name') );
		$school_country = sanitize( $this->set->post('school_country') );
		$school_address = sanitize( $this->set->post('school_address') );
		$school_suffix = sanitize ( $this->set->post('school_suffix') );
		$school_contact = sanitize ( $this->set->post('school_contact') );
		$model = $this->load->model('SuperAdminModel');
		$model->edit_profile( $school_id, $school_name, $school_country, $school_address, $school_suffix, $school_contact );	
	}
	
	#create news
	public function create_newsAction(){
		$this->load->view('/scripts/_SUPER_ADMIN/create_news');
	}
	
	public function post_newsAction(){
		$user_id   = $_SESSION['user_id'];
		$school_id = sanitize( $this->set->post('school_id') );
		$subject   = sanitize( $this->set->post('subject') );
		$message   = sanitize( $this->set->post('message') );
		$model = $this->load->model('SuperAdminModel');
		$model->post_news( $user_id, $school_id, $subject, $message );
		//header('Location:' . BASE_URL);
	}
	
	#add new user
	public function create_userAction(){
		$school_id = $this->set->post('school_id');
		$type = $this->set->post('usertype');
		$fname = sanitize( $this->set->post('fname') );
		$mname = sanitize( $this->set->post('mname') );	
		$lname = sanitize( $this->set->post('lname') );
		$pass  = sanitize( $this->set->post('password') );
		$pconfirm = sanitize( $this->set->post('pconfirm') );
		$username = sanitize ( $this->set->post('username') );
		$model = $this->load->model('SuperAdminModel');
		$model->create_user( $school_id, $type, $fname, $mname, $lname, $pass, $pconfirm, $username );
	}
	
	#manage user / type / access
	public function manageAction(){
		$this->load->view('/scripts/_SUPER_ADMIN/manage.user.type.access');
	}
	
	#School DropDown List
	public function Dpschool_listAction(){
		$school_name = $this->set->post('country');
		$model = $this->load->model('SuperAdminModel');
		$result = $model->dropdown_school_list( $school_name );
		if ( !is_array($result) ){
			echo "<option> Select a country first </option>";
		}
		$this->load->view('/scripts/_SUPER_ADMIN/listings', $result);
	}
	
	#load all users list
	public function loadusersAction(){
		$school_id = $this->set->post('school_id');
		$model = $this->load->model('SuperAdminModel');
		$result = $model->loadusers_list( $school_id );
		$this->load->view('/scripts/_SUPER_ADMIN/user_lists', $result);
	}
}
?>