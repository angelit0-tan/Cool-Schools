<?php
/*
$page = <<< EOPAGE
<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="txt/html; charset=utf-8" />
</head>
<body>
<img src='index.php?__profile/s_list'>
</body>
</html>
EOPAGE;
echo $page;
<img src='index.php?__profile/s_list'>
*/
	/*
	foreach ($data as $row){
		echo $row['firstname'] . '</br>';
		if ( $row['user_id'] == $_SESSION['user_id'] ){
			echo "
				<div style='margin-top: 5px;'>
					<img src='index.php?__profile/s_list&id=".$row['friend_id']."'>".
					$row['firstname'].
				"</div>";
		}else{
			echo "<div style='margin-top: 5px;'>
					<img src='index.php?__profile/s_list&id=".$row['user_id']."'>
				</div>";
		}
	}
	*/
/*	
foreach ($data as $row){	
?>
<div style='margin-top: 5px;width: 630px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);'>
<table style='width: 100%'>
	<tr>
		<td style='align: center; valign: middle; width: 9%'> 
			<a href="index.php?__profile/profile&id=<?php echo $row['user_id'];?>">	<img src='index.php?__profile/s_list&id=<?php echo $row['user_id'];?>'>	</a>
		</td>
		<td align='left' valign='middle' style='font-family: tahoma; font-size: 12px; font-weight: bold;'>
			<a href="index.php?__profile/profile&id=<?php echo $row['user_id'];?>"><?php echo ucfirst($row['firstname']).' '.ucfirst($row['middlename']).' '.ucfirst($row['lastname']);?></a>
		</td>
	</tr>
</table>
</div>
<?php
}
*/
?>
<script language='javascript'>
$(document).ready(function(){
	$('.fff_rr').click(function(){
		//alert($(this).attr('id'));
		$.post('index.php?__profile/c_friend',{rr: $(this).attr('id')});
	});
});
</script>
<?php
$f_request='';
$friends='';
if(is_array($data)){
	foreach ($data as $row){	
		if ( $row['request_to'] == $_SESSION['user_id'] ){
			if ( $row['be_friends'] == 0 ) { // for friend_request
					$f_request .= "
						<div style='margin-top: 5px;width: 630px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);'>
							<table style='width: 100%'>
							<tr>
								<td style='align: center; valign: middle; width: 9%'> 
									<a href='index.php?__profile/profile&id=$row[user_id]'>	<img src='index.php?__profile/s_list&id= $row[user_id]'>	</a>
								</td>
								<td align='left' valign='middle' style='font-family: tahoma; font-size: 12px; font-weight: bold;'>
									<a href='index.php?__profile/profile&id=$row[user_id]'>" .ucfirst($row['firstname']).' '.ucfirst($row['middlename']).' '.ucfirst($row['lastname'])."</a>
								</td>
								<td><input class='fff_rr' id=$row[user_id]_$row[friend_id]_$row[request_to] type='button' value='Confirm Friend Request'></td>
							</tr>
						</table>
						</div>";
			}else{ //already friends
					$friends .= "
						<div style='margin-top: 5px;width: 630px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);'>
						<table style='width: 100%'>
							<tr>
								<td style='align: center; valign: middle; width: 9%'> 
									<a href='index.php?__profile/profile&id=$row[user_id]'>	<img src='index.php?__profile/s_list&id= $row[user_id]'>	</a>
								</td>
								<td align='left' valign='middle' style='font-family: tahoma; font-size: 12px; font-weight: bold;'>
									<a href='index.php?__profile/profile&id=$row[user_id]'>" .ucfirst($row['firstname']).' '.ucfirst($row['middlename']).' '.ucfirst($row['lastname'])."</a>
								</td>
							</tr> 
						</table>
						</div>";
			}
		}else{
			if ( $row['be_friends'] == 1 ) { //already friends
					$friends .= "
						<div style='margin-top: 5px;width: 630px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);'>
						<table style='width: 100%'>
							<tr>
								<td style='align: center; valign: middle; width: 9%'> 
									<a href='index.php?__profile/profile&id=$row[user_id];'>	<img src='index.php?__profile/s_list&id= $row[user_id]'>	</a>
								</td>
								<td align='left' valign='middle' style='font-family: tahoma; font-size: 12px; font-weight: bold;'>
									<a href='index.php?__profile/profile&id=$row[user_id]'>" .ucfirst($row['firstname']).' '.ucfirst($row['middlename']).' '.ucfirst($row['lastname'])."</a>
								</td>
							</tr> 
						</table>
						</div>";
			}
		}
	}
}
?>

<div style='width: 66%'>
	<?php echo $f_request; ?>
</div>
<div>
	<?php echo $friends; ?>
</div>

