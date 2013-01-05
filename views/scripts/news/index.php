<script language='javascript'>
		function xclick(id, data){
			$('#' + id).html($('#get' + id).html());
		}
</script>

<div style='border-bottom: 1px solid #dddddd;'>
	<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
	 <span style='float: right; position: absolute; font-size: 16px;'>
		<b>News </b>
	 </span>
	 <span style='float: left; position: absolute; font-size: 11px; margin-top: 20px;'>
		Current announcement, events, update on your school !!
	 </span>
	 </br>
</div>
<?php
foreach( $data as $row ){
?>
<div style='width: 650px; border-bottom: 1px solid #dddddd; font-family: tahoma;'>
	<div  style='font-size: 12px; margin-top: 10px;'>
		<a href='#'> <b> <?php echo $row['news_subject']; ?> </b></a>
	</div>
	<div style='font-size: 11px;'>
		By <a href='index.php?__profile/profile&id=<?php echo $row['user_id'];?>'> <?php echo ucfirst($row['firstname']) . ' ' . ucfirst($row['lastname']); ?> </a>
		<abbr title="" data-date=""><?php echo date('D, F d, Y', strtotime($row['news_date'])) //echo date("D M j G:i:s T Y"); $row['news_date']; ?></abbr>
	</div>

	<div style='font-size:11px; margin-top: 6px; height: auto;' id ="<?php echo $row['news_id']; ?>">
		<?php
			$news = limit_str($row['news_content'], 500);
			if ( strlen($news[0]) == strlen($news[1]) ) {
				echo $news[0];
			}else{
				echo $news[0]. '...' . ' ' . "<a href=javascript:xclick(" . $row['news_id'] . "," . "'angelito');>" . 'Read more' . "</a>";
			}
		?>
		<div id="<?php echo 'get' . $row['news_id']; ?>" style='display: none;'>
			<?php 
				echo $news[1]; 
			?>
		</div>
	</div>
</div>
<?php
}
?>
</br></br>