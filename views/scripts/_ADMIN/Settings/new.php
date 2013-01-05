<script language='javascript'>

$(document).ready(function(){
	$('#miscsave').click(function(){
		var error = 0;
		//check if there's a field that need an input value
		if ( $('#miscname').val() == '' ) {
			error = 1;
			$('#error_name').fadeIn();
			$('#error_name').html(' * Please input a misc.name ');
		}else{
			$('#error_name').fadeOut();
		}
		
		/*
		if (!$("input[name='rate']").is(':checked')){
			error = 1;
			$('#error_percent').fadeIn();
			$('#error_percent').html(' * choose any ');
			
			$('#error_amount').fadeIn();
			$('#error_amount').html(' * choose any ');
		}else{
			$('#error_percent').fadeOut();
			$('#error_amount').fadeOut();
		}
		*/
		if ( $('#misc_percent').val () == '' && $('#misc_amount').val() == '' ){
			error = 1;
			$('#error_percent').fadeIn();
			$('#error_percent').html(' * choose any ');
			
			$('#error_amount').fadeIn();
			$('#error_amount').html(' * choose any ');
		}else{
			$('#error_percent').fadeOut();
			$('#error_amount').fadeOut();
		}
		
		if ( $('#year').val() == '' ) {
			error = 1;
			$('#error_year').fadeIn();
			$('#error_year').html(' * Please input a year ');
		}else{
			$('#error_year').fadeOut();
		}
		
		if ( error == 0 ){
			$.post('index.php?__admin/save_misc',
				{
					year: $('#year').val(), misc_name: $('#miscname').val(), misc_percent: $('#misc_percent').val(), misc_amount: $('#misc_amount').val()
				},function(data){
					$('.content-body').load('index.php?__admin/set_index');
			});
		}
	});
	//	var _status = $("input[name='_status']:checked").val();
	$("input[name='rate']").bind('change',function(){
		//alert($(this).is(':checked'));
		if ( $(this).is(':checked') ){
			if( $(this).val() == 'misc_percent' ){
				$('#'+ $(this).val()).attr('disabled', false);
				$('#misc_amount').attr('disabled',true);
				$('#chk_amount').attr('checked', false);
			
			}else{
				$('#'+ $(this).val()).attr('disabled', false);
				$('#misc_percent').attr('disabled',true);
				$('#chk_percent').attr('checked', false);
			}
		}else{
			$('#'+$(this).val()).attr('disabled',true).val('');
		}
	});
	
	
	//
	$('#misccancel').click(function(){
		$('#_bgpop').fadeOut('slow');
		$('#_miscform').fadeOut('slow');
	});
});
</script>
<div>
<table>
<tr>
	<td align='right'>
		<b>Misc. Name :</b>
	</td>
	<td>
		<div style=' display: none; color: red;font-family:tahoma; font-size: 11px;' id='error_name'> * error </div>
		<input type='text' style='font-family: tahoma; font-size: 11px;' id='miscname'>
	</td>
</tr>
<tr>
	<td align='right'>
		<b>Percent Rate : </b>
	</td>
	<td>
		<div style=' display: none; color: red;font-family:tahoma; font-size: 11px;' id='error_percent'> * error </div>
		<input type='text' id='misc_percent' disabled style='font-family: tahoma; font-size: 11px;'> 
		<input type='checkbox' id='chk_percent' name='rate' value='misc_percent'>
	</td>
</tr>
<tr>
	<td align='right'>
		<b>Fix Amount Rate: </b>
	</td>
	<td>
		<div style=' display: none; color: red;font-family:tahoma; font-size: 11px;' id='error_amount'> * error </div>
		<input type='text' id='misc_amount' disabled style='font-family: tahoma; font-size: 11px;'>
		<input type='checkbox' id='chk_amount' name='rate' value='misc_amount'>
	</td>
</tr>
<tr>
	<td align='right'>
		<b>Validation Year :</b>
	</td>
	<td>
		<div style=' display: none; color: red;font-family:tahoma; font-size: 11px;' id='error_year'> * error </div>
		<input type='text' id='year' style='font-family: tahoma; font-size: 11px;'>
	</td>
</tr>
</table>
<input type='button' style='font-family: tahoma; font-size: 11px; height: 24px;' value='Save' id='miscsave'>
<input type='button' style='font-family: tahoma; font-size: 11px; height: 24px;' value='Cancel' id='misccancel'>
</div>