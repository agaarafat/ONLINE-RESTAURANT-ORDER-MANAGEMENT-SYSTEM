<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-6" style="border-right: 2px solid #d3d3d3">
		<table id="contacts" class="display nowrap table table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>City Name</th>
					<th>Contact Information</th>
				</tr>
			</thead>
		</table>
    </div>
    <div class="col-sm-6 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
	var manageDataTable;
	$(document).ready( function() {
		manageDataTable = $('#contacts').DataTable({
			'ajax': '<?php echo base_url();?>restaurant_control/fetch_contacts_data',
			'orders': [],
			scrollY: 200,
			scroller: {
				loadingIndicator: true
			}
		});
	});
</script>

<!-- Add Google Maps -->
<!--
<div id="googleMap" style="height:400px;width:100%;"></div>
<script>
function myMap() {
var myCenter = new google.maps.LatLng(41.878114, -87.629798);
var mapProp = {center:myCenter, zoom:12, scrollwheel:false, draggable:false, mapTypeId:google.maps.MapTypeId.ROADMAP};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
var marker = new google.maps.Marker({position:myCenter});
marker.setMap(map);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWXqKGF23tcGjWX5ilQcfNRGcmaDV5iHU&callback=initMap"</script>

To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->