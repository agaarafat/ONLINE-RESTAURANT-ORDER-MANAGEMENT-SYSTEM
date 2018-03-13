
<div class="col-md-8">
			<div class="messages"></div>			
			<table class="table table-bordered" id="manageOrderTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Location</th>
						<th>Customer Name</th>
						<th>Status</th>
						<th>Type</th>
						<th>Time - Date</th>
						<th>Total Amount</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
		
<!-- cancel Modal -->
<div class="modal fade" id="cancelOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-top: 30px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>	  
      <div class="modal-body">
        <p>Do you really want to cancel this order ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="cancelOrderBtn" class="btn btn-default">Cancel Order</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" language="javascript">
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#manageOrderTable').DataTable({
			'ajax': '<?php echo base_url();?>order_control/fetch_order_data/1',
			"order": [[ 0, "desc" ]]
		});
	});
	function cancelOrder(oid = null, status = null) 
	{
		if(oid) {
			$("#cancelOrderBtn").unbind('click').bind('click', function() {
				
				$.ajax({
					url: '<?php echo base_url();?>order_control/update_order_status/'+ oid + '/Canceled/' + status,
					type: 'post',				
					dataType: 'json',
					success:function(response) {
						if(response.success === true) {
							$(".messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
							'</div>');

							// hide the modal
							$("#cancelOrder").modal('hide');

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
								
								// hide the modal
								$("#cancelOrder").modal('hide');
							}
						}
					} // /succes
				}); // /ajax
			});
		}
	}
</script>
