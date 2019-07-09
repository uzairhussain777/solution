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
				<img src="<?php echo $this->config->base_url();?>r/images/main-heading-logo.png" alt="">
				<h1><?php echo $category_name;?></h1>
				<!-- <h4>Suspendisse commodo hendrerit dapibus nulla rhoncus bibendum pellentesque morbi facilisis urna arcu nunc vel fermentum massaras ullamcorper ex elit, id consequat mi auctor tempus.</h4> -->
			</div>
	</section>

	</header>
	<section class="sub-page-container">
		<div class="sub-page-about-us">
			<div class="content">
				<h2>Category Description<br><small><?php echo $category_short_text; ?></small> <br></h2>

				<p><?php echo $category_long_text; ?></p>
			</div>  <!-- /end content -->
		</div>	<!-- /end sub page about-us -->
	
		<div class="our-project">
			<div class="content">
				<h2>Categories</h2>
		
			<?php if(!empty($stories)){ ?>
					<?php foreach($stories as $key){
				$name = "days-left-".$key->slug;
				?>
                <div class="project">
					<div class="img-box">
                        <img src="<?php if(isset($key->resource_name) && $key->resource_name!="" && $key->resource_type!='video/mp4'){
                            echo $this->config->base_url(); ?>uploads/stories/image/<?php echo $key->resource_name;
                            } else{ ?>
                            <?php echo resource_path; ?>/noImage.jpg
                        <?php } ?>" alt="">
                    </div>
					<div class="project-content">
						<a class="proj-category" href="<?php echo $this->config->base_url(); ?>categories"><?php echo $key->category_name; ?></a>
						<h3><a href="<?php echo $this->config->base_url(); ?>categories/<?php echo $category_slug; ?>/<?php echo $key->slug?>"><?php echo $key->story_name ?> </a></h3>
						<p><?php echo $key->story_short_description; ?></p>
						<!--
						<div class="proj-pledged"><strong>$<?php echo $key->fundraising_target?></strong> Target</div>
												<div class="proj-fund"><strong><?php echo $key->donationpercentage; ?></strong>% funded</div>
						
						
						<p class="date">
                            <?php $startDate = new DateTime($key->date_created);
                            $diff=$startDate->diff(new DateTime);
                            $days =  $diff->format('%d');
							if($days!='0'){
								echo $days." Days ago";
							}else{
								echo "Created Today";
							}
                            
                            ?>
                        </p>
                        -->
						<div class="line-progressbar-container" data-percent="50">
							<div id="<?php echo $name;?>"></div>
						</div>
						
						<script>
						$('#<?php echo $name;?>').LineProgressbar({
							radius: '0px',
							height: '12px',
							percentage: '<?php echo $key->donationpercentage;?>',
							fillBackgroundColor: '#1e6bb5'
						});
						</script>
						
                        <a class="link" href="<?php echo $this->config->base_url(); ?>categories/<?php echo $category_slug; ?>/<?php echo $key->slug?>">View Story Details</a>
					</div><!-- /end project-content -->
				</div>	<!-- /end project -->

            <?php } ?>
				<?php }else{?>
					<h2><small><?php echo "No Ongoing Stories"; ?></small></h2>
					<?php }?>
						
			</div>	<!-- /end content -->
		</div>	<!-- /end our project -->
      <!--  
       <div class="our-project">
			<div class="content">
				<h2>Completed Stories</h2>
			
				<?php if(!empty($completedstories)){ ?>
					<?php foreach($completedstories as $key){
				$name = "days-left-".$key->slug;
				?>
                <div class="project">
					<div class="img-box">
                        <img src="<?php if(isset($key->resource_name) && $key->resource_name!="" && $key->resource_type!='video/mp4'){
                           	  echo resource_path; ?>/stories/images/<?php echo $key->resource_name;
                            } else{ ?>
                            <?php   echo resource_path; ?>/noImage.jpg
                        <?php } ?>" alt="">
                    </div>
					<div class="project-content">
						<a class="proj-category" href="<?php echo $this->config->base_url(); ?>categories"><?php echo $key->category_name; ?></a>
						<h3><a href="<?php echo $this->config->base_url(); ?>categories/<?php echo $category_slug; ?>/<?php echo $key->slug?>"><?php echo $key->story_name ?> </a></h3>
						<p><?php echo $key->story_short_description; ?></p>
						<div class="proj-pledged"><strong>$<?php echo $key->fundraising_target?></strong> Target</div>
						<div class="proj-fund"><strong><?php echo $key->donationpercentage; ?></strong>% funded</div>

						<p class="date">
                            <?php $startDate = new DateTime($key->date_created);
                            $diff=$startDate->diff(new DateTime);
                            $days =  $diff->format('%d');
                            echo $days." Days ago";
                            ?>
                        </p>
						<div class="line-progressbar-container" data-percent="50">
							<div id="<?php echo $name;?>"></div>
						</div>
						
						<script>
						$('#<?php echo $name;?>').LineProgressbar({
							radius: '0px',
							height: '12px',
							percentage: '<?php echo $key->donationpercentage;?>',
							fillBackgroundColor: '#05af3c'
						});
						</script>
						
                        <a class="link" href="<?php echo $this->config->base_url(); ?>categories/<?php echo $category_slug; ?>/<?php echo $key->slug?>">View Story Details</a>
					</div><!-- /end project-content -->
			<!--	</div>	<!-- /end project -->
<!--
            <?php } ?>
				<?php }else{?>
					<h2><small><?php echo "No Completed Stories"; ?></small></h2>
					<?php }?>
						
			</div>	<!-- /end content -->
	<!--	</div>	<!-- /end our project -->
        
        
     	</section>
     	

