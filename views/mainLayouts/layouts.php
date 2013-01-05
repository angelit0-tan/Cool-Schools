<html>
<head>
	<meta http-equiv="content-language" content="en"/>
	<meta http-equiv="content-style-type" content="text/css"/>
	<meta http-equiv="content-script-type" content="text/javascript"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="createdbychoi" content="all"/>
	<link rel="stylesheet" type="text/css" href="public/css/layout-z.css">
	<link rel="stylesheet" type="text/css" href="public/css/jquery-ui-1.8.14.custom.css">
	<link rel="stylesheet" type="text/css" href="public/css/content.css">
	<link rel="stylesheet" type="text/css" href="public/css/jquery-ui-timepicker.css">
	<link rel="stylesheet" type="text/css" href="public/css/jquery.ui.all.css">
	<link rel="stylesheet" type="text/css" href="public/css/demos.css">
	
	<script type="text/javascript" src="public/js/jquery-1.6.2.js"></script>
	<script type="text/javascript" src="public/js/jquery-extension.js"></script>
	<script type="text/javascript" src="public/js/jquery-ui-1.8.14.custom.min.js"></script>
	
	<script type="text/javascript" src="public/js/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="public/js/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="public/js/jquery.ui.tabs.min.js"></script>
    <script type="text/javascript" src="public/js/jquery.ui.position.min.js"></script>
	
    <script type="text/javascript" src="public/js/jquery.ui.timepicker.js"></script>
	
	<title> Cool Schools </title>
	<script language="javascript">
		function loadPage( url ){
			//alert(url);
			$('.content-body').load( url );
		}
		
		function getpage( url ){
			$('#work-content').load( url );
		}
		
	</script>
	
</head>
<body>
<form action="index.php?authenticate/verify" method="post">
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
							echo "Welcome " . ucfirst($data['userinfo'][0]['firstname']) .' '. ucfirst($data['userinfo'][0]['lastname']) . "! ". "<a href='index.php?authenticate/logout'>" . 'Logout' . "</a>";
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
			
			<div class="main-content-body">
				<div class="content-body">
					<?php
						echo $data['home'];
					?>
				</div>
				
				<!-- side menu -->
				<div class="site-body-sidebar" >
					<?php
						
						if (isset($_SESSION['user'])){
							?>
							<div style='cursor: pointer;'>
							<table>
								<tr>
									<td>
									<div style='height: 46px; width: 52px; float: left;'>
										<a href="index.php?__profile/profile&id=<?php echo $_SESSION['user_id'];?>"><img style='height: 46px; width: 52px;' src='index.php?__profile/s_list&id=<?php echo $_SESSION['user_id'];?>'></a>
									</div>
									</td>
									<td>
									<div style='font-family: tahoma; font-size: 13px; margin-left: 5px; '>
										<?php 
											echo  '<a>' . '<b>' . ucfirst($data['userinfo'][0]['firstname']) . ' ' . ucfirst($data['userinfo'][0]['lastname']) . '</b>'  . '</a>'; 
										?>
									</div>
									<div style='font-family: tahoma; font-size: 11px; margin-left: 5px;'>
											<a href="index.php?__profile/profile&id=<?php echo $_SESSION['user_id']; ?>"> My Profile  </a>
									</div>
									</td>
								</tr>
							
							</table>
							</div>
							<?php
							foreach($data['right_menu'] as $link){
							echo "<div class='' id=" . $link['module_id'] . ">";
								echo "<a href=" . $link['menu_link'] . " class='sidebar-block' id=" . 'side'.$link['module_id'] . ">";
								echo "<img class='sidebar-block-image' style='border-style: none;' src=" . '/' . BASE_DIR . $link['image_location'] . ">";
								echo "<span class='sidebar-block-text'> <span class='sidebar-block-title'>";
								echo $link['menu_name'] . "</span> <br/>";
								echo $link['menu_description']. "</span>";
								echo "</a>";
							echo "</div>";
							}
						}else{
							//login module
							echo $data['right_menu'];
						}
					?>
				</div>
			</div>

		</div>
	</div>
	<div class="footer">
	
	</div>
</form>
</body>
</html>