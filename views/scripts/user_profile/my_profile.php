<?php
	ob_clean();
?>
<html>
<head>
	<meta http-equiv="content-language" content="en"/>
	<meta http-equiv="content-style-type" content="text/css"/>
	<meta http-equiv="content-script-type" content="text/javascript"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="createdbychoi" content="all"/>
	<link rel="stylesheet" type="text/css" href="public/css/layout-z.css">
	<link rel="stylesheet" type="text/css" href="public/css/content.css">
	<link rel="stylesheet" type="text/css" href="public/css/my_profile.css">
	<script type="text/javascript" src="public/js/jquery-1.6.2.js"></script>
	<script type="text/javascript" src="public/js/jauto-grow.js"></script>
	<title> Cool Schools </title>
	<script language="javascript">
		$(document).ready(function(){
			$('#content-area_data').load('index.php?__profile/u_wall');
		});
		//loadwall('index.php?__profile/u_wall');
		function loadPage( url ){
			//alert(url);
			$('.content-body_profile').load( url );
		}
		
		function getpage( url ){
			$('#work-content').load( url );
		}
		function loadwall ( url ){
			$('#content-area_data').load(url);
		}
		
	</script>
	<style>
	h1{
		font-weight: bold;
		font-size: 20px;
	}
	</style>
</head>
<body>

	<div class="body">
		<div class="site">
			<div class="site-header" align="center">
			<!-- TOP -->
				<img src="<?php echo  '/' . BASE_DIR . '/public/images/header/head_1-trans.png';?>" alt=""style="width: 1203px; height: 180px; position: absolute; left: -10%; top: 50%; margin-top: -112px; ">
				
			</div>
				<!-- MENU -->
			<div class="site-header-menu">
				<div class="site-user-log-text">
					<?php
						
						if ( isset($_SESSION['user']) ){
							echo "Welcome " . ucfirst($data['user_info'][0]['firstname']) .' '. ucfirst($data['user_info'][0]['lastname']) . "! ". "<a href='index.php?authenticate/logout'>" . 'Logout' . "</a>";
							
							
						}
						
					?>
				</div>
				<div class="site-hold-menu-position">
					<div class="site-header-menu-text">
						<?php
							
							foreach ($data['menu'] as $link){
								echo "<a href=" . $link['menu_link']. ">" . $link['menu_name'] . "</a>";
							}
							
						?>
					</div>
				</div>
			</div>
			<!-- work area -->
			<div class='main-content-body_profile'>
				<div class='content-body_profile'>
					<div class='head-profile'>
						<div style='margin-left: 10px; float: left;'>
							<table style='width: 100%;height: 56px;'>
							<tr>
								<td align='left' valign='top' style='text-decoration: none; color: #333333;'>
								<h1>
									<span><?php echo ucfirst($data['user_info'][0]['firstname']) . ' ' . ucfirst($data['user_info'][0]['middlename']) . ' ' . ucfirst($data['user_info'][0]['lastname']) ;?></span>
								</h1>
								</td>
							</tr>
							</table>
						</div>
					</div>
					<div class='content-area_profile' role='main'>
						<div id='content-area_data'>
						</div>
					</div>
					
				</div>
				<!-- side menu -->
				<div class="site-body-sidebar_profile">
					<?php
						
						if (isset($_SESSION['user'])){
							?>
							<div style='cursor: pointer;'>
							<table>
								<tr>
									<td>
									<div style='height: 113px; width: 178px; float: left;'>
										<img style='height: 113px; width: 178px;' src= 'index.php?__profile/s_list&id=<?php echo $_SESSION['user_id'];?>'>
									</div>
									</td>
								</tr>
							</table>
							</div>
							<div class='side-block'> 
								<a class='sidebar-block_profile' href="javascript: loadwall('index.php?__profile/u_wall');"> 
									<img class='sidebar-block-image_profile' src="<?php echo '/'. BASE_DIR  .'/public/images/icons/_system_used_icon/bubble.ico';?>">
									<span class='sidebar-block-text_profile'>
									Wall
								</a>
							</div>
							<div class='side-block'> 
								<a class='sidebar-block_profile' href="javascript:loadwall('index.php?__profile/u_info');"> 
									<img class='sidebar-block-image_profile' src="<?php echo '/'. BASE_DIR  .'/public/images/icons/_system_used_icon/user-info-icon.png';?>">
									<span class='sidebar-block-text_profile'>
									Info
								</a>
							</div>
							<div class='side-block'> 
								<a class='sidebar-block_profile' href="javascript:loadwall('index.php?inbox/inbox_msg');"> 
									<img class='sidebar-block-image_profile' src="<?php echo '/'. BASE_DIR  .'/public/images/icons/_system_used_icon/mail_alt.ico';?>">
									<span class='sidebar-block-text_profile'>
									Send Message
								</a>
							</div>
							<div class='side-block'> 
								<a class='sidebar-block_profile' href="javascript:loadwall('index.php?__profile/u_friendlist');"> 
									<img class='sidebar-block-image_profile' src="<?php echo '/'. BASE_DIR  .'/public/images/icons/_system_used_icon/friend.ico';?>">
									<span class='sidebar-block-text_profile'>
									Friends
								</a>
							</div>
							<?php
						}
						?>
				</div>
			</div>

		</div>
	</div>
	<div class="footer">
	
	</div>
</body>
</html>