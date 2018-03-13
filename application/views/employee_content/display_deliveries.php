
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="messages"></div>			
			<table class="table table-bordered" id="manageDeliveryTable">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Address</th>
						<th>Telephone</th>
						<th>Email</th>
						<th>Order ID</th>
						<th>Assign Person</th>
						<th>Status</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript">
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#manageDeliveryTable').DataTable({
			'ajax': '<?php echo base_url();?>delivery_control/fetch_delivery_data',
			"order": [[ 0, "desc" ]]
		});
	});		
</script>