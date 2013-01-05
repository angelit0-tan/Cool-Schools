<script language='javascript'>
$(document).ready(function(){
	var click=0;
	$('.usersId').unbind().bind('mouseover',function(){
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
<div style='height: 21px; margin-top: 1px;' id="<?php echo $row['user_id'];?>" class='usersId'>
<table style='font-family: verdana; font-size: 11px;'>
<tr>
	<td width='150' style='text-align: center;'>  <?php echo $row['user_id']; ?> </td>
	<td width='300' style='text-align:left;'> <?php echo ucfirst($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']); ?> </td>
	<td width='80' style='text-align: left;'> <?php echo $row['user_name']; ?> </td>
</tr>
</table>
</div>
<?php
	}
}
?>
