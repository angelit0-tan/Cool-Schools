<script language='javascript'>
$(document).ready(function(){
	var error = 0;
	//save
	$('#cancel').click(function(){
		$('#_bgpop').fadeOut('slow');
		$('#_seasonform').fadeOut('slow');
	});
	$('#save').click(function(){
		if ( $('#year').val() == '' ){
			alert('Please input year !!');
			error = 1;
		}else{
			error = 0;
			if (isNaN( $("#year").val() )) {
				alert('Only integer are allowed !!');
				error = 1;
			}else{
				error = 0;
			}
		}

		if ( error == 0 ){
			$.post('index.php?__admin/p_save',
			{
				year: $('#year').val(), season_desc: $('#season').val(), status: $('#status').val()
			},function(data){
				$('.content-body').load('index.php?__admin/p_index');
			});
		}
	});
});
</script>
<div>
	<table>
	<tr>
		<td style='font-size: 11px; font-family: tahoma; text-align: right;'>
			<b>Year : </b>
		</td>
		<td>
			<input type='text' id='year' name='year' style='width: 60px; font-size: 11px; font-family: tahoma;' value="">
		</td>
	</tr>
	<tr>
		<td style='font-size: 11px; font-family: tahoma; text-align: right;'>
			<b> Season : </b>
		</td>
		<td>
			<select id='season' name='season' style='font-size: 11px; font-family: tahoma;'>
				<?php 
				foreach ( $data as $row ) {
				?>
				<option value="<?php echo $row['season_desc']; ?>"> <?php echo $row['season_desc']; ?> </option>
				<?php 
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td style='font-size: 11px; font-family: tahoma;text-align: right;' >
			<b> Status : </b>
		</td>
		<td>
			<select id='status' name='status' style='font-size: 11px; font-family: tahoma;'>
				<option value='1'> Open </option>
			</select>
		</td>
	</tr>
	<tr>
		<td style='font-size: 11px; font-family: tahoma;text-align: right;' >
			<b> Last Modfy : </b>
		</td>
		<td>
			<input type='text' disabled style='width: 150px;'>
		</td>
	</tr>
	</table>
</div>
<div style='margin-top: 5px;'>
	<input type='button' value='Save' id='save' style='font-size: 11px; height: 23px;'>
	<input type='button' value='Cancel' id='cancel' style='font-size: 11px; height: 23px;'>
</div>