<?php
	include('../action/action.php');
	$db=new Action;
?>

<div class="frm">
	<div class="header">
		<span>Brand</span>
		<p id="btn-close"><i class="fas fa-times"></i></p>
		
	</div>
	<form class="upl">
		<div class="body">
			<input type="text" id="txt-edit-id" name="txt-edit-id" value="0">                                
			<label>ID</label>
			<input readonly type="text" id="txt-id" name="txt-id" class="frm-control">
			<label>Name</label>
			<input type="text" id="txt-name" name="txt-name" class="frm-control">
			<label>Brand</label>
			<select id="txt-brand" name="txt-brand" class="frm-control">
				<?php
					$post_data=$db->select_data("id,name","tbl_category","id>0 && location=1","id DESC","0,100");
						if($post_data != '0'){
							foreach($post_data as $row){
								?>
									<option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
								<?php
							}
						}
				?>
			</select>
			<label>Location</label>
			<select id="txt-location" name="txt-location" class="frm-control">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<label>OD</label>
			<input type="text" id="txt-od" name="txt-od" class="frm-control">
			<label>Status</label>
			<select id="txt-status" name="txt-status" class="frm-control">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<label>Photo</label>
			<div class="img-box">
				<input type="file" id="txt-file" name="txt-file" class="txt-file">
				<input hidden type="text" id="txt-photo" name="txt-photo">
			</div>
			
			<div class="footer">
				<a class="btn btn-save">Save Change</a>
			</div>
		</div>
	</form>
</div>
