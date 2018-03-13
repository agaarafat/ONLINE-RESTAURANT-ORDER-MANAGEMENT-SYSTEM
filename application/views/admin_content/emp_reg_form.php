<div class="col-md-1"></div>
<div class="col-md-5">
	</br></br></br><h2>Add a Employee</h2>
	<?php echo validation_errors(); ?>

	<?php echo form_open_multipart('employee_control/add_employee'); ?>
	    <div class="form-group">
		  <label for="name">Employee Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>">
		</div>
		<div class="form-group">
		  <label for="name">User Role:</label>
		  <select class="form-control" name="role">
			<option value="">Select One</option>
			<option value="Admin">Admin</option>
			<option value="Salesman">Salesman</option>
			<option value="Deliveryman">Deliveryman</option>
		  </select>
		</div>
		<div class="form-group">
		  <label for="email">Email:</label>
		  <input type="email" class="form-control" id="txtEmail" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>">
		</div>
		<div class="form-group">
		  <label for="telephone">Telephone:</label>
		  <input type="text" class="form-control" id="txtTelephone" placeholder="Enter Telephone" name="telephone" value="<?php echo set_value('telephone'); ?>">
		</div>
		<div class="form-group">
		  <label for="addr1">Password:</label>
		  <input type="password" class="form-control" id="txtPwd" placeholder="Enter Password" name="pwd" value="<?php echo set_value('pwd'); ?>">
		</div>		
		<button type="submit" class="btn btn-default">Submit</button>
	<?php echo form_close(); ?>