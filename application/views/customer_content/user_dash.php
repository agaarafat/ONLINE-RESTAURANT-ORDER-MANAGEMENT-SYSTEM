<br/><br/><br/><div class="container">
  <div class="row">
	<h1 style="color: green;"><?php if(isset($_SESSION['message'])) { echo $this->session->userdata('message'); } ?></h1>
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<a href="<?php echo base_url(); ?>user_access/update_page" class="btn btn-success">Update Account</a>
		<button class="btn btn-danger pull pull-right">Delete Account</button>
		<br/><br/>
		<h3>Your Information</h3>
		<table class="table">
			 <tr>
				<th>Name :</th>
				<td><?php echo $user['FirstName'] . " " . $user['LastName']; ?></td>
			  </tr>
			  <tr>
				<th>Address :</th>
				<td>
			<?php echo $user['Address1'] . ", " . $user['Address2'] . "<br/>" 
				. $user['City'] . ", " . $user['Province'] . "<br/>"
				. $user['Postcode'] . ", " . $user['Country']; ?>
				</td>
			 </tr>
			 <tr>
				<th>Telephone :</th>
				<td><?php echo $user['Telephone']; ?></td>
			 </tr>
			 <tr>
				<th>Email :</th>
				<td><?php echo $user['Email']; ?></td>
			 </tr>
		</table>	
	</div>
	<div class="col-md-2"></div>
  </div>
  <div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		
		<h3>Your Orders</h3>
	<table class="table table-bordered" id="ordersTable">
		<thead>
			<tr>
				<th>Serial</th>
				<th>Status</th>
				<th>Type</th>
				<th>Order Date</th>
				<th>Total Amount</th>
			</tr>
		</thead>
	</table>
	</div>
	<div class="col-md-2"></div>
  </div>
</div>

<script type="text/javascript" language="javascript">
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#ordersTable').DataTable({
			'ajax': '<?php echo base_url();?>order_control/fetch_orders_by_cid',
			'orders': []
		});
	});
</script>

