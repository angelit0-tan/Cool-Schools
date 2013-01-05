<script language='javascript'>
var subject_id, subject_desc, lecture_room, lab_room, xday, xday2, clickz, lec_days = {};
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
	
	//add lecture day
	$('#add_lec_day').click(function(){
		xday = $('#lec_day').val().split('-');
		if ( !lec_days[xday[0]] ) {
			$('#day_list').append("<div class='list' id="+ "list_" + xday[0] +" style='height: 15px;'>" + xday[1] + "</div>");
			lec_days[xday[0]] = $('#lec_day').val();
		}else{
			alert('The selected day is already on the list');
		}
	});
	
	//remove lecture from list
	
	$('#remove_lec_day').click(function(){
		xday2 = clickz.split('_');
		
		lec_days[xday2[1]] = '';
		$('#'+clickz).remove();
	});
	
	$('#save').click(function(){
		$.post('index.php?__admin/s_save',
		{
			subject_id: subject_id, lec_time_from: $('#lec_time_from').val(), lec_time_to: $('#lec_time_to').val(), lect_room: $('#lec_room').val(),
			lab_day: $('#lab_day').val(), lab_time_from: $('#lab_time_from').val(), lab_time_to: $('#lab_time_to').val(), dissolve: $('#dissolve').val(),
			section_type: s_type, lab_room: $('#lab_room').val(), section: $('#section').val(), lec_days: lec_days
		},function(data){
			$('#list').load('index.php?__admin/c_section&id=' + s_type);
			$('#cancel').trigger('click');
		});
	});
	//click of subject code
	$('#_code').change(function(){
		subject_id = $(this).val().split('#/%')[0];
		subject_desc = $(this).val().split('#/%')[1];
		$('#description').val( subject_desc );
	});
	
	//hover for lecture days
	$('.list').live('mouseover mouseout click', function(event) {
	  if ( event.type == 'mouseover' ) {
		var id = $(this).attr('id');
		$('#'+id).css({ cursor: 'pointer', backgroundColor: 'CCFFFF'});
	  } else if (event.type == 'mouseout' ){
		var id = $(this).attr('id');
		if (clickz != id ){
			$('#'+id).css('backgroundColor', 'transparent');
		}
	  }else if(event.type =='click' ){
		var id = $(this).attr('id');
		if (clickz > 0){
			$('#'+clickz).css('backgroundColor', 'transparent');
		}
		clickz = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
	  }
	});
});

</script>
<div>
	<table>
	<tr align='right' style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td> <b>Subject Code : </b></td>
		<td align='left'> 
		<select style='width: 128px; font-size: 12px; font-family: tahoma;' id='_code'> 
		<option> Select Code</option>
		<?php
			foreach ( $data['subject_code'] as $row ) {
		?>
			<option value="<?php echo $row['subject_id'].'#/%'.$row['subject_description']; ?>"> <?php echo $row['subject_code']; ?> </option>
		<?php
			}
		?>
		</select>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Section : </b></td>
		<td align='left'> <input  id='section' name='section' type='text' style='font-family: tahoma; font-size: 12px;'/></td>
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
			<input  id='lec_time_from' name='lec_time_from' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;'/>
			<b>To :</b>
			<input  id='lec_time_to' name='lec_time_to' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;'/>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Room : </b></td>
		<td align='left'> 
		<select id='lec_room' name='lec_room' style='width: 128px; font-size: 12px; font-family: tahoma;'> 
		<option> Choose Room</option>
		<?php
			foreach ( $data['room'] as $row ){
		?>
			<option value="<?php echo $row['room_id']; ?>"> <?php echo $row['room_name']?> </option>
		<?php
			}
		?>
		</select>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Lab day : </b></td>
		<td align='left'> <input id='lab_day' name='lab_day' type='text' style='font-family: tahoma; font-size: 12px;'/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Lab Room : </b></td>
		<td align='left'> 
		<select id='lab_room' name='lab_room' style='width: 128px; font-size: 12px; font-family: tahoma;'> 
		<option> Choose Room</option>
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
		<input  id='lab_time_from' name='lab_time_from' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;'/>
		<b> To : </b>
		<input  id='lab_time_to' name='lab_time_to' type='text' style='width: 60px; font-family: tahoma; font-size: 12px;'/>
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