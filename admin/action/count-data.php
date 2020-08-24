<?php
	//$cn=new MySQLi("localhost","megateam_nano","16629060","megateam_nano");

	$cn=new MySQLi("localhost","root","","nanosound");
	$tbl=array("tbl_menu","tbl_slide","tbl_category","tbl_brand","tbl_product","tbl_user","tbl_userprice");
	$frm=$_POST['frm'];

	$sql="SELECT COUNT(*) AS total FROM ".$tbl[$frm]."";
	$result=$cn->query($sql);
	$row=$result->fetch_array();
	$res['total']=$row[0];
	echo json_encode($res);


?>
