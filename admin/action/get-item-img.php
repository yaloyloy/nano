<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['id'];
	$img=array();
	$post_data = $db->select_data("*","tbl_product_img","pro_id='".$id."'","id","0,8");
	foreach($post_data as $val){
		$img[]=array("img"=>$val[2]);
	}

	echo json_encode($img);
?>