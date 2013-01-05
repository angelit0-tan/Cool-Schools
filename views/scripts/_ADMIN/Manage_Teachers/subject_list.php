<script language='javascript'>
var click=0;
$(document).ready(function(){
	//hover
	$('.subject').unbind().bind('mouseover',function(){
		var id = $(this).attr('id');
		$('#'+id).css('backgroundColor', 'CCFFFF');
	}).bind('mouseout',function(){
		var id = $(this).attr('id');
		if (click != id ){
			$('#'+id).css('backgroundColor', 'transparent');
		}
	}).bind('click',function(){
		var id = $(this).attr('id');
		if (click.length > 0){
			$('#'+click).css('backgroundColor', 'transparent');
		}
		click = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
	}).css({ cursor: 'pointer'});
	
});

//tr click
function trclick( data ){
	dataz = data;
}
</script>	
<?php
if( is_array($data) ){
	foreach ( $data as $row ){
?>
	<div style='margin-top: 1px;' id="<?php echo 'divx_'.$row['season_subj_id'];?>" class='subject'>
			<table style='font-family: verdana; font-size: 11px;'>
			<tr onclick="trclick('<?php echo 
								$row['subject_code'].'@'.
								$row['section'].'@'.
								$row['lecture_day'].'@'.
								date('g:i A ',$row['lecture_time_from']).'@'.
								date('g:i A ',$row['lecture_time_to']).'@'.
								$row['room_name'].'@'.
								($row['w_lab'] > 0 ? $row['laboratory_day'] : '--').'@'.
								($row['w_lab'] > 0 ? $row['room_name2'] : '--').'@'.
								($row['w_lab'] > 0 ? date('g:i A ',$row['laboratory_time_from']) . ' - ' . date('g:i A ',$row['laboratory_time_to'])  : '--').'@'.
								$row['season_subj_id']; ?> ')">
				<td width='110' style='text-align: center;'>  <?php echo '<b>' . $row['subject_code'] .'</b>'; ?> </td>
				<td width='20' align='center'> <?php echo $row['section']; ?> </td>
				<td width='110' align='center'> <?php echo $row['lecture_day']; ?> </td>
				<td width='70' align='center'> <?php echo date('g:i A ',$row['lecture_time_from']) . ' - ' . date('g:i A ',$row['lecture_time_to']); ?> </td>
				<td width='80' align='center'> <?php echo $row['room_name']; ?> </td>
				<td width='70' align='center'> <?php echo $row['w_lab'] > 0 ? $row['laboratory_day'] : '--'; ?> </td>
				<td width='120' align='center'> <?php echo $row['w_lab'] > 0 ? $row['room_name2'] : '--'; ?> </td>
				<td width='70' align='center'> <?php echo $row['w_lab'] > 0 ? date('g:i A ',$row['laboratory_time_from']) . ' - ' . date('g:i A ',$row['laboratory_time_to'])  : '--'; ?> </td>
			</tr>
			</table>
	</div>
<?php
	}
}
?>
