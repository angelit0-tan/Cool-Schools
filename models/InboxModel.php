<?php
Class InboxModel extends _Db{
	public function load_inbox( $user_id ){
	   $sql = "SELECT inbox_id, firstname, inbox_title, sender_id
			   FROM cool_users_inbox, cool_users
			   WHERE user_id =
			    ( 
					case when sender_id IN (select sender_id from cool_users_inbox where sender_id = $user_id ) then receiver_id else sender_id  end
			    )
				AND sender_id IN ( select sender_id from cool_users_inbox WHERE sender_id = $user_id or receiver_id = $user_id ) 
				ORDER BY inbox_id DESC";
	   $result = $this->query( $sql );
	   return $result;
	}
	
	public function load_msgs( $inbox_id ){
		$result = $this->query ("SELECT * 
								FROM cool_users_inbox_msg 
								INNER JOIN cool_users ON cool_users_inbox_msg.sender_id = cool_users.user_id
								WHERE inbox_id = $inbox_id ORDER BY messages_id ASC");
		return $result;
	}
	
	public function reply_msg( $inbox_id, $sender_id , $reply_msg ) {
		$result = $this->query("SELECT * FROM cool_users WHERE user_id = $sender_id");
		$this->query("INSERT INTO cool_users_inbox_msg ( inbox_id, sender_id, messages_data ) VALUES ( $inbox_id, $sender_id, '$reply_msg' )");
		echo json_encode(array('username'=>ucfirst($result[0]['firstname']), 'msg'=>$reply_msg));
	}
}