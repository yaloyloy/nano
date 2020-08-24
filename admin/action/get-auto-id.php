<?php
	include('action.php');
	$db = new Action;
	$tbl=array("tbl_menu","tbl_slide","tbl_category","tbl_brand","tbl_product","tbl_user","tbl_userprice");
	$frm=$_POST['frm'];
	$res['id'] = $db->get_auto_id("id",$tbl[$frm],"id>0","id DESC");
	echo json_encode($res);
?>
