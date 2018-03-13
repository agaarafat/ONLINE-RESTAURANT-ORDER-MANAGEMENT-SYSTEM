<div class="container">
	<h1>Order Details</h1>
	<div class="row">
		<div class="col-lg-4">
			<div class="panel panel-info">
			  <div class="panel-heading">Order Details</div>
			  <div class="panel-body">
				<table class="table">
					  <tr>
						<th>Order # :</th>
						<td>#<?php echo $orders['OrderId']; ?></td>
					  </tr>
					  <tr>
						<th>Order Date :</th>
						<td><?php echo $orders['OrderDate']; ?></td>
					  </tr>
					  <tr>
						<th>Order Type :</th>
						<td><?php echo $orders['Type']; ?></td>
					  </tr>
					  <tr>
						<th>Order Status :</th>
						<td><?php echo $orders['Status']; ?></td>
					  </tr>
					  <tr>
						<th>Delivery / Pickup Time :</th>
						<td><?php echo $orders['ReadyTime']; ?></td>
					  </tr>
					  <tr>
						<th>Payment Method :</th>
						<td>Online Payment</td>
					  </tr>
				  </table>
			  </div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-info">
			  <div class="panel-heading">Customer Details</div>
			  <div class="panel-body">
				<table class="table">
					  <tr>
						<th>Name :</th>
						<td><?php echo $orders['FirstName']; ?> <?php echo $orders['LastName']; ?></td>
					  </tr>
					  <tr>
						<th>Address :</th>
						<td><?php echo $orders['Address1']; ?>, <?php echo $orders['Address2']; ?><br/><?php echo $orders['City']; ?>, <?php echo $orders['Province']; ?>, <?php echo $orders['Postcode']; ?></td>
					  </tr>
					  <tr>
						<th>Telephone :</th>
						<td><?php echo $orders['Telephone']; ?></td>
					  </tr>
					  <tr>
						<th>Email :</th>
						<td><?php echo $orders['Email']; ?></td>
					  </tr>
				  </table>
			  </div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-info">
			  <div class="panel-heading">Invoice (Planning)</div>
			  <div class="panel-body">
				<table class="table">
					  <tr>
						<th>Invoice # :</th>
						<td>INV-YYYY-OID</td>
					  </tr>
					  <tr>
						<th>Order Total :</th>
						<td><?php echo $orders['TotalAmount']; ?></td>
					  </tr>
					  <tr>
						<th>TPS (5%) :</th>
						<td><?php echo $orders['TPS']; ?></td>
					  </tr>
					  <tr>
						<th>TVQ (9.975%) :</th>
						<td><?php echo $orders['TVQ']; ?></td>
					  </tr>
					  <tr>
						<th>Total Amount :</th>
						<td><?php echo $orders['TotalAmount']+$orders['TPS']+$orders['TVQ']; ?></td>
					  </tr>
					  <tr>
						<th>Status :</th>
						<td>Paid</td>
					  </tr>
				  </table>
			  </div>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-lg-6">
		  <div id='tableItems'>
			<div class="panel panel-info">
			  <div class="panel-heading">Menu Items</div>
			  <div class="panel-body">
				
					<table class="table table-bordered">
						<thead>
							<tr>								
								<td>Item Name</td>
								<td>Quantity</td>
								<td>Price</td>
								<td>Sub-Total</td>
								<td>Status</td>
							</tr>
						</thead>
						<tbody>
							<?php 
								$checked = "";
								if($orders['Status'] === 'Pending' || $orders['Status'] === 'Preparing')
									$checked = "";
								else
									$checked = 'checked';
								foreach($order_items as $items): ?>
							<tr>
								<td><?php echo $items['Name']; ?></td>
								<td><?php echo $items['Quantity']; ?></td>
								<td>$ <?php echo $this->cart->format_number($items['UnitPrice']); ?></td>
								<td>$ <?php echo $this->cart->format_number($items['TotalPrice']); ?></td>
								<td>
									<label class="switch">
									  <input type="checkbox" <?php echo $checked;?>>
									  <span class="slider round"></span>
									</label>
								</td>
							</tr>
							<?php endforeach; ?>							
						</tbody>
					</table>
					<?php 
						if($orders['Status'] === 'Pending' || $orders['Status'] === 'Preparing') {
						echo form_open('order_control/update_order_status/'. $orders['OrderId'] .'/Completed'); ?>
							<button type="submit" class="btn btn-warning pull pull-right">Complete</button>
					<?php 
						echo form_close(); }
						else {
							echo "<b class='text-green pull pull-right'>Completed Successfully</b>";
						}
					?>
			  </div>
			</div>
		  </div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-info">
			<?php foreach($restaurants as $items): 
				$str = $items['Address1'] . ', ' . $items['City']; 
				if($orders['Location'] === $str) {?>
			  <div class="panel-heading">Restaurant (Planning) - <?php echo $items['City']; ?></div>
			  <div class="panel-body">
				<address>
					<?php echo $items['Address1']; ?>, <?php echo $items['Address2']; ?><br/>
					<?php echo $items['City']; ?>, <?php echo $items['Province']; ?>, <?php echo $items['Postcode']; ?><br/>
					<?php echo $items['Country']; ?>
				</address>
			  </div>
				<?php }
					endforeach; ?>
			</div>
		</div>
	</div>
	<hr/>
	<div class="row">
		<div class="col-lg-4">
			<div class="panel panel-info">
			  <div class="panel-heading">Customer Comment</div>
			  <?php if($orders['Commant'] === "") { ?>
				<div class="panel-body"><b>No order comment</b></div>
			  <?php } else { ?>
				<div class="panel-body"><b><?php echo $orders['Commant']; ?></b></div>
			  <?php } ?>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-info">
			  <div class="panel-heading">Delivery</div>
			  <div class="panel-body">
			  <div class="error"><?php echo form_error('person'); ?></div>
			  <?php if($orders['Status'] === 'Delivered') : ?>
				<b>Order has been delivered successfully!</b>
			  <?php elseif($orders['Status'] === 'Delivering') : ?>
				<b>Order on the way!</b>
			  <?php elseif($orders['Type'] !== 'Pickup') : ?>
				<?php echo form_open('delivery_control/make_delivery/'. $orders['OrderId']); ?>
					<div class="form-group">
						<label for="name">Address:</label>
						<address>
							<?php echo $orders['Address1']; ?>, <?php echo $orders['Address2']; ?><br/><?php echo $orders['City']; ?>, <?php echo $orders['Province']; ?>, <?php echo $orders['Postcode']; ?>
						</address>
					</div>
					<div class="form-group">
					  <label for="name">Assign Person:</label>
					  <input type="text" name="oid" value="<?php echo $orders['OrderId']; ?>" hidden>
					  <input type="text" name="cid"  value="<?php echo $orders['CustomerId']; ?>" hidden>
					  <select name="person" id="cboPerson" class="form-control">
						<option value="">Select One</option>
						<?php foreach($employees as $emp): 
							if($emp['Role'] === 'Deliveryman'): ?>
						<option value="<?php echo $emp['EmployeeId']; ?>"><?php echo $emp['Name']; ?></option>
						<?php endif; endforeach; ?>
					  </select>
					</div>					
					<button type="submit" class="btn btn-warning pull pull-right">Make Delivery</button>
			    <?php echo form_close();   ?>	
			  <?php else: ?>
			  <b>This is a pickup order, there is no delivery Option.</b> <?php endif; ?>
			  </div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-info">
			  <div class="panel-heading">Confirm Delivery/Pickup</div>
			  <div class="panel-body">
				<label for="name">Name:</label>
				<p><?php echo $orders['FirstName']; ?> <?php echo $orders['LastName']; ?></p>
				<label for="name">Address:</label>
				<address>
					<?php echo $orders['Address1']; ?>, <?php echo $orders['Address2']; ?><br/><?php echo $orders['City']; ?>, <?php echo $orders['Province']; ?>, <?php echo $orders['Postcode']; ?>
				</address>
				<?php if($orders['Status'] === 'Received' || $orders['Status'] === 'Delivered') : ?>
					<b>Items Pickup / Delivery has done successfully!</b>
				<?php elseif($orders['Type'] === 'Pickup') : ?>
					<?php echo form_open('order_control/update_order_status/'. $orders['OrderId'] .'/Received'); ?>
						<input type="text" name="oid" value="<?php echo $orders['OrderId']; ?>" hidden>
						<input type="text" name="cid" value="<?php echo $orders['CustomerId']; ?>" hidden>					
						<button type="submit" class="btn btn-warning pull pull-right">Pickup Confirm</button>
					<?php echo form_close(); ?>
				<?php else: ?>
					<?php echo form_open('order_control/update_order_status/'. $orders['OrderId'] .'/Delivered'); ?>
						<input type="text" name="oid" value="<?php echo $orders['OrderId']; ?>" hidden>
						<input type="text" name="cid" value="<?php echo $orders['CustomerId']; ?>" hidden>						
						<button type="submit" class="btn btn-warning pull pull-right">Delivery Confirm</button>
					<?php echo form_close(); ?>
				<?php endif; ?>
				
			  </div>
			</div>
		</div>
	</div>
</div>

<script>


</script>