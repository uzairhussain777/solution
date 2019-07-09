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
				<img src="<?php echo $this->config->base_url(); ?>r/images/cat-main-heading-logo.png" alt="">
				<h1>Categories</h1>
				<!-- <h4>Suspendisse commodo hendrerit dapibus nulla rhoncus bibendum pellentesque morbi facilisis urna arcu nunc vel fermentum massaras ullamcorper ex elit, id consequat mi auctor tempus.</h4> -->
			</div>
	</section>

	</header>
	<section class="sub-page-container">
		<div class="sub-page-about-us">
			<div class="content">
				<h2>In at convallis sapien<br> Etiam ut ipsum magna <span>ivamus vitae dolor</span> eu dui porta faucibus. Quisque eget felis tempus metus luctus porta.<br><span> Maecenas sit amet felis est.</span> <br>Aliquam a vulputate ligula, non rhoncus mi.</h2>

				<p>In at convallis sapien etiam ut ipsum magna ivamus vitae dolor eu dui porta faucibus.  Quisque eget felis tempus metus luctus porta.  Maecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.In at convallis sapien etiam ut ipsum magna ivamus vitae dolor eu dui porta faucibus.  Quisque eget felis tempus metus luctus porta.  Maecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.In at convallis sapien etiam ut ipsum magna ivamus vitae dolor eu dui porta faucibus.  Quisque eget felis tempus metus luctus porta.  Maecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.In at convallis sapien etiam ut ipsum magna ivamus vitae dolor eu dui porta faucibus.  Quisque eget felis tempus metus luctus porta.  Maecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi.</p>
			</div>  <!-- /end content -->
		</div>	<!-- /end sub page about-us -->
		<div class="our-project">
			<div class="content">
				<h2>Ongoing Projects</h2>
				<?php foreach($categories as $key){?>
                <div class="project">
                	<div class="img-box">
                		<?php if(isset($key->resource_name) && $key->resource_name!="" && $key->resource_type!='video/mp4') {?>
                    	<img src="<?php echo $this->config->base_url(); ?>uploads/categories/image/<?php echo $key->resource_name; ?>" alt="">
	                    <?php } else{ ?>
	                    	<img src="<?php echo $this->config->base_url(); ?>uploads/noImage.jpg" alt="">
	                	<?php }?>
                	</div>
                    <div class="project-content">
                        <h3><?php echo $key->category_name ?></h3>
                        <p><?php echo $key->category_short_description?></p>
                      <!--  <div class="proj-pledged"> No. of stories: <strong><?php echo $key->storycount; ?></strong></div>
                       -->
                        <a class="link" href="<?php echo $this->config->base_url(); ?>categories/<?php echo $key->slug?>">View Category</a>
                    </div><!-- /end project-content -->
                </div>	<!-- /end project -->
            <?php } ?>
            
            <?php 
            if(empty($categories)){
            ?>
            	<h2><small> No Category Found</small></h2>
			
            <?php	
            }
            ?>
			
			</div>	<!-- /end content -->
		</div>	<!-- /end our project -->
        
     	</section>
