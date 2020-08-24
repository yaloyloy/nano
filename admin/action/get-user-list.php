<?php
	include('action.php');
	$db = new Action;
	$data=array();
	$e=$_POST['e'];
	$s=$_POST['s'];
	$post_data= $db->select_data("*","tbl_user","id>0","id DESC","".$s.",".$e."");
	if($post_data != '0'){
		foreach($post_data as $row){
			$data[]=array(
				"id" => $row[0] , "email" => $row[1] , "img" => $row[3] , "type" => $row[4] ,
				"ip" => $row[5] , "status" => $row[6]
			);
		}
	}
	echo json_encode($data);
?>
