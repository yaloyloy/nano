<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['id'];
	$post_data= $db->get_cur_data("*","tbl_userprice","id=".$id."");
	if($post_data !='0'){
		$res['name'] =$post_data[1];
		$res['email'] =$post_data[2];
		$res['type'] =$post_data[4];
		$res['img'] =$post_data[5];
		$res['ip'] =$post_data[6];
		$res['status'] =$post_data[9];
	}
	echo json_encode($res);
?>
