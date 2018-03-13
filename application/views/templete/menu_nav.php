<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#about">All Menus</a></li>
		<?php foreach ($meal_times as $meal_time_item): ?>
			<li><a href="#contact"><?php echo $meal_time_item['Name']; ?></a></li>
		<?php endforeach; ?>
      </ul>
	  <ul class="nav navbar-nav navbar-right">
		  <li>
			<?php if(!$this->session->has_userdata('user_id')) { ?>
			<a href="<?php echo base_url(); ?>user_access/registration"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
			<?php } else { ?>
			<a href="<?php echo base_url(); ?>user_access/access_account"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('user_name'); ?></a>
			<?php } ?>		  
		  </li>
		  <li>
			<?php if(!$this->session->has_userdata('user_id')) { ?>
			<a href="<?php echo base_url(); ?>user_access/signin_page"><span class="glyphicon glyphicon-user"></span> Sign In</a>
			<?php } else { ?>
			<a href="<?php echo base_url(); ?>user_access/signout"><span class="glyphicon glyphicon-user"></span> Sign Out</a>
			<?php } ?>		  
		  </li>
	  </ul>
    </div>
  </div>
</nav>