<?php
	include('action.php');
	$db = new Action;
	$id = $_POST['id'];
	$post_data= $db->get_cur_data("*","tbl_product","id=".$id."");
	if($post_data != '0'){
		$res['cat_id'] 		=$post_data[1];
		$res['brand_id'] 	=$post_data[2];
		$res['name'] 		=$post_data[3];
		$res['pro_desc'] 	=$post_data[4];
		$res['price_guest'] =$post_data[12];
		$res['price_dealer']=$post_data[13];
		$res['price_member']=$post_data[14];
		$res['price_vip'] 	=$post_data[15];
		$res['old_price'] 	=$post_data[16];
		$res['date_post'] 	=$post_data[5];
		$res['img'] 		=$post_data[6];
		$res['od'] 			=$post_data[10];
		$res['status'] 		=$post_data[11];
	}
	echo json_encode($res);

?>
