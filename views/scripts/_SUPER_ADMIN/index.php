<html>
<head>	
	<title> Upload an image </title>
</head>
<body>
	<form action ="index.php?" method="post" enctype="multipart/form-data">
		File :
		<input type="file" name="image"> <input type="submit" value="Upload">
	</form>
	<?php
		
		$lastid =0;
		$con = mysql_connect('localhost','root','') or die (mysql_error());
		$db = mysql_select_db('databaseimage',$con) or die (mysql_error());
		
		//file properties
		
		
		
		if (isset($_FILES["image"])){
			
			$file = $_FILES["image"]["tmp_name"];
		}
		
		if (!isset($file)){
			echo "Please select an image.";
		}else{
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			
			//return false if not an images
			$image_size = getimagesize($_FILES['image']['tmp_name']);

			if( $image_size == false ){
				echo "That's not an image";
			}else{
				if ( !$insert = mysql_query("INSERT INTO store values('','$image_name','$image')"))
				{
					echo "Problem uploading.";	
				}else{
					$lastid = mysql_insert_id();
					echo "Image uploaded. <p/> Your image :<p /> <img src = get.php?id=$lastid>";
				}
			}
		}
		echo "<img src =views/scripts/_SUPER_ADMIN/get.php?id=56>";

	?>
</body>
</html>