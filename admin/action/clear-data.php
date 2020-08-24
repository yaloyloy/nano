<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['txt-id'];
	$tbl="tbl_product_img";
	$con= "pro_id='$id'";
	$db->del_data($tbl,$con);
 ?>