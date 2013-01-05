<script language='javascript'>
var windowWidth = document.documentElement.clientWidth;
var windowHeight = document.documentElement.clientHeight;
var click=0;
$(document).ready(function(){
	$('#_add').click(function(){
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_roomform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_roomform').height() - 70 ,
				"left":( windowWidth / 2 ) - (($('#_roomform').width() + $('#_roomform').height() - ($('#_roomform').height() / 2) + 30) / 2 )
			}).fadeIn('slow').load('index.php?__admin/mrl_new');
		});
	});
	$('#_edit').click(function(){
		if( click > 0 ){
			$('#_bgpop').css({
				'opacity': '0.1'
			}).fadeIn('slow',function(){
				$('#_roomform').css({
					'position': 'absolute',
					'top': ( windowHeight / 2 ) - $('#_roomform').height() - 70 ,
					"left":( windowWidth / 2 ) - (($('#_roomform').width() + $('#_roomform').height() - ($('#_roomform').height() / 2) + 30) / 2 )
				}).fadeIn('slow').load('index.php?__admin/mrl_edit&id='+click);
			});
		}
	});
	//hover
	$('.season').unbind().bind('mouseover',function(){
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
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd; height: 45px;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px; margin-left: 6px;'>
			<b>Manage room </b>
		</div>
		<div style='float: right; margin-top: 15px;'>
			<input type='button' style='height: 23px; width: 70px; font-size: 11px;' value='Add new' id='_add'>
			<input type='button' style='height: 23px; width: 70px; font-size: 11px;' value='Edit' id='_edit'>
			<input type='button' style='height: 23px; width: 70px; font-size: 11px;' value='Delete' id='_delete'>
		</div>
		</br></br>
	</div>
</div>
<div style='margin-top: 2px;'>
	<div style="height: 30px; margin-left: 2px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/bgopen.png);">
		<table>
		<tr>
		<td>
			<div style='float: left; font-size: 11px; margin-left: 30px; margin-top: 5px;'>
				<b> Room #  </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 34px; margin-top: 5px;'>
				<b> Building </b>
			</div>
		</td>
		<tr>
		</table>
	</div>
	<div id='list' style='width: 600px; margin-left: 4px;'>
		<?php
		if( is_array($data) ){
			foreach ( $data as $row ){
		?>
		<div style='height: 21px; margin-top: 1px; width: 635px;' id="<?php echo $row['room_id'];?>" class='season'>
			<table style='font-family: verdana; font-size: 11px;'>
			<tr>
				<td width='100' style='text-align: center;'>  <?php echo $row['room_name']; ?> </td>
				<td width='100' align='left'> <?php echo $row['room_building']; ?> </td>
			</tr>
			</table>
		</div>
		<?php
			}
		}
		?>
	</div>
</div>
<div id='_roomform' class='popupform' style='width: 250; height: 100px;'>

</div>
<div id='_bgpop' class='popupbg'> 

</div>