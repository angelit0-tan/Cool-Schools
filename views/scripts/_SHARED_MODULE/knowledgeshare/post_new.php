<script language='javascript'>
$(document).ready(function(){
	$('#post_new').unbind().bind('mouseover', function(){
		$(this).css("text-decoration", "underline");
	}).bind('mouseout', function(){
		$(this).css("text-decoration", "none");
	}).bind('click',function(){
	
	var error = 0;
		if ( $('#subject').val() == 0 ){
			error = 1;
			$('#error_subject').fadeIn();
			$('#error_subject').html(' * Please input a subject');
		}else{
			$('#error_subject').fadeOut();
		}
		
		if ( $('#message').val() == 0 ){
			error = 1;
			$('#error_msg').fadeIn();
			$('#error_msg').html('* Please input a message');
		}else{
			$('#error_msg').fadeOut();
		}
		
		if ( error == 0 ){
			$.post('index.php?knowledgeshare/postnew', 
			{ 
				category: category, subject: $('#subject').val(), message: $('#message').val(), share_type: share_type 
			}, function(data){
				getpage('index.php?knowledgeshare/'+category+'&category='+category);
			});
		}
	});
});
	
</script>
<div style='width: 650px; height: 300px;'>
	<div>
	<table>
	<tr>
		<td style='font-family: tahoma; font-size: 11px;'> Subject : </td>
		<td> 
			<div id='error_subject' style='display: none; color: red; font-family:tahoma; font-size: 11px;'> * error </div>
			<input style='font-family: tahoma; font-size: 12px; width: 300px;' type='text' id='subject' name='subject'> 
		</td>
	</tr>
	<tr>
		<td style='vertical-align: text-top; font-family: tahoma; font-size: 11px;'> Message : </td>
		<td style='font-family: tahoma; font-size: 12px;'>
			<div id='error_msg' style='display: none; color: red; font-family:tahoma; font-size: 11px;'> * error </div>
			<textarea rows='15' cols='70' id='message' name ='message' >
		</textarea></td>
	</tr>
	<tr>
		<td></td>
		<td><input type='button' value='Post new' id='post_new' style='cursor: pointer;border-style:none; background-color: transparent; font-family: tahoma; font-size: 11px; color:0066CC;'></td>
	</tr>
	</table>
	</div>
	
</div>