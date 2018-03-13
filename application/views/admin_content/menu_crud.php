
<div class="col-md-8">
	<div class="messages"></div>
	
	<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMenu" onclick="addMenu()">Add Menu</button>
	<br/><br/>
	
	<table class="table table-bordered" id="manageMenuTable">
		<thead>
			<tr>
				<th>Menu Name</th>
				<th>Price</th>
				<th>Description</th>
				<th>Category</th>
				<th>Stock</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('menu_control/add_menu', 'id="createForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Menu Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" >
		</div>
		<div class="form-group">
		  <label for="price">Price:</label>
		  <input type="text" class="form-control" id="txtPrice" placeholder="Enter Price" name="price" >
		</div>
		<div class="form-group">
		  <label for="desc">Description:</label>
		  <textarea type="textarea" class="form-control" id="txtDesc" placeholder="Enter Description" name="desc"></textarea>
		</div>
		<div class="form-group">
		  <label for="categroy">Category:</label>
		  <select name="category" class="form-control" id="cboCategory" >
			<option value="">Select One</option>
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
		  <input type="number" class="form-control" id="txtSQnt" placeholder="Enter Stock Quantity" name="sqnt" >
		</div>
		<div class="form-group">
		  <label for="mqnt">Minimum Quantity:</label>
		  <input type="number" class="form-control" id="txtMQnt" placeholder="Enter Minimum Quantity" name="mqnt" >
		</div>
		<div class="form-group">
		  <label for="option">Menu Option:</label>
		  <input type="text" class="form-control" id="txtOption" placeholder="Enter Menu Option" name="option" >
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="remember"> Is it Special</label>
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
<div class="modal fade" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <?php echo form_open_multipart('menu_control/edit_menu', 'id="editForm"'); ?>
      <div class="modal-body">
        <div class="form-group">
		  <label for="name">Menu Name:</label>
		  <input type="text" class="form-control" id="txtEditName" placeholder="Enter Name" name="name" >
		</div>
		<div class="form-group">
		  <label for="price">Price:</label>
		  <input type="text" class="form-control" id="txtEditPrice" placeholder="Enter Price" name="price" >
		</div>
		<div class="form-group">
		  <label for="desc">Description:</label>
		  <textarea type="textarea" class="form-control" id="txtEditDesc" placeholder="Enter Description" name="desc"></textarea>
		</div>
		<div class="form-group">
		  <label for="categroy">Category:</label>
		  <select name="category" class="form-control"  >
			<option value="" id="cboEditCategory">Select One</option>
		  <?php foreach ($categories as $category_item): ?>
			<option value="<?php echo $category_item['CategoryId']; ?>"><?php echo $category_item['Name']; ?></option>
		  <?php endforeach; ?>
		  </select>
		</div>
		<div class="form-group">
		  <label for="image">Image Path:</label>
		  <input type="file" class="form-control" id="imgEditFile" placeholder="Upload Image" name="image">
		  <span id="user_uploaded_image"></span> 
		</div>
		<div class="form-group">
		  <label for="mtime">Meal Time:</label>
		  <select name="mtime" class="form-control" > 
			<option value="" id="cboEditMTime">Select One</option>
		  <?php foreach ($meal_times as $meal_time_item): ?>
			<option value="<?php echo $meal_time_item['MealTimeId']; ?>"><?php echo $meal_time_item['Name'] . " ( " . $meal_time_item['StartTime'] . " - " . $meal_time_item['EndTime'] . " )" ; ?></option>
		  <?php endforeach; ?>
		  </select>
		</div>
		<div class="form-group">
		  <label for="sqnt">Stock Quantity:</label>
		  <input type="number" class="form-control" id="txtEditSQnt" placeholder="Enter Stock Quantity" name="sqnt" >
		</div>
		<div class="form-group">
		  <label for="mqnt">Minimum Quantity:</label>
		  <input type="number" class="form-control" id="txtEditMQnt" placeholder="Enter Minimum Quantity" name="mqnt" >
		</div>
		<div class="form-group">
		  <label for="option">Menu Option:</label>
		  <input type="text" class="form-control" id="txtEditOption" placeholder="Enter Menu Option" name="option" >
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="remember"> Is it Special</label>
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
<div class="modal fade" id="deleteMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
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
        <button type="button" id="deleteMenuBtn" class="btn btn-default">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" language="javascript">
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#manageMenuTable').DataTable({
			'ajax': '<?php echo base_url();?>menu_control/fetch_menu_data',
			'orders': []
		});
	});
		
	function addMenu()
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
					
						$("$addMenu").modal('hide'); // hide the model
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
		
	function editMenu(id = null) 
	{
		if(id) {

			$("#editForm")[0].reset();
			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();

			$.ajax({
				url: "<?php echo base_url();?>menu_control/get_selected_menu/" + id,
				type: 'post',
				dataType: 'json',
				success:function(response) {
					$("#txtEditName").val(response.Name);
					$("#txtEditPrice").val(response.Price);
					$("#txtEditDesc").val(response.Description);
					$("#cboEditCategory").val(response.CategoryId);
					$("#cboEditCategory").html(response.CategoryName);
					$('#user_uploaded_image').html(response.ImagePath);
					$("#cboEditMTime").val(response.MealTimeId);
					$("#cboEditMTime").html(response.MTName);
					$("#txtEditSQnt").val(response.StockQuantity);
					$("#txtEditMQnt").val(response.MinQuantity);
					$("#txtEditOption").val(response.MenuOption);
					$("#txtId").val(response.MenuId);				

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
									$("#editMenu").modal('hide');

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
	
	
	function deleteMenu(id = null) 
	{
		if(id) {
			$("#deleteMenuBtn").unbind('click').bind('click', function() {
				$.ajax({
					url: '<?php echo base_url();?>menu_control/delete_menu' + '/' + id,
					type: 'post',				
					dataType: 'json',
					success:function(response) {
						if(response.success === true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// hide the modal
							$("#deleteMenu").modal('hide');

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