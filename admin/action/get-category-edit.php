<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['id'];
	$post_data= $db->get_cur_data("*","tbl_category","id=".$id."");
	if($post_data !='0'){
		$res['name'] 	=$post_data[1];
		$res['img'] 	=$post_data[2];
		$res['location']=$post_data[4];
		$res['od'] 		=$post_data[5];
		$res['status'] 	=$post_data[6];
	}
	echo json_encode($res);
?>