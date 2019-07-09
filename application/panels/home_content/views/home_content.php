<?php if (isset($success_message) && $success_message!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $success_message;?>', {
	         type: 'success',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
<?php } ?>

<?php if (isset($email_not_found) && $email_not_found!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $email_not_found;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
<?php } ?>


<?php if (isset($Temp_user) && $Temp_user!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $Temp_user;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
<?php } ?>


<?php if (isset($signup_error) && $signup_error!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $signup_error;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
<?php } ?>


<?php if (isset($invalid_email_pass) && $invalid_email_pass!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $invalid_email_pass;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>

<?php } ?>
<?php
	if (isset($error_message) && $error_message!="" ){ ?>
		<?php if(!isset($user_add_data['error_message'])){
		?>
<script>
	
	       setTimeout(function() {
	            $.bootstrapGrowl('<?php echo $error_message;?>', {
	                type: 'danger',
	                align: 'center',
	                width: 'auto',
	                allow_dismiss: false
	            });
	        }, 1);
</script>
	   <?php
		
		}
		$error_message =  strip_tags($user_add_data['error_message']);
	    $error_message = str_replace(array("\r", "\n"), '', $error_message);
		$error_message= explode('.',$error_message);
	 	for($i=0; $i<count($error_message)-1; $i++){
  			$error = $error_message[$i];
        	if (isset($error)){ ?>
	        	
        		<script>
	       setTimeout(function() {
	            $.bootstrapGrowl("<?php echo $error;?>", {
	                type: 'danger',
	                align: 'center',
	                width: 'auto',
	                allow_dismiss: false
	            });
	        }, 1);
	    </script>
        		
        		
        	<?php }	}
		 } ?>
<?php if ($this->session->flashdata('flash_msg')) { ?>
  <script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo  $this->session->flashdata('flash_msg'); ;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
    <?php } ?>

<?php if ($this->session->flashdata('category_msg')) { ?>
  <script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo  $this->session->flashdata('category_msg'); ;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
    <?php } ?>

		 	<section class="banner">
		 
			<div class="content">
				<img src="<?php echo $this->config->base_url(); ?>r/images/main-heading-logo.png" alt="">
				<h1>Twelve for Twelve</h1>
				<h4>Suspendisse commodo hendrerit dapibus nulla rhoncus bibendum pellentesque morbi facilisis urna arcu nunc vel fermentum massaras ullamcorper ex elit, id consequat mi auctor tempus.</h4>
			</div>
	</section>
	
	

	</header>
	<section class="how-it-works">
		<div class="content">
			<h2>How it Works</h2>
			<p>In at convallis sapien. Etiam ut ipsum magna. Vivamus vitae dolor eu dui porta faucibus. Quisque eget felis tempus metus luctus porta. Maecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.</p>
			<div class="col-work">
				<img src="<?php echo $this->config->base_url(); ?>r/images/work-image-01.png" alt="">
				<h3>Meet with people</h3>
					<p>
						In at convallis sapien. Etiam ut ipsum magna. Vivamus vitae dolor eu dui porta faucibus. Qui sque eget felis tempus metus luctus porta. Ma ecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.</p>
			</div>	<!-- /end col-work -->

			<div class="col-work">
				<img src="<?php echo $this->config->base_url(); ?>r/images/work-image-02.png" alt="">
				
				<h3>Fund their happiness</h3>
					<p>
						In at convallis sapien. Etiam ut ipsum magna. Vivamus vitae dolor eu dui porta faucibus. Qui sque eget felis tempus metus luctus porta. Ma ecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.</p>
			</div>	<!-- /end col-work -->

			<div class="col-work">
				<img src="<?php echo $this->config->base_url(); ?>r/images/work-image-03.png" alt="">
				<h3>Get results</h3>
					<p>
						In at convallis sapien. Etiam ut ipsum magna. Vivamus vitae dolor eu dui porta faucibus. Qui sque eget felis tempus metus luctus porta. Ma ecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.</p>
			</div>	<!-- /end col-work -->
			

		</div>	<!-- /end content -->
	</section>


	<section class="about-us">
			<div class="content">
				<h2>About Us</h2>

				<div class="about-us-image">
					<img src="<?php echo $this->config->base_url(); ?>r/images/about-us-image.png" alt="">
				</div>   <!-- /end about-us image -->
				<div class="about-us-text">
					<p><strong>Suspendisse commodo</strong> hendrerit dapibus. Nulla rhoncus bibendum pellentesque. Morbi facilisis urna arcu. Nunc vel fermentum massa. Cras ullamcorper ex elit, id consequat mi auctor tempus. In at convallis sapien. Etiam ut ipsum magna. Vivamus vitae dolor eu dui porta faucibus. Quisque eget felis tempus metus luctus porta. </p>
					<p>Maecenas sit amet felis est aliquam a vulputate ligula, non rhoncus mi ivamus vitae odio risus. 
					Mauris sed sapien lacus ed sit amet purus in eros consectetur fringilla non nec justo. Curabitur eu ligula velit ivamus vitae dolor eu dui porta faucibus.</p>
					 <p>Quisque eget felis tempus metus luctus porta aecenas sit amet felis est. liquam a vulputate ligula, non rhoncus mi vivamus vitae odio risus. Alquam a vulputate ligula, non rhoncus mi vivamus vitae odio risus.  Quisque eget felis tempus metus luctus porta aecenas sit amet felis est. </p>
					<p>Liquam a vulputate ligula, non rhoncus mi vivamus vitae odio risus. Alquam a vulputate ligula, non rhoncus mi vivamus vitae odio risus. </p>
				</div>  <!-- /end about-us text -->
				
				
			</div>	<!-- /end content -->
		</section>
		



