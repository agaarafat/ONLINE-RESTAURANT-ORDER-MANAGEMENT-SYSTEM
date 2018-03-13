<div class="col-md-1"></div>
<div class="col-md-5">
	</br></br></br><h2>Add a Meal Time</h2>
	<?php echo validation_errors(); ?>

	<?php echo form_open('meal_time_control/add_meal_time'); ?>
	    <div class="form-group">
		  <label for="name">Meal Time Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>">
		</div>
		<div class="form-group">
		  <label for="start">Start Time:</label>
		  <input type="time" class="form-control" id="txtStartTime" placeholder="Enter Start Time" name="start" value="<?php echo set_value('start'); ?>">
		</div>
		<div class="form-group">
		  <label for="end">End Time:</label>
		  <input type="time" class="form-control" id="txtEndTime" placeholder="Enter End Time" name="end" value="<?php echo set_value('end'); ?>">
		</div>		
		<button type="submit" class="btn btn-default pull-right">Submit</button>
	<?php echo form_close(); ?>
</div>