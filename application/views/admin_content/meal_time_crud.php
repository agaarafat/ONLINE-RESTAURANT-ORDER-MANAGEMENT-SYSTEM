
<div class="col-md-8">
	<div class="messages"></div>
	
	<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMealTime" onclick="addMealTime()">Add Meal Time</button>
	<br/><br/>
	
	<table class="table table-bordered" id="manageMealTimeTable">
		<thead>
			<tr>
				<th>Meal Time Name</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addMealTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Meal Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('meal_time_control/add_meal_time', 'id="createForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Meal Time Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" >
		</div>
		<div class="form-group">
		  <label for="start">Start Time:</label>
		  <input type="time" class="form-control" id="txtStartTime" placeholder="Enter Start Time" name="start" >
		</div>
		<div class="form-group">
		  <label for="end">End Time:</label>
		  <input type="time" class="form-control" id="txtEndTime" placeholder="Enter End Time" name="end" >
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
<div class="modal fade" id="editMealTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Meal Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('meal_time_control/edit_meal_time', 'id="editForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Meal Time Name:</label>
		  <input type="text" class="form-control" id="txtEditName" placeholder="Enter Name" name="name" >
		</div>
		<div class="form-group">
		  <label for="start">Start Time:</label>
		  <input type="time" class="form-control" id="txtEditStartTime" placeholder="Enter Start Time" name="start" >
		</div>
		<div class="form-group">
		  <label for="end">End Time:</label>
		  <input type="time" class="form-control" id="txtEditEndTime" placeholder="Enter End Time" name="end">
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
<div class="modal fade" id="deleteMealTime" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Meal Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>	  
      <div class="modal-body">
        <p>Do you really want to delete ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="deleteMealTimeBtn" class="btn btn-default">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" language="javascript">
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#manageMealTimeTable').DataTable({
			'ajax': '<?php echo base_url();?>meal_time_control/fetch_meal_time_data',
			'orders': []
		});
	});
		
	function addMealTime()
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
					
						$("$addMealTime").modal('hide'); // hide the model
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
		
	function editMealTime(id = null) 
	{
		if(id) {

			$("#editForm")[0].reset();
			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			$.ajax({
				url: "<?php echo base_url();?>meal_time_control/get_selected_meal_time/" + id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					$("#txtEditName").val(response.Name);
					$("#txtEditStartTime").val(response.StartTime);
					$("#txtEditEndTime").val(response.EndTime);
					$("#txtId").val(response.MealTimeId);				

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
									$("#editMealTime").modal('hide');

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
	
	function deleteMealTime(id = null) 
	{
		if(id) {
			$("#deleteMealTimeBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '<?php echo base_url();?>meal_time_control/delete_meal_time' + '/' + id,
					type: 'post',				
					dataType: 'json',
					success:function(response) {
						if(response.success === true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// hide the modal
							$("#deleteMealTime").modal('hide');

							// update the manageMemberTable
							//manageCategoryTable.ajax.reload(null, false); 
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