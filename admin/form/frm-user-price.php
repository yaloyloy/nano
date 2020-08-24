<?php
	include('../action/action.php');
	$db=new Action;
?>

<div class="frm">
	<div class="header">
		<span>User</span>
		<p id="btn-close"><i class="fas fa-times"></i></p>

	</div>
	<form class="upl">
		<div class="body">
			<input type="text" id="txt-edit-id" name="txt-edit-id" value="0">
			<label>ID</label>
			<input readonly type="text" id="txt-id" name="txt-id" class="frm-control">
			<label>Name</label>
			<input type="text" id="txt-name" name="txt-name" class="frm-control">
			<label>Email</label>
			<input type="text" id="txt-email" name="txt-email" class="frm-control">
			<label>Password</label>
			<input type="text" id="txt-pass" name="txt-pass" class="frm-control">

			<label>User Type</label>
			<select id="txt-type" name="txt-type" class="frm-control">
				<option value="admin">Admin</option>
				<option value="client">Client</option>
			</select>

			<label>Status</label>
			<select id="txt-status" name="txt-status" class="frm-control">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<label>Photo</label>
			<div class="img-box">
				<input type="file" id="txt-file" name="txt-file" class="txt-file">
				<input type="text" id="txt-photo" name="txt-photo">
			</div>

			<div class="footer">
				<a class="btn btn-save">Save Change</a>
			</div>
		</div>
	</form>
</div>
