
<div class="col-md-8">
	<div class="messages"></div>
	
	<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addCategory" onclick="addCategory()">Add Category</button>
	<br/><br/>
	
	<table class="table table-bordered" id="manageCategoryTable">
		<thead>
			<tr>
				<th>Category Name</th>
				<th>Description</th>
				<th>Image</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('category_control/add_category', 'id="createForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Category Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name"/>
		</div>		
		<div class="form-group">
		  <label for="desc">Description:</label>
		  <textarea type="textarea" class="form-control" id="txtDesc" placeholder="Enter Description" name="desc"></textarea>
		</div>
		<div class="form-group">
		  <label for="image">Image Path:</label>
		  <input type="file" class="form-control" id="imgFile" placeholder="Upload Image" name="image">
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="remember"> Remember me</label>
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
<div class="modal fade" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('category_control/edit_category', 'id="editForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Category Name:</label>
		  <input type="text" class="form-control" id="txtEditName" placeholder="Enter Name" name="name"/>
		</div>		
		<div class="form-group">
		  <label for="desc">Description:</label>
		  <textarea type="textarea" class="form-control" id="txtEditDesc" placeholder="Enter Description" name="desc"></textarea>
		</div>
		<div class="form-group">
		  <label for="image">Image Path:</label>
		  <input type="file" class="form-control" id="imgEditFile" placeholder="Upload Image" name="image">
		  <span id="user_uploaded_image"></span> 
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="remember"> Remember me</label>
		  <input type="text" id="txtId" name="id" hidden >
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default">Save Changes</button>
      </div>
	  <?php echo form_close(); ?>
    </div>
  </div>
</div>

<!-- delete Modal -->
<div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>	  
      <div class="modal-body">
        <p>Do you really want to delete ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="deleteCategoryBtn" class="btn btn-default">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" language="javascript">
	var manageCategoryTable;
	$(document).ready( function() {
		manageCategoryTable = $('#manageCategoryTable').DataTable({
			'ajax': '<?php echo base_url();?>category_control/fetch_category_data',
			'orders': []
		});
	});
	
	/*function addCategory() 
	{
		$("#createForm")[0].reset();

		//remove textdanger
		$(".text-danger").remove();
		// remove form-group
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#createForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			// remove the text-danger
			$(".text-danger").remove();

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(), // /converting the form data into array and sending it to server
				dataType: 'json',
				success:function(response) {
					if(response.success === true) {
						$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
						'</div>');

						// hide the modal
						$("#addCategory").modal('hide');

						// update the manageMemberTable
						manageCategoryTable.ajax.reload(null, false); 

					} else {
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
				}
			});	

			return false;
		});

	} */
	
	function addCategory()
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
					
						$("$addCategory").modal('hide'); // hide the model
						manageCategoryTable.ajax.reload(null, false); // update the manage category table					
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
	
	/* function editCategory(id = null)
	{
		if(id)
		{
			$("#editForm")[0].reset();
			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
			
			
			$.ajax({
				url: "category_control/get_selected_category/" + id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					$("#txtEditName").val(response.Name);
					$("#txtEditDesc").val(response.Description);
					//$("#user_uploaded_image").val(response.ImagePath);
					$('#user_uploaded_image').html(response.ImagePath);
					$("#txtId").val(response.CategoryId);
					
					$("#editForm").unbind('submit').bind('submit', function() {
						var form = $(this);
						
						$.ajax({
							url: form.attr('action') + '/' + id,
							type: 'post',
							data: form.selialize(),
							dataType: 'json',
							success:function(response) {
								if(response.success === true) {
									$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									'<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
									'</div>');
									
									// hide the modal
									$("#editMemberModal").modal('hide');
									// update the manageMemberTable
									manageMemberTable.ajax.reload(null, false); 
									
								}
								else {
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
									}
									else {
										$(".messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
										'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
										'<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
										'</div>');
									}
								}
							} // success
						}); // ajax
						return false;
					});
				}
			});
		}
		else {
			alert('error');
		}
	} */
	
	
	function editCategory(id = null) 
	{
		if(id) {

			$("#editForm")[0].reset();
			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			$.ajax({
				url: "<?php echo base_url();?>category_control/get_selected_category/" + id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					$("#txtEditName").val(response.Name);
					$("#txtEditDesc").val(response.Description);
					//$("#user_uploaded_image").val(response.ImagePath);
					$('#user_uploaded_image').html(response.ImagePath);
					$("#txtId").val(response.CategoryId);				

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
									$("#editCategory").modal('hide');

									// update the manageMemberTable
									manageCategoryTable.ajax.reload(null, false); 

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
	
	
	function deleteCategory(id = null) 
	{
		if(id) {
			$("#deleteCategoryBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '<?php echo base_url();?>category_control/delete_category' + '/' + id,
					type: 'post',				
					dataType: 'json',
					success:function(response) {
						if(response.success === true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// hide the modal
							$("#deleteCategory").modal('hide');

							// update the manageMemberTable
							//manageCategoryTable.ajax.reload(null, false); 
							manageCategoryTable.ajax.reload()

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