<?php
	include('action.php');
	$db = new Action;
	//$data=array();
	$e=$_POST['e'];
	$s=$_POST['s'];

	$post_data=$db->select_data("*","tbl_menu","status=1 && location=1","id DESC","".$s.",".$e."");
	if($post_data != 0){
		foreach($post_data as $val){
			?>
				<tr>
					<td><?php echo $val[0]; ?></td>
					<td><?php echo $val[1]; ?></td>
					<td><?php echo $val[2]; ?></td>
					<td>
						<img src="../admin/<?php echo $val[3]; ?>" width="50" height="50">
					</td>
					<td><?php echo $val[4]; ?></td>
					<td><?php echo $val[5]; ?></td>
					<td><?php echo $val[6]; ?></td>
					<td><input type='button' value='Edit' class='btn-edit'></td>
				</tr>
			<?php
		}
	}

//	echo json_encode($data);
?>