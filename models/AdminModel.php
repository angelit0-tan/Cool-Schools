<?php
Class AdminModel extends _Db{
#for teacher
	//show all the status
	public function statuslist(){
		$result = $this->query("SELECT * FROM cool_users_status WHERE user_type_id = 3");
		return $result;
	}
	//saving state
	public function savenew_teacher( $school_id, $status_id, $lname, $fname, $mname, $bday, $address = '', $contact = '', $username, $password, $image ){
		$bday = date('Y-m-d', strtotime($bday));
		$sql = "INSERT INTO cool_users ( user_name, user_pass, firstname, middlename, lastname, school_id, user_type_id ) 
				VALUES( '$username', '$password', '$fname', '$mname', '$lname', $school_id, 3 )";
		$this->query( $sql );		
		$user_id = mysql_insert_id();
		$sql = "INSERT INTO cool_users_info ( user_id , status_id, birthday, address, contact, image ) 
				VALUES ( $user_id, $status_id, '$bday', '$address', '$contact', '$image' )";
		$this->query( $sql );
		#search for available menus in cool_users_default_access_type
		$search = $this->query("SELECT * FROM cool_users_default_access_type WHERE user_type_id = 3");
		foreach ( $search as $row ){
			$module_id = $row['module_id'];
			$this->query("INSERT INTO cool_users_menu ( user_id, module_id )  
						  VALUES ( $user_id, $module_id )");
				
		}
		echo "<script type='text/javascript'>";
			echo "parent.upload_completed();";
		echo "</script>";
	}
	
	//show all list
	public function teacher_lists( $school_id ){
		$sql = "SELECT * FROM
				cool_users
				INNER JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
				INNER JOIN cool_users_status ON cool_users_info.status_id = cool_users_status.status_id
				WHERE cool_users.school_id = $school_id 
				AND cool_users.user_type_id = 3";
		return $this->query( $sql );
	}
	
	//get info about teacher
	public function retrive_info( $id ){
		$sql = "SELECT * FROM
				cool_users
				INNER JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
				INNER JOIN cool_users_status ON cool_users_info.status_id = cool_users_status.status_id
				WHERE cool_users.user_id = $id";
		return $this->query( $sql );
	}
	
	#update info
	public function __update_teacher( $user_id, $status_id, $lname, $fname, $mname, $bday, $address = '', $contact = '', $username, $password, $image ){
		$bday = date('Y-m-d', strtotime($bday));
		$sql = "UPDATE cool_users 
				INNER JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
				SET lastname='$lname', firstname='$fname', middlename='$mname', birthday='$bday', 
					 address='$address', contact='$contact', user_name='$username',
					 user_pass='$password', image='$image', status_id=$status_id
				WHERE cool_users.user_id = $user_id";
		
		$this->query( $sql );
		echo "<script type='text/javascript'>";
			echo "parent.upload_completed();";
		echo "</script>";
	}
	
	public function retrieve_subjects( $school_id, $user_id ){
		$sql = "SELECT * FROM cool_school_period AS c_period 
			   INNER JOIN cool_season_subjects AS c_subject ON c_period.period_id = c_subject.period_id
			   AND c_period.school_id = c_subject.school_id
			   INNER JOIN cool_teacher_schedule AS c_t_sched ON c_subject.season_subj_id = c_t_sched.season_subj_id
			   INNER JOIN cool_school_subjects_list AS c_list ON c_subject.subject_id = c_list.subject_id
			   INNER JOIN cool_school_room_list AS r_list ON  c_subject.lecture_room = r_list.room_id
			   LEFT JOIN ( SELECT room_name AS 'room_name2',  room_id FROM cool_school_room_list ) AS r_list2  
			   ON c_subject.laboratory_room = r_list2.room_id
			   WHERE c_period.school_id = $school_id AND c_period.s_status = 1 AND c_t_sched.user_id = $user_id";
		return $this->query($sql);
		//return $this->query("SELECT * FROM cool_teacher_schedule WHERE user_id = $user_id");
		//echo json_encode ($result[0]['season_subj_id']);
		//echo $result[1]['season_subj_id'];
		//return $result;
	}
	
	
	
	public function save_subject ( $user_id, $season_subj_id ){
		/*
		$newval = '';
		foreach ( $season_subj_id as $val ){
			($newval .= $newval == '' ? $val :  ',' . $val);
		}
		$this->query("DELETE FROM cool_teacher_schedule WHERE user_id = $user_id AND season_subj_id NOT IN ( $newval )");
		*/
		$this->query("DELETE FROM cool_teacher_schedule WHERE user_id = $user_id");
		foreach ( $season_subj_id as $val ){
			$this->query("INSERT INTO cool_teacher_schedule  values( $val, $user_id ) ");
			/*$sql = "SELECT * FROM cool_teacher_schedule 
					(
					   CASE WHEN season_subj_id NOT IN ( SELECT season_subj_id FROM cool_teacher_schedule WHERE user_id = $user_id AND season_subj_id = $val )
					   then INSERT INTO cool_teacher_schedule VALUES ($val, $user_id)
					   else DELETE FROM season_subj_id WHERE user_id = $user_id AND season_subj_id = $val end
					)";
			*/
		}
		
		
	}
	public function subject_avail( $school_id , $section_type, $user_id  ){
		$sql = "SELECT * FROM cool_school_period as c_period 
			   INNER JOIN cool_season_subjects as c_subject ON c_period.period_id = c_subject.period_id
			   AND c_period.school_id = c_subject.school_id
			   INNER JOIN cool_school_subjects_list as c_list ON c_subject.subject_id = c_list.subject_id
			   INNER JOIN cool_school_room_list as r_list ON  c_subject.lecture_room = r_list.room_id
			   LEFT JOIN ( SELECT room_name as 'room_name2',  room_id FROM cool_school_room_list ) as r_list2  
			   ON c_subject.laboratory_room = r_list2.room_id
			   WHERE c_period.school_id = $school_id AND c_period.s_status = 1 AND c_subject.section_type = $section_type
			   AND c_subject.season_subj_id	 NOT IN (SELECT season_subj_id FROM cool_teacher_schedule WHERE user_id = $user_id)";
		return $this->query($sql);					   
		//return $result;
	}
#--end for teacher functions 

#for open close period
	public function p_list( $school_id ){
		return $this->query("SELECT * FROM cool_school_period WHERE school_id = $school_id");
	}
	
	public function p_edit( $p_id ){
		return $this->query("SELECT * FROM cool_school_period WHERE period_id = $p_id");
		// echo json_encode(array('year'=>$result[0]['year'], 'season'=>$result[0]['season_desc'], 'status'=>$result[0]['s_status']));
	}
	public function p_update( $period_id, $year, $season_desc, $status ){
		$sql = "UPDATE cool_school_period SET year = $year, 
			    season_desc = '$season_desc', s_status=$status
				WHERE period_id = $period_id";
		$this->query( $sql );
	
	}
	public function p_getp_type( $school_id ){
		$sql = "SELECT * FROM cool_school_profile as c_profile
				INNER JOIN cool_school_period_season as c_season ON c_profile.season_id = c_season.season_id
				INNER JOIN cool_school_period_season_desc as c_desc ON c_season.season_id = c_desc.season_id
				WHERE school_id = $school_id";
		return $this->query( $sql );
	}
	public function p_save( $school_id , $year, $season_desc, $status ){
		$this->query("UPDATE cool_school_period SET s_status = 0 WHERE school_id = $school_id");
		$this->query("INSERT INTO cool_school_period ( school_id, season_desc, s_status, year )
					  VALUES ( $school_id, '$season_desc', $status, $year)");
	}
#---end for open close period functions

#for Manage Subjects
	public function s_index( $school_id ){
		$result['section_type'] = $this->query("SELECT * FROM cool_section_type");
		/*$result['data']= $this->query("SELECT * FROM cool_school_period as c_period 
											    INNER JOIN cool_season_subjects as c_subject ON c_period.period_id = c_subject.period_id
												AND c_period.school_id = c_subject.school_id
												INNER JOIN cool_school_subjects_list as c_list ON
												c_subject.subject_id = c_list.subject_id 
												WHERE c_period.school_id = $school_id AND c_period.s_status = 1");
		*/
		return $result;
	}	
	public function s_edit( $school_id, $season_subj_id ){
		//$result['subject_code'] = $this->query("SELECT * FROM cool_school_subjects_list WHERE school_id = $school_id ORDER BY subject_id ASC");
		$result = $this->s_get_data( $school_id );
		$result['data']	= $this->query("SELECT *
										FROM cool_season_subjects as c_subject
										INNER JOIN cool_season_subjects_lec_dtl AS c_lec_dtl ON  c_subject.season_subj_id = c_lec_dtl.season_subj_id
										INNER JOIN cool_school_period as c_period ON c_subject.period_id = c_period.period_id
										INNER JOIN cool_school_subjects_list as c_list ON c_subject.subject_id = c_list.subject_id
										INNER JOIN cool_school_room_list as r_list ON c_subject.lecture_room = r_list.room_id 
										WHERE c_subject.season_subj_id = $season_subj_id");
		return $result;
	}
	
	public function c_section ( $school_id , $section_type ){

		return    $this->query("SELECT * FROM cool_school_period as c_period 
							   INNER JOIN cool_season_subjects as c_subject ON c_period.period_id = c_subject.period_id
							   AND c_period.school_id = c_subject.school_id
							   INNER JOIN cool_school_subjects_list as c_list ON c_subject.subject_id = c_list.subject_id
							   INNER JOIN cool_school_room_list as r_list ON  c_subject.lecture_room = r_list.room_id
							   LEFT JOIN ( SELECT room_name as 'room_name2',  room_id FROM cool_school_room_list ) as r_list2  
							   ON c_subject.laboratory_room = r_list2.room_id
							   WHERE c_period.school_id = $school_id AND c_period.s_status = 1 AND c_subject.section_type = $section_type");
	
		
	}
	
	public function s_get_data( $school_id ){
	//get subject code
		$result['subject_code'] = $this->query("SELECT * FROM cool_school_subjects_list WHERE school_id = $school_id ORDER BY subject_id ASC");
		$result['room'] 	    = $this->query("SELECT * FROM cool_school_room_list WHERE school_id = $school_id ORDER BY room_id ASC");
		return $result;
	}
	public function s_save( $school_id, $section_type, $subject_id, $lecture_time_from , $lecture_time_to, $lecture_room, $laboratory_day, 
							$laboratory_room = 0, $laboratory_time_from = 0, $laboratory_time_to = 0 , $dissolve, $section, $lecture_days ){
		#i didn't know why the default is not working that's why i do this!!
		if ( $laboratory_room == 0 or strlen( $laboratory_room ) == 0 ) {
			$laboratory_room = 0;
		}
		if ( $laboratory_time_from == 0 or strlen( $laboratory_time_from ) == 0 ) {
			$laboratory_time_from = 0;
		}
		if ( $laboratory_time_to == 0 or strlen( $laboratory_time_to ) == 0 ) {
			$laboratory_time_to = 0;
		}				
		$period_id = $this->query("SELECT period_id FROM cool_school_period WHERE school_id = $school_id AND s_status= 1");
		$period_id = $period_id[0]['period_id'];
		$lec_day = '';
		foreach( $lecture_days as $days => $alpha ){
			$lec_day .= ( $lec_day == '' ? substr($alpha,2,3) : ', ' . substr($alpha,2,3) ); 
		}
		$this->query ("INSERT INTO cool_season_subjects  
							  ( school_id,  period_id, section_type, subject_id, lecture_time_from, lecture_time_to , lecture_room, 
								laboratory_day ,laboratory_room, laboratory_time_from, laboratory_time_to, dissolve, section, lecture_day ) 
					   VALUES( $school_id, $period_id, $section_type, $subject_id, $lecture_time_from, $lecture_time_to, $lecture_room,
							  '$laboratory_day', $laboratory_room, $laboratory_time_from, $laboratory_time_to, $dissolve, '$section', '$lec_day')");
		$season_subj_id = mysql_insert_id();
		foreach( $lecture_days as $days => $alpha ){
			$this->query("INSERT INTO cool_season_subjects_lec_dtl ( season_subj_id, lecture_day, lecture_time_from, lecture_time_to ) 
						  VALUES( $season_subj_id, '$alpha', $lecture_time_from, $lecture_time_to)");
		}
	}
	#update
	public function s_update( $season_subj_id, $section_type, $subject_id, $lecture_time_from , $lecture_time_to, $lecture_room, $laboratory_day, 
							  $laboratory_room = 0, $laboratory_time_from = 0, $laboratory_time_to = 0 , $dissolve, $section, $lecture_day){
		#i didn't know why the default is not working that's why i do this!!
		if ( $laboratory_room == 0 or strlen( $laboratory_room ) == 0 ) {
			$laboratory_room = 0;
		}
		if ( $laboratory_time_from == 0 or strlen( $laboratory_time_from ) == 0 ) {
			$laboratory_time_from = 0;
		}
		if ( $laboratory_time_to == 0 or strlen( $laboratory_time_to ) == 0 ) {
			$laboratory_time_to = 0;
		}	
		$this->query("UPDATE cool_season_subjects
					  SET subject_id = $subject_id, lecture_time_from = $lecture_time_from, lecture_time_to = $lecture_time_to,
					  lecture_room = $lecture_room, laboratory_day = '$laboratory_day', laboratory_room = $laboratory_room,
					  laboratory_time_from = $laboratory_time_from, laboratory_time_to = $laboratory_time_to, dissolve = $dissolve,
					  section = '$section', lecture_day = '$lecture_day'
					  WHERE season_subj_id = $season_subj_id");
	}
#---end for manage subjects functions

#for Master Room List
	public function mrl_index( $school_id ){
		return $this->query("SELECT * FROM cool_school_room_list WHERE school_id = $school_id ORDER BY room_id ASC");
	}
	public function mrl_edit( $room_id ){
		return $this->query("SELECT * FROM cool_school_room_list WHERE room_id = $room_id");
	}
	public function mrl_save( $school_id, $room_no, $building_name ){
		$this->query("INSERT INTO cool_school_room_list ( school_id , room_name, room_building ) 
					  VALUES ( $school_id, '$room_no', '$building_name')");
	}
	public function mrl_update( $room_id, $room_no, $building_name ){
		$this->query("UPDATE cool_school_room_list SET room_name = '$room_no',
					  room_building = '$building_name' WHERE room_id = $room_id");
	}
#--- end Master Room List function

#for Subject List
	public function sl_index( $school_id ){
		return $this->query("SELECT * FROM cool_school_subjects_list WHERE school_id = $school_id");
	}
	public function sl_edit( $subject_id ){
		return $this->query("SELECT * FROM cool_school_subjects_list WHERE subject_id = $subject_id");
	}
	
	public function sl_save( $school_id, $subj_code, $subj_desc, $no_unit, $per_unit, $w_lab, $lab_no_unit = 0, $lab_per_unit = 0, $year_level  ){
		#i didn't know why the default is not working that's why i do this!!
		if ( $lab_per_unit == 0 or strlen( $lab_per_unit ) == 0 ) {
			$lab_per_unit = 0;
		}
		if ( $lab_no_unit == 0 or strlen( $lab_no_unit ) == 0 ) {
			$lab_no_unit = 0;
		}
		$this->query("INSERT INTO cool_school_subjects_list 
					( school_id, subject_code, subject_description, no_of_unit, per_unit, w_lab, lab_no_unit, lab_per_unit, year_level )
					  VALUES( $school_id, '$subj_code', '$subj_desc', $no_unit, $per_unit, $w_lab, $lab_no_unit, $lab_per_unit, $year_level)");
	}
	
	public function sl_update( $subject_id, $subj_code, $subj_desc, $no_unit, $per_unit, $w_lab, $lab_no_unit = 0, $lab_per_unit = 0, $year_level ){
		#i didn't know why the default is not working that's why i do this!!
		if ( $lab_per_unit == 0 or strlen( $lab_per_unit ) == 0 ) {
			$lab_per_unit = 0;
		}
		if ( $lab_no_unit == 0 or strlen( $lab_no_unit ) == 0 ) {
			$lab_no_unit = 0;
		}
		
		$this->query("UPDATE cool_school_subjects_list
					  SET subject_code = '$subj_code', subject_description = '$subj_desc', no_of_unit = $no_unit, per_unit = $per_unit,
					  w_lab = $w_lab, lab_no_unit = $lab_no_unit, lab_per_unit = $lab_per_unit, year_level = $year_level
					  WHERE subject_id = $subject_id");
	}
	
	public function sl_view( $year_level, $school_id ){
		return $this->query("SELECT * FROM cool_school_subjects_list WHERE school_id = $school_id AND year_level = $year_level");
	}
#----end for Subject List

#--- FOR MANAGE STUDENTS
	public function ms_index( $school_id ){
		$result['user_type'] = $this->query("SELECT * FROM cool_users_status WHERE user_type_id = 2");
		$result['students'] =  $this->query("SELECT * 
											FROM cool_users 
 											LEFT JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
											INNER JOIN cool_users_status ON cool_users_info.status_id = cool_users_status.status_id 
 											WHERE school_id = $school_id AND cool_users.user_type_id = 2");
		return $result;
	}
	
	public function ms_new(){
		return $this->query("SELECT * FROM cool_users_status WHERE user_type_id = 2");
	}
	
	public function ms_saveStudent( $school_id, $status_id, $lname, $fname, $mname, $bday, $address = '', $contact = '', $username, $password, $image ){
		$bday = date('Y-m-d', strtotime($bday));
		$sql = "INSERT INTO cool_users ( user_name, user_pass, firstname, middlename, lastname, school_id, user_type_id ) 
				VALUES( '$username', '$password', '$fname', '$mname', '$lname', $school_id, 2 )";
		$this->query( $sql );		
		$user_id = mysql_insert_id();
		$sql = "INSERT INTO cool_users_info ( user_id , status_id, birthday, address, contact, image ) 
				VALUES ( $user_id, $status_id, '$bday', '$address', '$contact', '$image' )";
		$this->query( $sql );
		#search for available menus in cool_users_default_access_type
		$search = $this->query("SELECT * FROM cool_users_default_access_type WHERE user_type_id = 2");
		foreach ( $search as $row ){
			$module_id = $row['module_id'];
			$this->query("INSERT INTO cool_users_menu ( user_id, module_id )  
						  VALUES ( $user_id, $module_id )");
				
		}
		echo $image;
		/*
		echo "<script type='text/javascript'>";
			echo "parent.upload_completed();";
		echo "</script>";
		*/
	}
	
	public function ms_retrive_info( $id ){
		$result1 = "SELECT * FROM
					cool_users
					INNER JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
					INNER JOIN cool_users_status ON cool_users_info.status_id = cool_users_status.status_id
					WHERE cool_users.user_id = $id";
		$result2 = "SELECT * FROM cool_users_status WHERE user_type_id = 2";
		return array( $this->query($result1), $this->query($result2));
		//return $result;
		//return $this->query( $sql );
	}
	
	#update info
	public function ms_updateStudent( $user_id, $status_id, $lname, $fname, $mname, $bday, $address = '', $contact = '', $username, $password, $image ){
		$bday = date('Y-m-d', strtotime($bday));
		$sql = "UPDATE cool_users 
				INNER JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
				SET lastname='$lname', firstname='$fname', middlename='$mname', birthday='$bday', 
					 address='$address', contact='$contact', user_name='$username',
					 user_pass='$password', image='$image', status_id=$status_id
				WHERE cool_users.user_id = $user_id";
		
		$this->query( $sql );
		echo $image;
		/*
		echo "<script type='text/javascript'>";
			echo "parent.upload_completed();";
		echo "</script>";
		*/
	}
	#click of status
	public function ms_status( $school_id , $status_id ){
		switch ( $status_id ){
			case 'all':
				$result['students'] = $this->query("SELECT * 
									  FROM cool_users 
									  LEFT JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
									  INNER JOIN cool_users_status ON cool_users_info.status_id = cool_users_status.status_id 
									  WHERE school_id = $school_id AND cool_users.user_type_id = 2");
			break;
			
			case 'enrolled' :
				$result = '';
			break;
			
			default:
				$result['students'] = $this->query("SELECT * 
									  FROM cool_users 
									  LEFT JOIN cool_users_info ON cool_users.user_id = cool_users_info.user_id
									  INNER JOIN cool_users_status ON cool_users_info.status_id = cool_users_status.status_id 
									  WHERE school_id = $school_id AND cool_users.user_type_id = 2 AND cool_users_info.status_id = $status_id");
									  
			break;
		}
		return $result;
	}
#---END FOR MANAGE STUDENTS

#-- FOR SETTINGS 
	public function set_index( $school_id ){
		$result['info'] = $this->query("SELECT * FROM cool_school_profile WHERE school_id = $school_id");
		$result['type'] = $this->query("SELECT * FROM cool_school_period_season");
		$result['misc']	= $this->query("SELECT * FROM cool_school_misc WHERE school_id = $school_id");
		return $result;
	}
	//$admin->save_misc( $school_id, $misc_name, $misc_percent, $misc_amount, $year );
	public function save_misc( $school_id, $misc_name, $misc_percent = 0, $misc_amount = 0, $year){
			#i didn't know why the default is not working that's why i do this!!
		if ( $misc_percent == 0 or strlen( $misc_percent ) == 0 ) {
			$misc_percent = 0;
		}
		if ( $misc_amount == 0 or strlen( $misc_amount ) == 0 ) {
			$misc_amount = 0;
		}
		$this->query("INSERT INTO cool_school_misc ( school_id, misc_name, misc_percent_rate, misc_amount_rate, validated_year ) VALUES( $school_id, '$misc_name', $misc_percent, $misc_amount, $year )");
	}
	
	public function set_edit ( $school_id, $misc_id ){
		return $this->query("SELECT * FROM cool_school_misc WHERE school_id = $school_id AND misc_id = $misc_id");
	}
	
	public function update_misc( $misc_name, $misc_percent =0, $misc_amount = 0, $year, $misc_id ){
		if ( $misc_percent == 0 or strlen( $misc_percent ) == 0 ) {
			$misc_percent = 0;
		}
		if ( $misc_amount == 0 or strlen( $misc_amount ) == 0 ) {
			$misc_amount = 0;
		}
		$this->query("UPDATE cool_school_misc 
					  SET misc_name ='$misc_name',
					      misc_percent_rate = $misc_percent,
						  misc_amount_rate = $misc_amount,
						  validated_year = $year
						  WHERE misc_id = $misc_id");
	}

	public function save_school_info( $school_id, $school_address, $school_contact, $school_suffix, $start_digit, $minimum_unit, $maximum_unit, $season_id, $email, $ceo, $vice_ceo, $per_stud_subject){
		$this->query("UPDATE cool_school_profile
					  SET school_address ='$school_address', school_contact='$school_contact', school_suffix = '$school_suffix', start_digit= $start_digit,
					  minimum_unit = $minimum_unit, maximum_unit = $maximum_unit, season_id = $season_id, email_address = '$email', ceo = '$ceo', vice_ceo = '$vice_ceo',
					  maximum_student_per_subject = $per_stud_subject
					  WHERE school_id = $school_id");
	}
}
?>