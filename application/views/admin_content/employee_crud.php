
<div class="col-md-8">
	<div class="messages"></div>
	
	<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addEmployee" onclick="addEmployee()">Add Employee</button>
	<br/><br/>
	
	<table class="table table-bordered" id="manageEmployeeTable">
		<thead>
			<tr>
				<th>Employee Name</th>
				<th>Role</th>
				<th>Email</th>
				<th>Telephone</th>
				<th>Password</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open('employee_control/add_employee', 'id="createForm"'); ?>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
	  <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Restaurant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open('employee_control/edit_employee', 'id="editForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Employee Name:</label>
		  <input type="text" class="form-control" id="txtEditName" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>">
		</div>
		<?php echo form_error('role'); ?>
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
		  <input type="email" class="form-control" id="txtEditEmail" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>">
		</div>
		<div class="form-group">
		  <label for="telephone">Telephone:</label>
		  <input type="text" class="form-control" id="txtEditTelephone" placeholder="Enter Telephone" name="telephone" value="<?php echo set_value('telephone'); ?>">
		</div>
		<div class="form-group">
		  <label for="addr1">Password:</label>
		  <input type="password" class="form-control" id="txtEditPwd" placeholder="Enter Password" name="pwd" value="<?php echo set_value('pwd'); ?>">
		</div>				
      </div>
      <div class="modal-footer">
		<input type="text" id="txtId" name="id" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default">Save Changes</button>
      </div>
	  <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>	  
      <div class="modal-body">
        <p>Do you really want to delete ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="deleteEmployeeBtn" class="btn btn-default">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" language="javascript">
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#manageEmployeeTable').DataTable({
			'ajax': '<?php echo base_url();?>employee_control/fetch_employee_data',
			'orders': []
		});
	});
		
	function addEmployee()
	{
		$("#createForm")[0].reset();
		
		$(".text-danger").remove(); // remove textdanger
		$(".form-group").removeClass('has-error').removeClass('has-success'); // remove form-group
		
		$("#createForm").submit( function() {
			var form = $(this);
			
			$(".text-danger").remove(); // remove the text-danger
			
			$.ajax({
				url: form.attr('action'),
				type: "POST",
				data: new FormData(this), // converting the form data into array and sending to server
				dataType: 'json',
				success: function(data) {
					if(response.success === true) {
						$(".messages").html(
							'<div class="alert alert-success alert-dismissible" role="alert">'+
							'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							'<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>'
						);
					
						$("$addEmployee").modal('hide'); // hide the model
						manageDataTable.ajax.reload(null, false); // update the manage category table					
					} 
					else {
						if(response.messages instanceof Object){
							$.each(response.messages, function(index, value) {
								var id = $("#"+index);
								
								id
								.closest('.form-group')
								.removeClass('has-error')
								.removeClass('has-success')
								.addClass(value.length > 0 ? 'has-error' : 'has-success')
								.after(value);
							});
						}
						else {
							$(".messages").html(
								'<div class="alert alert-warning alert-dismissible" role="alert">'+
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								'<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
								'</div>'
							);
						}
					}
				}
			});
			return false;
		});		
	} 
		
	function editEmployee(id = null) 
	{
		if(id) {

			$("#editForm")[0].reset();
			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			$.ajax({
				url: "<?php echo base_url();?>employee_control/get_selected_employee/" + id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					$("#txtEditName").val(response.Name);
					$("#txtEditEmail").val(response.Email);
					$("#txtEditTelephone").val(response.Telephone);
					$("#txtEditPwd").val(response.Password);
					$("#txtId").val(response.EmployeeId);				

					$("#editForm").unbind('submit').bind('submit', function() {
						
						var form = $(this);

						$.ajax({
							url: form.attr('action') + '/' + id,
							type: 'post',
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success === true) {
									$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
									'</div>');

									// hide the modal
									$("#editEmployee").modal('hide');

									// update the manageMemberTable
									manageDataTable.ajax.reload(null, false); 

								} else {
									$('.text-danger').remove()
									if(response.messages instanceof Object) {
										$.each(response.messages, function(index, value) {
											var id = $("#"+index);

											id
											.closest('.form-group')
											.removeClass('has-error')
											.removeClass('has-success')
											.addClass(value.length > 0 ? 'has-error' : 'has-success')										
											.after(value);										

										});
									} else {
										$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
										  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
										  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
										'</div>');
									}
								}
							} // /succes
						}); // /ajax

						return false;
					});
					
				}
			});
		}
		else {
			alert('error');
		}
	}
	
	
	function deleteEmployee(id = null) 
	{
		if(id) {
			$("#deleteEmployeeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '<?php echo base_url();?>employee_control/delete_Employee' + '/' + id,
					type: 'post',				
					dataType: 'json',
					success:function(response) {
						if(response.success === true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// hide the modal
							$("#deleteEmployee").modal('hide');

							// update the manageMemberTable
							//manageDataTable.ajax.reload(null, false); 
							manageDataTable.ajax.reload()

						} else {
							$('.text-danger').remove()
							if(response.messages instanceof Object) {
								$.each(response.messages, function(index, value) {
									var id = $("#"+index);

									id
									.closest('.form-group')
									.removeClass('has-error')
									.removeClass('has-success')
									.addClass(value.length > 0 ? 'has-error' : 'has-success')										
									.after(value);										

								});
							} else {
								$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
								  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
								  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
								'</div>');
							}
						}
					} // /succes
				}); // /ajax
			});
		}
	}
	
</script>