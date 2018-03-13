<div id="cart_content"><div class="col-sm-4 orders">
	<div class="error"><b><?php echo $this->session->userdata('stock_error'); ?></b></div>
	<h1>My Order</h1>
	<?php if(!$this->cart->contents()):
		echo 'You don\'t have any items yet.';
		else:
	?>
	
	<?php echo form_open('food_cart/update_cart'); ?>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Quantity</td>
				<td>Item Name</td>
				<td>Price</td>
				<td>Sub-Total</td>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1 ?>
			<?php foreach($this->cart->contents() as $items): ?>
			<?php echo form_hidden('rowid[]', $items['rowid']); ?>
			<tr <?php if($i&1) { echo 'class="alt"';}?>>
				<td>
				<?php foreach ($menus as $menu_item): ?>
				<?php if($menu_item['Name'] == $items['name']) { ?>
					<input type="number" name="qty[]" value="<?php echo $items['qty']; ?>" min="0" max=<?php echo $menu_item['StockQuantity']; ?>  width="30px" style="width: 60px;"/>
				<?php } ?>
				<?php endforeach; ?>
				</td>
				<td><?php echo $items['name']; ?></td>
				<td>$ <?php echo $this->cart->format_number($items['price']); ?></td>
				<td>$ <?php echo $this->cart->format_number($items['subtotal']); ?></td>
			</tr>
			<?php $i++; ?>
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
				<td colspan="3"><strong>T.V.Q. (9.975%)</strong></td>
				<td>$ <?php echo $this->cart->format_number($this->cart->tvq_total()); ?></td>
			</tr>
			<tr>
				<td colspan="3"><strong>Total</strong></td>
				<td>$ <?php echo $this->cart->format_number($this->cart->net_total()); ?></td>
			</tr>
		</tbody>
	</table>
	
	<p><?php echo form_submit('', 'Update your Cart');?> | <?php echo anchor('food_cart/empty_cart', 'Empty Cart', 'class="empty"');?></p>
	<p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>	
	<?php echo form_close(); ?>
	<?php if(!$this->cart->is_minimum(40)) { ?>
	<p class="error"><b>Please order more than $ 40.00 </b></p>
	<?php }
	elseif (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name'])) { ?>
		<a class="btn btn-success btn-lg pull pull-right" href="<?php echo base_url();?>user_access/signin_page">Sign In Now</a>
		<a class="btn btn-success btn-lg pull pull-right" href="<?php echo base_url();?>user_access/registration">Registration Now</a>
	<?php } else { ?>
	<a href="<?php echo base_url(); ?>order_control/order_now" class="btn btn-success btn-lg pull pull-right">Order Now</a>
	<?php }	?>
	<?php endif; ?>
</div></div>

<script>
	$(document).ready(function() {
		var link ="<?php echo site_url();?>";
		$("div.menus form").submit(function(){
			
			var id = $(this).find('input[name=menuId]').val();
			var qty = $(this).find('input[name=quantity]').val();
			
			$.post(link + "food_cart/add_cart_item", { menuId: id, quantity: qty, ajax: '1' }, function(data) {
				if(data == 'true')
				{
					$.get(link + "food_cart/show_cart", function(cart){
						$("#cart_content").html(cart);
					});
				}
				else
				{
					alert("Product does not exist");
				}

			});		
			return false;
		});
			
		$(".empty").live("click", function(){
			$.get(link + "food_cart/empty_cart", function(){
				$.get(link + "food_cart/show_cart", function(cart){
					$("#cart_content").html(cart);
				});
			});
			
			return false;
		});
	});
	
	function displayMenus(id)
	{
		$.ajax({url: "<?php echo base_url();?>menu_page/get_menus_by_cat/" + id, success: function(result){
            $("#menu_content").html(result);
        }});
	}
</script>
