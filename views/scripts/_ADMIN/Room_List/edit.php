<script language='javascript'>
$(document).ready(function(){
	$('#save').click(function(){
		$.post('index.php?__admin/mrl_update',
		{
			room_no: $('#room_no').val(), building_name: $('#building_name').val(), room_id: $('#room_id').val()
		},function(data){
			$('.content-body').load('index.php?__admin/mrl_index');
		});
	});
	
	$('#cancel').click(function(){
		$('#_roomform').fadeOut('slow');
		$('#_bgpop').fadeOut('slow');
	});
});

</script>
<div>
	<table>
	<tr align='right' style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td> <b>Room # : </b></td>
		<td> <input id='room_no' name='room_no' type='text' style='font-family: tahoma; font-size: 12px;' value="<?php echo $data[0]['room_name'];?>"/></td>
	</tr>
	<tr align='right' style='font-family: tahoma; font-size: 12px; height: 23px;'>
		<td> <b>Building : </b></td>
		<td> <input id='building_name'  name='building_name' type='text' style='font-family: tahoma; font-size: 12px;' value="<?php echo $data[0]['room_building'];?>"/></td>
	</tr>
	</table>
</div>
<div style='margin-top: 10px;'>
	<input type='button' value='Save' id='save' style='font-size: 11px; height: 23px;'>
	<input type='button' value='Cancel' id='cancel' style='font-size: 11px; height: 23px;'>
</div>
<input type='hidden' id='room_id' name='room_id' value="<?php echo $data[0]['room_id'];?>" >