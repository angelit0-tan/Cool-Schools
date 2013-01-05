<script language='javascript'>
var windowWidth = $(window).width();
var windowHeight = $(window).height();
function edit( url ){
	$('#_bgpop').css({
		'opacity': '0.1'
	}).fadeIn('slow',function(){
		$('#_newform').css({
			'position': 'absolute',
			'top': ( windowHeight / 2 ) - $('#_newform').height() - 40 ,
			"left":( windowWidth / 2 ) - (($('#_newform').width() + $('#_newform').height() - ($('#_newform').height() / 2) + 170) / 2 )
		}).fadeIn('slow').load( url );
	});
}
$(document).ready(function(){

	$("input[name='_status']").bind('change',function(){
		var _status = $("input[name='_status']:checked").val();
		$('#stud_data').load('index.php?__admin/ms_status&stat=' + _status);
	});
	
	$('#_enroll').click(function(){
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_newform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_newform').height() - 40 ,
				"left":( windowWidth / 2 ) - (($('#_newform').width() + $('#_newform').height() - ($('#_newform').height() / 2) + 170) / 2 )
			}).fadeIn('slow').load('index.php?__admin/ms_new');
		});
	});
});
</script>
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd; height: 72px;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 5px; margin-left: 6px;'>
			<b>Manage Students </b>
		</div>
		<div style='float: right; font-family: tahoma; font-size: 11px; width: 450px;'>
		<!-- edit -->
			<ul style='list-style-type: none; padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 0px;'>
				<li>
					<input type='radio' name='_status' checked value='all' id='_status' style='margin-left: 20px;'/> List of all Students
					<input type='radio' name='_status' value='enrolled' id='_status' style='margin-left: 20px;'/> Enrolled Students
					<input type='radio' name='_status' value="<?php echo $data['user_type'][0]['status_id']; ?>" id='_status' style='margin-left: 20px;'/> <?php echo $data['user_type'][0]['status']. ' ' . 'Students';?>
				</li>
			<?php
				$i = 1;
				$count = ceil (count($data['user_type']) / 3) ;
				for ($z = 1; $z <= ( $count - 1 ) ; $z++){
				//echo $data['user_type'][1]['status'];
			?>
				<li>
					<?php
						for($i; $i <= ($z * 3); $i++){
					?>
						<input type='radio' name='_status' value="<?php echo $data['user_type'][$i ]['status_id']; ?>" id='_status' style='margin-left: 20px;'/> <?php echo $data['user_type'][$i ]['status']. ' ' .'Students'; ?>
					<?php
						}
					?>
				</li>
			<?php
				}
			?>
			</ul>
		</div>
		<div style='float: left; margin-top: 10px;'>
			<input type='button' style='height: 29px; width: 150px; font-size: 12px;' value='Enroll New Student' id='_enroll' name='_enroll'>
		</div>
	</div>
</div>
	
<div style='margin-top: 5px;' id='stud_data'>
<table>
	<?php	
		//print_r ($data['students'][1]['user_name']);
		$count =  ceil( count($data['students']) / 3 );
		$i = 1;
		for( $z=1; $z <= $count; $z++ ){
	?>
	<tr>
		<?php
			for( $i; $i<=($z * 3); $i++ ){
				if ( isset($data['students'][$i - 1]) )
				{
		?>
			<td> 
				<div style=' height: 110px; width: 212px; border-bottom: 1px solid #dddddd;' class='m_box-block' id="<?php echo $data['students'][$i - 1]['user_id'];?>">
					<div style='float: left; height: 55px; width: 56px;'>
						<a href="index.php?__profile/profile&id=<?php echo $data['students'][$i - 1]['user_id'];?>"><img style='height: 55px; width: 56px;' src="index.php?__profile/s_list&id=<?php echo $data['students'][$i - 1]['user_id'];?>" ></a>
					</div>

					<div style='float: left; height: 105px; width: 154px; font-family: tahoma; border-right: 1px solid #dddddd; '>
					<ul style='list-style-type: none; padding-top: 0px; padding-bottom: 0px; padding-right: 0px; padding-left: 4px; font-size: 11px;'>
						<li align='left'>
							<b> Name: </b> <span style='margin-left: 4px;'> <?php echo $data['students'][$i - 1]['lastname'] . ', ' . $data['students'][$i - 1]['firstname']; ?> </span>
						</li>
						<li align='left' style='margin-top: 3px;'>
							<b>B-Day:</b> <span style='margin-left: 4px;'> <?php echo date('F d, Y', strtotime($data['students'][$i - 1]['birthday'])); ?> </span>
						</li>
						<li align='left' style='margin-top: 3px;'>
							<b>Status:</b> <span style='margin-left: 4px;'> <?php echo $data['students'][$i - 1]['status'];?> </span>
						</li>
						<li align='left' style='margin-top: 3px;'>
							<b>Contact:</b> <span style='margin-left: 4px;'> <?php echo $data['students'][$i - 1]['contact'];?> </span>
							<li style='margin-top: 6px;'>
								<a href="javascript:edit('index.php?__admin/ms_edit&id=<?php echo $data['students'][$i - 1]['user_id'];?>');"><b> Edit Information </b></a>
							</li>
							<li style='margin-top: 2px;'>
								<a href="javascript:view('index.php?__admin/ms_edit&id=<?php echo $data['students'][$i - 1]['user_id'];?>');"><b> View Details </b></a>
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
<div id='_newform' class='popupform' style='width: 700; height: 240px;'>

</div>

<div id='_bgpop' class='popupbg'> 

</div>