
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="messages"></div>			
			<table class="table table-bordered" id="manageOrderTable">
				<thead>
					<tr>
						<th>ID</th>
						<th>Location</th>
						<th>Customer Name</th>
						<th>Status</th>
						<th>Type</th>
						<th>Ready Time</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript">
	var manageCategoryTable;
	$(document).ready( function() {
		manageCategoryTable = $('#manageOrderTable').DataTable({
			'ajax': '<?php echo base_url();?>order_control/fetch_order_data',
			"order": [[ 0, "desc" ]]
		});
	});		
</script>