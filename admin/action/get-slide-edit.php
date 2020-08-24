<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['id'];
	$post_data= $db->get_cur_data("*","tbl_slide","id=".$id."");
	if($post_data !='0'){
		$res['name'] =$post_data[1];
		$res['slide_desc'] =$post_data[2];
		$res['img'] =$post_data[4];
		$res['location'] =$post_data[5];
		$res['od'] =$post_data[6];
		$res['status'] =$post_data[7];
	}
	echo json_encode($res);
?>