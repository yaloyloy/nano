<?php
	include('../action/action.php');
	$db=new Action;
?>

<div class="frm box-pro">
		<div class="header">
			<span>Product</span>
			<p id="btn-close"><i class="fas fa-times"></i></p>

		</div>
	<form class="upl">
		<div class="body">
			<input hidden type="text" id="txt-edit-id" name="txt-edit-id" value="0">

			<div class="box-photo">
				<label>Name</label>
					<input type="text" id="txt-name" name="txt-name" class="frm-control"><br><br>
				<br><br><textarea type="text" id="txt-desc" name="txt-desc" class="ckeditor frm-control"></textarea>

				<div class="pro-img-box">
					<div class="pri-box">Price<br>
						<input type="text" id="txt-pri-gue" name="txt-pri-gue" class="frm-control" value="">
					</div>
					<div class="pri-box">Price Dealer<br>
						<input type="text" id="txt-pri-dea" name="txt-pri-dea" class="frm-control" value="">
					</div>
					<div class="pri-box">Price Member<br>
						<input type="text" id="txt-pri-mem" name="txt-pri-mem" class="frm-control" value="">
					</div >
					<div class="pri-box">Price VIP<br>
						<input type="text" id="txt-pri-vip" name="txt-pri-vip" class="frm-control" value="">
					</div>
					<div class="pri-box">Old Price<br>
						<input type="text" id="txt-old-pri" name="txt-old-pri" class="frm-control" value="">
					</div>
				</div>



			<?php
				$i=0;
				while($i<8)

			{
				?>

					<div class="img-box img-box2">
						<input type="file" id="txt-file" name="txt-file2[]" class="txt-file2"><br>
						<input type="text" id="txt-photo" name="txt-photo2[]" value="0">
					</div>

				<?php
					$i++;
				}
			?>

			</div>

			<div class="box-desc">
				<label>ID</label>
					<input readonly type="text" id="txt-id" name="txt-id" class="frm-control">
				<label>Category</label>
					<select id="txt-cat-id" name="txt-cat-id" class="frm-control" value="">
			<?php
				$tbl="tbl_category";
				$fld="id,name";
				$od="id DESC";
				$con="id>0";
				$limit="0,50";
				$post_data=$db->select_data($fld,$tbl,$con,$od,$limit);
				if($post_data != 0){
					foreach($post_data as $val){
			?>
							<option value="<?php echo $val[0]; ?>"><?php echo $val[1]; ?></option>
						<?php
					}
				}
			?>
					</select>
				<label>Brand</label>
					<select id="txt-brand-id" name="txt-brand-id" class="frm-control">
			<?php
				$tbl="tbl_brand";
				$fld="id,name";
				$od="id DESC";
				$con="id>0";
				$limit="0,50";
				$post_data=$db->select_data($fld,$tbl,$con,$od,$limit);
				if($post_data != 0){
					foreach($post_data as $val){
			?>
							<option value="<?php echo $val[0]; ?>"><?php echo $val[1]; ?></option>
						<?php
					}
				}
			?>
					</select>
				<label>OD</label>
					<input type="text" id="txt-od" name="txt-od" class="frm-control">
				<label>Status</label>
					<select id="txt-status" name="txt-status" class="frm-control">
						<option value="1">On</option>
						<option value="2">Off</option>
					</select>
				<label>Photo</label>
					<div class="img-box" id="img-box">
						<input type="file" id="txt-file" name="txt-file" class="txt-file">
						<input type="text" id="txt-photo" name="txt-photo">
					</div>

			</div>

			<div class="footer">
				<a class="btn btn-save">Save Change</a>
			</div>
		</div>
	</form>
</div>
<script>

function clear_data(id){
				//var id = id;
				if(confirm('Are You Sure To clear?')){
					$.ajax({
						url:'action/clear-data.php',
						type:'POST',
						data:{id:id},
						success:function(data){
							alert(1);
						},
					});
				}
		};



</script>
