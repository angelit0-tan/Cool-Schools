<style>
	a:hover{
		text-decoration: underline;
	}
</style>
<script language='javascript'>
$(document).ready(function(){
	$('.inbox-area').unbind().bind('mouseover',function(){
		var id = $(this).attr('id');
		$('#'+id+'sender').css("text-decoration", "underline");
	}).bind('mouseout',function(){
		var id = $(this).attr('id');
		$('#'+id+'sender').css("text-decoration", "none");
	}).bind('click',function(){
		var id = $(this).attr('id');
		$('#inbox-content').load('index.php?inbox/inbox_archieve&id='+id);
	});
});
</script>

<div style='float: left; font-family: tahoma;'>
	<div style='width: 640px;'>
		<div style='float: left;'>
			<img src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/messages.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px;'>
			<b>Messages </b>
		</div>
		</br></br>
	</div>
	<div id='inbox-content'>
	<?php
	if ( is_array( $data ) ){
		
		foreach ( $data as $row ){
	?>
		<div style='border-top: 1px solid #dddddd; cursor: pointer; margin-top: 10px; height: 42px;' class='inbox-area' id="<?php echo $row['inbox_id'];?>">
		<table>
			<tr>
				<td>
				<div style='height: 46px; width: 52px; float: left;'>
					<img src='index.php?__profile/s_list&id=<?php echo $row['sender_id'];?>' style='height: 46px; width: 52px;'>
				</div>
				</td>
				<td align='left' valign='middle'>
				<div style='font-family: tahoma; font-size: 13px; ' id="<?php echo $row['inbox_id'].'sender'?>">
					<?php 
						echo  '<a>' . '<b>' . ucfirst($row['firstname']) . '</b>'  . '</a>'; 
					?>
				</div>
				
				<div style='font-family: tahoma; font-size: 11px; color:#878C97;'>
					<?php
						echo $row['inbox_title'];
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
</div>
