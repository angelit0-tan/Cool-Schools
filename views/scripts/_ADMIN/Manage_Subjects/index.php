<script language='javascript'>

var s_type = 0, click = 0;
$(document).ready(function(){
var windowWidth = $(window).width();
var windowHeight = $(window).height();
	//show add form
	$('#_addz').click(function(){
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_subjectform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_subjectform').height() - 70 ,
				"left":( windowWidth / 2 ) - (($('#_subjectform').width() + $('#_subjectform').height() - ($('#_subjectform').height() / 2) + 30) / 2 )
			}).fadeIn('slow').load('index.php?__admin/s_new');
		});
	});
	//show edit form
	$('#_edit').click(function(){
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_subjectform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_subjectform').height() - 70 ,
				"left":( windowWidth / 2 ) - (($('#_subjectform').width() + $('#_subjectform').height() - ($('#_subjectform').height() / 2) + 30) / 2 )
			}).fadeIn('slow').load('index.php?__admin/s_edit&id='+click);
		});
	});
	$("input[name='section_type']").bind('change',function(){
		s_type = $("input[name='section_type']:checked").val();
		$('#list').load('index.php?__admin/c_section&id=' + s_type);
	});
	$("input[name='section_type']").trigger('change');
});
</script>
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd; height: 45px;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px; margin-left: 6px;'>
			<b>Manage Subjects </b>
		</div>
		<div style='float: right; margin-top: 15px;'>
			<input type='button' style='height: 23px; width: 100px; font-size: 11px;' value='Add subject' id='_addz'>
			<input type='button' style='height: 23px; width: 100px; font-size: 11px;' value='Edit subject' id='_edit'>
			<input type='button' style='height: 23px; width: 100px; font-size: 11px;' value='Delete subject' id='_delete'>
		</div>
		</br></br>
	</div>
</div>
<div style='width: 600px; background: blue; margin-top: 5px; font-size: 13px;'>
<?php
	$left = 5;
	foreach ( $data['section_type'] as $row ){
?>
	<div style='float: left; margin-left:  <?php echo $left ?>  px; cursor: pointer;'>
		<input type='radio' checked name='section_type' id='section_type' value="<?php echo $row['section_type']; ?>"> <b> <?php echo $row['description']; ?></b><br>
	</div>
<?php
	$left+= 30;
	}
?>
</div>
<div style='margin-top: 30px;'>
	<div style="height: 30px; margin-left: 2px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/bgopen.png);">
		<table>
		<tr>
		<td>
			<div style='float: left; font-size: 11px; margin-left: 12px; margin-top: 5px;'>
				<b> Subject Code  </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 20px; margin-top: 5px;'>
				<b> Section </b>
			</div>
			<div style='float: left;font-size: 11px; margin-left: 40px; margin-top: 5px;'>
				<b>  Day </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 60px; margin-top: 5px;'>
				<b>  Time </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 40px; margin-top: 5px;'>
				<b>  Room </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 40px; margin-top: 5px;'>
				<b>  Lab / Room / Time</b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 20px; margin-top: 5px;'>
				<b>  # of Student </b>
			</div>
		</td>
		<tr>
		</table>
	</div>
	<div id='list' style='width: 600px; margin-left: 4px;'>

	</div>
</div>
<div id='_subjectform' class='popupform' style='width: 300; height: 430px;'>

</div>
<div id='_bgpop' class='popupbg'> 

</div>