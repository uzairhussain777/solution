<?php
	if (isset($success_message) && $success_message!=""){ ?>
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

<?php
	if (isset($error_message) && $error_message!="" ){ 
		if(!isset($user_add_data['error_message'])){
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
		if(isset($user_add_data['error_message'])){
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
		 }} ?>


<div class="container">
	<div class="row">
    	<div class="col-xs-12">
    	<div class="login-form">
        	<div class="login-top">
				<i class="fa fa-unlock-alt"></i>
            </div>
             <h1>Reset Password</h1>
              
			  <div class="message_wrapper">
             <?php //include('includes/display_msg.php'); ?>
             </div>
              <form method="post" name="reset_form" id="reset_form" action="<?php echo $this->config->base_url();?>login_content/check_reset_password" autocomplete="off">
				<p>
				  <span class="fa fa-key"></span>
                  <input type="password" name="password" id="password" placeholder="New Password" autocomplete="off" >
                </p>
                <p>
				  <span class="fa fa-key"></span>
                  <input type="password" name="cnfpassword" id="cnfpassword" placeholder="Confirm Password" autocomplete="off">
                </p>
				<p class="login-submit-block">
                  <input type="hidden"  name="csrf_name" value="<?php echo htmlspecialchars($unique_form_name);?>"/>
   				  <input type="hidden"  name="csrf_token" value="<?php echo htmlspecialchars($token);?>"/>	
				  <input type="hidden" name="forgot_token" value="<?php echo htmlspecialchars($forgot_token);?>" />
				  <input type="submit" name="usersLogin" value="Reset Password" class="prime-button"/>
				</p>
				<p class="login-footrllinks-block">
                	<a href="<?php echo site_url('login/forgot'); ?>">Remember password? Login</a> 					<br />
                    <a href="<?php echo site_url('register'); ?>">New user? Register</a>
                </p>
			  </form>
        </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $.validator.addMethod("EqualPassword", function(value, element) {
			if(value != $("#password").val()){
		   		return false;
		   	}else{
		   		return true;
		   		
		   	}
	});

         $("#reset_form").validate({
            rules: {
					  	password: {required:true},
					  	cnfpassword: {required:true,
					  				  EqualPassword:true},
					  	
					},

					  	messages: {
					               cnfpassword: {
					                	required:"Confirm Password Required",
					                	EqualPassword:"Confirm password are not equal"},
					               password:
	                                        {
	                                        required:"Password Required"},
					                    	},
					       
					           tooltip_options:
					                       {
					               password: {placement:'top',html:true},
									cnfpassword: {placement:'top',html:true},
						
								   }
					});
</script>