<?php
Class __adminController extends _Controller {
#News
	#show the first page all list
	public function manage_newsindexAction(){
		$news = $this->load->model('NewsModel');
		$result = $news->show_news( $_SESSION['user_id'] );
		$this->load->view('/scripts/_ADMIN/Manage_News/index', $result);
	}
	
	#just show the data
	public function view_newsAction(){
		$news = $this->load->model('NewsModel');
		$result = $news->view_news( $this->set->post('news_id') );
		$this->load->view('/scripts/_ADMIN/Manage_News/view', $result);
	}
	
	#just show the edit form
	public function edit_newsAction(){
		$news = $this->load->model('NewsModel');
		$result = $news->view_news( $this->set->post('news_id') );
		$this->load->view('/scripts/_ADMIN/Manage_News/edit', $result);
	}
	
	#for POSTING A NEW NEWS!!
	public function post_newsAction(){
		$news = $this->load->model('NewsModel');
		$subject = $this->set->post('subject');
		$content = $this->set->post('message');
		$news->post_news( $_SESSION['school_id'], $_SESSION['user_id'], $subject, $content );
	}
	
	#for editing the NEWS
	public function update_newsAction(){
		$news = $this->load->model('NewsModel');
		$subject = $this->set->post('subject');
		$content = $this->set->post('message');
		$news_id = $this->set->post('news_id');
		$news->update_news( $_SESSION['school_id'], $subject, $content, $news_id );
	}
	
	#show create news form
	public function postnewAction(){
		$this->load->view('/scripts/_ADMIN/Manage_News/create_news');
	}
#---end for news functions
#Teachers
	#show Manage Teachers form
	#the first page, with all the list of teachers
	public function m_indexAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->teacher_lists( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Manage_Teachers/index', $result);
	}
	
	#show Add new teacher / prof form
	public function m_newAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->statuslist();
		$this->load->view('/scripts/_ADMIN/Manage_Teachers/new', $result);
	}
	
	#show edit form teacher / prof
	public function m_editAction(){
		$id = $this->set->get('id');
		$admin = $this->load->model('AdminModel');
		$result['info'] = $admin->retrive_info( $id );
		$result['status'] = $admin->statuslist();
		$this->load->view('/scripts/_ADMIN/Manage_Teachers/edit', $result);
	}
	
	#save new teacher
	public function m_saveAction(){
		$admin = $this->load->model('AdminModel');
		$image ='';
		if ( isset($_FILES['browse']['tmp_name']) && !EMPTY($_FILES['browse']['tmp_name']) ){
			//$file  = $_FILES['browse']['tmp_name'];
			$image = addslashes( file_get_contents($_FILES['browse']['tmp_name']) );
		}
		$school_id = $_SESSION['school_id'];
		$status_id = $this->set->post('status');
		$lname = $this->set->post('lname');
		$fname = $this->set->post('fname');
		$mname = $this->set->post('mname');
		$bday = $this->set->post('bday');
		$address = $this->set->post('address');
		$contact = $this->set->post('contact');
		$username = $this->set->post('username');
		$password = $this->set->post('password');
		$admin->savenew_teacher( $school_id, $status_id, $lname, $fname, $mname, $bday, $address, $contact, $username, $password, $image );
	}
	
	//for update
	public function m_updateAction(){
		$admin = $this->load->model('AdminModel');
		$image ='';
		if ( isset($_FILES['browse']['tmp_name']) && !EMPTY($_FILES['browse']['tmp_name']) ){
			//$file  = $_FILES['browse']['tmp_name'];
			$image = addslashes( file_get_contents($_FILES['browse']['tmp_name']) );
		}
		$user_id = $this->set->post('user_id');
		$status_id = $this->set->post('status');
		$lname = $this->set->post('lname');
		$fname = $this->set->post('fname');
		$mname = $this->set->post('mname');
		$bday = $this->set->post('bday');
		$address = $this->set->post('address');
		$contact = $this->set->post('contact');
		$username = $this->set->post('username');
		$password = $this->set->post('password');
		$admin->__update_teacher( $user_id, $status_id, $lname, $fname, $mname, $bday, $address, $contact, $username, $password, $image );
	}
	#for assigning form
	public function m_assignAction(){
		$id = $this->set->get('id');
		//$admin = $this->load->model('AdminModel');
		$this->load->view('/scripts/_ADMIN/Manage_Teachers/assign', $id);
	}
	#for viewing form
	public function m_viewAction(){
		$id = $this->set->get('id');
		//$admin = $this->load->model('AdminModel');
		$this->load->view('/scripts/_ADMIN/Manage_Teachers/view', $id);
	}
	#choose section
	public function m_sectionAction(){
		$section_type = $this->set->get('id');
		$user_id = $this->set->get('user_id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->subject_avail( $_SESSION['school_id'], $section_type, $user_id );
		$this->load->view('/scripts/_ADMIN/Manage_Teachers/subject_list', $result);
	}	
	
	public function m_save_subjectAction(){
		$user_id = $this->set->post('user_id');
		$subjects = $this->set->post('s_id');
		$admin = $this->load->model('AdminModel');
		$admin->save_subject( $user_id, $subjects );
	}
	
	public function m_retrieveAction(){
		$user_id = $this->set->get('user_id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->retrieve_subjects( $_SESSION['school_id'], $user_id );
		$this->load->view('/scripts/_ADMIN/Manage_Teachers/schedule_list', $result);
	}
#--end for teachers functions
#for period
	public function p_indexAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->p_list( $_SESSION['school_id'] );
		$result = $this->load->tmpl_view('/scripts/_ADMIN/Open_Period/season_list', $result);
		$this->load->view('/scripts/_ADMIN/Open_Period/index', $result);
	}
	#show edit form
	public function p_editAction(){
		$admin = $this->load->model('AdminModel');
		$period_id = $this->set->get('p_id');
		$result = $admin->p_edit( $period_id );
		$this->load->view('/scripts/_ADMIN/Open_Period/edit', $result);
	}
	
	#show new form
	public function p_newAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->p_getp_type( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Open_Period/new', $result);
	}
	#update
	public function p_updateAction(){
		$admin = $this->load->model('AdminModel');
		$period_id = $this->set->post('p_id');
		$year = $this->set->post('year');
		$season_desc = $this->set->post('season_desc');
		$status= $this->set->post('status');
		$admin->p_update( $period_id, $year, $season_desc, $status );
	}
	
	public function p_saveAction(){
		$admin = $this->load->model('AdminModel');
		$year = $this->set->post('year');
		$season_desc = $this->set->post('season_desc');
		$status= $this->set->post('status');
		$admin->p_save( $_SESSION['school_id'] , $year, $season_desc, $status );
	}
#---end for period functions

#for MANAGE SUBJECTS
	#first page
	public function s_indexAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->s_index( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Manage_Subjects/index', $result);
	}
	#show new subject form
	public function s_newAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->s_get_data( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Manage_Subjects/new', $result);
	}
	#show edit form
	public function s_editAction(){
		$season_subj_id = $this->set->get('id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->s_edit($_SESSION['school_id'], $season_subj_id);
		$this->load->view('/scripts/_ADMIN/Manage_Subjects/edit', $result);
	}
	#save new subject
	public function s_saveAction(){
		$subject_id = $this->set->post('subject_id');
		$lecture_days = $this->set->post('lec_days');
		$lec_time_from = format_time( $this->set->post('lec_time_from') );
		$lec_time_to   = format_time( $this->set->post('lec_time_to') );
		$lecture_room = $this->set->post('lect_room');
		$laboratory_day = $this->set->post('lab_day');
		$laboratory_time_from = format_time( $this->set->post('lab_time_from') );
		$laboratory_time_to = format_time( $this->set->post('lab_time_to') );
		$laboratory_room = $this->set->post('lab_room');
		$dissolve = $this->set->post('dissolve');
		$section_type = $this->set->post('section_type');
		$section 	 = $this->set->post('section');
		$admin = $this->load->model('AdminModel');
		$admin->s_save( $_SESSION['school_id'], $section_type, $subject_id, $lec_time_from, $lec_time_to, $lecture_room, $laboratory_day, $laboratory_room, $laboratory_time_from, $laboratory_time_to , $dissolve, $section, $lecture_days );
	}
	
	#update
	public function s_updateAction(){
		$subject_id = $this->set->post('subject_id');
		$lecture_day = $this->set->post('lec_day');
		$lec_time_from = format_time( $this->set->post('lec_time_from') );
		$lec_time_to   = format_time( $this->set->post('lec_time_to') );
		$lecture_room = $this->set->post('lect_room');
		$laboratory_day = $this->set->post('lab_day');
		$laboratory_time_from = format_time( $this->set->post('lab_time_from') );
		$laboratory_time_to = format_time( $this->set->post('lab_time_to') );
		$laboratory_room = $this->set->post('lab_room');
		$dissolve = $this->set->post('dissolve');
		$section_type = $this->set->post('section_type');
		$section 	 = $this->set->post('section');
		$admin = $this->load->model('AdminModel');
		$season_subj_id = $this->set->post('subj_id');
		$admin->s_update( $season_subj_id, $section_type, $subject_id, $lec_time_from, $lec_time_to, $lecture_room, $laboratory_day, $laboratory_room, $laboratory_time_from, $laboratory_time_to , $dissolve, $section, $lecture_day );
	}
	
	#choose section
	public function c_sectionAction(){
		$section_type = $this->set->get('id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->c_section( $_SESSION['school_id'], $section_type );
		$this->load->view('/scripts/_ADMIN/Manage_Subjects/subject_list', $result);
	}	
	
#-- end for manage subjects

#Master Room List
	public function mrl_indexAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->mrl_index( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Room_list/index', $result);
	}
	public function mrl_newAction(){
		$this->load->view('/scripts/_ADMIN/Room_list/new');
	}
	public function mrl_editAction(){
		$room_id = $this->set->get('id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->mrl_edit( $room_id );
		$this->load->view('/scripts/_ADMIN/Room_list/edit', $result);
	}
	public function mrl_saveAction(){
		$room_no = $this->set->post('room_no');
		$building_name = $this->set->post('building_name');
		$admin = $this->load->model('AdminModel');
		$admin->mrl_save( $_SESSION['school_id'], $room_no, $building_name );
	}
	public function mrl_updateAction(){
		$room_no = $this->set->post('room_no');
		$building_name = $this->set->post('building_name');
		$room_id = $this->set->post('room_id');
		$admin = $this->load->model('AdminModel');
		$admin->mrl_update( $room_id, $room_no, $building_name );
	}
#--- end for Master Room List

#Master Subject List
	public function sl_indexAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->sl_index( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Subject_List/index', $result);
	}
	public function sl_newAction(){
		$this->load->view('/scripts/_ADMIN/Subject_List/new');
	}
	public function sl_editAction(){
		$id = $this->set->get('id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->sl_edit( $id );
		$this->load->view('/scripts/_ADMIN/Subject_List/edit', $result);
	}
	public function sl_saveAction(){
		$subj_code = $this->set->post('subj_code');
		$subj_desc = $this->set->post('subj_desc');
		$no_unit   = $this->set->post('no_unit');
		$per_unit  = $this->set->post('per_unit');
		$w_lab	   = $this->set->post('w_lab') == 'true'  ? 1 : 0 ;
		$lab_no_unit = $this->set->post('lab_no_unit');
		$lab_per_unit = $this->set->post('lab_per_unit');
		$year_level = $this->set->post('year_lvl');
		$admin = $this->load->model('AdminModel');
		$admin->sl_save( $_SESSION['school_id'], $subj_code, $subj_desc, $no_unit, $per_unit, $w_lab, $lab_no_unit, $lab_per_unit, $year_level );
	}
	
	public function sl_updateAction(){
		$subj_code = $this->set->post('subj_code');
		$subj_desc = $this->set->post('subj_desc');
		$no_unit   = $this->set->post('no_unit');
		$per_unit  = $this->set->post('per_unit');
		$w_lab	   = $this->set->post('w_lab') == 'true'  ? 1 : 0 ;
		$lab_no_unit = $this->set->post('lab_no_unit');
		$lab_per_unit = $this->set->post('lab_per_unit');
		$subject_id = $this->set->post('s_id');
		$year_level = $this->set->post('year_lvl');
		$admin = $this->load->model('AdminModel');
		$admin->sl_update( $subject_id, $subj_code, $subj_desc, $no_unit, $per_unit, $w_lab, $lab_no_unit, $lab_per_unit, $year_level );
		//$admin->sl_update( $s_id, $subj_code, $subj_desc, $no_unit, $per_unit, $w_lab, $lab_no_unit, $lab_per_unit )
	}
	
	public function sl_viewAction(){
		$year_level = $this->set->get('year_level');
		$admin = $this->load->model('AdminModel');
		$result = $admin->sl_view( $year_level, $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Subject_List/list', $result);
		//$this->load->view('/scripts/_ADMIN/Subject_List/index', $result);
	}
#--END FOR Master Subject List
#-- FOR MANAGE STUDENTS
	public function ms_indexAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->ms_index( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Manage_Students/index', $result);
	}
	
	public function ms_newAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->ms_new();
		$this->load->view('/scripts/_ADMIN/Manage_Students/new', $result);
	}
	
	public function ms_saveStudentAction(){
		$admin = $this->load->model('AdminModel');
		$image ='';
		if ( isset($_FILES['browse']['tmp_name']) && !EMPTY($_FILES['browse']['tmp_name']) ){
			//$file  = $_FILES['browse']['tmp_name'];
			$image = addslashes( file_get_contents($_FILES['browse']['tmp_name']) );
		}
		$school_id = $_SESSION['school_id'];
		$status_id = $this->set->post('status');
		$lname = $this->set->post('lname');
		$fname = $this->set->post('fname');
		$mname = $this->set->post('mname');
		$bday = $this->set->post('bday');
		$address = $this->set->post('address');
		$contact = $this->set->post('contact');
		$username = $this->set->post('username');
		$password = $this->set->post('password');
		$admin->ms_saveStudent( $school_id, $status_id, $lname, $fname, $mname, $bday, $address, $contact, $username, $password, $image );
	}
	
	public function ms_editAction(){
		$id = $this->set->get('id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->ms_retrive_info( $id );
		$this->load->view('/scripts/_ADMIN/Manage_Students/edit', $result);
	}
	//for update
	public function ms_updateAction(){
		$admin = $this->load->model('AdminModel');
		$image ='';
		if ( isset($_FILES['browse']['tmp_name']) && !EMPTY($_FILES['browse']['tmp_name']) ){
			//$file  = $_FILES['browse']['tmp_name'];
			$image = addslashes( file_get_contents($_FILES['browse']['tmp_name']) );
		}
		$user_id = $this->set->post('user_id');
		$status_id = $this->set->post('status');
		$lname = $this->set->post('lname');
		$fname = $this->set->post('fname');
		$mname = $this->set->post('mname');
		$bday = $this->set->post('bday');
		$address = $this->set->post('address');
		$contact = $this->set->post('contact');
		$username = $this->set->post('username');
		$password = $this->set->post('password');
		$admin->ms_updateStudent( $user_id, $status_id, $lname, $fname, $mname, $bday, $address, $contact, $username, $password, $image );
	}
	//for choosing status 
	public function ms_statusAction(){
		$status_id = $this->set->get('stat');
		$admin = $this->load->model('AdminModel');
		$result = $admin->ms_status( $_SESSION['school_id'], $status_id );
		$this->load->view('/scripts/_ADMIN/Manage_Students/load_students', $result);
	}
#-- END FOR MANAGE SUBJECTS
#-- FOR SETTINGS
	public function set_indexAction(){
		$admin = $this->load->model('AdminModel');
		$result = $admin->set_index( $_SESSION['school_id'] );
		$this->load->view('/scripts/_ADMIN/Settings/index', $result);
	}
	
	public function set_newAction(){
		$admin = $this->load->model('AdminModel');
		$this->load->view('/scripts/_ADMIN/Settings/new');
	}
	
	public function save_miscAction(){
		$school_id = $_SESSION['school_id'];
		$misc_name = $this->set->post('misc_name');
		$misc_percent = $this->set->post('misc_percent');
		$misc_amount = $this->set->post('misc_amount');
		$year = $this->set->post('year');
		$admin = $this->load->model('AdminModel');
		$admin->save_misc( $school_id, $misc_name, $misc_percent, $misc_amount, $year );
	}
	
	public function set_editAction(){
		$school_id = $_SESSION['school_id'];
		$misc_id   = $this->set->get('misc_id');
		$admin = $this->load->model('AdminModel');
		$result = $admin->set_edit( $school_id, $misc_id );
		$this->load->view('/scripts/_ADMIN/Settings/edit', $result);
	}
	
	public function update_miscAction(){
		$misc_name = $this->set->post('misc_name');
		$misc_percent = $this->set->post('misc_percent');
		$misc_amount = $this->set->post('misc_amount');
		$year = $this->set->post('year');
		$misc_id = $this->set->post('misc_id');
		$admin = $this->load->model('AdminModel');
		$admin->update_misc( $misc_name, $misc_percent, $misc_amount, $year, $misc_id );
	}

	public function save_school_infoAction(){
		$school_address = $this->set->post('school_address');
		$contact_no = $this->set->post('contact_no');
		$suffix = $this->set->post('suffix');
		$start_digit = $this->set->post('start_digit');
		$minimum_unit = $this->set->post('minimum_unit');
		$maximum_unit = $this->set->post('maximum_unit');
		$season_id = $this->set->post('season_id');
		$email = $this->set->post('email');
		$ceo = $this->set->post('ceo');
		$vice_ceo= $this->set->post('vice_ceo');
		$per_stud_subject = $this->set->post('per_stud_subject');
		$admin = $this->load->model('AdminModel');
		$admin->save_school_info( $_SESSION['school_id'], $school_address, $contact_no, $suffix, $start_digit, $minimum_unit, $maximum_unit, $season_id, $email,
								  $ceo, $vice_ceo, $per_stud_subject );
	}
}

?>