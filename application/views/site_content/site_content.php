<!-- Container (Services Section) -->
<div id="menus" class="container-fluid">
 
<!--Item slider text-->
<h2>Delicious Menus</h2>

<!-- Item slider-->
<div class="container">

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="carousel carousel-showmanymoveone slide" id="itemslider">
        <div class="carousel-inner">

		<?php
			$i = 1;
			foreach ($menus as $menus_item): 				
		?>

			<div class="item <?php if($i==1) {echo 'active';} ?>">
				<div class="col-xs-12 col-sm-6 col-md-2">
				  <a href="#"><img src="<?php echo $menus_item['ImagePath']; ?>" class="img-responsive center-block"></a>
				  <h4 class="text-center"><?php echo $menus_item['Name']; ?></h4>
				  <h5 class="text-center"><?php echo $menus_item['Price']; ?> CAD</h5>
				</div>
			</div>
		<?php $i++; endforeach; ?>          

        </div>

        <div id="slider-control">
        <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://s12.postimg.org/uj3ffq90d/arrow_left.png" alt="Left" class="img-responsive"></a>
        <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="https://s12.postimg.org/djuh0gxst/arrow_right.png" alt="Right" class="img-responsive"></a>
      </div>
      </div>
    </div>
  </div>
</div>
<!-- Item slider end-->
<script>
$(document).ready(function(){

$('#itemslider').carousel({ interval: 3000 });

$('.carousel-showmanymoveone .item').each(function(){
var itemToClone = $(this);

for (var i=1;i<6;i++) {
itemToClone = itemToClone.next();

if (!itemToClone.length) {
itemToClone = $(this).siblings(':first');
}

itemToClone.children(':first-child').clone()
.addClass("cloneditem-"+(i))
.appendTo($(this));
}
});
});
</script>
</div>

