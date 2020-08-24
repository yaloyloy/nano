<?php
	include('action.php');
	$db = new Action;
	$data=array();
	$e=$_POST['e'];
	$s=$_POST['s'];
	$post_data= $db->select_data("*","tbl_brand","id>0","id DESC","".$s.",".$e."");
	if($post_data != '0'){
		foreach($post_data as $row){
			$data[]=array(
				"id" => $row[0] , "cat_id" => $row[1] , "name" => $row[2] , "img" => $row[3] , "location" => $row[5] , "od" => $row[6] , "status" => $row[7]
			);
		}
	}
	echo json_encode($data);
?>