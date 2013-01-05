<script language='javascript'>
$(document).ready(function(){
	$('#save').click(function(){
		$.post('index.php?__admin/sl_save',
		{
			subj_code: $('#subj_code').val(), subj_desc: $('#subj_desc').val(), no_unit: $('#no_unit').val(), per_unit: $('#per_unit').val(),
			w_lab: $('#w_lab').is(':checked'), lab_no_unit: $('#lab_no_unit').val(), lab_per_unit: $('#lab_per_unit').val(), year_lvl: $('#year_lvl').val()
		},function(data){
			$('.content-body').load('index.php?__admin/sl_index');
		});
		//$('#cancel').trigger();
	});
	
	$('#cancel').click(function(){
		$('#_subjectlistform').fadeOut('slow');
		$('#_bgpop').fadeOut('slow');
	});
	
	//
	$('#w_lab').click(function(){
		  if ($('#w_lab').is(':checked')) {
			$('#lab_no_unit').attr('disabled', false);
			$('#lab_per_unit').attr('disabled', false);
		  }else{
			$('#lab_no_unit').attr('disabled', true);
			$('#lab_per_unit').attr('disabled', true);
		  }
	});
});

</script>
<div>
	<table>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <b>Year Level : </b></td>
		<td align='left'> 
		<select style='width: 128px; font-size: 12px; font-family: tahoma;' id='year_lvl'> 
			<option value="1"> <b>1st Year </b></option>
			<option value="2"> <b>2nd Year </b></option>
			<option value="3"> <b>3rd Year </b></option>
			<option value="4"> <b>4th Year </b></option>
		</select>
		</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td  align='right' > <b>Subject Code : </b></td>
		<td  align='left' > <input id='subj_code' name='subj_code' type='text' style='font-family: tahoma; font-size: 12px;'/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td  align='right' > <b>Subject Description : </b></td>
		<td  align='left' > <input id='subj_desc'  name='subj_desc' type='text' style='width: 250px; font-family: tahoma; font-size: 12px;'/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td  align='right' > <b>No. of Unit : </b></td>
		<td  align='left' > <input id='no_unit'  name='no_unit' type='text' style='font-family: tahoma; font-size: 12px;'/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td  align='right' > <b>Amnt. Per Unit : </b></td>
		<td  align='left' > <input id='per_unit'  name='per_unit' type='text' style='font-family: tahoma; font-size: 12px;'/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td align='right'> <input type='checkbox' id='w_lab' name='w_lab'/></td>
		<td align='left'> with Laboratory</td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td  align='right'> <b>Lab No. of Unit : </b></td>
		<td  align='left'> <input id='lab_no_unit'  disabled name='lab_no_unit' type='text' style='font-family: tahoma; font-size: 12px;'/></td>
	</tr>
	<tr style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td  align='right' > <b> Amnt. Lab Per Unit : </b></td>
		<td  align='left' > <input id='lab_per_unit'  disabled name='lab_per_unit' type='text' style='font-family: tahoma; font-size: 12px;'/></td>
	</tr>
	</table>
</div>
<div style='margin-top: 10px;'>
	<input type='button' value='Save' id='save' style='font-size: 11px; height: 23px;'>
	<input type='button' value='Cancel' id='cancel' style='font-size: 11px; height: 23px;'>
</div>