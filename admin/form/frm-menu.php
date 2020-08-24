<div class="frm">
	<div class="header">
		<span>Menu</span>
		<p id="btn-close">X</p>
		<i class="fas fa-times"></i>
		
	</div>
	<form class="upl">
		<div class="body">
			<input type="text" id="txt-edit-id" name="txt-edit-id" value="0">
			<label>ID</label>
			<input readonly type="text" id="txt-id" name="txt-id" class="frm-control">
			<label>Name</label>
			<input type="text" id="txt-name" name="txt-name" class="frm-control">
			<label>Link</label>
			<input type="text" id="txt-url" name="txt-url" class="frm-control">
			<label>Location</label>
				<select id="txt-location" name="txt-location" class="frm-control">
					<option value="1">Top</option>
					<option value="2">Middle</option>
					<option value="3">Bottom</option>
				</select>
			<label>OD</label>
			<input type="text" id="txt-od" name="txt-od" class="frm-control">
			<label>Status</label>
				<select id="txt-status" name="txt-status" class="frm-control">
					<option value="1">On</option>
					<option value="2">Off</option>
				</select>
			<label>Photo</label>
			<div class="img-box">
				<input type="file" id="txt-file" name="txt-file">	
			</div>
			<input type="text" id="txt-photo" name="txt-photo">
			<div class="footer">
				<a class="btn btn-save">Save Change</a>
			</div>
		</div>
	</form>
</div>