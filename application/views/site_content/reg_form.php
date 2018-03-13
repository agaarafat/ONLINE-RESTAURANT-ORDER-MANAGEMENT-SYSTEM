<br/><div class="container" style="padding-top: 50px;">
<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
		<h2 class="form-signin-heading">User Registration Form</h2>
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
                        <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-user"></i>
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

            <?php echo form_open('customer_control/add_customer/1'); ?>
            <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
						<div class="row">
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="name">First Name:</label>
							  <div class="error"><?php echo form_error('fname'); ?></div>
							  <input type="text" class="form-control" id="txtFName" placeholder="Enter First Name" name="fname" value="<?php echo set_value('fname'); ?>">
							</div>
						  </div>
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="name">Last Name:</label>
							  <div class="error"><?php echo form_error('lname'); ?></div>
							  <input type="text" class="form-control" id="txtLName" placeholder="Enter First Name" name="lname" value="<?php echo set_value('lname'); ?>">
							</div>
						  </div>
						</div>                         
						
						<div class="form-group">
						  <label for="email">Email:</label>
						  <div class="error"><?php echo form_error('email'); ?></div>
						  <input type="email" class="form-control" id="txtEmail" placeholder="Enter Email" name="email" value="<?php echo set_value('email'); ?>">
						</div>
						<div class="form-group">
						  <label for="telephone">Telephone:</label>
						  <div class="error"><?php echo form_error('telephone'); ?></div>
						  <input type="text" class="form-control" id="txtTelephone" placeholder="Enter Telephone" name="telephone" value="<?php echo set_value('telephone'); ?>">
						</div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
						<div class="row">
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="addr1">Address 1:</label>
							  <div class="error"><?php echo form_error('addr1'); ?></div>
							  <input type="text" class="form-control" id="txtAddr1" placeholder="Enter Address 1" name="addr1"  value="<?php echo set_value('addr1'); ?>">
							</div>
						  </div>
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="addr2">Address 2:</label>
							  <div class="error"><?php echo form_error('addr2'); ?></div>
							  <input type="text" class="form-control" id="txtAddr2" placeholder="Enter Address 2" name="addr2" value="<?php echo set_value('addr2'); ?>">
							</div>
						  </div>
						</div>  
                        
						<div class="row">
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="city">City:</label>
							  <div class="error"><?php echo form_error('city'); ?></div>
							  <input type="text" class="form-control" id="txtCity" placeholder="Enter City" name="city" value="<?php echo set_value('city'); ?>">
							</div>
						  </div>
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="province">Province:</label>
							  <div class="error"><?php echo form_error('province'); ?></div>
							  <input type="text" class="form-control" id="txtProvince" placeholder="Enter Province" name="province" value="<?php echo set_value('province'); ?>">
							</div>
						  </div>
						</div>  
						
						<div class="row">
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="pcode">Post Code:</label>
							  <div class="error"><?php echo form_error('pcode'); ?></div>
							  <input type="text" class="form-control" id="txtPcode" placeholder="Enter Postcode" name="pcode" value="<?php echo set_value('pcode'); ?>">
							</div>
						  </div>
						  <div class="col-lg-6 col-sm-12">
							<div class="form-group">
							  <label for="country">Country:</label>
							  <div class="error"><?php echo form_error('country'); ?></div>
							  <input type="text" class="form-control" id="txtCountry" placeholder="Enter Country" name="country" value="<?php echo set_value('country'); ?>">
							</div>
						  </div>
						</div> 						
						
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <div class="form-group">
						  <label for="userid">User ID:</label>
						  <div class="error"><?php echo form_error('userid'); ?></div>
						  <input type="text" class="form-control" id="txtUserId" placeholder="Enter UserId" name="userid" value="<?php echo set_value('userid'); ?>">
						</div>
						<div class="form-group">
						  <label for="password">Password:</label>
						  <div class="error"><?php echo form_error('pwd'); ?></div>
						  <input type="password" class="form-control" id="txtPwd" placeholder="Enter Password" name="pwd">
						</div>
						<div class="form-group">
						  <label for="password2">Confirm Password:</label>
						  <div class="error"><?php echo form_error('pwd2'); ?></div>
						  <input type="password" class="form-control" id="txtPwd" placeholder="Enter Password" name="pwd2">
						</div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="complete">
						<p id="captImg"><?php echo $captchaImg; ?></p>
						<a href="javascript:void(0);" class="refreshCaptcha" ><img src="<?php echo base_url().'assets/images/refresh.png';?>"     wedth="50px" height="50px"/></a>
						<div class="form-group">
						  <label for="captcha">Captcha Answer:</label>
						  <div class="error"><?php echo form_error('captcha'); ?></div>
						  <input type="text" name="capans" value="<?php echo $capans; ?>" hidden = "hidden">
						  <input type="text" class="form-control" id="txtCaptcha" placeholder="Enter Answer" name="captcha" >						  
						</div>
						<button type="submit" class="btn btn-primary btn-info-full pull pull-right">Submit</button>
						<ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                        </ul>
                    </div>
					
                    <div class="clearfix"></div>
			</div>
            <?php echo form_close(); ?>
		</div>
		</section>
	</div>
	<div class="col-sm-3"></div>
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
</script>