<script language='javascript'>
function upload_started(){
	$("#upload_status").css({display:"block"});
}
 
function upload_completed(){
	$("#upload_status").css({display:"none"});
	$('#_bgpop').fadeOut('slow');
	$('#_profform').fadeOut('slow');
	$('.content-body').load('index.php?__admin/ms_index');
	/*
	$.post('index.php?__admin/m_teachers',
	{
	},function(data){
		$('.content-body').html(data);
	});
	*/

}

$(document).ready(function(){
	$('#cancel').click(function(){
		$('#_bgpop').fadeOut('slow');
		$('#_newform').fadeOut('slow');
	});
	
	$( "#bday" ).datepicker({
			changeMonth: true,
			changeYear: true
	});
	
	
	$('#save').click(function(){
		var error = 0;
		if ( $('#lname').val() == '' ) {
			error = 1;
			$('#l_error').fadeIn();
			$('#l_error').html('*');
		}else{
			$('#l_error').fadeOut();
		}
		//
		if ( $('#fname').val() == '' ) {
			error = 1;
			$('#f_error').fadeIn();
			$('#f_error').html('*');
		}else{
			$('#f_error').fadeOut();
		}
		//
		if ( $('#mname').val() == '' ) {
			error = 1;
			$('#m_error').fadeIn();
			$('#m_error').html('*');
		}else{
			$('#m_error').fadeOut();
		}
		//
		if ( $('#bday').val() == '' ) {
			error = 1;
			$('#b_error').fadeIn();
			$('#b_error').html('*');
		}else{
			$('#b_error').fadeOut();
		}
		//
		if ( $('#status').val() == '' ) {
			error = 1;
			$('#stat_error').fadeIn();
			$('#stat_error').html('*');
		}else{
			$('#stat_error').fadeOut();
		}
		
		if ( $('#username').val() == '' ) {
			error = 1;
			$('#u_error').fadeIn();
			$('#u_error').html('*');
		}else{
			$('#u_error').fadeOut();
		}
		//
		if ( $('#password').val() == '' ) {
			error = 1;
			$('#p_error').fadeIn();
			$('#p_error').html('*');
		}else{
			$('#p_error').fadeOut();
		}
		//
		if ( $('#cpassword').val() == '' ) {
			error = 1;
			$('#cp_error').fadeIn();
			$('#cp_error').html('*');
		}else{
			$('#cp_error').fadeOut();
		}
		//check if password and confirm password didn't match !!
		if ( error == 0 ){
			if ( $('#password').val() != $('#cpassword').val() ){
				error = 1;
				$('#p_error').fadeIn();
				$('#p_error').html('Password not match');
				//
				$('#cp_error').fadeIn();
				$('#cp_error').html('Password not match');
			}else{
				$('#p_error').fadeOut();
				$('#cp_error').fadeOut();
				$('#newupload').submit();
			}

		}
	});
});
</script>
<form method="post" id="newupload" action="index.php?__admin/ms_update" enctype="multipart/form-data" target="hidden_upload" onsubmit="upload_started()">
	<div id='m_content' style='float: left;'>
		<table style='font-family: tahoma; font-size: 11px;'>
		<tr>
			<td align='right'>
				<b>Lastname : </b>
			</td>
			<td align='left'>
				<input type='text' id='lname' name='lname' style='width: 160px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 11px;' value="<?php echo $data[0][0]['lastname']; ?>">
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; width: 10px; margin-top: -15px; margin-left: 170px; position: absolute;' id='l_error'> * error </div>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<b>Firstname : </b>
			</td>
			<td align='left'>
				<input type='text' id='fname' name='fname' style='width: 200px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 11px;' value="<?php echo $data[0][0]['firstname']; ?>">
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; margin-top: -15px; margin-left: 210px; position: absolute;' id='f_error'> * error </div>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<b>Middlename : </b>
			</td>
			<td align='left'>
				<input type='text' id='mname' name='mname' style='width: 200px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 11px;' value="<?php echo $data[0][0]['middlename']; ?>">
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; width: 10px; margin-top: -15px; margin-left: 210px; position: absolute;' id='m_error'> * error </div>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<b>Birthday : </b>
			</td>
			<td align='left'>
				<input type='text' id='bday' name='bday' style='width: 160px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 12px;' class='demo' value="<?php echo date('m/d/Y', strtotime($data[0][0]['birthday'])); ?>">
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; margin-top: -15px; margin-left: 170px; position: absolute;' id='b_error'> * error </div>
			</td>
		</tr>
		<tr>
			<td style='vertical-align: text-top;' align='right'>
				<b>Address : </b>
			</td>
			<td align='left'>
				<textarea cols='40' rows='5' id='address' name='address'> 
					<?php //echo trim($data['info'][0]['address']); ?>
				</textarea>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<b>Contact # : </b>
			</td>
			<td align='left'>
				<input type='text' id='contact' name='contact' style='width: 160px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 11px;' value="<?php echo $data[0][0]['contact']; ?>">
			</td>
		</tr>
		<tr>
			<td align='right'>
				<b>Status : </b>
			</td>
			<td>
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; width: 10px; margin-top: 5px; margin-left: 106px; position: absolute;' id='stat_error'> * error </div>
				<select id='status' name='status' style='font-size: 11px;'>
					<?php
					foreach ( $data[1] as $row ){
					?>
						<option <?php echo ( $row['status_id']==$data[0][0]['status_id'] ? 'selected' : '') ;?> value="<?php echo $row['status_id'];?>"> <?php echo $row['status']; ?> </option>
					<?php
					}
					?>
				</select>
			</td>
		</tr>
		</table>
	</div>

	<div id='m_content2' style='float: left;'>
	<table style='font-family: tahoma; font-size: 11px;'>
		<tr>
			<td align='right'>
				<b>Username : </b>
			</td>
			<td align='left'>
				<input type='text' id='username' name='username' style='width: 120px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 11px;' value="<?php echo $data[0][0]['user_name']; ?>">
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; margin-top: -15px; margin-left: 130px; position: absolute;' id='u_error'> * error </div>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<b>Password : </b>
			</td>
			<td align='left'>
				<input type='password' id='password' name='password' style='width: 160px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 11px;' value="<?php echo $data[0][0]['user_pass']; ?>">
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; margin-top: -15px; margin-left: 170px; position: absolute;' id='p_error'> * error </div>
			</td>
		</tr>
		<tr>
			<td align='right'>
				<b>Confirm Password : </b>
			</td>
			<td align='left'>
				<input type='password' id='cpassword' name='cpassword' style='width: 160px; height: 19px; font-size: 12px; margin-left: 4px; font-size: 11px;' value="<?php echo $data[0][0]['user_pass']; ?>">
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px; margin-top: -15px; margin-left: 170px; position: absolute;' id='cp_error'> * error </div>
			</td>
		</tr>
		<tr>
			<td style='vertical-align: text-top;' align='right'>
				<b> Photo </b>
			</td>
			<td>
				<div style='height: 55px; width: 58px; margin-left: 4px;'>
				</div>
				<input type='file' name='browse' id='browse' style='font-size: 11px;'>
			</td>
		</tr>
		</table>
		<div id='m_content3'>
			<input type='button' value='Save' id='save' style='margin-top: 60px; font-size: 11px; height: 23px;'>
			<input type='button' value='Cancel' id='cancel' style='margin-top: 60px; font-size: 11px; height: 23px;'>
		</div>
	</div>
	<img src="<?php echo '/' . BASE_DIR . '/public/images/loading.gif';?>" id="upload_status" style="display:none;float:left;margin-right:10px">
	<input type='hidden' id='user_id' name='user_id' value="<?php echo $data[0][0]['user_id']; ?>">
</form>

<iframe id="hidden_upload" name="hidden_upload" style="" ></iframe>