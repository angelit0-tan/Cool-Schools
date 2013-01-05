<script language='javascript'>
var save2 = false;
$(document).ready(function(){
	for(var a in subjects){
		var _a = subjects[a].split('_');
		if ( _a != '' ){
			$('#subj_list').append("<div class='selected_list' id='"+'list_'+_a[0]+"'style='font-family: tahoma; font-size: 12px;'> <table><tr><td width='60'>"+_a[4]+"</td>"+"<td width='150'>"+_a[12]+"</td>"+"<td width='35'>"+_a[5]+"</td>"+"<td width='60'>"+_a[6]+"</td>"+"<td width='120'>"+_a[7] +'-'+_a[8]+'/'+_a[13]+"</td>"+"<td width='60'>"+_a[15]+"</td>"+"<td width='60'>"+_a[9]+"</td>"+"<td width='125'>"+_a[10]+'-'+_a[11]+'/'+_a[14]+"</td>"+"<td widt='30'>"+_a[16]+"</td>"+"</tr></table></div>");
			save2 = true;
		}
	}
	//process
	$('#p_proc').click(function(){
		if ( save2 ){
			$.post('index.php?__student/enlist_save', { subjects: subjects },function(){
				$('#p_close').trigger('click');
			});
		}else{
			alert('Cannot continue saving.., no details has found !!');
		}
	});
	//close
	$('#p_close').click(function(){
		$('#_bgpop').fadeOut('slow');
		$('#_viewform').fadeOut('slow');
	});
});
</script>
<div style='height: 220px; border-bottom: 1px solid #dddddd;'>
	<div style="height: 28px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/view.png);">
	<table>
	<tr>
	<td>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 10px; margin-top: 4px;'>
			<b> Code </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 50px; margin-top: 4px;'>
			<b> Description</b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 50px; margin-top: 4px;'>
			<b> Section</b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 15px; margin-top: 4px;'>
			<b> Lec. day </b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 20px; margin-top: 4px;'>
			<b> Lec. Time / Room</b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 20px; margin-top: 4px;'>
			<b> Lec. Unit</b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 15px; margin-top: 4px;'>
			<b> Lab. day</b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 20px; margin-top: 4px;'>
			<b> Lab. Time / Room</b>
		</div>
		<div style='float: left; font-family: tahoma; font-size: 11px; margin-left: 20px; margin-top: 4px;'>
			<b> Lab. Unit</b>
		</div>
	</td>
	</tr>
	</table>
	</div>
	<div id='subj_list' style='overflow: auto;'>
	
	</div>
</div>
<div style='height: 150px; float: left; margin-top: 2px;'>
	<table>
	<tr>
		<td> <b> Total Units : </b></td>
		<td> <input type='text' readonly style='font-family: tahoma; font-size: 11px;' value='' id='total_units'></td>
	</tr>
	<tr>
		<td> <b>Lecture Tuition : </b></td>
		<td> <input type='text' readonly style='font-family: tahoma; font-size: 11px;' value='' id='lec_tuition'</td>
	<tr>
	<tr>
		<td><b>Laboratory Tuition :</b></td>
		<td><input type='text' readonly style='font-family: tahoma; font-size: 11px;' value='' id='lab_tuition'</td>
	</tr>
	<tr>
		<td><b>Miscellaneous :</b></td>
		<td><input type='text' readonly style='font-family: tahoma; font-size: 11px;' value='' id='misc_tuition'</td>
	</tr>
	<tr>
		<td><b>TOTAL TUITION :</b></td>
		<td><input type='text' readonly style='font-family: tahoma; font-size: 11px;' value='' id='tot_tuition'</td>
	</tr>
	<tr>
		<td>
			<input type='button' style='font-family: tahoma; font-size: 11px; height: 28px; width: 60px;' value='Process' id='p_proc'>
			<input type='button' style='font-family: tahoma; font-size: 11px; height: 28px; width: 60px;' value='Close' id='p_close'>
		</td>
	</tr>
	</table>
</div>


<div style='height: 150px; margin-top: 2px;'>
<fieldset>
	<div style="height: 30px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/bgopen.png);">
	<table>
	<tr>
	<td>
		<div style='float: left; font-family: verdana; font-size: 11px; margin-left: 20px; margin-top: 5px;'>
			<b> Misc. Name  </b>
		</div>
		<div style='float: left; font-family: verdana; font-size: 11px; margin-left: 50px; margin-top: 5px;'>
			<b> Rate %</b>
		</div>
		<div style='float: left; font-family: verdana; font-size: 11px; margin-left: 30px; margin-top: 5px;'>
			<b>  Fixed Amount </b>
		</div>
		<div style='float: left; font-family: verdana; font-size: 11px; margin-left: 30px; margin-top: 5px;'>
			<b>  Validation Year </b>
		</div>
	</td>
	<tr>
	</table>
	</div>
	<?php 
	if ( is_array($data) ){
		foreach ( $data as $row ){
	?>
	<div style='height: 21px; margin-top: 1px;' id="<?php echo $row['misc_id'];?>" class='misc'>
	<table>
			<tr>
				<td width='120' style='text-align: center;'> <b><?php echo $row['misc_name']; ?> </b></td>
				<td width='40' style='text-align: right;'> <?php echo $row['misc_percent_rate']; ?> </td>
				<td width='120' style='text-align: right;'> <?php echo $row['misc_amount_rate']; ?> </td>
				<td width='100' style='text-align: right;'> <?php echo $row['validated_year']; ?> </td>
			</tr>
	</table>
	</div>
	<?php
			}
		}
	?>
</fieldset>
</div>

