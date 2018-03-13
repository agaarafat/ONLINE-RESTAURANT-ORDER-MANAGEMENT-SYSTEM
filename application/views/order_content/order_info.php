<br/><br/><br/>
<div class="container">
	<div class="row">		
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-6">
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
				  <a href="<?php echo base_url();?>user_access/update_page" class="btn btn-success pull pull-right">Update User Information</a>
				</div>
				<div class="col-sm-6">
					<h3>Your Order Information</h3>
					<table class="table table-bordered">
						<thead>
							<tr>								
								<td>Item Name</td>
								<td>Quantity</td>
								<td>Price</td>
								<td>Sub-Total</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach($this->cart->contents() as $items): ?>
							<tr>
								<td><?php echo $items['name']; ?></td>
								<td><?php echo $items['qty']; ?></td>
								<td>$ <?php echo $this->cart->format_number($items['price']); ?></td>
								<td>$ <?php echo $this->cart->format_number($items['subtotal']); ?></td>
							</tr>
							<?php endforeach; ?>
							<tr>
								<td colspan="3"><strong>Sub-Total</strong></td>
								<td>$ <?php echo $this->cart->format_number($this->cart->total()); ?></td>
							</tr>
							<tr>
								<td colspan="3"><strong>T.P.S. (5%)</strong></td>
								<td>$ <?php echo $this->cart->format_number($this->cart->tps_total()); ?></td>
							</tr>
							<tr>
								<td><strong>T.V.Q. (9.975%)</strong></td>
								<td colspan="3">$ <?php echo $this->cart->format_number($this->cart->tvq_total()); ?></td>
							</tr>
							<tr>
								<td colspan="3"><strong>Total</strong></td>
								<td>$ <?php echo $this->cart->format_number($this->cart->net_total()); ?></td>
							</tr>
						</tbody>
					</table>
					<a href="<?php echo base_url();?>menu_page" class="btn btn-success pull pull-right">Update Order Information</a>
				</div>				
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
