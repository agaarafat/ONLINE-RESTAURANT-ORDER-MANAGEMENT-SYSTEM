<div class="col-md-1"></div>
<div class="col-md-5">
	</br></br></br><h2>Add a Restaurant</h2>
	<?php echo validation_errors(); ?>

	<?php echo form_open_multipart('restaurant_control/add_restaurant'); ?>
	    <div class="form-group">
		  <label for="name">Restaurant Name:</label>
		  <input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>">
		</div>
		<div class="form-group">
		  <label for="email">Email:</label>
		  <input type="email" class="form-control" id="txtEmail" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>">
		</div>
		<div class="form-group">
		  <label for="telephone">Telephone:</label>
		  <input type="text" class="form-control" id="txtTelephone" placeholder="Enter Telephone" name="telephone" value="<?php echo set_value('telephone'); ?>">
		</div>
		<div class="form-group">
		  <label for="addr1">Address 1:</label>
		  <input type="text" class="form-control" id="txtAddr1" placeholder="Enter Address 1" name="addr1" value="<?php echo set_value('addr1'); ?>">
		</div>
		<div class="form-group">
		  <label for="addr2">Address 2:</label>
		  <input type="text" class="form-control" id="txtAddr2" placeholder="Enter Address 2" name="addr2" value="<?php echo set_value('addr2'); ?>">
		</div>
		<div class="form-group">
		  <label for="city">City:</label>
		  <input type="text" class="form-control" id="txtCity" placeholder="Enter City" name="city" value="<?php echo set_value('city'); ?>">
		</div>
		<div class="form-group">
		  <label for="province">Province:</label>
		  <input type="text" class="form-control" id="txtProvince" placeholder="Enter Province" name="province" value="<?php echo set_value('province'); ?>">
		</div>
		<div class="form-group">
		  <label for="pcode">Post Code:</label>
		  <input type="text" class="form-control" id="txtPcode" placeholder="Enter Postcode" name="pcode" value="<?php echo set_value('pcode'); ?>">
		</div>
		<div class="form-group">
		  <label for="country">Country:</label>
		  <input type="text" class="form-control" id="txtCountry" placeholder="Enter Country" name="country" value="<?php echo set_value('country'); ?>">
		</div>
		<div class="form-group">
		  <label for="desc">Description:</label>
		  <textarea type="textarea" class="form-control" id="txtDesc" placeholder="Enter Description" name="desc"><?php echo set_value('desc'); ?></textarea>
		</div>
		<div class="form-group">
		  <label for="image">Image Path:</label>
		  <input type="file" class="form-control" id="imgFile" placeholder="Upload Image" name="image" value="<?php echo set_value('image'); ?>">
		</div>
		<div class="checkbox">
		  <label><input type="checkbox" name="remember"> Enable This Restaurant</label>
		</div>
		<hr/>
		<!--map div-->
        <div id="map"></div>
		<div class="form-group">
		  <label for="latitude">Latitude:</label>
		  <input type="text" class="form-control" id="txtLatitude" placeholder="Enter Latitude" name="latitude" id="lat" readonly="yes">
		</div>
		<div class="form-group">
		  <label for="longitude">Longitude:</label>
		  <input type="text" class="form-control" id="txtLongitude" placeholder="Enter Longitude" name="longitude" id="lat" readonly="yes">
		</div>
		<button type="submit" class="btn btn-default">Submit</button>
	<?php echo form_close(); ?>
	  <script type="text/javascript">
	    //map.js
 
		//Set up some of our variables.
		var map; //Will contain map object.
		var marker = false; ////Has the user plotted their location marker? 
				
		//Function called to initialize / create the map.
		//This is called when the page has loaded.
		function initMap() {
		 
			//The center location of our map.
			var centerOfMap = new google.maps.LatLng(52.357971, -6.516758);
		 
			//Map options.
			var options = {
			  center: centerOfMap, //Set center.
			  zoom: 7 //The zoom value.
			};
		 
			//Create the map object.
			map = new google.maps.Map(document.getElementById('map'), options);
		 
			//Listen for any clicks on the map.
			google.maps.event.addListener(map, 'click', function(event) {                
				//Get the location that the user clicked.
				var clickedLocation = event.latLng;
				//If the marker hasn't been added.
				if(marker === false){
					//Create the marker.
					marker = new google.maps.Marker({
						position: clickedLocation,
						map: map,
						draggable: true //make it draggable
					});
					//Listen for drag events!
					google.maps.event.addListener(marker, 'dragend', function(event){
						markerLocation();
					});
				} else{
					//Marker has already been added, so just change its location.
					marker.setPosition(clickedLocation);
				}
				//Get the marker's location.
				markerLocation();
			});
		}
				
		//This function will get the marker's current location and then add the lat/long
		//values to our textfields so that we can save the location.
		function markerLocation(){
			//Get location.
			var currentLocation = marker.getPosition();
			//Add lat and lng values to a field that we can save.
			document.getElementById('lat').value = currentLocation.lat(); //latitude
			document.getElementById('lng').value = currentLocation.lng(); //longitude
		}
				
				
		//Load the map when the page has finished loading.
		google.maps.event.addDomListener(window, 'load', initMap);
	  </script>
</div>