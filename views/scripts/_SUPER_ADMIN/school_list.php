<script language='javascript'>
var cnt = 0;
$(document).ready(function(){
	//hover
	$('.list').unbind().bind('mouseover', function(){
		id= $(this).attr('id');
		$('#'+id+'choi').show();
	}).bind('mouseout', function(){
		id=$(this).attr('id');
		$('#'+id+'choi').hide();
	});
	
	// icon user click
	$('.user').click(function(){
		user_id = $(this).attr('id');
		if( !$('#'+user_id+'user').is(':visible') ){
			$('#'+user_id+'profile').hide();
			$('#'+user_id+'data').show();
			$('#'+user_id+'user').show();
		}else{
			$('#'+user_id+'user').hide(); 
			$('#'+user_id+'data').hide();
		}
	
	});
	//icon delete click
	$('.delete').click(function(){
		id_del = $(this).attr('id');
	});
	
	//icon edit click
	$('.edit').click(function(){
		id_edit = $(this).attr('id');
		if( !$('#'+id_edit+'profile').is(':visible') ){
			$('#'+id_edit+'user').hide();
			$('#'+id_edit+'data').show();
			$('#'+id_edit+'profile').show();
		}else{
			$('#'+id_edit+'profile').hide();
			$('#'+id_edit+'data').hide();
		}
	});
	
	//for saving
	$('.save').unbind().bind('mouseover', function(){
		$(this).css("text-decoration", "underline");
	}).bind('mouseout', function(){
		$(this).css("text-decoration", "none");
	}).bind('click',function(){
	//
		id = $(this).attr('id');
			var error = 0;
		if ($('#'+id+'school_name').val() == '') {
			error = 1;
			$('#'+id+'error_school').fadeIn();
			$('#'+id+'error_school').html(' * Please input a school name ');
		}else{
			$('#'+id+'error_school').fadeOut();
		}
		
		if ($('#'+id+'school_country').val() == ''){
			error = 1;
			$('#'+id+'error_country').fadeIn();
			$('#'+id+'error_country').html(' * Please input a country ');
		}else{
			$('#'+id+'error_country').fadeOut();
		}
		
		if ($('#'+id+'school_suffix').val() == ''){
			$('#'+id+'error_suffix').fadeIn();
			$('#'+id+'error_suffix').html(' * Please input a school suffix ');
			error = 1;
		}else{
			$('#'+id+'error_suffix').fadeOut();
		}
		
		if ( error == 0 ){
			$.post('index.php?menu_SuperAdmin/_editprofile',
			{ 
				school_name: $('#'+id+'school_name').val(), school_country: $('#'+id+'school_country').val(), school_address: $('#'+id+'school_address').val(),
				school_suffix: $('#'+id+'school_suffix').val(), school_contact: $('#'+id+'contact').val() , school_id: id
			}, function(data){
				//
				if( !$('#'+id+'profile').is(':visible') ){
					$('#'+id+'user').hide();
					$('#'+id+'data').show();
					$('#'+id+'profile').show();
				}else{
					$('#'+id+'profile').hide();
					$('#'+id+'data').hide();
				}
				//
				$('#'+id+'divname').html( "<a href='#'>" + "<b>" + $('#'+id+'school_name').val() + "</b>" + "</a>" );
				$('#'+id+'divcountry').html ( $('#'+id+'school_country').val() );
				$('#'+id+'divaddress').html ( $('#'+id+'school_address').val() );
				$('#'+id+'divcontact').html ( $('#'+id+'contact').val() );
			});
		}
	//
	});
	
	//add new user
	$('.userbut').unbind().bind('mouseover', function(){
		$(this).css("text-decoration", "underline");
	}).bind('mouseout', function(){
		$(this).css("text-decoration", "none");
	}).bind('click',function(){
	//
	id=$(this).attr('id');
		var _err_user = 0;
		
		//firstname = null
		if ( $('#'+id+'firstname').val() == 0 ){
			_err_user = 1;
			$('#'+id+'tdfname').html('<b> * Firstname : </b>').css({ color: 'red' });
		}else{
			$('#'+id+'tdfname').html('<b> Firstname : </b>').css({ color: 'black' });
		}
		
		//middlename = null
		if ( $('#'+id+'middlename').val() == 0 ){
			_err_user = 1;
			$('#'+id+'tdmname').html('<b> * Middlename : </b>').css({ color: 'red' });
		}else{
			$('#'+id+'tdmname').html('<b> Middlename : </b>').css({ color: 'black' });
		}
		
		//lastname = null
		if ( $('#'+id+'lastname').val() == 0 ){
			_err_user = 1;
			$('#'+id+'tdlname').html('<b> * Lastname : </b>').css({ color: 'red' });
		}else{
			$('#'+id+'tdlname').html('<b> Lastname : </b>').css({ color: 'black' });
		}
		
		//username = null
		if ( $('#'+id+'username').val() == 0 ){
			_err_user = 1;
			$('#'+id+'tdusername').html('<b> * Username : </b>').css({ color: 'red' });
		}else{
			$('#'+id+'tdusername').html('<b> Username : </b>').css({ color: 'black' });
		}
		
		//password = null
		if ( $('#'+id+'password').val() == 0 ){
			_err_user = 1;
			$('#'+id+'tdpass').html('<b> * Password : </b>').css({ color: 'red' });
		}else{
			$('#'+id+'tdpass').html('<b> Password : </b>').css({ color: 'black' });
		}
		
		//confirm password = null
		if ( $('#'+id+'confirm').val() == 0 ){
			_err_user = 1;
			$('#'+id+'tdcpass').html('<b> * Confirm Password : </b>').css({ color: 'red' });
		}else{
			$('#'+id+'tdcpass').html('<b> Confirm Password : </b>').css({ color: 'black' });
		}
		
		//if all inputs are there
		//check if password and confirm password match
		
		if ( _err_user == 0 ){
			if ( $('#'+id+'password').val() == $('#'+id+'confirm').val() ){
				$.post('index.php?menu_SuperAdmin/create_user',
				{
					school_id: id, fname: $('#'+id+'firstname').val(), mname: $('#'+id+'middlename').val(), lname: $('#'+id+'lastname').val(),
					username: $('#'+id+'username').val(), password: $('#'+id+'password').val(), pconfirm: $('#'+id+'confirm').val(), usertype: $('#'+id+'usertype').val()
				});
			}else{
				//$('#'+id+'area1').append('not match');
				alert('Password not match');
			}
		}
	//
	});
});
</script>
<div style='border-bottom: 1px solid #dddddd;'>
	<img style='height: 58px; width: 63px;' src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/accept_page.png';  ?> >
	 <span style='float: right; position: absolute; font-size: 35px;'>
		<b>School List </b>
	 </span>
	 <span style='float: left; position: absolute; font-size: 11px; margin-top: 40px; '>
		View current school enlisted
	 </span>
	 </br>
</div>
<?php
if (is_array($data['profile']))
{
	foreach ( $data['profile'] as $row )
	{
?>
<div>
	<div style='height: 130px; border-bottom: 1px solid #dddddd;' class='list' id="<?php echo $row['school_id']; ?>">
		<div style='width: 160px; float: left; margin-top: 5px; margin-left: 2px;'>		
			<img style='height: 110px; width: 186px;' src="index.php?__profile/s_list&id=<?php echo $row['school_id'];?>">
		</div>
		<div id="<?php echo $row['school_id'].'choi'; ?>" style='display: none;'>
			<div style='float: right;  padding-right: 2px;' id="<?php echo $row['school_id']; ?>" class='delete'>
				<img style='cursor: pointer;' src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/delete_page.png';  ?> >
			</div>
			<div style='float: right; padding-right: 5px;' id="<?php echo $row['school_id']; ?>" class='edit'>
				<img style='cursor: pointer;' src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/edit.png';  ?> >
			</div>
			<div style='float: right; padding-right: 5px;' id="<?php echo $row['school_id']; ?>" class='user'>
				<img style='cursor: pointer;' src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/add_user.png';  ?> >
			</div>
		</div>
		<div id="<?php echo $row['school_id'] .'divname';?>" style='margin-left: 200px; font-family: arial; font-size: 20px;'>
			<a href='#'> <b>  <?php echo $row['school_name'] ?> </b>  </a>
		</div>

		<ul style='list-style-type:none; padding-top: 0; padding-bottom: 0; padding-right: 0; padding-left: 200; margin-top: 2px;'>
			<li>
				<div style='color:#313A3B; display:block; float:left; font:normal normal bold 12px/18px Arial, Helvetica, sans-serif; text-align:left; width:80px;'>
					 Country :
				</div>
				<div id="<?php echo $row['school_id'] . 'divcountry'?>" style='float: left; color:#313A3B;  font:normal normal normal 12px/18px Arial, Helvetica, sans-serif; text-align:left; width: 65%;'>
					<?php echo $row['school_country']; ?>
				</div>
				<br/>
			</li>
			<li>
				<div style='color:#313A3B; display:block; float:left; font:normal normal bold 12px/18px Arial, Helvetica, sans-serif; text-align:left; width:80px;'>
					 Address :
				</div>
				<div id="<?php echo $row['school_id'] . 'divaddress'?>" style='float: left; color:#313A3B;  font:normal normal normal 12px/18px Arial, Helvetica, sans-serif; text-align:left; width: 65%;'>
					<?php echo trim($row['school_address']); ?>
				</div>
				<br/>
			</li>
			<li>
				<div style='color:#313A3B; display:block; float:left; font:normal normal bold 12px/18px Arial, Helvetica, sans-serif; text-align:left; width:80px;'>
					 Contact No :
				</div>
				<div id="<?php echo $row['school_id'] . 'divcontact'?>" style='float: left; color:#313A3B;  font:normal normal normal 12px/18px Arial, Helvetica, sans-serif; text-align:left; width: 65%;'>
					<?php echo $row['school_contact']; ?>
				</div>
				<br/>
			</li>
		</ul>
	</div>
	<!-- !! -->
	<div id="<?php echo $row['school_id'] . 'data'; ?>" style='border-bottom: 1px solid #dddddd; display: none;'>
		<!-- PROFILE -->
		<div id="<?php echo $row['school_id'] . 'profile'; ?>" style='display:none; padding-bottom: 26px;'>
		<table style="font-size: 11px;">
		<tr>
			<td align='right'> 
				<b> School Profile : </b>
			</td>
			<td>
				<div id="<?php echo $row['school_id'] . 'error_school';?>" style='color: red; display: none;'> * error </div>
				<input type='text' style='width: 250px; font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'] . 'school_name'; ?>" name='school_name' value="<?php echo $row['school_name']; ?>">  
			</td>
			<td align='right'> <b> Country : </b> </td>
			<td>
				<div id="<?php echo $row['school_id'] .'error_country'?>" style='color: red; display: none;'> * error </div>
				<input type='text' style='width: 140px; font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'] .'school_country'; ?>" name='school_country' value="<?php echo $row['school_country']; ?>">
			</td>
		</tr>
		<tr>
			<td align='right'> <b> Address : </b> </td>
			<td>
				<textarea rows='3' style='font-family: tahoma; font-size: 11px;' cols='30%' id="<?php echo $row['school_id'] . 'school_address';?>" name='school_address'> <?php echo $row['school_address']; ?></textarea>
			</td>
			<td align='right'> <b> Contact No : </b> </td>
			<td><input type='text' style='width: 200px;font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'] .'contact';?>" name='contact' value="<?php echo $row['school_contact']; ?>"> </td>
		</tr>
		<tr>
			<td align='righ'> <b> Account Suffix : <b> </td>
			<td>
				<div id="<?php echo $row['school_id'] .'error_suffix'; ?>" style='color: red; display: none;'> * error </div>
				<input type='text' style='width: 150px;font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'] . 'school_suffix'; ?>" name='school_suffix' value="<?php echo $row['school_suffix']; ?>">
			</td>
		</tr>
		<tr>
			<td></td>
			<td><input type='button' value='Save' class='save' id="<?php echo $row['school_id'];?>" style='cursor: pointer;border-style:none; background-color: transparent; font-family: tahoma; font-size: 11px; color:0066CC;'></td>
		</tr>
		</table>
		</div>
		
		<!-- USER -->
		<div id="<?php echo $row['school_id'] . 'user'; ?>" style='display:none; margin-left: 40px; padding-bottom: 37px;'>
		<table>
		<tr>
			<td style ='text-align: right; font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'tdfname'; ?>"> <b> Firstname : </b></td>
			<td> <input type='text' style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'firstname'; ?>"> </td> 
			<td style='text-align:right; font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'tdusername'; ?>"> <b> Username : </b></td>
			<td> <input type='text' style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'username'; ?>"> </td>
		</tr>
		<tr>
			<td style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'tdmname'; ?>"> <b> Middlename : </b></td>
			<td> <input type='text' style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'middlename'; ?>"> </td>
			<td style='text-align:right; font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'tdpass'; ?>"> <b> Password : </b></td>
			<td> <input type='password' style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'password'; ?>"> </td>
		</tr>
		<tr>
			<td style='text-align: right; font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'tdlname'; ?>"> <b> Lastname : </b></td>
			<td> <input type='text' style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'lastname'; ?>"> </td>
			<td style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'tdcpass'; ?>"> <b> Confirm password : </b></td>
			<td id="<?php echo $row['school_id'].'area1'; ?>" style='font-family: tahoma; color: red; font-size: 11px;'> <input type='password' style='font-family: tahoma; font-size: 11px;' id="<?php echo $row['school_id'].'confirm'; ?>"> </td>
		</tr>
		<tr>
			<td style='text-align: right; font-family: tahoma; font-size: 11px;'> <b> User Type : </b></td>
			<td>
			<select id="<?php echo $row['school_id'].'usertype'?>" style='font-family:tahoma; font-size: 11px;'>
				<?php 
					foreach ($data['type'] as $type ){
				?>
				<option value="<?php echo $type['user_type_id']; ?>"><?php echo $type['type_name']; ?></option>
				<?php
					}
				?>
			</select>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td><input type='button' id="<?php echo $row['school_id']; ?>" class='userbut' name='userbut' value='Save' style='cursor: pointer;border-style:none; background-color: transparent; font-family: tahoma; font-size: 11px; color:0066CC;'></td>
		</tr>
		</table>
		</div>
	</div>
</div>
<?php
	}
}
?>