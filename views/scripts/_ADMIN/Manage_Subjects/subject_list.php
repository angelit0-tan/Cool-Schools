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
		if (click > 0){
			$('#'+click).css('backgroundColor', 'transparent');
		}
		click = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
	}).css({ cursor: 'pointer'});
});
</script>
<?php
if( is_array($data) ){
	foreach ( $data as $row ){
?>
<div style='margin-top: 1px; width: 635px;' id="<?php echo $row['season_subj_id'];?>" class='subject'>
	<table style='font-family: verdana; font-size: 11px;'>
	<tr>
		<td width='110' style='text-align: center;'>  <?php echo '<b>' . $row['subject_code'] .'</b>'; ?> </td>
		<td width='30' align='left'> <?php echo $row['section']; ?> </td>
		<td width='110' align='center'> <?php echo $row['lecture_day']; ?> </td>
		<td width='70' align='left'> <?php echo date('g:i A ',$row['lecture_time_from']) . ' - ' . date('g:i A ',$row['lecture_time_to']); ?> </td>
		<td width='55' align='left'> <?php echo $row['room_name']; ?> </td>
		<td width='130' align='center'> <?php echo $row['w_lab'] > 0 ? $row['laboratory_day'] . ' / ' . $row['room_name2'] . ' / ' .  date('g:i A ',$row['laboratory_time_from']) . ' - ' . date('g:i A ',$row['laboratory_time_to']) : '-none-'; ?> </td>
	</tr>
	</table>
</div>
<?php
	}
}
?>