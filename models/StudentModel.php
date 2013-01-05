<?php
Class StudentModel extends _Db{
	public function enlist_index( $school_id, $user_id ){
		
		$result['data'] =  $this->query ("SELECT * FROM cool_season_subjects AS c_subj
							  INNER JOIN cool_school_period AS c_period ON c_subj.period_id = c_period.period_id
							  INNER JOIN cool_school_subjects_list AS c_subj_list ON c_subj.subject_id = c_subj_list.subject_id 
							  WHERE c_period.s_status = 1 AND c_subj.school_id = $school_id GROUP BY c_subj.subject_id");

		$result['encode'] =  $this->query ("SELECT * FROM cool_season_subjects AS c_subj
							  INNER JOIN cool_school_subjects_list AS c_subj_list ON c_subj.subject_id = c_subj_list.subject_id 
							  INNER JOIN cool_school_period AS c_period ON c_subj.period_id = c_period.period_id
							  INNER JOIN cool_school_room_list AS c_r_list ON c_subj.lecture_room = c_r_list.room_id
							  LEFT JOIN ( SELECT room_name as 'room_name2', room_id FROM cool_school_room_list ) as r_list2  
							  ON c_subj.laboratory_room = r_list2.room_id
							  WHERE c_period.s_status = 1 AND c_subj.school_id = $school_id");
	  
		$result['lecdays'] = $this->query ("SELECT c_subj.season_subj_id, c_dtl.lecture_day FROM cool_season_subjects AS c_subj
							  INNER JOIN cool_school_period AS c_period ON c_subj.period_id = c_period.period_id
							  INNER JOIN cool_school_subjects_list AS c_subj_list ON c_subj.subject_id = c_subj_list.subject_id 
							  INNER JOIN cool_season_subjects_lec_dtl AS c_dtl ON c_subj.season_subj_id = c_dtl.season_subj_id
							  WHERE c_period.s_status = 1 AND c_subj.school_id = $school_id");
	    
		$result['enlist']  = $this->query ("SELECT * FROM cool_season_subjects AS c_subj
							  INNER JOIN cool_school_subjects_list AS c_subj_list ON c_subj.subject_id = c_subj_list.subject_id
							  INNER JOIN cool_school_enlistment AS c_enlistment ON c_subj.season_subj_id = c_enlistment.season_subj_id
							  INNER JOIN cool_school_period AS c_period ON c_subj.period_id = c_period.period_id
							  INNER JOIN cool_school_room_list AS c_r_list ON c_subj.lecture_room = c_r_list.room_id
							  LEFT JOIN ( SELECT room_name as 'room_name2', room_id FROM cool_school_room_list ) as r_list2  
							  ON c_subj.laboratory_room = r_list2.room_id
							  WHERE c_period.s_status = 1 AND c_enlistment.user_id = $user_id AND c_subj.school_id = $school_id");
							  	  
		//echo json_encode ($result['enlist']);
		//$result['def'] = array();
		foreach ( $result['encode'] as $res ){
			$result['def'][] = json_encode(
								array('subject_id'=>$res['subject_id'], 'lecture_day'=>$res['lecture_day'],'section'=> $res['section'], 
									  'season_subj_id'=>$res['season_subj_id'], 'lecture_time_from'=> date('g:iA', $res['lecture_time_from']),
									  'lecture_time_to'=>date('g:iA', $res['lecture_time_to']), 'laboratory_day'=> ($res['w_lab']==1 ? $res['laboratory_day']: '--'),
									  'laboratory_time_from'=>($res['w_lab'] == 1 ? date('g:iA', $res['laboratory_time_from']) : '--'), 'laboratory_time_to'=>($res['w_lab'] == 1 ? date('g:iA',$res['laboratory_time_to']) : '--'),
									  'subject_code'=> $res['subject_code'],
									  'lec_from'=> $res['lecture_time_from'],'lec_to'=>$res['lecture_time_to'],
									  'lab_from'=>($res['w_lab'] == 1 ? $res['laboratory_time_from'] : '--'), 'lab_to'=>($res['w_lab'] == 1 ? $res['laboratory_time_to'] : '--'),
									  'code_description'=>$res['subject_description'], 'lecture_room'=>$res['room_name'],'laboratory_room'=>$res['room_name2'],
									  'lec_unit'=>$res['no_of_unit'], 'lab_unit'=>$res['lab_no_unit']
										 )
							   );
								
		}
	    return $result;
	}
	public function enlist_misc( $school_id ){
		return $this->query("SELECT * FROM cool_school_misc WHERE school_id = $school_id");
	}
	public function enlist_save ( $user_id, $subjects ){
		$this->query("DELETE FROM cool_school_enlistment WHERE user_id = $user_id");
		foreach( $subjects as $subj ){
			$a = explode('_', $subj);
			$a=$a[0];
			$this->query("INSERT INTO cool_school_enlistment VALUES( $user_id, $a)");
		}
	}
}