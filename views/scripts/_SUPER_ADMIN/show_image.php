<?php
	
	$con = mysql_connect('localhost','root','') or die (mysql_error());
	$db = mysql_select_db('cool_schools',$con) or die (mysql_error());
	$id = addslashes($_REQUEST['id']);
	$res = mysql_query("select * from cool_school_profile where school_id = $id");
	$image = mysql_fetch_assoc($res);
	$image = $image['school_image'];
	
	header("Content-type: image/jpeg");

	echo $image;
?>