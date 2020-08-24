<?php
		$file=$_FILES['txt-file'];
		$img_name = $file['name'];
		$tmp_name = $file['tmp_name'];
		$size = $file['size'];
		$type_file = pathinfo($img_name, PATHINFO_EXTENSION);

		$new_img = time().rand(10,999999);
		$check = getimagesize($tmp_name);
	$res['send']=false;
	if($check==true){
		//echo $size;
		if($size<1542299){
			if($type_file =='jpg' || $type_file =='png' || $type_file =='gif'){
				move_uploaded_file($tmp_name,"../img/".$new_img.'.'.$type_file);
				$res['img_name']='img/'.$new_img.'.'.$type_file;
				$res['send']=true;
			}else{
				$res['msg']='ខុស';
			}
		}else{
			 $res['msg']='ធំ';
			}

		}
		echo json_encode($res);
	?>