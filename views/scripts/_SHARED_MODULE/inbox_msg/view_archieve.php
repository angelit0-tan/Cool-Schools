<script language='javascript'>
$(document).ready(function(){
	$('#reply').click(function(){
		
		if ( $('#replymsg').val().length > 0 ){
			$.post('index.php?inbox/sendReply', 
			{
				inboxid: $('#inboxid').val(), replymsg: $('#replymsg').val()
			},function(data){
				var json_obj = $.parseJSON(data);
				$('#v_content').append("<div style='border-top: 1px solid #dddddd; height: 45px;'> <table> <tr> <td style='vertical-align: text-top; width: 9%;'> <div style='float: left; width: 56px; height: 52px;'> <img src = <?php echo '/' . BASE_DIR  . '/public/images/icons/knowledge_base/discussion_b.png'; ?>  style='height: 52px; width: 56px;'> </div> </td><td> <div style='padding-left: 5px; font-family: tahoma; font-size: 12px;'> <a href='#'> <b>" + json_obj.username + "</b> </a> </div> <div style='padding-left: 5px; font-family: tahoma; font-size: 11px; margin-top: 3px;'> " + json_obj.msg + "</div></td></tr></table></div>");
				$('#replymsg').val('');
			});
		}
	});
});
</script>
<div id='v_content'>
	<?php
	if ( is_array($data) ) {
		foreach ( $data as $row ){
	?>
	<div style='border-top: 1px solid #dddddd; margin-top: 7px;'>
		<table>
		<tr>
			<td style='vertical-align: text-top;width: 9%;'> 
				<div style='float: left; width: 56px; height: 52px;'>
					<img src ='index.php?__profile/s_list&id=<?php echo $row['user_id'];?>' style='height: 52px; width: 56px;'>
				</div>
			</td>
			<td> 
				<div style='padding-left: 5px; font-family: tahoma; font-size: 12px;'>
					<?php echo '<a href="#">'.'<b>' . ucfirst($row['firstname']) .'</b>'.'</a>';?>
				</div>
				<div style='padding-left: 5px; font-family: tahoma; font-size: 11px; margin-top: 3px;'>
					<?php 
						echo $row['messages_data'];
					?>
				</div>
			</td>
		</tr>
		</table>
	</div>
	
	<?php
		}
	}
	?>

</div>
<div style='border-top: 1px solid #dddddd; margin-left: 65px; height: 200px;' id='reply-content'>
	<textarea cols='67' rows='3' style='margin-top: 8px; font-family: tahoma; font-size: 11px;' id='replymsg' name='replymsg'/>
	</br>
	<input type='button' id='reply' class='replay' value='Reply' style='font-family: tahoma; font-size: 13px; background-color: transparent;'>
	<input type='hidden' id='inboxid' name='inboxid' value="<?php echo $data[0]['inbox_id']; ?>">
</div>



