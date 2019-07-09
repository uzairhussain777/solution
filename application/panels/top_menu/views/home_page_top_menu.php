<div class="content">
	<div class="logo"><a href="<?php echo $this->config->base_url(); ?>"><img src="<?php echo $this->config->base_url(); ?>r/images/logo.png" alt=""></a></div>
	<span onclick="openNav()"><img src="<?php echo $this->config->base_url(); ?>r/images/burger_menu.png"></span>
	<nav id="mySidenav" class="sidenav">
		<div class="closebtn" onclick="closeNav()">&times;</div>
		<a href="<?php echo $this->config->base_url(); ?>home">Home</a>
		<a href="<?php echo $this->config->base_url(); ?>categories"> Categories</a>
		<a href="<?php echo $this->config->base_url(); ?>pages?content=about-us"> About us</a>
		<a href="<?php echo $this->config->base_url(); ?>contactus"> Contact us</a>
						
		<?php if($this->session->userdata('is_logged_in')==0) {?>
		<a href="#" id="login-responsive" onclick="showloginmodal()">Login</a>
		<a href="#" id="signup-responsive" onclick="showsignupmodal()">Signup</a>
		<?php }else{?>
		<a href="#">My Account</a>
		
		<a class="acc-sub-menu myprofile-bg" href="<?php echo $this->config->base_url(); ?>user/profile" id="login-responsive">My Profile</a>
			
		<?php
			$check=$this->session->userdata('user_type');				
					
			if($check!='registered_user'){ ?>
			<a class="acc-sub-menu dashboard-bg" href="<?php echo $this->config->base_url(); ?>dashboard/view" id="login-responsive">Dashboard</a>
			<?php  
			} 
			else {?>
		<a class="acc-sub-menu donation-bg" href="<?php echo $this->config->base_url(); ?>donation" id="login-responsive">Donation History</a>
		<?php	}	?>
		<a class="acc-sub-menu signout-bg" href="<?php echo $this->config->base_url(); ?>login_content/logout" id="login-responsive">Logout</a>
		
		<?php }?>
		<!--
			<a class="acc-sub-menu bg1" href="#">My Profile</a>
						  <a class="acc-sub-menu bg4" href="#">Donation History</a>
						  <a class="acc-sub-menu bg3" href="#">Signout</a>
						-->
	</nav>
	<nav  class="desktop-menu">
		<ul class="menu">
			<li><a href="<?php echo $this->config->base_url(); ?>home">Home</a></li>
			<li>  <a href="<?php echo $this->config->base_url(); ?>categories"> Categories</a></li>
			<li> <a href="<?php echo $this->config->base_url(); ?>pages?content=about-us"> About us</a>
			</li>
			<li> <a href="<?php echo $this->config->base_url(); ?>contactus"> Contact us</a>
			</li>
			<?php if($this->session->userdata('is_logged_in')==0) {?>
			<li><a href="#" id="login-desktop" onclick="showloginmodal()">Login</a>/<a href="#" id="signup-desktop" onclick="showsignupmodal()">Signup</a></li>
			<?php }else{	?>
			<li class="dropdown">
				<a href="#">My Account</a>
				<div class="sub-menu">
					<ul>
						<li class="myprofile-bg">	<a class="acc-sub-menu bg2" href="<?php echo $this->config->base_url(); ?>user/profile" id="login-responsive">My Profile</a></li>
						<?php
							$check=$this->session->userdata('user_type');				
									
							if($check!='registered_user'){ ?>
						<li class="dashboard-bg">	<a class="acc-sub-menu bg2" href="<?php echo $this->config->base_url(); ?>dashboard/view" id="login-responsive">Dashboard</a></li>
						<?php  } 
							else {?>
						<li class="donation-bg">	<a class="acc-sub-menu bg2" href="<?php echo $this->config->base_url(); ?>donation" id="login-responsive">Donation History</a></li>
						<?php	}	?>
						<!--
						<li class="signout-bg"> 	<a class="acc-sub-menu bg1" href="<?php echo $this->config->base_url(); ?>login_content/logout" id="login-responsive">Logout</a></li>
						
						
							<li><a href="#">My Profile</a></li>
							<li><a href="#">Donation History</a></li>
							<li><a href="#">Signout</a></li>
							-->
					</ul>
				</div>
			</li>
			<?php }?>
				
		</ul>
	</nav>
</div>
<!-- /end content -->