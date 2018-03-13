<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">Nahee Restaurant</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
	  <li><a href="#"><span class="glyphicon glyphicon-king"></span><?php echo $this->session->userdata('user_role'); ?></a></li>
      <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo $this->session->userdata('user_name'); ?></a></li>
      <li><a href="<?php echo base_url() ?>employee_access/signout"><span class="glyphicon glyphicon-log-in"></span> Sign Out</a></li>
    </ul>
  </div>
</nav>