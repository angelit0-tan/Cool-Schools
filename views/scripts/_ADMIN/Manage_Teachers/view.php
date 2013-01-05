<script language='javascript'>
var clickz=0;
$(document).ready(function(){
	
	
	$('.beer').die().live('mouseover',function(){
		var id = $(this).attr('id');
		$('#'+id).css({ cursor: 'pointer', backgroundColor: 'CCFFFF'});
		
	}).live('mouseout',function(){
		var id = $(this).attr('id');
		if (clickz != id ){
			$('#'+id).css('backgroundColor', 'transparent');
		}
	}).live('click',function(){
		var id = $(this).attr('id');
		if (clickz > 0){
			$('#'+clickz).css('backgroundColor', 'transparent');
		}
		clickz = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
	});
//close
	$('#but_close2').click(function(){
		$('#_viewform').fadeOut('slow');
		$('#_bgpop').fadeOut('slow');
	});
	$('#c_scheds').load('index.php?__admin/m_retrieve&user_id=' + $('#user_id').val()); //first load of window	
});

//alert( $('#user_id').val() );
</script>
<div id='m_sched' style='float: left;'>
	<div> <b> Current Schedule</b></div>
	<div style='margin-top: 2px;'>
		<div style="height: 30px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/bgopen.png);">
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
			<div style='float: left; font-size: 11px; margin-left: 50px; margin-top: 5px;'>
				<b>  Room </b>
			</div>
			<div style='float: left; font-size: 11px; margin-left: 45px; margin-top: 5px;'>
				<b>  Lab day
			</div> 
			<div style='float: left; font-size: 11px; margin-left: 45px; margin-top: 5px;'>
				<b>  Lab Room
			</div>
			<div style='float: left; font-size: 11px; margin-left: 45px; margin-top: 5px;'>
				<b>  Lab Time
			</div>
		</td>
		<tr>
		</table>
		</div>
	</div>
	<div id='c_scheds' style='overflow: auto; height: 370px; width: 700px;' class='c_scheds'>
	</div>
	<input type='button' id='but_close2' value='Close' style='height: 23px; width: 70px; font-family: tahoma; font-size: 11px;'/>
</div>
<input type="hidden" id="user_id" value="<?php echo $data; ?>">
