<script language='javascript'>
var windowWidth = document.documentElement.clientWidth;
var windowHeight = document.documentElement.clientHeight;

$(document).ready(function(){

});
</script>
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd; height: 45px;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px; margin-left: 6px;'>
			<b>Open / Closed Period </b>
		</div>
		<div style='float: right; margin-top: 15px;'>
			<input type='button' style='height: 23px; width: 100px; font-size: 11px;' value='Edit period' id='_edit'>
			<input type='button' style='height: 23px; width: 110px; font-size: 11px;' value='Open new period' id='_new'>
		</div>
		</br></br>
	</div>
</div>
<div style='margin-top: 5px;'>
	<div style="height: 30px; margin-left: 2px; background-repeat: no-repeat; background-image: url(<?php echo '/' . BASE_DIR; ?>/public/images/header/bgopen.png);">
		<table>
		<tr>
		<td>
			<div style='float: left; font-family: verdana; font-size: 12px; margin-left: 20px; margin-top: 5px;'>
				<b> Year  </b>
			</div>
			<div style='float: left; font-family: verdana; font-size: 12px; margin-left: 190px; margin-top: 5px;'>
				<b> Season Description </b>
			</div>
			<div style='float: left; font-family: verdana; font-size: 12px; margin-left: 200px; margin-top: 5px;'>
				<b>  Status </b>
			</div>
		</td>
		<tr>
		</table>
	</div>
	<div id='list' style='width: 600px; margin-left: 4px;'>
		<?php echo $data; ?>
	</div>
</div>

<div id='_seasonform' class='popupform' style='width: 250; height: 130px;'>

</div>
<div id='_bgpop' class='popupbg'> 

</div>