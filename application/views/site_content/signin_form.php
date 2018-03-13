<br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
		<?php echo form_open('user_access/signin_user'); ?>
			<h2 class="form-signin-heading">User Sign In</h2>
			<div class="error"><?php echo validation_errors(); ?></div>
			<div class="error"><?php if($this->session->has_userdata('error')) { echo $this->session->userdata('error'); } ?></div>
			<label for="inputEmail" class="">Email address or user ID</label>
			<input type="text" id="txtUserId" name='userid' class="form-control" placeholder="Email address or User ID" required autofocus value="<?php echo set_value('userid'); ?>"> <br/>
			<label for="inputPassword" class="">Password</label>
			<input type="password" id="txtPwd" name='pwd' class="form-control" placeholder="Password" required>
			<div class="checkbox">
			  <label>
				<input type="checkbox" value="remember-me"> Remember me
			  </label>
			</div>
			<button class="btn btn-lg btn-primary pull pull-right" type="submit">Sign in</button>
		<?php echo form_close(); ?>
		</div>
		<div class="col-sm-3"></div>
	</div>
	<?php if($this->session->has_userdata('error')) { echo $this->session->unset_userdata('error'); } ?>
</div>
