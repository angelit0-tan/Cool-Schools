<?php
Class ProfileModel extends _Db{
	public function Menu(){
		$result = $this->query("SELECT * FROM cool_menu");
		return $result;
	}
	
	public function check_exist ( $user_id ) {
		$result = $this->query("SELECT * FROM cool_users WHERE user_id = $user_id");
		return $result;
	}
	
	public function check_list( $user_id, $friend_id ){
		$result = $this->query("SELECT * FROM cool_users_friends WHERE user_id = $user_id AND friend_id = $friend_id OR user_id = $friend_id AND friend_id = $user_id");
		return $result;
	}

	public function add_friend ( $user_id, $friend_id ){
		$this->query("INSERT INTO cool_users_friends VALUES( $user_id, $friend_id, 0, $friend_id)");
	}
	
	public function uprepend_post ( $user_id, $status , $date_post ){
		$status = sanitize(stripslashes($status));
		$this->query("INSERT INTO cool_users_wall ( to_id, from_id, wall_post, wall_date ) VALUES ( $user_id, $user_id, '$status', '$date_post')");
		$lastid = mysql_insert_id();
		$result = $this->query("SELECT * FROM cool_users 
								WHERE user_id = $user_id");
		echo json_encode ( array('f_n' => ucfirst($result[0]['firstname']), 'l_n' => ucfirst($result[0]['lastname']), 'status' => $status, 'id' => $lastid) );
	}
	
	public function vprepend_post ( $user_id, $friend_id, $status , $date_post ){
		$status = sanitize(stripslashes($status));
		$this->query("INSERT INTO cool_users_wall ( to_id, from_id, wall_post, wall_date ) VALUES ( $friend_id, $user_id, '$status', '$date_post')");
		$lastid = mysql_insert_id();
		$result = $this->query("SELECT * FROM cool_users 
								WHERE user_id = $user_id");
		echo json_encode ( array('f_n' => ucfirst($result[0]['firstname']), 'l_n' => ucfirst($result[0]['lastname']), 'status' => $status, 'id' => $lastid) );
	}
	
	public function uwall( $user_id ){
		$sql1 = "SELECT * FROM cool_users_wall AS u_wall
				LEFT JOIN cool_users AS c_users ON u_wall.from_id = c_users.user_id 
				WHERE u_wall.to_id = $user_id ORDER BY wall_date DESC";
				
		$sql2 = "SELECT * FROM cool_users_wall AS u_wall
				INNER JOIN cool_users_wall_comment AS w_comment ON u_wall.wall_id = w_comment.wall_id
				LEFT JOIN cool_users AS c_users ON w_comment.user_id = c_users.user_id 
				WHERE u_wall.to_id = $user_id ORDER BY comment_date ASC";
		return array( $this->query($sql1), $this->query($sql2) ) ;
	}
	
	public function u_sent_cmnt( $wall_id, $user_id, $wall_comment, $comment_date ){
		$wall_id = $wall_id[2];
		$wall_comment = sanitize(stripslashes($wall_comment));
		$this->query("INSERT INTO cool_users_wall_comment ( wall_id, user_id, wall_comment, comment_date ) 
		     VALUES ( $wall_id, $user_id, '$wall_comment', '$comment_date')");
		$result = $this->query("SELECT firstname, lastname FROM cool_users WHERE user_id = $user_id");
		echo json_encode( array('f_n'=>ucfirst($result[0]['firstname']), 
								'l_n'=>ucfirst($result[0]['lastname']),  
								'd_t'=>date('F d',strtotime($comment_date)),
								'a_t'=>date('h:i A',strtotime($comment_date))) );
	}
	
	public function u_del_cmnt( $comment_id ){
		$this->query("DELETE FROM cool_users_wall_comment WHERE w_c_id = $comment_id");
	}
	
	public function u_del_wall( $wall_id ){
		$this->query("DELETE FROM cool_users_wall WHERE wall_id = $wall_id");
		$this->query("DELETE FROM cool_users_wall_comment WHERE wall_id = $wall_id");
	}
	
	public function u_friendlist( $user_id ){
	/*
		$sql = "SELECT DISTINCT c_users.user_id, firstname, lastname, middlename, be_friends,request_to FROM cool_users AS c_users
				INNER JOIN cool_users_friends AS c_friends ON c_users.user_id =
				(
				   CASE WHEN c_users.user_id IN (SELECT friend_id 
				FROM cool_users_friends WHERE user_id  = $user_id ) then c_users.user_id 

							 WHEN c_users.user_id IN (SELECT user_id 
				FROM cool_users_friends WHERE friend_id  = $user_id ) then c_users.user_id  end
				  
				)
				WHERE c_friends.friend_id= 
				(
				 CASE WHEN c_users.user_id IN (SELECT friend_id 
				FROM cool_users_friends WHERE user_id  = $user_id ) then c_users.user_id  

						   WHEN c_users.user_id IN (SELECT user_id
				FROM cool_users_friends WHERE friend_id  = $user_id ) then $user_id  end
				)";
				*/
		$sql =	"SELECT c_users.user_id,  c_friends.friend_id, firstname, lastname, middlename, be_friends,request_to FROM cool_users AS c_users
				INNER JOIN cool_users_friends AS c_friends ON c_users.user_id =
				(
				 CASE WHEN c_users.user_id IN (SELECT friend_id 
				FROM cool_users_friends WHERE user_id  = $user_id ) then c_users.user_id
				 WHEN c_users.user_id IN (SELECT user_id 
				FROM cool_users_friends WHERE friend_id  = $user_id ) then c_users.user_id end
				)
				WHERE c_friends.friend_id= 
				(

				CASE WHEN c_users.user_id IN (SELECT friend_id 
				FROM cool_users_friends WHERE user_id  = $user_id ) then c_users.user_id
				WHEN c_users.user_id IN (SELECT user_id
				FROM cool_users_friends WHERE friend_id  = $user_id ) then $user_id  end
				) AND c_friends.user_id =  
				(  
				CASE WHEN c_users.user_id IN (SELECT user_id
				FROM cool_users_friends WHERE friend_id = $user_id ) then c_users.user_id
				WHEN c_users.user_id IN (SELECT friend_id
				FROM cool_users_friends WHERE user_id = $user_id ) then $user_id 
				end
				)";
				return $this->query($sql);
	}
	
	public function s_list( $user_id ){
		//ob_end_clean();
		$result = $this->query("SELECT * FROM cool_users_info WHERE user_id = $user_id");
		$image=$result[0]['image'];
		header("Content-type: image/jpeg");
		echo $image;
	}
	
	public function c_friend ( $user_id, $friend_id, $request_to ){
		$this->query("UPDATE cool_users_friends SET be_friends = 1 
					  WHERE user_id = $user_id AND friend_id = $friend_id AND request_to = $request_to");
	}
}
?>