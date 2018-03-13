<div class="col-md-1"></div>
<div class="col-md-5">
	</br></br></br><h2>Add a Category</h2>
	<?php echo validation_errors(); ?>

	<?php echo form_open_multipart('category_control/add_category'); ?>
	    <div class="form-group">
		  <label for="name">Category Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>">
		</div>		
		<div class="form-group">
		  <label for="desc">Description:</label>
		  <textarea type="textarea" class="form-control" id="txtDesc" placeholder="Enter Description" name="desc"><?php echo set_value('desc'); ?></textarea>
		</div>
		<div class="form-group">
		  <label for="image">Image Path:</label>
		  <input type="file" class="form-control" id="imgFile" placeholder="Upload Image" name="image">
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="remember"> Remember me</label>
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	<?php echo form_close(); ?>
</div>