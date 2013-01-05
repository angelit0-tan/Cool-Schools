<script language='javascript'>
$(document).ready(function(){
	$('input[type="text"]').focus( function() {
		if ($(this).attr('id') == 'status') return false;
		//$('#c_id_'+$(this).attr('id').split('_')[1]).show().focus().val('').addClass('focusComment').focusout(function(){
		$(this).val('').addClass('focusComment').focusout(function(){
			$(this).val('Write a comment..').removeClass().addClass('idleComment');
		}).keypress(function(e){
			if (e.which == 13) {
			//
				var text = $(this).val().replace(/\n\r?/g, '<br />');
				var xtext = text.split('<br />');
				var len_text = 0;
				var fix_txt = '';

				if (xtext.length == 1 ){
					if ( xtext[0].length >= 76 ){
						len_text = Math.ceil(parseInt(xtext[0].length) / 76,2);
						
						for(i=1; i<=len_text ; i++){
							if (i > 0){
							fix_txt += ( fix_txt == '' ? xtext[0].substring(i,i*76) + '<br />' :  xtext[0].substring( ((i*76) - (76)) + 1,i*76) + '<br />');		
							}
						}
					}else{
							fix_txt = $(this).val();
					}
				}else{
					for(i=0; i<= (xtext.length - 1); i++){
						//check if its more than 76
							if ( xtext[i].length >= 76 ){
								len_text = Math.ceil(parseInt(xtext[i].length) / 76,2);
								
									for(x=1; x<=len_text ; x++){
										if (x == 1){
											fix_txt += xtext[i].substring( 76, 0) + '<br />';
										}else{
											fix_txt += xtext[i].substring( (xtext[i].length - 76,  (x * 76) - 76)) + '</br>';
										}
									}		
							}else{
								if ( i == (xtext.length - 1) ) {
									fix_txt += xtext[i];
								}else{
									fix_txt += xtext[i] + '<br />';
								}
							}
					}
				}
			//
				//alert(fix_txt);
				var xid = $(this).attr('id').split('_');
				$.post('index.php?__profile/u_sent_cmnt', { c: fix_txt, xid: $(this).attr('id') },function(data, response){
					if ( response ){
						var json_obj = $.parseJSON(data);
						//alert(json_obj.f_n);
						$('#c_data_'+xid[2]).append("<div style='width: 95%;background-color: #F0F0FF; height: auto;'>"+
							"<div style='background-color: #F0F0FF; height: auto; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #C4DBD4;'>"+
							"<form>"+
							"<table style='width: 100%;'>"+
							"<tr>"+
								"<td style='align: center; position: absolute;'>"+
									"<a href='index.php?__profile/profile&id=<?php echo $_SESSION['user_id'];?>'>" + "<img style='height: 30px; width: 30px;' src= 'index.php?__profile/s_list&id=<?php echo $_SESSION['user_id'];?>' >" +
								"</td>"+
								"<td>"+
									"<div style='margin-left: 35px; height: auto; width: 89%;'>"+
										"<div style='font-size: 11px; width: 100%; height: auto;'>"+
											"<a href='index.php?__profile/profile&id=<?php echo $_SESSION['user_id'];?>'><b>"+json_obj.f_n+' '+json_obj.l_n+"</b></a> "+
											fix_txt+
											"<div style='color: red;'>"+
												"<span>"+json_obj.d_t+' at '+json_obj.a_t+"</span>"+
											"</div>"+
										"</div>"+
									"</div>"+
								"</td>"+
							"</tr>"+
							"</table>"+
							"</form>"+
							"</div>"+
							"</div>");
					}
				});
				$(this).val('');
			}
		});
	});
	
	$('#status').focus(function(){
		$(this).hide();
		$('#stat_show').show();
		$('#status2').ata().focus();
	}).focusout(function(){
		
		
	});
	//
	$('#i_post').click(function(){
		var text = $('#status2').val().replace(/\n\r?/g, '<br />');
		var xtext = text.split('<br />');
		var len_text = 0;
		var fix_txt = '';
	
		if (xtext.length == 1 ){
			if ( xtext[0].length >= 76 ){
				len_text = Math.ceil(parseInt(xtext[0].length) / 76,2);
				
				for(i=1; i<=len_text ; i++){
					if (i > 0){
					fix_txt += ( fix_txt == '' ? xtext[0].substring(i,i*76) + '<br />' :  xtext[0].substring( ((i*76) - (76)) + 1,i*76) + '<br />');		
					}
				}
			}else{
					fix_txt = $('#status2').val();
			}
		}else{
			for(i=0; i<= (xtext.length - 1); i++){
				//check if its more than 76
					if ( xtext[i].length >= 76 ){
						len_text = Math.ceil(parseInt(xtext[i].length) / 76,2);
						
							for(x=1; x<=len_text ; x++){
								if (x == 1){
									fix_txt += xtext[i].substring( 76, 0) + '<br />';
								}else{
									fix_txt += xtext[i].substring( (xtext[i].length - 76,  (x * 76) - 76)) + '</br>';
								}
							}		
					}else{
						if ( i == (xtext.length - 1) ) {
							fix_txt += xtext[i];
						}else{
							fix_txt += xtext[i] + '<br />';
						}
					}
			}
		}
		$.get('index.php?__profile/uprepend_post&m_i_stat='+fix_txt,function(data, response){
			if (response =='success'){
			var json_obj = $.parseJSON(data);
			
				$("<div id='_cid'"+json_obj.id+"style='height: auto; margin-bottom: 10px; margin-top: 10px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);'>"+
					"<table style='width: 100%;height: 56px;'>"+
					"<tr>"+
						"<td style='align: center; top: middle; position: absolute;'>"+
							"<img style='height: 50px; width: 50px;' src= <?php echo "index.php?__profile/s_list&id=1"; ?> >" +
						"</td>"+
						"<td align='left' valign='top' style='font-family: tahoma; font-size: 12px; text-decoration: none;'>"+
							"<div style='margin-left: 55px;'>"+
							
								"<a href='index.php?__profile/profile&id=<?php echo $_SESSION['user_id'];?>'> <b>"+json_obj.f_n+' '+json_obj.l_n+"</b></a>"+
								"<div style='font-size: 11px; cursor: none; margin-top: 4px; width: 66%; height: auto; margin-bottom: 10px;'>"+
									"<span>"+json_obj.status+"</span>"+
								"</div>"+
							"</div>"+
						"</td>"+
					"</tr>"+
					"</table>"+
				"</div>").prependTo('#content-area_data_tmp');	

			}
		});
	});
	//
	//hover comment
	$('.comment-area').unbind().bind('mouseover',function(){
		idz = $(this).attr('id').split('_');
			$('#'+idz[2]+'choi').show();
	}).bind('mouseout',function(){
			$('#'+idz[2]+'choi').hide();
	});
	//delete comment
	$('.d_cmnt').click(function(){
		comment_id = $(this).attr('id').split('choi');
		//alert(comment_id[0]);
		$.post('index.php?__profile/u_del_cmnt', { comment_id : comment_id[0] }, function(data, response){
			if ( response ){
				$('#c_area_'+comment_id[0]).remove();
			}
		});
	});
	//hover wall
	$('.wall_area').unbind().bind('mouseover',function(){
		id = $(this).attr('id').split('_');
		$('#'+id[1]+'_wall').show();
	}).bind('mouseout',function(){
		$('#'+id[1]+'_wall').hide();
	});
	//delete wall
	$('.d_wall').click(function(){
		//delete
		id = $(this).attr('id').split('_');
		$.get('index.php?__profile/u_del_wall', { wall_id : id[0] }, function(data, response){
			if ( response ){
				$('#cid_'+id[0]).remove();
			}
		});
	});
	
});
</script>
<input name='status' class='idleField' id='status' style='font-color: #000000;' value='Type something here' type='text'/>
<div id='stat_show' style='display:none;'>
	<textarea class='focusField' id='status2' ></textarea>
	<input type='button' id='i_post' value='Post' style='background-color:#fed; border:1px solid; border-color: #696 #363 #363 #696; margin-top: 4px;'/>
</div>
<div id='content-area_data_tmp'>	
<?php
	if ( isset($data['wall'][0]) ) {
		foreach ($data['wall'][0] as $row){
?>
	<div class='wall_area' id="cid_<?php echo $row['wall_id'];?>" style='height: auto; margin-bottom: 10px; margin-top: 10px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);'>
	<div style='font-family: arial;font-size: 16px; display: none; float: right; cursor: pointer; width: 22px; text-align: center;' class='d_wall' id="<?php echo $row['wall_id'].'_wall';?>"> <a>X</a></div>
		<table style='width: 100%;height: 56px;'>
		<tr>
			<td style='align: center; top: middle; position: absolute;'> 
					<a href="index.php?__profile/profile&id=<?php echo $row['from_id'];?>"><img style='height: 50px; width: 50px;' src='index.php?__profile/s_list&id=<?php echo $row['from_id'];?>'></a>
			</td>
			<td align='left' valign='top' style='text-decoration: none;'>
				<div style='margin-left: 55px;'>
					<div id="c_data_<?php echo $row['wall_id'];?>">
					
					<a href="index.php?__profile/profile&id=<?php echo $row['from_id'];?>"> <b> <?php echo ucfirst($row['firstname']) . ' ' . ucfirst($row['lastname']); ?> </b> </a>
						<div style='font-size: 11px; cursor: none; margin-top: 4px; width: 66%; height: auto; margin-bottom: 10px;'>
							
							<span> <?php echo $row['wall_post'];?> </span>
							<!--
							<input type='button' id="bC_<?php //echo $row['wall_id'];?>" style='color: #0000FF; background-color: transparent; margin-top: 2px; font-size: 11px;cursor: pointer;  border:none;' value='Comment'/>					
							-->
						</div>
						<div style='width: 95%;background-color: #F0F0FF; height: auto;'>
							<?php 
							if( isset($data['wall'][1]) ){
								foreach( $data['wall'][1] as $row2 ){
									if ( isset($row2['wall_id']) ){
										if( $row2['wall_id'] == $row['wall_id'] ){
							?>
								<div class='comment-area' id="c_area_<?php echo $row2['w_c_id'];?>" style='background-color: #F0F0FF; height: auto; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #C4DBD4;'>
								<div style='font-family: arial; font-size: 12px;float: right; display: none; cursor: pointer; width: 22px; text-align: center;' class='d_cmnt' id="<?php echo $row2['w_c_id'].'choi';?>"> <a>X</a></div>
								<form>					
								<table style='width: 100%;'>
								<tr>
									<td style='align: center; position: absolute;'>
										<a href="index.php?__profile/profile&id=<?php echo $row2['user_id'];?>"><img style='height: 30px; width: 30px;' src='index.php?__profile/s_list&id=<?php echo $row2['user_id'];?>' ></a>
									</td>
									<td>
										<div style='margin-left: 35px; height: auto; width: 89%;'>
											<div style='font-size: 11px; width: 100%; height: auto;'>
												<a href="index.php?__profile/profile&id=<?php echo $row2['user_id'];?>"> <b> <?php echo ucfirst($row2['firstname']) . ' ' . ucfirst($row2['lastname']); ?> </b> </a>
												<?php echo $row2['wall_comment'];?>
												<div style='color: red;'>
													<span> <?php echo date('F d',strtotime($row2['comment_date'])) .' at ' .date('h:i A',strtotime($row2['comment_date']));?> </span>
												</div>
											</div>
										</div>
									</td>
								</tr>
								</table>
								</form>
								</div>
							<?php
										}
									}
								}
							}
							?>
							
						</div>
					</div>
					<input type='text' id="c_id_<?php echo $row['wall_id'];?>" class='idleComment' value='Write a comment..'/>
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