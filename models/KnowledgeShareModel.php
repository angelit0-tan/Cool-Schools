<?php
Class KnowledgeShareModel extends _Db{

	public function loadKnowledge ( $school_id, $knowledgetype ){
		if ( $school_id > 0 ){
			$result = $this->query("SELECT * FROM cool_users
						INNER JOIN " . cool_forum . $knowledgetype . " ON cool_users.user_id = " . cool_forum . $knowledgetype . ".user_id 
						WHERE " . cool_forum . $knowledgetype . ".school_id = $school_id ORDER BY knowledge_id DESC");
		}else{
			//display all
			//this query will return all, its for super admin only =))
			$result = $this->query("SELECT * FROM cool_users
									INNER JOIN " . cool_forum . $knowledgetype . " ON cool_users.user_id = " . cool_forum . $knowledgetype . ".user_id 
									WHERE " . cool_forum . $knowledgetype . ".school_id >= 0 ORDER BY knowledge_id DESC");
		}
		return $result;
	}
	
	#post new knowledge discussion / ideas/ question
	public function knowledgepost( $user_id, $knowledgetype, $subject, $message, $share_type , $school_id = 0 ){
		$this->query("INSERT INTO " . cool_forum . $knowledgetype . " ( user_id, fld_subject, fld_message, share_type, school_id ) 
					 VALUES( $user_id , '$subject', '$message', $share_type, $school_id )");
	}
	
	public function knowledgeview( $knowledgetype, $id ){
		$result = $this->query ("SELECT 
								fld_subject, 
								fld_message,
								cool_users.user_id,
									 (SELECT 
										firstname
										FROM cool_users 
										LEFT JOIN " . cool_forum . $knowledgetype . 
										" ON cool_users.user_id = " . cool_forum . $knowledgetype . ".user_id
										WHERE " . cool_forum . $knowledgetype . ".knowledge_id = $id
									 ) AS 'postby' , "
								. cool_forum . $knowledgetype . ".knowledge_id , " 
								. cool_forum . $knowledgetype . ".share_type ,
								cool_school_knowledge_comment.comment_id ,
								comment,
								firstname as 'comment_by'
								FROM " . cool_forum . $knowledgetype . "
								LEFT JOIN cool_school_knowledge_comment ON " . cool_forum . $knowledgetype  . 
								".knowledge_id = cool_school_knowledge_comment.knowledge_id
								AND " . cool_forum . $knowledgetype . ".share_type = cool_school_knowledge_comment.share_type
								LEFT JOIN cool_users ON cool_school_knowledge_comment.user_id = cool_users.user_id
								WHERE " . cool_forum . $knowledgetype . ".knowledge_id = $id 
								ORDER BY cool_school_knowledge_comment.comment_id ASC ");
		
		/*
		$result = $this->query("SELECT 
								fld_subject, 
								fld_message,
								cool_users.user_id,
								firstname  AS 'postby' , "
								. cool_forum . $knowledgetype . ".knowledge_id , " 
								. cool_forum . $knowledgetype . ".share_type ,
								cool_school_knowledge_comment.comment_id ,
								comment
								FROM " . cool_forum . $knowledgetype . "
								LEFT JOIN cool_school_knowledge_comment ON " . cool_forum . $knowledgetype  . ".knowledge_id = cool_school_knowledge_comment.knowledge_id
								AND " . cool_forum . $knowledgetype . ".share_type = cool_school_knowledge_comment.share_type
								LEFT JOIN cool_users ON cool_school_knowledge_comment.user_id = cool_users.user_id
								WHERE " . cool_forum . $knowledgetype . ".knowledge_id = $id 
								ORDER BY cool_school_knowledge_comment.comment_id ASC ");
		*/
		return $result;
		//print_r ($result);
	}
	
	#post a new comment
	public function postcomment( $user_id, $knowledge_id, $share_type, $comment ){
		$result = $this->query("SELECT * FROM cool_users WHERE user_id = $user_id");
		$this->query("INSERT INTO cool_school_knowledge_comment ( user_id, knowledge_id, share_type , comment )
					  VALUES ( $user_id, $knowledge_id, $share_type, '$comment')");
		$lastid = mysql_insert_id();
		echo json_encode(array('comment'=>$comment, 'user'=>$result[0]['firstname'], 'id' => $lastid, 'c_id' => $result[0]['user_id']));
	}
	
	#delete a comment
	public function deleteComment( $comment_id ){
		$this->query("DELETE FROM cool_school_knowledge_comment WHERE comment_id = $comment_id");
		echo json_encode(array('result'=>'ok'));
	}
}
?>