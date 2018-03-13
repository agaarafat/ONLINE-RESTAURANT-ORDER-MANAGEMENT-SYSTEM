
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="messages"></div>			
			<table class="table table-bordered" id="managePickupTable">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Telephone</th>
						<th>Email</th>
						<th>Order ID</th>
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
		manageDataTable = $('#managePickupTable').DataTable({
			'ajax': '<?php echo base_url();?>pickup_control/fetch_pickup_data',
			"order": [[ 0, "desc" ]]
		});
	});		
</script>