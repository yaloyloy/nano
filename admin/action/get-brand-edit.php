<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['id'];
	$post_data= $db->get_cur_data("*","tbl_brand","id=".$id."");
	if($post_data !='0'){
		$res['cat_id'] =$post_data[1];
		$res['name'] =$post_data[2];
		$res['img'] =$post_data[3];
		$res['location'] =$post_data[5];
		$res['od'] =$post_data[6];
		$res['status'] =$post_data[7];
	}
	echo json_encode($res);
?>