<?php
Class SuperAdminModel extends _Db{
	public function save_new_profile( $name ='' , $country = '', $address = '', $description = '', $suffix, $school_contact = '',  $image ){
		$date = date('Y-m-d');
		$this->query ("INSERT INTO cool_school_profile 
					 ( school_name, school_country, school_address, school_description, school_suffix, school_contact, school_image, date_created )
					 VALUES ( '$name', '$country', '$address', '$description', '$suffix','$school_contact', '$image','$date' )");
	
		echo "<script type='text/javascript'>";
			echo "parent.upload_completed();";
		echo "</script>";
		
	}
	
	public function edit_profile( $school_id, $name ='', $country = '', $address ='', $suffix, $school_contact ='' ){
		$this->query("UPDATE cool_school_profile 
					 SET school_name = '$name' ,
					 school_country = '$country' ,
					 school_address = '$address' ,
					 school_suffix = '$suffix' , 
					 school_contact = '$school_contact' WHERE school_id = $school_id ");
	}
	
	public function school_list(){
		$result = $this->query("SELECT * FROM cool_school_profile");
		return $result;
	}
	
	public function user_type(){
		$result = $this->query("SELECT * FROM cool_users_type");
		return $result;
	}
	
	public function school_image( $id ){
		$result = $this->query("SELECT school_image FROM cool_school_profile where school_id = $id");
		return $result[0]['school_image'];
	}
	
	public function post_news( $user_id, $school_id, $subject, $content ){
		$this->query("INSERT INTO cool_school_news 
					( user_id, school_id, news_subject, news_content )
					 VALUES ( $user_id, $school_id, '$subject', '$content' )");
	}
	
	//for new user
	public function create_user( $school_id, $type, $fname, $mname, $lname, $pass, $pconfirm, $username){
		#insert first in user account
		$this->query("INSERT INTO cool_users ( user_name, user_pass, firstname, middlename, lastname, school_id, user_type_id )
					  VALUES('$username','$pass','$fname','$mname','$lname',$school_id, $type)");
	    $lastid = mysql_insert_id();
		
		#search for available menus in cool_users_default_access_type
		$search = $this->query("SELECT * FROM cool_users_default_access_type WHERE user_type_id = $type");
		foreach ( $search as $row ){
			$module_id = $row['module_id'];
			$this->query("INSERT INTO cool_users_menu ( user_id, module_id )  
						  VALUES ( $lastid, $module_id )");
				
		}
	}
	
	#school listings
	public function dropdown_school_list( $school_name ){
		$result = $this->query("SELECT * FROM cool_school_profile WHERE school_country = '$school_name'");
		return $result;
	}
	
	# load users
	public function loadusers_list ( $school_id ){
		$result = $this->query("SELECT * FROM cool_users WHERE school_id = $school_id ORDER BY user_id ASC");
		return $result;
	}
}
?>