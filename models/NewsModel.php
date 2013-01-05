<?php
Class NewsModel extends _Db{
	public function show_news( $user_id = 0){
		
		$result = $this->query("SELECT * FROM cool_users WHERE user_id = $user_id");

		if ( $result[0]['school_id'] > 0 ){
			$school_id = $result[0]['school_id'];
			$result = $this->query("SELECT * FROM cool_users
								   INNER JOIN cool_school_news ON cool_users.user_id = cool_school_news.user_id
								   WHERE cool_school_news.school_id = $school_id
								   ORDER BY news_id DESC"); 
		}else{
			$result = $this->query("SELECT * FROM cool_users
								   INNER JOIN cool_school_news ON cool_users.user_id = cool_school_news.user_id
								   ORDER BY news_id DESC"); 
		}
		return $result;
	}
	
	public function view_news ( $news_id ){
		$result = $this->query("SELECT * FROM cool_school_news
								WHERE news_id = $news_id");
		return $result;
	}
	
	public function post_news ( $school_id, $user_id, $subject, $content ){
		$date = date('Y-m-d');
		$result = $this->query("INSERT INTO cool_school_news ( school_id, user_id, news_subject, news_content, news_date )
								VALUES($school_id, $user_id, '$subject', '$content', '$date')");
	}
	
	public function update_news( $school_id, $subject, $content, $news_id ) {
		$result = $this->query("UPDATE cool_school_news 
								SET news_subject = '$subject', news_content = '$content' 
								WHERE news_id = $news_id AND school_id = $school_id");
	}
}
?>