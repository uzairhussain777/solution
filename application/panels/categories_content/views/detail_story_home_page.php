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

<?php if (isset($card_error) && $card_error!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl("<?php echo $card_error;?>", {
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
		 
<?php
	if (isset($donation_error) && $donation_error!="" ){?>
		<?php if(!isset($user_add_data['donation_error'])){
		?>
<script>
	
	       setTimeout(function() {
	            $.bootstrapGrowl('<?php echo $donation_error;?>', {
	                type: 'danger',
	                align: 'center',
	                width: 'auto',
	                allow_dismiss: false
	            });
	        }, 1);
</script>
	   <?php
		
		}
		$donation_error =  strip_tags($user_add_data['donation_error']);
	    $donation_error = str_replace(array("\r", "\n"), '', $donation_error);
		$donation_error= explode('.',$donation_error);
	 	for($i=0; $i<count($donation_error)-1; $i++){
  			$error = $donation_error[$i];
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
        <img src="<?php  echo $this->config->base_url() ?>r/images/main-heading-logo.png" alt="">
        <h1>solution_new</h1>
        <h4>Suspendisse commodo hendrerit dapibus nulla rhoncus bibendum pellentesque morbi facilisis urna arcu nunc vel fermentum massaras ullamcorper ex elit, id consequat mi auctor tempus.</h4>
    </div>
</section>

</header>
<section class="sub-page-container">
    <div class="projects-detail">
        <div class="content">
            <h2><?php echo $result->story_name?> </h2>

            <div class="post">
                <ul>

                    <li>Posted in:<a href="<?php echo $this->config->base_url(); ?>categories/<?php echo $this->uri->segment(2)?>"><?php echo $result->category_name?></a></li>
                    <li>Posted by: <a><?php echo $result->nameofcreator?></a></li>

                </ul>
            </div>
            <div class="proj-content">
                <div class="proj-image-slider">
                    <ul class="bxslider">
                        <?php
                        if(!empty($result->resources)){
                        foreach ($result->resources as $key){
                            if(isset($key->resource_name) && $key->resource_name!="" && $key->resource_type!='video/mp4') {
                                ?>
                                <li><div class="slider-img-box"><img src="<?php echo resource_path ?>/stories/images/<?php echo $key->resource_name ?>" alt=""></div></li>
                                <?php
                                }else{ ?>
                                <li><div class="slider-img-box"><img src="<?php echo resource_path ?>/noImage.jpg" alt=""></div></li>
                           <?php }
                            }
                        }else{?>
                            <li><div class="slider-img-box"><img src="<?php echo resource_path ?>/noImage.jpg" alt=""></div></li>
                        <?php }?>
                    </ul>
                </div>	<!-- /end project-image -->
                <div class="proj-text">
                    <p><?php echo $result->story_description?></p>
                </div><!-- /end projects-text -->
                <?php
                if(!empty($result->resources)) {
                    foreach ($result->resources as $key) {
                        if ($key->resource_type == "video/mp4") { ?>
                            <div class="proj-image-video">
                                <video poster="" controls style="width: 100% !important;height: auto !important;">
                                    <source src="<?php echo resource_path ?>/stories/videos/<?php echo $key->resource_name ?>"
                                            type="video/mp4">
                                </video>
                            </div>    <!-- /end project-image -->
                            <?php
                        }
                    }
                }else{?>
                    <img src="<?php resource_path ?>/noVideo.jpg" alt="">
                <?php }?>
            </div>	<!-- /end project-content -->

            <div class="side-bar">
                <div class="donar-search">
                	
                    <p><span>Goal Amount:</span> <?php echo "$".$result->fundraising_target;?></p>
                    <?php if($result->remaning_amount_to_fund!=0){?>
                    <div class="search">
                        <form id="storydonation">
                            <input type="hidden" name="storyid" id="storyid" value="<?php echo $result->story_id;?>">
                            <input type="hidden" name="remaningamount" id="remaningamount" value="<?php echo $result->remaning_amount_to_fund;?>">
                            <strong class="currency-symbol">$</strong>
                            <input type="text" class="text-field" name="donation_amount" id="donation_amount" value="<?php echo $result->remaning_amount_to_fund?>">

                            <input type="submit" class="donate-btn" value="Donate">
                        </form>

                    </div>
                    <?php }?>
                    <div class="progress-bar-container">
							<div class="progress-bar position" data-percent="<?php echo $result->donation_percentage; ?>" data-duration="1000" data-color="#fff, #3877ba"></div>
					</div>
				
                </div>	<!-- /end donar-search -->
                <?php if(!empty($result->donators)){?>
                <div class="donar-list">
                    <h6>Donar List</h6>
                    <div class="rcat">
                        <ul class="lev1">
                             <?php foreach ($result->donators as $key){?>
                            <li><span><?php echo $key->first_name." ".$key->last_name; ?> </span></li>
                                <?php    }?>
                        </ul>
                    </div>
                </div>
               <?php } ?>	<!-- /end donar-list -->
            </div>	<!-- /end side-bar -->

        </div>	<!-- /end content -->
    </div>	<!-- /end projects-detail -->


</section>
<script>

    $(document).ready(function(){
        $('.bxslider').bxSlider();
    });

</script>
<script>
	$(".progress-bar").loading();
	$('input').on('click', function () {
		 $(".progress-bar").loading();
	});
</script>