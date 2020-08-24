<?php
	include('action.php');
	$db = new Action;
	$id=$_POST['txt-id'];
	$catId=$_POST['txt-cat-id'];
	$brandId=$_POST['txt-brand-id'];
	$name=$_POST['txt-name'];
	$name=trim($name);
	$name=$db->real_string($name);
	$proDesc=$_POST['txt-desc'];
	$proDesc=trim($proDesc);
	$proDesc=$db->real_string($proDesc);
	$time= date("Y-m-d H:i:s");
	$img=$_POST['txt-photo'];
	$user=1;
	$titleLink=$db->php_slug($name);
	
	$view=0;
	$od=$_POST['txt-od'];
	$status=$_POST['txt-status'];

	$priGeu=$_POST['txt-pri-gue'];
	$priDea=$_POST['txt-pri-dea'];
	$priMem=$_POST['txt-pri-mem'];
	$priVip=$_POST['txt-pri-vip'];
	$oldPri=$_POST['txt-old-pri'];

	$edit_id=$_POST['txt-edit-id'];

	$dpl =$db->dpl_data("id","tbl_product","name='".$name."' AND id != ".$edit_id."");
	$res['dpl']=true;
	$res['edit']=false;	
	if($dpl==false){
		if($edit_id==0){
			$tbl="tbl_product";
			$val="null,'".$catId."','".$brandId."','".$name."','".$proDesc."','".$time."','".$img."','".$user."','".$titleLink."','".$view."','".$od."','".$status."','".$priGeu."','".$priDea."','".$priMem."','".$priVip."','".$oldPri."'";
			
			$db->insert_data($tbl,$val);
			
			
			$lastId=$db->last_id;
			$res['id']=$lastId;
			$imgbox2=$_POST['txt-photo2'];
				foreach($imgbox2 as $val)
				{
					if($val != '0')
					{
						$db->insert_data("tbl_product_img","null,".$lastId.",'".$val."'");
					}
					
//					$db->upd_data("tbl_product_img","null,".$lastId.",'".$val."'","$con");
				}

		}else{
			$tbl="tbl_product";
			$fld="cat_id='".$catId."',brand_id='".$brandId."',name='".$name."',pro_desc='".$proDesc."',date_post='".$time."',img='".$img."',od='".$od."',status='".$status."',price_guest='".$priGeu."',price_dealer='".$priDea."',price_member='".$priMem."',price_vip='".$priVip."',old_price='".$oldPri."'";
			$con="id=".$edit_id."";
			$db->upd_data($tbl,$fld,$con);
			
			$db->del_data("tbl_product_img","pro_id=".$id."");
			
//			$lastId=$db->last_id;
			//$db->insert_data("tbl_product_img","null,'".$id."','5555555555.jpg'");
//			$res['id']=$lastId;
			$imgbox2=$_POST['txt-photo2'];
				foreach($imgbox2 as $val)
				{
					if($val != '0')
					{
						$db->insert_data("tbl_product_img","null,".$id.",'".$val."'");
					}
					
//					$db->upd_data("tbl_product_img","null,".$lastId.",'".$val."'","$con");
				}

		
			
			
			$res['edit']=true;
			
		}
		$res['dpl']=false;
	}
	echo json_encode($res);
	
?>