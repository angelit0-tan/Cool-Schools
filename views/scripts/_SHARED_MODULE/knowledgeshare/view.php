<style>
 .comment-area{
	background-attachment:scroll;
	background-color:#F0F0E8; 
	background-repeat:repeat repeat;
	border-top-color:#E0E0CF;
	border-top-style:solid;
	border-top-width:1px;
	padding-bottom:0.5em;
	padding-left:15px;
	padding-right:15px;
	padding-top:0.5em;
 }
</style>
<script language='javascript'>
var z = 0;
$(document).ready(function(){
	// post comment
	$('#postComment').unbind().bind('click',function(){
		if ( $('#comment').val().length > 0 ){
			$.post('index.php?knowledgeshare/newComment', 
			{ 
			knowledge_id : $('#knowledge_id').val(), share_type: $('#share_type').val(), comment: $('#comment').val() 
			},function(data){
				var json_obj = $.parseJSON(data);
				$('#ul-content').append("<li style='margin-top: 1px;'> <div id=" + json_obj.c_id  + '_' + json_obj.id + " class='comment-area'> <div style='float: right; display: none; cursor: pointer; width: 22px; text-align: center;' class='deletex' id= " + json_obj.id + 'choi' + "> <a> X </a> </div> <div style='float: left; padding-right: 10px;'> <a> <b> " + json_obj.user + " : </b> </a> </div> <div>" + json_obj.comment + "</div></div></li>");
					$('#' + json_obj.c_id + '_' + json_obj.id).hide();
					$('#' + json_obj.c_id + '_' + json_obj.id).fadeIn(700);
					$('#comment').val('');
			});
		}	
	});
	
	//hover in div
	$('.comment-area').unbind().bind('mouseover',function(){
		id = $(this).attr('id').split('_');
		if ( $('#c_id').val() == id[1] ){
			$('#'+id[0]+'choi').show();
		}
	}).bind('mouseout',function(){
		$('#'+id[0]+'choi').hide();
	});
	
	//delete click
	$('.deletex').click(function(){
		comment_id = $(this).attr('id').split('c');
		$.post('index.php?knowledgeshare/deleteComment', { comment_id : comment_id[0] }, function(data){
			var json_obj = $.parseJSON(data);
			if (json_obj.result == 'ok'){
				var div = comment_id[0] + '_' + $('#c_id').val();
				$('#'+div).remove();
			}
		});
	});
});
</script>

<div>
	<table width='100%'>
	<tr>
		<td align='left' valign='middle'>
		<div style='float: left; margin-left: 10px; border-style: none;'>
			<?php 
				if ( $data[0]['share_type'] == 1 ) {
					echo "<img src = /"  . BASE_DIR . '/public/images/icons/knowledge_base/discussion_b.png' . " style='height: 60px; width: 60px;'>";
				}elseif ( $data[0]['share_type'] == 2 ){
					echo "<img src = /"  . BASE_DIR . '/public/images/icons/knowledge_base/idea_b.png' . " style='height: 60px; width: 60px;'>";
				}else{
					echo "<img src = /"  . BASE_DIR . '/public/images/icons/knowledge_base/question_b.png' . " style='height: 60px; width: 60px;'>";
				}
			?>
		</div>
		<div style=''>
			<div style='float: right; width: 85%; font-size:1.6em;line-height: 1.6em; color:#368512;padding-left:10px;'>
				<?php
					echo $data[0]['fld_subject'];
				?>
			</div>
			<div style='width: 80%; float: left; padding-left: 10px; color:#878C97;' >
				By
				<span style='color:#66cc00; font-style:italic;' id='postby' name='postby'>
					<?php echo ucfirst($data[0]['postby']); ?> 
				</span>
				Sunday, March 14, 2010 
				<br/><br/>
			</div>
		</div>
	</tr>
	<tr>
		<td colspan='2' style='font-family: arial; font-size: 12px;'>
		<?php
			echo $data[0]['fld_message'];
		?>
		</td>
	</tr>
	</table>
	
	<!-- comment area -->
	<div style='width: 640px;' id='comment-content' name='comment-content'>
	<ul style='list-style-type: none; padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px;' id='ul-content'>
		<?php 
		if ( is_array($data) ){
			foreach ( $data as $row ){
				if ( $row['comment_id'] > 0 ){
		?>
		<li style='margin-top: 1px;'>
			<div class='comment-area' id="<?php echo $row['comment_id'] . '_' . $row['user_id'];?>">
				<div style='float: right; display: none; cursor: pointer; width: 22px; text-align: center;' class='deletex' id="<?php echo $row['comment_id'] . 'choi';?>"> <a>X</a></div>
				<div id='postby' style='float: left; padding-right: 10px; font-family: arial; font-size: 12px;'>
					
					<?php echo '<a>' .'<b>' . ucfirst($row['comment_by'])  .' : '. '</b>' . '</a>'; ?>
					
				</div>
				<div style='font-family: tahoma; font-size: 12px;'>
					<?php echo $row['comment']; ?>
				</div>
			</div>
		</li>
		<?php
				}
			}
		}
		?>
	</ul>
	</div>
	<table width='100%' style=''>
	<tr>
		<td colspan='2' style='padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;'> 
			<form method='post'>
				<div style='color: rgb(73, 22, 109); font-size: 1.6em; line-height: 1.6em; '>Post Comment:</div>
				<p>
					<textarea style='width: 95%; font-family: tahoma; font-size: 11px; ' id='comment' name='comment'/>
				</p>
				<p align='right' style='padding-right: 10px; '>
					<button id='postComment' type='button' name='Post' style='background-color: transparent; text-decoration:underline;'>Post</button>
				</p>
				<input type='hidden' id='share_type' name='share_type' value= "<?php echo $data[0]['share_type']; ?>">
				<input type='hidden' id='knowledge_id' name='knowledge_id' value= "<?php echo $data[0]['knowledge_id']; ?>">
			</form>
		</td>
	</tr>
	</table>
	
</div>
<input type='hidden' id='c_id' name='c_id' value="<?php echo $_SESSION['user_id']; ?>">
