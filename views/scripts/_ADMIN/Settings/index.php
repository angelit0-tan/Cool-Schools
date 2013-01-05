<script language='javascript'>

//$(window).height()
$(document).ready(function(){
var windowWidth = $(window).width();
var windowHeight = $(window).height();
var click = 0;	
	//$('#cancel').click(function(){
	$('#addmisc').click(function(){
		$('#_bgpop').css({
			'opacity': '0.1'
		}).fadeIn('slow',function(){
			$('#_miscform').css({
				'position': 'absolute',
				'top': ( windowHeight / 2 ) - $('#_miscform').height() - 50 ,
				"left":( windowWidth / 2 ) - (($('#_miscform').width() + $('#_miscform').height() - ($('#_miscform').height() / 2) + 170) / 2 )
			}).fadeIn('slow').load('index.php?__admin/set_new');
		});
	});
	//edit
	$('#editmisc').click(function(){
		if ( click > 0 ){
			$('#_bgpop').css({
				'opacity': '0.1'
			}).fadeIn('slow',function(){
				$('#_miscform').css({
					'position': 'absolute',
					'top': ( windowHeight / 2 ) - $('#_miscform').height() - 50 ,
					"left":( windowWidth / 2 ) - (($('#_miscform').width() + $('#_miscform').height() - ($('#_miscform').height() / 2) + 170) / 2 )
				}).fadeIn('slow').load('index.php?__admin/set_edit&misc_id='+click);
			});
		}
	});
	//save
	$('#miscSave').click(function(){
		$.post('index.php?__admin/save_school_info',
		{
			school_address: $('#school_address').val().replace(/^[\s]+/g,''), contact_no: $('#contact_no').val(), suffix: $('#suffix').val(), start_digit: $('#start_digit').val(),
			minimum_unit: $('#minimum_unit').val(), maximum_unit: $('#maximum_unit').val(), season_id: $('#season_type').val(), email: $('#email').val(),
			ceo: $('#ceo').val(), vice_ceo: $('#vice_ceo').val(), per_stud_subject: $('#per_stud_subject').val()
		});
			/*
			,function(){
				$('.content-body').load('index.php?__admin/set_index');
			});*/
	});
	//hover
	$('.misc').unbind().bind('mouseover',function(){
		var id = $(this).attr('id');
		$('#'+id).css('backgroundColor', 'CCFFFF');
	}).bind('mouseout',function(){
		var id = $(this).attr('id');
		if (click != id ){
			$('#'+id).css('backgroundColor', 'transparent');
		}
	}).bind('click',function(){
		var id = $(this).attr('id');
		if (click > 0){
			$('#'+click).css('backgroundColor', 'transparent');
		}
		click = id;
		$('#'+id).css('backgroundColor', 'CCFFFF');
	}).css({ cursor: 'pointer'});
	/*
	function pack(inStr) {
        var val = (arguments.length) ? (inStr) ? inStr : '' : this.toString(); // if called as a method
		val = val.replace(/^[\s]+/g,'');    // leading whitespace -> null
		val = val.replace(/[\s]+$/g,'');    // trailing whitespace -> null
		val = val.replace(/[\s]{2,}/g,' '); // multiple whitespace -> space
	return val;
	}
	String.prototype.pack = pack;
	*/
	//$('#school_address').val( $('#school_address').val().pack());
	// t.attr('src',t.attr('src').replace(/([^.]*)\.(.*)/, "$1-over.$2"));
	
	//$('#school_address').val( $('#school_address').val().replace(/^[\s]+/g,'') );
});
</script>
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd; height: 45px;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px; margin-left: 6px;'>
			<b>Settings </b>
		</div>
		</br></br>
	</div>
</div>

<div>
<table>
<tr>
	<td style='vertical-align: text-center; text-align: right;'>
		<b>School Address : </b>
	</td>
	<td>
		<textarea id='school_address' cols='35' name='school_address'><?php echo $data['info'][0]['school_address']; ?></textarea> 
	</td>
	<td align='right'>
		<b>Tel # :</b>
	</td>
	<td>
		 <input type='text' id='contact_no' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['school_contact']; ?>">
	</td>
</tr>
<tr>
	<td align='right'>
		<b>Identification Suffix : <b>
	</td>
	<td>
		 <input type='text' id='suffix' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['school_suffix']; ?>">
	</td>
	<td align='right'>
		<b> Starting Digit : </b>
	</td>
	<td>
		 <input type='text' id='start_digit' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['start_digit']; ?>">
	</td>
</tr>
<tr>
	<td align='right'> 
		<b>Minimum Unit :</b>
	</td>
	<td>
		 <input type='text' id='minimum_unit' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['minimum_unit']; ?>">
	</td>
	<td>
		<b>Maximum Unit :</b>
	</td>
	<td>
		 <input type='text' id='maximum_unit' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['maximum_unit']; ?>">
	</td>
</tr>
<tr>
	<td align='right'>
		<b>Season Type :</b>
	</td>
	<td>
		<select id="season_type" name="season" style="font-size: 11px; width: 127px;">
			<?php
				foreach ( $data['type'] as $type ){
			?>
				<option <?php echo ( $type['season_id'] == $data['info'][0]['season_id'] ? 'selected' : '') ;?> value="<?php echo $type['season_id']; ?>"> <?php echo $type['season_type']; ?></option>
			<?php
				}
			?>
		</select>
	</td>
	<td align='right'>
		<b>E-mail Add : </b>
	</td>
	<td>
		<input type='text' id='email' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['email_address']; ?>">
	</td>
</tr>
<tr>
	<td align='right'>
		<b>CEO :</b>
	</td>
	<td>
		<input type='text' id='ceo' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['ceo']; ?>">
	</td>
	<td align='right'>
		<b>Vice CEO :</b>
	</td>
	<td>
		<input type='text' id='vice_ceo' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['vice_ceo']; ?>">
	</td>
</tr>
<tr>
	<td align='right'>
		<b># of student per subject :</b>
	</td>
	<td>
		<input type='text' id='per_stud_subject' style='font-size: 11px; font-family: tahoma;' value="<?php echo $data['info'][0]['maximum_student_per_subject']; ?>">
	</td>
</tr>
</table>
</div>
<div style='margin-top: 5px;'>
<input type='button' style='width: 130px; height: 25px; font-family: tahoma; font-size: 11px;' value='Add Miscellaneous' id='addmisc'>
<input type='button' style='width: 130px; height: 25px; font-family: tahoma; font-size: 11px;' value='Edit Miscellaneous' id='editmisc'>
<input type='button' style='width: 130px; height: 25px; font-family: tahoma; font-size: 11px;' value='Delete Miscellaneous' id='delmisc'>
<input type='button' style='width: 50px; height: 25px; font-family: tahoma; font-size: 11px;' value='Save' id='miscSave'>
	<div style="height: 30px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/bgopen.png);">
		<table>
		<tr>
		<td>
			<div style='float: left; font-family: verdana; font-size: 12px; margin-left: 60px; margin-top: 5px;'>
				<b> Misc. Name  </b>
			</div>
			<div style='float: left; font-family: verdana; font-size: 12px; margin-left: 120px; margin-top: 5px;'>
				<b> Rate %</b>
			</div>
			<div style='float: left; font-family: verdana; font-size: 12px; margin-left: 40px; margin-top: 5px;'>
				<b>  Fixed Amount </b>
			</div>
			<div style='float: left; font-family: verdana; font-size: 12px; margin-left: 40px; margin-top: 5px;'>
				<b>  Validation Year </b>
			</div>
		</td>
		<tr>
		</table>
	</div>
	
	<?php 
	if ( is_array($data['misc']) ){
		foreach ( $data['misc'] as $row ){
	?>
	<div style='height: 21px; margin-top: 1px; width: 635px;' id="<?php echo $row['misc_id'];?>" class='misc'>
	<table>
			<tr>
				<td width='200' style='text-align: center;'> <?php echo $row['misc_name']; ?> </td>
				<td width='80' style='text-align: right;'> <?php echo $row['misc_percent_rate']; ?> </td>
				<td width='130' style='text-align: right;'> <?php echo $row['misc_amount_rate']; ?> </td>
				<td width='100' style='text-align: right;'> <?php echo $row['validated_year']; ?> </td>
			</tr>
	</table>
	</div>
	<?php
			}
		}
	?>
	
</div>
<div id='_miscform' class='popupform' style='width: 290; height: 175px;'>

</div>

<div id='_bgpop' class='popupbg'> 

</div>