<?php
		$con = mysql_connect('localhost','root','') or die (mysql_error());
		$db = mysql_select_db('databaseimage',$con) or die (mysql_error());
		//$id = addslashes($_REQUEST['id']);
		$res = mysql_query("select * from store where id = $id");
		$image = mysql_fetch_assoc($res);
		$image = $image['image'];
		header("Content-type: image/jpeg");
		echo $image;
	
?>