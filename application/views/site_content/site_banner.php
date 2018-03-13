<div class="jumbotron text-center">
  <h1>Online Restaurant</h1> 
  <p>We specialize in delicious foods</p> 
  <form>
	<div class="col-lg-3">
	</div>
    <div class="input-group col-lg-6">
		<select name="location" class="form-control"  id="cboLocation">
			<option value="">Select One</option>
			<?php foreach ($restaurants as $oneRec): ?>
			<option value="<?php echo $oneRec['RestaurantId']; ?>"><?php echo $oneRec['Address1'] . ', ' . $oneRec['City']; ?></option>
			<?php endforeach; ?>
		</select>
      <div class="input-group-btn">
        <a href="<?php echo base_url(); ?>menu_page" class="btn btn-danger">Our Menu</a>
      </div>
    </div>
	<div class="col-lg-3">
	</div>
  </form>
</div>
