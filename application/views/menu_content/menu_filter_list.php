<div class="col-sm-6 menus">
<h4 style="color: orange;"><?php //echo $menus['CategoryName']; ?></h4>
  <?php foreach ($menus as $menu_item): ?>
			<div class="row">
				<div class="col-lg-2"><img src="<?php echo $menu_item['ImagePath']; ?>" alt="<?php echo $menu_item['Name']; ?>" height="76" width="102" /></div>
				<div class="col-lg-6">
					<h4 style="line-height: 0px;"><?php echo $menu_item['Name']; ?></h4>
					<p><?php echo $menu_item['Description']; ?></p>
				</div>
				<?php echo form_open('food_cart/add_cart_item'); ?>
				<div class="col-lg-4">
					<p>Quantity : <input type="number" name="quantity" id="num<?php echo $menu_item['Name']; ?>" min=<?php echo $menu_item['MinQuantity']; ?> max=<?php echo $menu_item['StockQuantity']; ?> width="20px" placeholder="0"/></p>
					<input type="text" name="menuId" value="<?php echo $menu_item['MenuId']; ?>" hidden="hidden"/>		
					<p style="line-height: 0px;"><b><?php echo $menu_item['Price']; ?> CAD</b>
					<button type="submit" class="btn btn-success">Add</button></p>
				</div>
				<?php echo form_close(); ?>
			</div>
			<hr/>
  <?php endforeach; ?>
</div>
