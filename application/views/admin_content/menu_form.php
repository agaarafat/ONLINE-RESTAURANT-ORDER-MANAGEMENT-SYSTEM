<div class="col-md-1"></div>
<div class="col-md-5">
	</br></br></br><h2>Add a Menu</h2>
	<?php echo validation_errors(); ?>

	<?php echo form_open_multipart('menu_control/add_menu'); ?>
	    <div class="form-group">
		  <label for="name">Menu Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>">
		</div>
		<div class="form-group">
		  <label for="price">Price:</label>
		  <input type="text" class="form-control" id="txtPrice" placeholder="Enter Price" name="price" value="<?php echo set_value('price'); ?>">
		</div>
		<div class="form-group">
		  <label for="desc">Description:</label>
		  <textarea type="textarea" class="form-control" id="txtDesc" placeholder="Enter Description" name="desc"><?php echo set_value('desc'); ?></textarea>
		</div>
		<div class="form-group">
		  <label for="categroy">Category:</label>
		  <select name="category" class="form-control" id="cboCategory" >
			<option value="<?php echo set_value('category'); ?>"><?php echo set_value('category'); ?></option>
		  <?php foreach ($categories as $category_item): ?>
			<option value="<?php echo $category_item['CategoryId']; ?>"><?php echo $category_item['Name']; ?></option>
		  <?php endforeach; ?>
		  </select>
		</div>
		<div class="form-group">
		  <label for="image">Image Path:</label>
		  <input type="file" class="form-control" id="imgFile" placeholder="Upload Image" name="image">
		</div>
		<div class="form-group">
		  <label for="mtime">Meal Time:</label>
		  <select name="mtime" class="form-control" id="cboMTime" > 
		  <?php foreach ($meal_times as $meal_time_item): ?>
			<option value="<?php echo $meal_time_item['MealTimeId']; ?>"><?php echo $meal_time_item['Name'] . " ( " . $meal_time_item['StartTime'] . " - " . $meal_time_item['EndTime'] . " )" ; ?></option>
		  <?php endforeach; ?>
		  </select>
		</div>
		<div class="form-group">
		  <label for="sqnt">Stock Quantity:</label>
		  <input type="number" class="form-control" id="txtSQnt" placeholder="Enter Stock Quantity" name="sqnt" value="<?php echo set_value('sqnt');?>">
		</div>
		<div class="form-group">
		  <label for="mqnt">Minimum Quantity:</label>
		  <input type="number" class="form-control" id="txtMQnt" placeholder="Enter Minimum Quantity" name="mqnt" value="<?php echo set_value('mqnt');?>">
		</div>
		<div class="form-group">
		  <label for="option">Menu Option:</label>
		  <input type="text" class="form-control" id="txtOption" placeholder="Enter Menu Option" name="option" value="<?php echo set_value('option');?>">
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="remember"> Is it Special</label>
		</div>
		<button type="submit" class="btn btn-default pull-right">Submit</button>
	<?php echo form_close(); ?>
</div>