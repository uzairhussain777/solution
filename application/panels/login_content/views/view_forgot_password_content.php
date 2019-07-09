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
             <h1 >Forgot Password?</h1>
              
			  <div class="message_wrapper">
             <?php //include('includes/display_msg.php'); ?>
             </div>
              <form method="post" name="forgot_password_form" id="forgot_password_form" action="<?php echo $this->config->base_url();?>login_content/forgot_validate" autocomplete="off">
				
                <p>
                	<span class="fa fa-envelope"></span><input type="text" name="email" value="<?php echo set_value('email'); ?>"  placeholder="Email Address"/>
                </p>
				<p class="login-submit-block">
                  <input type="hidden"  name="csrf_name" value="<?php echo htmlspecialchars($unique_form_name);?>"/>
   				  <input type="hidden"  name="csrf_token" value="<?php echo htmlspecialchars($token);?>"/>	
				  <input type="submit" name="usersLogin" value="Send Instruction" class="prime-button"/>
				</p>
				<p class="login-footrllinks-block">
                	<a href="<?php echo site_url('login'); ?>">Remember password? Login</a> 					<br />
                    <a href="<?php echo site_url('register'); ?>">New user? Register</a>
                </p>
			  </form>
        </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $.validator.addMethod("Email", function(value, element) {
                return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
            }, "Email Address is invalid: Please enter a valid email address.");

         $("#forgot_password_form").validate({
            rules: {
					  	email: {required:true,
					  	Email:true},
					    },

					  	messages: {
					                email:
                                        {
                                        required:"Email Required",
					                	Email:"Email is not valid"},
					            	},
					       
					           tooltip_options:
					                       {
					                email: {placement:'top',html:true},
					               }
					});
</script>       
