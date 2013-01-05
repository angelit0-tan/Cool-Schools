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
						<img src="index.php?__profile/s_list&id=<?php echo $data['students'][$i - 1]['user_id'];?>" style='height: 55px; width: 56px;'>
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
