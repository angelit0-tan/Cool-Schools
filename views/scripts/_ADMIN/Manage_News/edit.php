<script language='javascript'>
$(document).ready(function(){
	$('#postnews').unbind().bind('mouseover', function(){
		$(this).css("text-decoration", "underline");
	}).bind('mouseout', function(){
		$(this).css("text-decoration", "none");
	}).bind('click',function(){
		var error = 0;
		if ( $('#subject').val() == '' ) {
			error = 1;
			$('#error_subject').fadeIn();
			$('#error_subject').html(' * Please input a subject ');
		}else{
			$('#error_subject').fadeOut();
		}
		
		if ( $('#message').val() == '' ) {
			error = 1;
			$('#error_message').fadeIn();
			$('#error_message').html(' * Please input a message ');
		}else{
			$('#error_message').fadeOut();
		}
		
		if ( error == 0 ){
			$.post('index.php?__admin/update_news',
			{ 
				subject: $('#subject').val(), message: $('#message').val().replace(/^[\s]+/g,'') , news_id : $('#news_id').val()
			},function(data){
				$('#subject' + $('#news_id').val()).html("<a href='javascript:loadnews(" + $('#news_id').val() + ")'> <b>" + $('#subject').val() + "</b></a>");
				$('#id' + $('#news_id').val()).html('');
				
			});
		}
		;
	});
});
</script>
<div>
	<table style=' font-family: tahoma; font-size: 11px;'>
		<tr>
			<td style='text-align: right;'> <b>Subject : </b></td>
			<td> 
				<div style=' display: none; color: red;font-family:tahoma; font-size: 11px;' id='error_subject'> * error </div>
				<input type='text' style='width: 300px; vertical-align: text-top;' id='subject' name='subject' value="<?php echo  $data[0]['news_subject'];?>"> 
			</td>
			
		</tr>
		<tr>
			<td style='vertical-align: text-top; text-align; right;'> <b>Message : </b> </td>
			<td>
				<div style='display: none; color: red; font-family:tahoma; font-size: 11px;' id='error_message'> * error </div>
				<textarea rows='15' cols='65' id='message' name='message'><?php echo $data[0]['news_content'];?></textarea>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type='button' value='Post' id='postnews' name='postnews' style='cursor: pointer;border-style:none; background-color: transparent; font-family: tahoma; font-size: 11px; color:0066CC;'></td>
		</tr>
		</table>
</div>
<input type='hidden' id='news_id' value="<?php echo $data[0]['news_id']; ?>">