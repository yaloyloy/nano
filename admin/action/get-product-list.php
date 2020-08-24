<?php
	include('action.php');
	$db = new Action;
	//$data=array();
	$e=$_POST['e'];
	$s=$_POST['s'];

	$tbl="tbl_product INNER JOIN tbl_category ON tbl_category.id=tbl_product.cat_id INNER JOIN tbl_brand ON tbl_brand.id=tbl_product.brand_id";
	$fld="tbl_product.id,tbl_category.name,tbl_brand.name,tbl_product.name,tbl_product.date_post,tbl_product.img,tbl_product.user,tbl_product.view,tbl_product.od,tbl_product.status,tbl_product.price_guest,tbl_product.price_dealer,tbl_product.price_member,tbl_product.price_vip,tbl_product.old_price";
	$od="tbl_product.id DESC";
	$con="tbl_product.id>0";
	$limit="".$s.",".$e."";
	$post_data=$db->select_data($fld,$tbl,$con,$od,$limit);
	if($post_data != 0){
		foreach($post_data as $val){
			?>
				<tr>
					<td><?php echo $val[0]; ?></td>
					<td><?php echo $val[1]; ?></td>
					<td><?php echo $val[2]; ?></td>
					<td><?php echo $val[3]; ?></td>

					<td><?php echo $val[10]; ?></td>
					<td><?php echo $val[11]; ?></td>
					<td><?php echo $val[12]; ?></td>
					<td><?php echo $val[13]; ?></td>
					<td><?php echo $val[14]; ?></td>

					<td><?php echo $val[4]; ?></td>
					<td>
						<img src="../admin/<?php echo $val[5]; ?>" width="50" height="50">
					</td>
					<td><?php echo $val[6]; ?></td>
					<td><?php echo $val[7]; ?></td>
					<td><?php echo $val[8]; ?></td>
					<td><?php echo $val[9]; ?></td>
					<td><input type='button' value='Edit' class='btn-edit'></td>

					<td><input type='button' value='Delete' class='btn-del' onClick="delete_data(<?php echo $val[0]; ?>)"></td>

				</tr>
			<?php
		}
	}
?>
<script>
	//Delete data
		function delete_data(id){
				var id = id;

				if(confirm('Are You Sure To Delete?')){
					$.ajax({
						url:'action/delete-data.php',
						type:'POST',
						data:{id:id},
						success:function(data){

						},
					});
				}
		};

</script>
