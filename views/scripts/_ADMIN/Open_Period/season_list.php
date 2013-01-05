<script language='javascript'>
var click=0;
$(document).ready(function(){	
	//edit
	$('#_edit').click(function(){
		if( click > 0 ){
			$('#_bgpop').css({
				'opacity': '0.2'
			}).fadeIn('slow',function(){
				$('#_seasonform').css({
					'position': 'absolute',
					'top': ( windowHeight / 2 ) - $('#_seasonform').height() - 70 ,
					"left":( windowWidth / 2 ) - (($('#_seasonform').width() + $('#_seasonform').height() - ($('#_seasonform').height() / 2) + 30) / 2 )
				}).fadeIn('slow').load('index.php?__admin/p_edit&p_id='+click);
			});
		}
	});
	
	$('#_new').click(function(){
		$('#_bgpop').css({
			'opacity': '0.2'
		}).fadeIn('slow',function(){
			$('#_seasonform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_seasonform').height() - 70 ,
				"left":( windowWidth / 2 ) - (($('#_seasonform').width() + $('#_seasonform').height() - ($('#_seasonform').height() / 2) + 30) / 2 )
			}).fadeIn('slow').load('index.php?__admin/p_new');
		});
	});
	
	$('.room').unbind().bind('mouseover',function(){
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
<div style='height: 21px; margin-top: 1px; width: 635px;' id="<?php echo $row['period_id'];?>" class='room'>
<table style='font-family: verdana; font-size: 11px;'>
<tr>
	<td width='80' style='text-align: center;'>  <?php echo $row['year']; ?> </td>
	<td width='440' style='text-align: center;'> <?php echo $row['season_desc']; ?> </td>
	<td width='75' style='text-align: right;'> <?php echo ( $row['s_status'] == 0 ? 'Closed' : 'Open' ); ?> </td>
</tr>
</table>
</div>
<?php
	}
}
?>