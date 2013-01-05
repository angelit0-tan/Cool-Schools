<script language='javascript'>
var dataz;
var add=true;
var cache = {};
var clickz=0;
		
$(document).ready(function(){
	
	$("input[name='section_type']").bind('change',function(){
		s_type = $("input[name='section_type']:checked").val();
		$('#c_subjects').load('index.php?__admin/m_section&id=' + s_type + '&user_id=' + $('#user_id').val());
	});
	
	//$(window).load(function(){
		
		//$('#c_scheds').load('index.php?__admin/m_retrieve&id=' + s_type + '&user_id=' + $('#user_id').val());
	//});
	$("input[name='section_type']:checked").trigger('change');
	$('#c_scheds').load('index.php?__admin/m_retrieve&id=' + s_type + '&user_id=' + $('#user_id').val()); //first load of window
	//assign click
	$('#but_assignz').click(function(){
		var xsplit = dataz.split('@');
		if ( !cache[parseInt(xsplit[9])] ){
			cache[parseInt(xsplit[9])] = parseInt(xsplit[9]);
			add=true;
		}else{
			alert("This schedule is already on the list !!");
			add=false;
		}
		if ( xsplit.length > 1 && add ){
		$('#c_scheds').append("<div id=" + xsplit[9] + " class='beer'> <table style='font-family: verdana; font-size: 11px;'> <td width='110' style='text-align: center;'> <b>" + xsplit[0] + "</b> </td> <td width='20' align='center'>" + xsplit[1] + "</td><td width='110' align='center'>" + xsplit[2] + "</td>			<td width='70' align='center'>" + xsplit[3] + ' - ' + xsplit[4] + "</td><td width='80' align='center'>" + xsplit[5] + "</td><td width='70' align='center'>" + xsplit[6] + "</td><td width='120' align='center'>" + xsplit[7] + "</td><td width='70' align='center'>" + xsplit[8] + "</td></table></div>");
		// after append remove the data on the list
			dataz = '';
			$('#'+click).remove();
		}
		xsplit = '';
	});
	
	//remove click
	$('#but_remove').click(function(){
		if ( clickz > 0 && cache[clickz]){
			cache[parseInt(clickz)]='';
			$('#'+clickz).remove();
		}
	});
	
	// close click
	$('#but_close').click(function(){
		if ( $('#check_save').is(':checked') ) {
			$.post('index.php?__admin/m_save_subject',
			{ 
				user_id: $('#user_id').val(), s_id: cache 
			}, function (data){
				$('#_assignform').fadeOut('slow');
				$('#_bgpop').fadeOut('slow');
			});
		}else{
			$('#_assignform').fadeOut('slow');
			$('#_bgpop').fadeOut('slow');
		}
	});
	
	//hover on schedule for teacher
	$('.beer').live('mouseover mouseout click', function(event) {
	  if ( event.type == 'mouseover' ) {
		var id = $(this).attr('id');
		$('#'+id).css({ cursor: 'pointer', backgroundColor: 'CCFFFF'});
	  } else if (event.type == 'mouseout' ){
		var id = $(this).attr('id');
		if (clickz != id ){
			$('#'+id).css('backgroundColor', 'transparent');
		}
	  }else if(event.type =='click' ){
		var id = $(this).attr('id');
		if (clickz > 0){
			$('#'+clickz).css('backgroundColor', 'transparent');
		}
		clickz = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
	  }
	});
	
	/*
	var clickz=0;
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
	*/
});

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
	<div id='c_scheds' style='overflow: auto; height: 200px; width: 700px;' class='c_scheds'>
	</div>
	<input type='button' id='but_remove' value='Remove' style='height: 23px; width: 70px; font-family: tahoma; font-size: 11px;'/>
	<div style='margin-top: 10px;'> 
		<b> Subjects List</b> 
		<input type='radio' name='section_type' value='1' id='section_type' style='margin-left: 20px;'/> Block Section 
		<input type='radio' name='section_type' value='2' checked id='section_type' style='margin-left: 10px;'/> Free Section 
	</div>
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
			<div style='float: left; font-size: 11px; margin-left: 45px; margin-top: 5px;'>
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
	<div id='c_subjects' style='overflow: auto; height: 250px; width: 700px;'>
	
	</div>
	<input type='button' id='but_assignz' value='Assign' style='height: 23px; width: 70px; font-family: tahoma; font-size: 11px;'/>
	<input type='button' id='but_close' value='Close' style='height: 23px; width: 70px; font-family: tahoma; font-size: 11px;'/>
	<input type='checkbox' id='check_save' style='font-family: tahoma; font-size: 11px;'/> <b>* Save all when close *</b>
</div>
<input type="hidden" id="user_id" value="<?php echo $data; ?>">