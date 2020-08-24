<?php
	include('action.php');
	$db = new Action;
	$id=$_POST['txt-id'];
	$name=$_POST['txt-name'];
	$slideDesc=$_POST['txt-desc'];
	$time= date("Y-m-d H:i:s");
	$img=$_POST['txt-photo'];
	$location=$_POST['txt-location'];
	$od=$_POST['txt-od'];
	$status=$_POST['txt-status'];
	$edit_id=$_POST['txt-edit-id'];

	$dpl =$db->dpl_data("id","tbl_slide","name='".$name."' AND id != ".$edit_id."");
	$res['dpl']=true;
	$res['edit']=false;
	if($dpl==false){	
		if($edit_id==0){
			$tbl="tbl_slide";
			$val="null,'".$name."','".$slideDesc."','".$time."','".$img."','".$location."','".$od."','".$status."'";
			$db->insert_data($tbl,$val);
			$res['id']=$db->last_id;
		}else{
			$tbl="tbl_slide";
			$fld="name='".$name."',slide_desc='".$slideDesc."',img='".$img."',location='".$location."',od='".$od."',status='".$status."'";
			$con="id=".$edit_id."";
			$db->upd_data($tbl,$fld,$con);
			$res['edit']=true;
		}
		$res['dpl']=false;
	}
	echo json_encode($res);
	
?>