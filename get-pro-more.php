<?php
	include('admin/action/action.php');
	$db = new Action;
	$data=array();
	$e=$_POST['e'];
	$s=$_POST['s'];
	$con=$_POST['con'];
	$post_data= $db->select_data("*","tbl_product",$con,"id DESC","".$s.",".$e."");
	if($post_data != '0'){
		foreach($post_data as $row){
			$data[]=array(
				"id" => $row[0] , "cat_id" => $row[1] , "name" => $row[3] , "img" => $row[6] , "price_guest" => $row[12] , "old_price" => $row[16]​ ,
				"title_link" => $row[8]

			);
		}
	}
	echo json_encode($data);
?>
