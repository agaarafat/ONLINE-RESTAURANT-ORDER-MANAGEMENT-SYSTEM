<br/><br/><br/>
<div class="container">
	<div class="row">		
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
					<h2>Payment and Order</h2
					<section>
					<div class="wizard">
						<div class="wizard-inner">
							<div class="connecting-line"></div>
							<ul class="nav nav-tabs" role="tablist">

								<li role="presentation" class="active">
									<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
										<span class="round-tab">
											<i class="glyphicon glyphicon-folder-open"></i>
										</span>
									</a>
								</li>

								<li role="presentation" class="disabled">
									<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
										<span class="round-tab">
											<i class="glyphicon glyphicon-pencil"></i>
										</span>
									</a>
								</li>

								<li role="presentation" class="disabled">
									<a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
										<span class="round-tab">
											<i class="glyphicon glyphicon-ok"></i>
										</span>
									</a>
								</li>
							</ul>
						</div>

						<?php echo form_open('order_control/make_order'); ?>
						<div class="tab-content">
								<div class="tab-pane active" role="tabpanel" id="step1">
									<h3>Select Option</h3>
									<div class="form-group">
										<label for="name">Order Type:</label>
										<div class="error"><?php echo form_error('ordertype'); ?></div>
										<label class="radio-inline"><input type="radio" name="ordertype" value="Pickup">Pickup</label>
										<label class="radio-inline"><input type="radio" name="ordertype" value="Delivery">Delivery</label>
									</div>
									<div class="form-group">
										<label for="name">Select Restaurent Location:</label>
										<div class="error"><?php echo form_error('location'); ?></div>
										<select name="location" class="form-control"  id="cboLocation">
											<option value="">Select One</option>
										  <?php foreach ($restaurants as $oneRec): ?>
											<option value="<?php echo $oneRec['Address1'] . ', ' . $oneRec['City']; ?>"><?php echo $oneRec['Address1'] . ', ' . $oneRec['City']; ?></option>
										  <?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="desc">Give Comment: <small>(if any)</small></label>
										<textarea type="textarea" class="form-control" id="txtEditDesc" placeholder="Enter Your Comment" name="comment"></textarea>
									</div>
									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
									</ul>
								</div>
								<div class="tab-pane" role="tabpanel" id="step2">
									<h3>Payment Option</h3>
									<div class="form-group">
										<label for="name">Payment Type:</label>
										<div class="error"><?php echo form_error('paymenttype'); ?></div>
										<label class="radio-inline"><input type="radio" name="paymenttype" value="VISA">VISA</label>
										<label class="radio-inline"><input type="radio" name="paymenttype" value="MasterCard">MasterCard</label>
										<label class="radio-inline"><input type="radio" name="paymenttype" value="AExpress">American Express</label>
									</div>
									<div class="form-group">
										<label for="card">Credit Card Number:</label>
										<div class="error"><?php echo form_error('cnumber'); ?></div>
										<input type="text" class="form-control" id="txtCreditNumber" placeholder="Enter Number" name="cnumber" >
									</div>
									<div class="form-group">
										<label for="card">Code:</label>
										<div class="error"><?php echo form_error('code'); ?></div>
										<input type="text" class="form-control" id="txtCode" placeholder="Enter Code" name="code" >
									</div>
									<div class="form-group">
										<label for="card">Expiration Month and Year:</label>
										<div class="error"><?php echo form_error('month'); ?></div>
										<input type="number" class="form-control" id="txtMonth" placeholder="Enter Month" name="month" min="1" max="12" value="1">
										<br/>
										<div class="error"><?php echo form_error('year'); ?></div>
										<input type="text" class="form-control" id="txtYear" placeholder="Enter Year" name="year" min="2017" max="2100" value="2017">
									</div>
									<div class="form-group">
										<label for="card">Name on Card:</label>
										<div class="error"><?php echo form_error('name'); ?></div>
										<input type="text" class="form-control" id="txtName" placeholder="Enter Name" name="name" >
									</div>
									<input type="text" name="fee" id="txtFee" value="4" hidden >
									<ul class="list-inline pull-right">
										<li><button type="button" class="btn btn-default prev-step">Previous</button></li>
										<li><button type="button" class="btn btn-primary next-step" onclick="displaySummary()">Save and continue</button></li>
									</ul>
								</div>
								<div class="tab-pane" role="tabpanel" id="complete">
									<p id="summary"></p>
									<input type="text" name="totalamount" id="txtAmount" value="" hidden>
									<button type="submit" class="btn btn-primary btn-info-full pull pull-right" >Submit Order</button>
								</div>
								
								<ul class="list-inline pull-right">
									
								</ul>
								<div class="clearfix"></div>
						</div>
						<?php echo form_close(); ?>
					</div>
					</section>				
				</div>								
			</div>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>

<script>
$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
	
	$('.refreshCaptcha').on('click', function(){
        $.get('<?php echo base_url().'welcome/captcha_refresh'; ?>', function(data){
            $('#captImg').html(data);
        });
    });
});


function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

function displaySummary()
{
	var oType, loc, pType, extraFee, totalAmount, cNum, cCode, cName;
	var radios = document.getElementsByName('ordertype');

	for (var i = 0; i<radios.length; i++)
	{
	 if (radios[i].checked)
	 {
	  oType = radios[i].value;
	  break;
	 }
	}
	
	loc = document.getElementById("cboLocation").options[ document.getElementById("cboLocation").selectedIndex].text;
	radios = document.getElementsByName('paymenttype');
	for (var i = 0; i<radios.length; i++)
	{
	 if (radios[i].checked)
	 {
	  pType = radios[i].value;
	  break;
	 }
	}
	
	extraFee = 0;
	if(document.getElementsByName('ordertype')[1].checked)
	{
		extraFee = document.getElementById("txtFee").value;
	}
	
	totalAmount = parseFloat(<?php echo $this->cart->net_total(); ?>) + parseFloat(extraFee);
	cNum = document.getElementById('txtCreditNumber').value;
	cCode = document.getElementById('txtCode').value;
	cName = document.getElementById('txtName').value;

	var str = "<b>Order Type : </b>" + oType
		+ "<br/><b>Location : </b>" + loc
		+ "<br/><b>Payment Type : </b>" + pType;
	if(document.getElementsByName('ordertype')[1].checked)
	{
		str += "<br/><b>Delivery Fee : $</b>" + extraFee;
	}
	str += "<br/><b>Total Amount : $</b>" + totalAmount
		+ "<br/><b>Card Information : </b>" + cNum + " / " + cCode
		+ "<br/><b>Name on Card : </b>" + cName;
		
		
	document.getElementById('summary').innerHTML = str;
	document.getElementById('txtAmount').value = totalAmount;
	
}
</script>