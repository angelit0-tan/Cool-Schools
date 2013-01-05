<script language='javascript'>
	function loadnews(news_id){
		$.post('index.php?__admin/view_news',
		{ 
			news_id : news_id 
		},function(data){			
			
			$('#id' + news_id).html(data);
		});	
	}
	
	$('.n_edit').click(function(){
		var news_id = this.id;
		$.post('index.php?__admin/edit_news',
		{
			news_id : news_id
		},function(data){
			
			$('#id' + news_id).html(data);
		});
	});
	
	$('#new_post').click(function(){
		$('#news-content').html('');
		$('#news-content').load('index.php?__admin/postnew');
	});
</script>
<div style='width: 640px; font-family: tahoma;'>
	<div style='border-bottom: 1px solid #dddddd;'>
		<div style='float: left;'>
			<img  src = <?php  echo  '/' . BASE_DIR . '/public/images/icons/_system_used_icon/news.png';  ?> >
		</div>
		<div style='font-size: 16px; float: left; margin-top: 7px; margin-left: 6px;'>
			<b>Manage News </b>
		</div>
		<div style='float: right; margin-top: 15px;'>
			<input type='button' style='height: 22px; width: 65px; font-size: 11px;' value='New Post' id='new_post'>
		</div>
		</br></br>
	</div>
	<div id='news-content'>
	<?php
	if (is_array( $data)){
		foreach ( $data as $row ){
	?>
		<div style='border-bottom: 1px solid #dddddd;'>
			<div  style='font-size: 12px; margin-top: 10px;' id="<?php echo 'subject'.$row['news_id'];?>">
				<a href="javascript:loadnews(<?php echo $row['news_id'];?>);"> <b> <?php echo $row['news_subject']; ?> </b></a>
			</div>
			<div style='font-size: 11px; height: 21px;'>
				By <a href='index.php?__profile/profile&id=<?php echo $row['user_id'];?>'> <?php echo ucfirst($row['firstname']) . ' ' . ucfirst($row['lastname']); ?> </a>														
				<abbr title="" data-date=""><?php echo date('D, F d, Y', strtotime($row['news_date'])) //echo date("D M j G:i:s T Y"); $row['news_date']; ?></abbr>
				<div style='float: right;'>
					<input type='button' style='height: 20px; width: 33px;font-size: 11px;' value='edit' class='n_edit' id="<?php echo $row['news_id'];?>">
					<input type='button' style='height: 20px; width: 44px;font-size: 11px;' value='delete' class='n_delete' id="<?php echo $row['news_id'];?>">
				</div>
			</div>
			<div id="<?php echo 'id'.$row['news_id'];?>">
			</div>
		</div>
	<?php
		}
	}
	?>
	</div>
</div>