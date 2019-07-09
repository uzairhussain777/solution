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

    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>

</header>
	<section class="sub-page-container">
		<div class="contact-us">
			<div class="content">
				<h2 class="page-title">Contact Us</h2>
				<div class="contact-form">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima, quae corporis non commodi!</p>
					<form action="<?php echo $this->config->base_url();?>/contactus_content/addmessage" id="contactus_form" method="post">
						<div class="field-wrapper">
							<input type="text" name="username" id="username" placeholder="Your name" class="usr-name">
						</div>
						<div class="field-wrapper">
							<input type="text" name="useremail" id="useremail" placeholder="Your email" class="usr-email">
						</div>
						<div class="field-wrapper">
							<input type="text" name="userphone" id="userphone" placeholder="Your contact number" class="usr-phone">
						</div>
						<div class="field-wrapper">
							<textarea rows="4" cols="50" placeholder="Your message" id="message" name="message"></textarea>
						</div>
						<div class="field-wrapper btn-wrapper">
						    <!-- <button class="save btn btn-submit-form" type="submit" value="Send Message" /> -->
						    <button class="btn btn-submit-form">Send Message</button>
						</div>
					</form>
				</div>	<!-- /end contact-form -->
				<div class="contact-detail">
					<h3>Contact Address</h3>
					<div class="detail-row">
						<img src="<?php echo $this->config->base_url();?>r/images/location-icon.png" alt="">
						<h4>Unit 6 / 12 Lyn Parade Preston NSW 2170</h4>
					</div>
					<div class="detail-row">
						<img src="<?php echo $this->config->base_url();?>r/images/phone-icon.png" alt="">
						<h4>123 456 789</h4>
					</div>
					<div class="detail-row">
						<img src="<?php echo $this->config->base_url();?>r/images/email-icon.png" alt="">
						<h4>support@solution_new.com</h4>
					</div>
					<div class="detail-row">
						<img src="<?php echo $this->config->base_url();?>r/images/skype-icon.png" alt="">
						<h4>solution_new_live</h4>
					</div>
					<div class="company-location-map">
					   <div id="map"></div>
 					</div>
				</div>	<!-- /end contact-detail -->
			

			</div>	<!-- /end content -->
		</div>	<!-- /end projects-detail -->
			
        
	</section>

<script type="text/javascript">

	  $.validator.addMethod("Email", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	        }, "Invalid Email Address.");
	    $("#contactus_form").validate({
	        rules: {
		        username: {required: true},
           		    useremail: {required: true,
           		    				Email:true},
                userphone: {required: true},
                message: {required: true},
           
		  },
		  messages: {
		                
		                username:{required: "Name Required"},
                        useremail:{required: "Email Required",
                       				 Email:"Email is not Valid"},
                        userphone:{required: "Phone number Required"},
                        message:{required: "Message Required"},
                       
		            },
		            tooltip_options: {
		       
		            }
		});
	  
	  
      function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDS8HQ7S0RfDx6zHQeWzkO2cxfwjGKkkGc&callback=initMap">
    </script>
