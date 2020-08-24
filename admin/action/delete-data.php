<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['id'];
	$tbl="tbl_product";
	$con= "id='$id'";
	$db->del_data($tbl,$con);
 ?>