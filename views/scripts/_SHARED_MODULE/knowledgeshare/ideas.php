<style>
	a:hover{
		text-decoration: underline;
	}
</style>
<?php
if ( is_array($data) ){
	foreach ( $data as $row ){
?>
<div style='width: 630px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(238, 238, 238);'> 
	<table style='width: 100%'>
	<tr>
		<td style='align: center; valign: middle; width: 9%'> 
			<img src = <?php echo '/' . BASE_DIR  . '/public/images/icons/knowledge_base/idea_b.png'; ?>  style='height: 35px; width: 35px;'>
		</td>
		<td align='left' valign='middle' style='font-family: tahoma; font-size: 16px; text-decoration: none;'>
			<a href="javascript:getpage('index.php?knowledgeshare/view&sharetype=idea&id=<?php echo $row['knowledge_id']; ?>');"> <b> <?php echo $row['fld_subject']; ?> </b> </a>
			<div style='font-size: 11px; cursor: none; margin-top: 4px; color:#878C97;'>
				By <a href='index.php?__profile/profile&id=<?php echo $row['user_id'];?>' style='color: green;'> <?php echo ucfirst($row['firstname']) . ' ' . ucfirst($row['lastname']); ?> </a> Sunday, March 14, 2010 
			</div>
		</td>
	<tr>
	</table>
</div>
<?php
	}
}
?>
