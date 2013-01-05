<script language='javascript'>
	var category='';
	var prevType='';
	var share_type = 0;
	$(document).ready(function(){
		var http = $('#postnew a').attr("href");
		$("#postnew a").removeAttr("href");
		//picture navigation
		$('.type_img').unbind().bind('mouseover',function(){
			var type = $(this).attr('id');
			$('#img_'+type).attr('src',' <?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/';?>' + type + '_b.png' );
		}).bind('mouseout',function(){
			var type = $(this).attr('id');
			if (prevType != type){
				$('#img_' + type).attr('src',' <?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/';?>' + type + '_b_gray.png' );
			}
		}).bind('click',function(){
			var type = $(this).attr('id');
			if (type == 'discussion'){
				$("#postnew a").attr("href",http);
				share_type = 1;
				$('#img_question').attr('src','<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/question_b_gray.png'; ?>');
				$('#img_idea').attr('src','<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/idea_b_gray.png'; ?>');
			}else if (type=='idea'){
				
				share_type = 2;
				$("#postnew a").attr("href",http);
				$('#img_discussion').attr('src','<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/discussion_b_gray.png'; ?>');
				$('#img_question').attr('src','<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/question_b_gray.png'; ?>');
			}else{
				share_type = 3;
				$("#postnew a").attr("href",http);
				$('#img_discussion').attr('src','<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/discussion_b_gray.png'; ?>');
				$('#img_idea').attr('src','<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/idea_b_gray.png'; ?>');
			}
			category = type;
			prevType = type;
		});
		
	});
	
</script>
<style>
	td{
		font-family: tahoma; 
		font-size: 12px;
		color:#333333;
	}	
	.shareList li { list-style:none outside none;}
	.shareList a { text-decoration:none;color:#333333; }
	.shareList a:hover { color:#66cc00; }			
	.share-title{
		color:#323232;
		cursor: pointer;
	}
	
	.share-title:hover{
		color:blue;
		text-decoration: underline;
	}
	

</style>
<div id='knowledge-menu' style='width: 650px; font-family: tahoma; border-bottom: 1px solid #dddddd; '>
	<table width="100%" cellspacing="5" cellpadding="5" border="0" align="center">
	<tr>
		<td style='text-align: center;' width='30%' align='center' valign='center'>
			<a class='type_img' id='discussion' href="javascript:getpage('index.php?knowledgeshare/discussion&category=discussion')"> 
				<img id='img_discussion' style='border-style: none;' src = "<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/discussion_b_gray.png' ?>" style='cursor: pointer; height: 80px; width: 80px;'>
				<div style='margin-top: 5px;'><b> Discussion </b></div>
			</a>
		</td>
		<td style='text-align: center;' width='30%' align='center' valign='center'>
			<a class='type_img' id='idea' href="javascript:getpage('index.php?knowledgeshare/idea&category=idea')"> 
				<img id='img_idea' style='border-style: none;' src = "<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/idea_b_gray.png' ?>" style='cursor: pointer; height: 80px; width: 80px;'>
				<div style='margin-top: 5px;'> <b> Ideas </b> </div> 
			</a>
		</td>
		<td style='text-align: center;' width='30%' align='center' valign='center'>
			<a class='type_img' id='question' href="javascript:getpage('index.php?knowledgeshare/question&category=question')"> 
				<img id='img_question' style='border-style: none;' src = "<?php echo '/' . BASE_DIR . '/public/images/icons/knowledge_base/question_b_gray.png' ?>" style='cursor: pointer; height: 80px; width: 80px;'>
				<div style='margin-top: 5px;'><b> Questions </b></div>
			</a>
		</td>
	</tr>
	</table>
</div>

<div id='knowledge-content' style='width: 650px;'>
	<div style='background-color:#F4F4F4; background-image:-webkit-gradient(linear, 0 0%, 0 100%, from(#F4F4F4), to(#EAEAEA)); font-family: tahoma; height: 23px;'>
		<b> Knowledge Share </b>
		<div style='position: absolute; top: 148px; right: 22px; font-family: arial;' id='postnew'>
			<a href="javascript:getpage('index.php?knowledgeshare/create');" class='share-title'> <b><i>Post new share </i></b></a>
		</div>
	</div>
	<div id='work-content'>
	</div>
</div>