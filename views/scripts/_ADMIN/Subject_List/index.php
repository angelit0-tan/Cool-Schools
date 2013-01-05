<script language='javascript'>
var click=0;
$(document).ready(function(){
	var windowWidth = $(window).width();
	var windowHeight = $(window).height();
	
	$('#_add').click(function(){
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_subjectlistform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_subjectlistform').height() - 70 ,
				"left":( windowWidth / 2 ) - (($('#_subjectlistform').width() + $('#_subjectlistform').height() - ($('#_subjectlistform').height() / 2) + 30) / 2 )
			}).fadeIn('slow').load('index.php?__admin/sl_new');
		});
	});
	
	$('#_edit').click(function(){
		if ( click > 0 ){
			$('#_bgpop').css({
				'opacity': '0.1'
			}).fadeIn('slow',function(){
				$('#_subjectlistform').css({
					'position': 'absolute',
					'top': ( windowHeight / 2 ) - $('#_subjectlistform').height() - 70 ,
					"left":( windowWidth / 2 ) - (($('#_subjectlistform').width() + $('#_subjectlistform').height() - ($('#_subjectlistform').height() / 2) + 30) / 2 )
				}).fadeIn('slow').load('index.php?__admin/sl_edit&id=' + click);
			});
		}
	});
	
	$('#year_lvl').change(function(){
		$('#list').load('index.php?__admin/sl_view&year_level='+$(this).val());
	});
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
	
	$('#year_lvl').trigger('change');
});
</script>
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd; height: 45px;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px; margin-left: 6px;'>
			<b>Subject List </b>
		</div>
		<div style='float: right; margin-top: 15px;'>
		<table>
		<tr>
			<td>
				<b>Select Year Level : </b>
				<select style='width: 128px; font-size: 12px; font-family: tahoma;' id='year_lvl'> 
					<option value="1"> <b>1st Year </b></option>
					<option value="2"> <b>2nd Year </b></option>
					<option value="3"> <b>3rd Year </b></option>
					<option value="4"> <b>4th Year </b></option>
				</select>
			</td>
			<td>
			<input type='button' style='height: 23px; width: 70px; font-size: 11px;' value='Add new' id='_add'>
			<input type='button' style='height: 23px; width: 70px; font-size: 11px;' value='Edit' id='_edit'>
			<input type='button' style='height: 23px; width: 70px; font-size: 11px;' value='Delete' id='_delete'>
			</td>
		</tr>
		</table>
		</div>
		</br></br>
	</div>
</div>
<div style='margin-top: 2px;'>
	<div style="height: 30px; margin-left: 2px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/bgopen.png);">
		<table>
		<tr>
		<td>
			<div style='float: left; font-size: 11px; margin-left: 20px; margin-top: 5px;'>
				<b> Subject Code  </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 50px; margin-top: 5px;'>
				<b> Subject Description </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 40px; margin-top: 5px;'>
				<b> No. of Unit </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 25px; margin-top: 5px;'>
				<b> Per Unit </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 25px; margin-top: 5px;'>
				<b> Lab. Unit </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 20px; margin-top: 5px;'>
				<b> Lab Per Unit </b>
			</div>
		</td>
		<tr>
		</table>
	</div>
	<div id='list' style='width: 600px; margin-left: 4px;'>

	</div>
</div>
<div id='_subjectlistform' class='popupform' style='width: 390; height: 250px;'>

</div>
<div id='_bgpop' class='popupbg'> 

</div>