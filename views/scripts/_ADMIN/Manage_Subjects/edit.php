<script language='javascript'>
var subject_id, subject_desc, lecture_room, lab_room;
$(document).ready(function(){
	$('#cancel').click(function(){
		$('#_subjectform').fadeOut('slow');
		$('#_bgpop').fadeOut('slow');
	});
	$('#lec_time_from').timepicker({
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#lec_time_to').timepicker({
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#lab_time_from').timepicker({
		showPeriod: true,
		showLeadingZero: true
	});
	$('#lab_time_to').timepicker({
		showPeriod: true,
		showLeadingZero: true
	});
	
	$('#save').click(function(){
		//alert($('#_code').val() );
		subject_id = $('#_code').val().split('#/%')[0];
		$.post('index.php?__admin/s_update',
		{
			subject_id: subject_id, lec_time_from: $('#lec_time_from').val(), lec_time_to: $('#lec_time_to').val(), lect_room: $('#lec_room').val(),
			lab_day: $('#lab_day').val(), lab_time_from: $('#lab_time_from').val(), lab_time_to: $('#lab_time_to').val(), dissolve: $('#dissolve').val(),
			section_type: s_type, lab_room: $('#lab_room').val(), section: $('#section').val(), lec_day : $('#lec_day').val(), subj_id: $('#subj_id').val()
		},function(data){
			$('#list').load('index.php?__admin/c_section&id=' + s_type);
			$('#cancel').trigger('click');
		});
	});
	//click of subject code
	$('#_code').change(function(){
		$('#description').val( $(this).val().split('#/%')[1] );
	});
});

</script>
<div>
	<table>
	<tr align='right' style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td> <b>Subject Code : </b></td>
		<td align='left'> 
		<select style='width: 128px; font-size: 12px; font-family: tahoma;' id='_code'> 
		<?php
			foreach ( $data['subject_code'] as $row ) {
			
		?>
			<option <?php echo ( $row['subject_id'] == $data['data'][0]['subject_id'] ? 'selected' : ''); ?> value="<?php echo $row['subject_id'].'#/%'.$row['subject_description']; ?>"> <?php echo $row['subject_code']; ?> </option>
		<?php
			}
		?>
		</select>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Section : </b></td>
		<td align='left'> <input  id='section' name='section' type='text' style='font-family: tahoma; font-size: 12px;' value="<?php echo $data['data'][0]['section']; ?>"/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Lecture day : </b></td>
		<td align='left'> 
			<select id='lec_day' name='lec_day' type='text' style='font-family: tahoma; font-size: 12px;'>
				<option value='1-Monday'> Monday </option>
				<option value='2-Tuesday'> Tuesday </option>
				<option value='3-Wednesday'> Wednesday </option>
				<option value='4-Thursday'> Thursday </option>
				<option value='5-Friday'> Friday </option>
				<option value='6-Saturday'> Saturday </option>
				<option value='7-Sunday'> Sunday </option>
			</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type='button' id='add_lec_day' style='font-family: tahoma; font-size: 11px; width: 40px; height: 20px;' value='add'>
			<input type='button' id='remove_lec_day' style='font-family: tahoma; font-size: 11px; width: 50px; height: 20px;' value='remove'>
		</td>
	</tr>
	<tr>
		<td> 
		</td>
		<td>
				<fieldset>
					<div style='height: 50px; font-family: tahoma; font-size: 11px; overflow: auto;' id='day_list'>
					<?php
						foreach( $data['data'] as $row){
						
					?>
						<div id="list_" <?php echo substr($row['lecture_day'],1,1);?>> <?php echo substr($row['lecture_day'],2); ?></div>
					<?php
						}
					?>
					</div>
				</fieldset>
			
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Description : </b></td>
		<td align='left'> <textarea id='description' name='description' type='text' style='font-family: tahoma; font-size: 12px; width: 200px;'/> </td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>From : </b></td>
		<td align='left'> 
			<input  id='lec_time_from' name='lec_time_from' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;' value="<?php echo date('g:i A ',$data['data'][0]['lecture_time_from']); ?>"/>
			<b>To :</b>
			<input  id='lec_time_to' name='lec_time_to' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;'  value="<?php echo date('g:i A ',$data['data'][0]['lecture_time_to']); ?>"/>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Room : </b></td>
		<td align='left'> 
		<select id='lec_room' name='lec_room' style='width: 128px; font-size: 12px; font-family: tahoma;'> 
		<?php
			foreach ( $data['room'] as $row ){
		?>
			<option <?php echo ( $row['room_id'] == $data['data'][0]['lecture_room'] ? 'selected' : ''); ?> value="<?php echo $row['room_id']; ?>"> <?php echo $row['room_name']?> </option>
		<?php
			}
		?>
		</select>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Lab day : </b></td>
		<td align='left'> <input <?php echo $data['data'][0]['w_lab'] == 0 ? 'disabled' : ''; ?> id='lab_day' name='lab_day' type='text' style='font-family: tahoma; font-size: 12px;' value="<?php echo $data['data'][0]['laboratory_day']; ?>"/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Lab Room : </b></td>
		<td align='left'> 
		<select <?php echo $data['data'][0]['w_lab'] == 0 ? 'disabled' : ''; ?> id='lab_room' name='lab_room' style='width: 128px; font-size: 12px; font-family: tahoma;'> 
		<?php
			foreach ( $data['room'] as $row ){
		?>
			<option value="<?php echo $row['room_id'];?>"> <?php echo $row['room_name']?> </option>
		<?php
			}
		?>
		</select>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>From : </b></td>
		<td align='left'> 
		<input  <?php echo $data['data'][0]['w_lab'] == 0 ? 'disabled' : ''; ?> id='lab_time_from' name='lab_time_from' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;' value="<?php echo $data['data'][0]['w_lab'] == 0 ? '' : date('g:i A ',$data['data'][0]['laboratory_time_from']);  ?>"/>
		<b> To : </b>
		<input  <?php echo $data['data'][0]['w_lab'] == 0 ? 'disabled' : ''; ?> id='lab_time_to' name='lab_time_to' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;' value="<?php echo $data['data'][0]['w_lab'] == 0 ? '' : date('g:i A ',$data['data'][0]['laboratory_time_to']);  ?>"/>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>	
		<td align='right'> <b> Dissolve : </b> </td>
		<td align='left'>
			<select id='dissolve' name='dissolve' style='font-size: 11px; font-family: tahoma;'>
				<option value='0'><b> No </b></option>
				<option value='1'><b> Yes </b></option>
			</select>
		</td>
	</tr>
	</table>
</div>
<div style='margin-top: 10px;'>
	<input type='button' value='Save' id='save' style='font-size: 11px; height: 23px;'>
	<input type='button' value='Cancel' id='cancel' style='font-size: 11px; height: 23px;'>
</div>
<input type='hidden' id='subj_id' name='subj_id' value="<?php echo $data['data'][0]['season_subj_id'];?>">