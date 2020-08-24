<div class="frm">
	<div class="header">
		<span>Slide</span>
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
			<label>Description</label>
			<input type="text" id="txt-desc" name="txt-desc" class="frm-control slide-desc">
<!--			<textarea type="text" id="txt-desc" name="txt-desc" class="frm-control"></textarea>-->
			
			<label>Location</label>
			<select id="txt-location" name="txt-location" class="frm-control">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
			<label>OD</label>
			<input type="text" id="txt-od" name="txt-od" class="frm-control">
			<label>Status (1=active 2=delete)</label>
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

