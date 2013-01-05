<?php
if ( is_array($data) ){
	foreach ( $data as $row ){
?>
	<option value="<?php echo $row['school_id']; ?>"> <?php echo $row['school_name']; ?> </option>
<?php
	}
}
?>