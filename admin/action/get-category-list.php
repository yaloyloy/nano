<?php
	include('action.php');
	$db = new Action;
	$data=array();
	$e=$_POST['e'];
	$s=$_POST['s'];
	$post_data= $db->select_data("*","tbl_category","id>0","id DESC","".$s.",".$e."");
	if($post_data != '0'){
		foreach($post_data as $row){
			$data[]=array(
				"id" => $row[0] , "name" => $row[1] , "img" => $row[2] , "location" => $row[4] ,
				"od" => $row[5] , "status" => $row[6]
			);
		}
	}
	echo json_encode($data);
?>