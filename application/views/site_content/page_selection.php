<br/><br/><br/>
<div class="container">
	<h1 style="color: green;"><?php if(isset($_SESSION['message'])) { echo $this->session->userdata('message'); } ?></h1>
	<div class="row">
		<h2 class="pull">Select an Option</h2>
		
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-4">
					<a href="#"><img src='../assets/images/utilities/menu.png' width='200' height='200'/></a>
					<br/><br/>
					<a class='btn btn-success btn-lg btn-block' href ='<?php echo base_url(); ?>menu_page'>Continue Shopping</a>
				</div>
				<div class="col-sm-4">
				<?php if($this->cart->contents() == null || !$this->cart->is_minimum(40)) { } else {?>
					<a href="#"><img src='../assets/images/utilities/order.png' width='200' height='200'/></a>
					<br/><br/>
					<a class='btn btn-success btn-lg btn-block' href ='<?php echo base_url(); ?>order_control/order_now'>Order Now</a>
				<?php } ?>
				</div>
				<div class="col-sm-4">
					<a href="#"><img src='../assets/images/utilities/membership.jpg' width='200' height='200'/></a>
					<br/><br/>
					<a class='btn btn-success btn-lg btn-block' href ='<?php echo base_url(); ?>user_access/access_account'>Access Account</a>
				</div>
			</div>
		</div>
		<div class="col-sm-2"></div>
		<?php $this->session->unset_userdata('message'); ?>
	</div>
</div>
