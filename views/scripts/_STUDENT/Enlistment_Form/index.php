<script language='javascript'>
var _save =false;
var click=0,clickz='',clickx='',tmp=0, tmp2=0;
var json_obj, lecdays, subjects={};

$(document).ready(function(){
	var windowWidth = $(window).width();
	var windowHeight = $(window).height();
	//hover for main list ( all subject list )
	$('.subject').unbind().bind('mouseover',function(){
		
		var id = $(this).attr('id');
		$('#'+id).css('backgroundColor', 'CCFFFF');
	}).bind('mouseout',function(){
		var id = $(this).attr('id');
		if (click != id ){
			$('#'+id).css('backgroundColor', 'transparent');
		}
	}).bind('click',function(){
		$('#subj_list1').html('');
		clickz='';
		var id = $(this).attr('id');
		if (click > 0){
			$('#'+click).css('backgroundColor', 'transparent');
		}
		click = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
		//find courses
		for( var i = 0; i < json_obj.length; i++){
			if (parseInt(json_obj[i].subject_id) == parseInt(id)){		
				//tmp = i;
				$('#subj_list1').append("<div class='selection_list' id='"+'slist_'+i+'_'+json_obj[i]['season_subj_id']+"'style='font-family: tahoma; font-size: 12px; margin-left: 2px;'> <table><tr><td width='65'>" + json_obj[i]['section']  + "</td>" + "<td width='80'>" + json_obj[i]['lecture_day'] + "</td>" + "<td width='70'>" + json_obj[i]['lecture_time_from'] + "-"  + json_obj[i]['lecture_time_to'] + "</td>" + "<td width='30'>" + json_obj[i]['laboratory_day'] + "</td>" + "<td>" + json_obj[i]['laboratory_time_from'] + "-" + json_obj[i]['laboratory_time_to']+"</td>"+"</tr></table></div>");
			}
		}
	}).css({ cursor: 'pointer'});
	
	// hover for selection subject
	$('.selection_list').live('mouseover mouseout click', function(event) {
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
		if ( clickz.length != id ){
			$('#'+clickz).css('backgroundColor', 'transparent');
		}
		clickz = id;
		tmp = id.split('_')[1];
		tmp2 = id.split('_')[2];
		$('#'+id).css('backgroundColor', 'CCFFFF');
	  }
	});
	
	//hover for selected list
	$('.selected_list').live('mouseover mouseout click', function(event) {
	  if ( event.type == 'mouseover' ) {
		var id = $(this).attr('id');
		$('#'+id).css({ cursor: 'pointer', backgroundColor: 'CCFFFF'});
	  } else if (event.type == 'mouseout' ){
		var id = $(this).attr('id');
		if (clickx != id ){
			$('#'+id).css('backgroundColor', 'transparent');
		}
	  }else if(event.type =='click' ){
		var id = $(this).attr('id');
		if ( clickx.length != id ){
			$('#'+clickx).css('backgroundColor', 'transparent');
		}
		clickx = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
	  }
	});
	
	// for add
	$('#s_add').click(function(){
		if ( clickz.length > 0 ){
			if ( !subjects[tmp2] ){
				//check if the subject id already exist in the selection list
				for( var a in subjects ){
					var _c = subjects[a].split('_')[1];
					//alert(subjects[a]);
					if ( parseInt(_c)  == parseInt(json_obj[tmp]['subject_id']) ){
						alert('This subject code is already on the list');
						return false;
					}
				}
				
				//check for posible conflict time if there is
				//first check if they have the same days, in any of the subjects
				 for (var a in subjects) {
					//alert(subjects[a]);
					for( var i = 0; i < lecdays.length; i++ ){
						// find first matching season subject id
						if ( parseInt(subjects[a].split('_')[0]) == parseInt(lecdays[i]['season_subj_id']) ){
							//loop again, to check the present season subj id
							for ( var x = 0; x < lecdays.length; x++ ){
								//alert( lecdays[i]['lecture_day'] + ' second store');
								if ( parseInt(json_obj[tmp]['season_subj_id']) == parseInt(lecdays[x]['season_subj_id']) ) {
									if ( lecdays[i]['lecture_day'] == lecdays[x]['lecture_day'] ) {
										//now we find a match lecture days, lets now see if the time is conflict to each other
										//so here's the code
										//for lecture time
										if ( parseInt(json_obj[tmp]['lec_from']) >= parseInt(subjects[a].split('_')[2]) ){
											if ( parseInt(subjects[a].split('_')[3]) > parseInt(json_obj[tmp]['lec_from']) ) {
												alert('.Conflict lecture time in ' + subjects[a].split('_')[4]);
												return false;
											}
										}else if ( parseInt(json_obj[tmp]['lec_from']) < parseInt(subjects[a].split('_')[3]) ){
											if ( parseInt(subjects[a].split('_')[3]) <= parseInt(json_obj[tmp]['lec_from']) ){
												alert('..Conflict lecture time in ' + subjects[a].split('_')[4]);
												return false;
											}else if ( parseInt(subjects[a].split('_')[2]) > parseInt(json_obj[tmp]['lec_from']) ){
												//alert( json_obj[tmp][)
												if( parseInt(json_obj[tmp]['lec_to']) > parseInt(subjects[a].split('_')[2]) ){
													alert('...Conflict lecture time in ' + subjects[a].split('_')[4]);
													return false;
												}
											}
										}
										//for laboratory, i didn't include it =))
									}
								}
							}
						}
					}
				}
				 subjects[tmp2] = json_obj[tmp]['season_subj_id'] + '_' + json_obj[tmp]['subject_id'] + '_' + json_obj[tmp]['lec_from'] + '_' + json_obj[tmp]['lec_to'] + '_' + json_obj[tmp]['subject_code'] + '_'+json_obj[tmp]['section']+'_'+json_obj[tmp]['lecture_day']+'_'+json_obj[tmp]['lecture_time_from']+'_'+json_obj[tmp]['lecture_time_to']+'_'+json_obj[tmp]['laboratory_day']+'_'+json_obj[tmp]['laboratory_time_from']+'_'+json_obj[tmp]['laboratory_time_to']+'_'+json_obj[tmp]['code_description']+'_'+json_obj[tmp]['lecture_room']+'_'+json_obj[tmp]['laboratory_room']+'_'+json_obj[tmp]['lec_unit']+'_'+json_obj[tmp]['lab_unit'];	 
				$('#subj_list2').append("<div class='selected_list' id='"+'list_'+json_obj[tmp]['season_subj_id']+"'style='font-family: tahoma; font-size: 12px;'> <table><tr><td width='60'>"+json_obj[tmp]['subject_code']+"</td>"+ "<td width='50'>"+json_obj[tmp]['section']+"</td>"+"<td width='90'>"+json_obj[tmp]['lecture_day']+"</td>"+"<td width='70'>"+json_obj[tmp]['lecture_time_from']+"-"+json_obj[tmp]['lecture_time_to']+"</td>"+"<td width='55'>"+json_obj[tmp]['laboratory_day']+"</td>"+"<td>"+json_obj[tmp]['laboratory_time_from']+"-"+json_obj[tmp]['laboratory_time_to']+"</td>"+"</tr></table></div>");
			}else{
				alert('This subject code is already on the list');
			}
		}else{
			alert('bug');
		}
	});
	
	//remove 
	$('#remove').click(function(){
		if ( clickx.length > 0 ){
			subjects[clickx.split('_')[1]] = '';
			$('#'+clickx).remove();
			clickx = '';
		}
	});
	//view
	$('#view').click(function(){
		
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_viewform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_viewform').height() - 50 ,
				"left":( windowWidth / 2 ) - (($('#_viewform').width() + $('#_viewform').height() - ($('#_viewform').height() / 2) + 170) / 2 )
			}).fadeIn('slow').load('index.php?__student/enlist_view');
		});
	});
	//process
	$('#process').click(function(){
	//check if its ready to save
	//i want to figure out something else for this procedure, 
	//and i don't have enough time to experiment 
	//that's why i will use this LAME algorithm, LAMMEEE, i need some more time to figure it out =))
		for(a in subjects){
			if ( parseInt(subjects[a]) > 0 ){
				_save = true;
			}else{
				_save = false;
			}
		}
		if ( _save ){
			$.post('index.php?__student/enlist_save', { subjects: subjects },function(){
				alert('Enlistment process completed!!');
			});
		}
	});
});
</script>
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd; height: 45px;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px; margin-left: 6px;'>
			<b>Enlistment Form </b>
		</div>
		</br></br>
	</div>
</div>

<div style='width: 240px; height: 450px; border-right: 1px solid #dddddd; float: left; margin-top: 5px;'>
	<div style="height: 24px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/enlist1.png);">
	<table>
	<tr>
	<td>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 10px; margin-top: 3px;'>
			<b> Code </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 30px; margin-top: 3px;'>
			<b> Description</b>
		</div>
	</td>
	</tr>
	</table>
	</div>
	<div>
	<?php 
	if ( is_array( $data['data'] ) ){
		foreach ( $data['data'] as $row ){
	?>
		<div style='margin-top: 1px; width: 239px;' id="<?php echo $row['subject_id'];?>" class='subject'>
		<table>
			<tr>
				<td width='63'><?php echo $row['subject_code']; ?> </td>
				<td> <?php echo $row['subject_description']; ?> </td>
			</tr>
		</table>
		</div>	
	<?php
		}
	}
	?>
	</div>
</div>

<div style='width: 409px; height: 220px; float: right; margin-top: 5px; border-bottom: 1px solid #dddddd; overflow: auto;'>
	<div style="height: 24px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/enlist2.png);">
	<table>
	<tr>
	<td>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 10px; margin-top: 3px;'>
			<b> Section </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lec. Day </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lec. Time </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lab. Day </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lab. Time </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> # </b>
		</div>
	</td>
	<tr>
	</table>
	</div>
	<div id='subj_list1'>
	
	</div>
	<input type='button' id='s_add' style='font-family: tahoma; font-size: 11px; height: 23px; margin-top: 2px;' value='ADD'>
</div>

<div style='width: 409px; height: 220px; float: right; margin-top: 5px;'>
	<div style="height: 24px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/enlist2.png);">
	<table>
	<tr>
	<td>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 10px; margin-top: 3px;'>
			<b> Code </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 15px; margin-top: 3px;'>
			<b> Section </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lec. Day </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lec. Time </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lab. Day </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 25px; margin-top: 3px;'>
			<b> Lab. Time </b>
		</div>
	</td>
	<tr>
	</table>
	</div>
	<div id='subj_list2'>
	<?php
	if ( is_array($data['enlist']) ){
		//POPULATE THE VARIABLE subjects
		//it takes me an hour to figure it out, you need to put a single qoutes in the beginning of the data up to an end
		//example:
		// var test[1] = '1_2_3_4';
		//in my experimentation, if you didnt put single qoutes, javascript will consider it as the passing array, that will be use in the bracket 
		//it will result 'undefined', haha its hard to explain, just try it =))
		echo "<script type='text/javascript'>";
		foreach( $data['enlist'] as $row ){
			echo "subjects[".$row['season_subj_id']."]='".$row['season_subj_id'].'_'.$row['subject_id'].'_'.$row['lecture_time_from'].'_'.$row['lecture_time_to'].'_'.$row['subject_code'].'_'.$row['section'].'_'.$row['lecture_day'].'_'.date('g:iA', $row['lecture_time_from']).'_'.date('g:iA', $row['lecture_time_to']).'_'.($row['w_lab']==1 ? $row['laboratory_day']: '--').'_'.($row['w_lab'] == 1 ? date('g:iA', $row['laboratory_time_from']) : '--').'_'.($row['w_lab'] == 1 ? date('g:iA',$row['laboratory_time_to']) : '--').'_'.$row['subject_description'].'_'.$row['room_name'].'_'.$row['room_name2'].'_'.$row['no_of_unit'].'_'.$row['lab_no_unit']."';";
		}
		echo "</script>";
		//end of explanation
		foreach( $data['enlist'] as $row ){
	?>
		<div class='selected_list' id="<?php echo 'list_'.$row['season_subj_id']?>" style='font-family: tahoma; font-size: 12px;'>
		<table>
		<tr>
			<td width='60'><?php echo $row['subject_code']; ?></td> 
			<td width='50'><?php echo $row['section']; ?></td>
			<td width='90'><?php echo $row['lecture_day']; ?></td>
			<td width='70'><?php echo date('g:iA', $row['lecture_time_from']).'-'.date('g:iA', $row['lecture_time_to']); ?></td>
			<td width='55'><?php echo ($row['w_lab']==1 ? $row['laboratory_day']: '--'); ?> </td>
			<td><?php echo ($row['w_lab'] == 1 ? date('g:iA', $row['laboratory_time_from']) : '--').'-'.($row['w_lab'] == 1 ? date('g:iA',$row['laboratory_time_to']) : '--'); ?></td>
		</tr>
		</table>
		</div>
	<?php
		}
	
	}
	?>
	</div>
	<input type='button' style='font-family: tahoma; font-size: 11px; height: 23px; margin-top: 2px;' value='Remove' id='remove'>
	<input type='button' style='font-family: tahoma; font-size: 11px; height: 23px; margin-top: 2px;' value='View Details' id='view'>
	<input type='button' style='font-family: tahoma; font-size: 11px; height: 23px; margin-top: 2px;' value='Process' id='process'>
</div>
<div id='_viewform' class='popupform' style='width: 750; height: 400px;'>

</div>

<div id='_bgpop' class='popupbg'> 

</div>