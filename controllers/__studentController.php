<?php
Class __studentController extends _Controller {
	#enlistment 
	public function enlist_indexAction(){
		$student = $this->load->model('StudentModel');
		$result = $student->enlist_index( $_SESSION['school_id'], $_SESSION['user_id'] );
		#self made, array(array()) <-- because of this figure i need to break it appart
		$sa = '';
		foreach ($result['def'] as $new){
			$sa.= ($sa == '' ? $new : ',' . $new);
		}
		echo "<script type='text/javascript'>";
			echo "json_obj=" . "[".$sa."]" ;
		echo "</script>";
		
		echo "<script type='text/javascript'>";
			echo "lecdays=" . json_encode($result['lecdays']) ;
		echo "</script>";
		
		
		$this->load->view('/scripts/_STUDENT/Enlistment_Form/index', $result);
	}
	
	public function enlist_viewAction(){
		$student = $this->load->model('StudentModel');
		$result = $student->enlist_misc( $_SESSION['school_id'] );
		$this->load->view('/scripts/_STUDENT/Enlistment_Form/view', $result);
	}
	
	public function enlist_saveAction(){
		$student = $this->load->model('StudentModel');
		$user_id = $_SESSION['user_id'];
		$subjects = $this->set->post('subjects');
		$student->enlist_save( $user_id, $subjects );
	}
}

?>