<div class="col-sm-2" id="menuCat">
	<a href="<?php echo base_url(); ?>menu_page" class="btn btn-default btn-block">All Categories</a>
	<?php foreach ($categories as $category_item): ?>
		<button type="button" class="btn btn-info btn-block" onclick="displayMenus(<?php echo $category_item['CategoryId']; ?>)"><?php echo $category_item['Name']; ?></button>
	<?php endforeach; ?>
</div>