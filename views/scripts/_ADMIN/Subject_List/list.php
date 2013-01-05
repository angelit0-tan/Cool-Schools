<script language='javascript'>
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
<div style='margin-top: 1px; width: 635px;' id="<?php echo $row['subject_id'];?>" class='subject'>
	<table style='font-family: verdana; font-size: 11px;'>
	<tr>
		<td width='120' align='center'>  <?php echo $row['subject_code']; ?> </td>
		<td width='190' align='left'> <?php echo $row['subject_description']; ?> </td>
		<td width='60'  align='left'> <?php echo $row['no_of_unit']; ?> </td>
		<td width='80'  align='left'> <?php echo $row['per_unit']; ?> </td>
		<td width='45'  align='left'> <?php echo $row['lab_no_unit']; ?> </td>
		<td width='40' align='left'> <?php echo $row['lab_per_unit']; ?> </td>
	</tr>
	</table>
</div>
<?php
	}
}
?>