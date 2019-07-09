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

		 </header>
	<section class="sub-page-container">
		<div class="profile">
			<div class="content">
				<h2>My Profile </h2>
				<p>In at convallis sapien etiam ut ipsum magna ivamus vitae dolor eu dui porta faucibus. In at convallis sapien etiam ut ipsum magna ivamus vitae dolor eu dui porta faucibus. In at convallis sapien etiam ut ipsum magna ivamus vitae dolor eu dui porta faucibus. Quisque eget felis tempus metus luctus porta.  Maecenas sit amet felis est. </p>
				<form id="edit_user_form" action="<?php echo $this->config->base_url(); ?>users_content/editprofile" method="post">
				<div class="field-wrapper">
					<input type="text" name="first_name" placeholder="First name" class="first-name" id="first_name" value="<?php echo $users->first_name ?>">
				    <input type="text" name="last_name" placeholder="Last name" class="last-name"id="last_name" value="<?php echo $users->last_name ?>">
				</div>
				<div class="field-wrapper">
				    <input type="text" name="country" id="country" placeholder="Enter Country" class="profile-email" value="<?php echo $users->country ?>">
				    <input type="text" name="city" placeholder="Enter City" class="profile-address" id="city" value="<?php echo $users->city ?>">
				</div>
				<div class="field-wrapper">
				    <input type="text" name="state" id="state" placeholder="Enter State" class="phone" value="<?php echo $users->state ?>">
				    <input type="text" name="zipcode" id="zipcode" placeholder="Enter Zip Code" class="mobile" value="<?php echo $users->zipcode ?>">
				</div>
				<div class="field-wrapper">
				    <input type="password" name="password" placeholder="New password" class="profile-password" id="password">
				    <input type="password" name="re_password" id="re_password" placeholder="Re-enter new password" class="profile-re-password">
				</div>
				<div class="btn-wrapper">
				    <input class="save" type="submit" value="Save Profile" />
				</div>
				</form>
			

			</div>	<!-- /end content -->
		</div>	<!-- /end projects-detail -->
			
        
	</section>
	
<script type="text/javascript">
	
	$.validator.addMethod("notEqual", function(value, element, param) {
			return this.optional(element) || value != param;
		});
		
	  $.validator.addMethod("email", function(value, element) {
					return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
				}, "Invalid Email Address.");
				
		$.validator.addMethod("EqualPasswords", function(value, element) {
		if($("#password").val() != $("#re_password").val()){		
	   		return false;	
	   	}else{		   	
   			return true;	
		}	
	});
    
	    $("#edit_user_form").validate({
	        rules: {
		   first_name: {required: true},
		   last_name: {required: true},
		   city: {required: true},
		   country: {required: true},
		   state: {required: true},
		   zipcode: {required: true},
		   password: {minlength:8},
			re_password: {
				minlength:8,
				EqualPasswords:true
			}

			        	
			  },
		  messages: {
		  	        		
		  			    first_name:{required: "First Name Required"},
		                last_name:{required: "Last Name Required"},
		                city:{required: "City Required"},
		                country:{required: "Country Required"},
		                state:{required: "State Required"},
		               	zipcode:{required: "Zip Code Required"},
		                password:{minlength:"Minimum length is 8 characters"},
		                  re_password:{
		                  	minlength:"Minimum length is 8 characters",
		                  	EqualPasswords:"Passwords are not matched"
		                  }
        },
		            
		            
		            tooltip_options: {
 						password: {placement:'top',html:true},
 						re_password: {placement:'top',html:true},
 						
 						first_name: {placement:'top',html:true},
		                last_name: {placement:'top',html:true},
 						city: {placement:'top',html:true},
 						country: {placement:'top',html:true},
		                state: {placement:'top',html:true},
 						zipcode: {placement:'top',html:true}
		               
		            },
		});
		
	    
    
	
</script>
	