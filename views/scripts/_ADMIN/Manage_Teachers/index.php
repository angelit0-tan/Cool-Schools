<script language='javascript'>
function assign( url ){
	$('#_bgpop').css({
		'opacity': '0.1'
	}).fadeIn('slow',function(){
		$('#_assignform').css({
			'position': 'absolute',
			'top': ( windowHeight / 2 ) - $('#_profform').height() - 240 ,
			"left":( windowWidth / 2 ) - (($('#_profform').width() + $('#_profform').height() - ($('#_profform').height() / 2) + 170) / 2 )
		}).fadeIn('slow').load( url );
	});
}

function view( url ){
	$('#_bgpop').css({
		'opacity': '0.1'
	}).fadeIn('slow',function(){
		$('#_viewform').css({
			'position': 'absolute',
			'top': ( windowHeight / 2 ) - $('#_profform').height() - 240 ,
			"left":( windowWidth / 2 ) - (($('#_profform').width() + $('#_profform').height() - ($('#_profform').height() / 2) + 170) / 2 )
		}).fadeIn('slow').load( url );
	});
}
$(document).ready(function(){
	var windowWidth = $(window).width();
	var windowHeight = $(window).height();
	var x_id = 0;
	//add new
	$('#_prof').click(function(){
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_profform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_profform').height() - 70 ,
				"left":( windowWidth / 2 ) - (($('#_profform').width() + $('#_profform').height() - ($('#_profform').height() / 2) + 30) / 2 )
			}).fadeIn('slow').load('index.php?__admin/m_new');
		});
	});
	//edit
	$('#_prof_edit').click(function(){
		if(x_id > 0){
			$('#_bgpop').css({
				'opacity': '0.1'
			}).fadeIn('slow',function(){
				$('#_profform').css({
					'position': 'absolute',
					'top': ( windowHeight / 2 ) - $('#_profform').height() - 70 ,
					"left":( windowWidth / 2 ) - (($('#_profform').width() + $('#_profform').height() - ($('#_profform').height() / 2) + 30) / 2 )
				}).fadeIn('slow').load('index.php?__admin/m_edit&id='+x_id);
			});
		}
	});
	
	$('.m_box-block').bind(
		"mouseenter mouseleave mousedown",
		function(event){
			if(event.type=='mouseenter'){
				if(this.id!=x_id){
					$(this).css({background:'#E0FFFF'});
				}
			}
			else if(event.type=='mouseleave')
			{
				if(this.id!=x_id){
					$(this).css({background:'white'});
				}
			}
			else
			{
				x_id=this.id;
				$(".m_box-block").css({background:'white'});
				$(this).css({background:'#E0FFFF'});
				
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
			<b>Manage Teachers / Professors </b>
		</div>
		<div style='float: right; margin-top: 15px;'>
			<input type='button' style='height: 23px; width: 150px; font-size: 11px;' value='Edit Teacher / Professor' id='_prof_edit'>
			<input type='button' style='height: 23px; width: 150px; font-size: 11px;' value='New Teacher / Professor' id='_prof'>
		</div>
		</br></br>
	</div>
</div>
<div style='margin-top: 5px;'>
	<table>
	<?php
		$count =  ceil( count($data) / 3 );
		$i = 1;
		for( $z=1; $z <= $count; $z++ ){
	?>
	<tr>
		<?php
			for( $i; $i<=($z * 3); $i++ ){
				if ( isset($data[$i - 1]) )
				{
				
		?>
			<td> 
				<div style=' height: 110px; width: 212px; border-bottom: 1px solid #dddddd;' class='m_box-block' id="<?php echo $data[$i - 1]['user_id'];?>">
					<div style='float: left; height: 55px; width: 56px;'>
						<img style='height: 55px; width: 56px;' src="index.php?__profile/s_list&id=<?php echo $data['students'][$i - 1]['user_id'];?>" >
					</div>

					<div style='float: left; height: 105px; width: 154px; font-family: tahoma; border-right: 1px solid #dddddd; '>
					<ul style='list-style-type: none; padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 4px; font-size: 11px;'>
						<li align='left'>
							<b> Name: </b> <span style='margin-left: 4px;'> <?php echo $data[$i - 1]['lastname'] . ', ' . $data[$i - 1]['firstname']; ?> </span>
						</li>
						<li align='left' style='margin-top: 3px;'>
							<b>B-Day:</b> <span style='margin-left: 4px;'> <?php echo date('F d, Y', strtotime($data[$i - 1]['birthday'])); ?> </span>
						</li>
						<li align='left' style='margin-top: 3px;'>
							<b>Status:</b> <span style='margin-left: 4px;'> <?php echo $data[$i - 1]['status'];?> </span>
						</li>
						<li align='left' style='margin-top: 3px;'>
							<b>Contact:</b> <span style='margin-left: 4px;'> <?php echo $data[$i - 1]['contact'];?> </span>
							<li style='margin-top: 6px;'>
								<a href="javascript:assign('index.php?__admin/m_assign&id=<?php echo $data[$i - 1]['user_id'];?>');"><b> Assign </b></a>
							</li>
							<li style='margin-top: 2px;'>
								<a href="javascript:view('index.php?__admin/m_view&id=<?php echo $data[$i - 1]['user_id'];?>');"><b>View details</b></a>
							</li>
						</li>
						
					</ul>
					</div>
				</div>
			</td>	
		<?php 
				}
		}
		?>
	</tr>
	<?php
	}
	?>
	</table>
</div>
<div id='_assignform' class='popupform' style='width: 700; height: 610px;'>

</div>
<div id='_viewform' class='popupform' style='width: 700; height: 460px;'>

</div>
<div id='_profform' class='popupform' style='width: 750; height: 240px;'>

</div>
<div id='_bgpop' class='popupbg'> 

</div>
