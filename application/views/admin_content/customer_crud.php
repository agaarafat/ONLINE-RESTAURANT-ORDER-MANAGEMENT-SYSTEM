
<div class="col-md-8">
	<div class="messages"></div>
	
	<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addCustomer" onclick="addCustomer()">Add Customer</button>
	<br/><br/>
	
	<table class="table table-bordered" id="manageCustomerTable">
		<thead>
			<tr>
				<th>Customer Name</th>
				<th>Email</th>
				<th>Telephone</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('customer_control/add_customer', 'id="createForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">First Name:</label>
		  <input type="text" class="form-control" id="txtFName" placeholder="Enter First Name" name="fname" >
		</div>
		<div class="form-group">
		  <label for="name">Last Name:</label>
		  <input type="text" class="form-control" id="txtLName" placeholder="Enter First Name" name="lname" >
		</div>
		<div class="form-group">
		  <label for="email">Email:</label>
		  <input type="email" class="form-control" id="txtEmail" placeholder="Enter Email" name="email" >
		</div>
		<div class="form-group">
		  <label for="telephone">Telephone:</label>
		  <input type="text" class="form-control" id="txtTelephone" placeholder="Enter Telephone" name="telephone" >
		</div>
		<div class="form-group">
		  <label for="addr1">Address 1:</label>
		  <input type="text" class="form-control" id="txtAddr1" placeholder="Enter Address 1" name="addr1" >
		</div>
		<div class="form-group">
		  <label for="addr2">Address 2:</label>
		  <input type="text" class="form-control" id="txtAddr2" placeholder="Enter Address 2" name="addr2" >
		</div>
		<div class="form-group">
		  <label for="city">City:</label>
		  <input type="text" class="form-control" id="txtCity" placeholder="Enter City" name="city" >
		</div>
		<div class="form-group">
		  <label for="province">Province:</label>
		  <input type="text" class="form-control" id="txtProvince" placeholder="Enter Province" name="province" >
		</div>
		<div class="form-group">
		  <label for="pcode">Post Code:</label>
		  <input type="text" class="form-control" id="txtPcode" placeholder="Enter Postcode" name="pcode" >
		</div>
		<div class="form-group">
		  <label for="country">Country:</label>
		  <input type="text" class="form-control" id="txtCountry" placeholder="Enter Country" name="country" >
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
<div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('customer_control/edit_customer', 'id="editForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">First Name:</label>
		  <input type="text" class="form-control" id="txtEditFName" placeholder="Enter First Name" name="fname" >
		</div>
		<div class="form-group">
		  <label for="name">Last Name:</label>
		  <input type="text" class="form-control" id="txtEditLName" placeholder="Enter First Name" name="lname" >
		</div>
		<div class="form-group">
		  <label for="email">Email:</label>
		  <input type="email" class="form-control" id="txtEditEmail" placeholder="Enter Email" name="email" >
		</div>
		<div class="form-group">
		  <label for="telephone">Telephone:</label>
		  <input type="text" class="form-control" id="txtEditTelephone" placeholder="Enter Telephone" name="telephone" >
		</div>
		<div class="form-group">
		  <label for="addr1">Address 1:</label>
		  <input type="text" class="form-control" id="txtEditAddr1" placeholder="Enter Address 1" name="addr1" >
		</div>
		<div class="form-group">
		  <label for="addr2">Address 2:</label>
		  <input type="text" class="form-control" id="txtEditAddr2" placeholder="Enter Address 2" name="addr2" >
		</div>
		<div class="form-group">
		  <label for="city">City:</label>
		  <input type="text" class="form-control" id="txtEditCity" placeholder="Enter City" name="city" >
		</div>
		<div class="form-group">
		  <label for="province">Province:</label>
		  <input type="text" class="form-control" id="txtEditProvince" placeholder="Enter Province" name="province" >
		</div>
		<div class="form-group">
		  <label for="pcode">Post Code:</label>
		  <input type="text" class="form-control" id="txtEditPcode" placeholder="Enter Postcode" name="pcode" >
		</div>
		<div class="form-group">
		  <label for="country">Country:</label>
		  <input type="text" class="form-control" id="txtEditCountry" placeholder="Enter Country" name="country" >
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
<div class="modal fade" id="deleteCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
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
        <button type="button" id="deleteCustomerBtn" class="btn btn-default">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" language="javascript">
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#manageCustomerTable').DataTable({
			'ajax': '<?php echo base_url();?>customer_control/fetch_customer_data',
			'orders': []
		});
	});
		
	function addCustomer()
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
					
						$("$addCustomer").modal('hide'); // hide the model
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
		
	function editCustomer(id = null) 
	{
		if(id) {

			$("#editForm")[0].reset();
			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			$.ajax({
				url: "<?php echo base_url();?>customer_control/get_selected_customer/" + id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					$("#txtEditFName").val(response.FirstName);
					$("#txtEditLName").val(response.LastName);
					$("#txtEditEmail").val(response.Email);
					$("#txtEditTelephone").val(response.Telephone);
					$("#txtEditAddr1").val(response.Address1);
					$("#txtEditAddr2").val(response.Address2);
					$("#txtEditCity").val(response.City);
					$("#txtEditProvince").val(response.Province);
					$("#txtEditPcode").val(response.Postcode);
					$("#txtEditCountry").val(response.Country);
					$("#txtId").val(response.CustomerId);				

					$("#editForm").unbind('submit').bind('submit', function() {
						
						var form = $(this);

						$.ajax({
							url: form.attr('action'),
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
									$("#editCustomer").modal('hide');

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
	
	
	function deleteCustomer(id = null) 
	{
		if(id) {
			$("#deleteCustomerBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '<?php echo base_url();?>customer_control/delete_customer' + '/' + id,
					type: 'post',				
					dataType: 'json',
					success:function(response) {
						if(response.success === true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// hide the modal
							$("#deleteCustomer").modal('hide');

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