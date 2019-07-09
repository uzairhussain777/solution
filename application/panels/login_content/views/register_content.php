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
				<i class="fa fa-user"></i>
            </div>
             <h1>Register</h1>
             <div class="message_wrapper">
             <?php //include('includes/display_msg.php'); ?>
             </div> 
              <form method="post" id="signup_form" action="<?php echo $this->config->base_url();?>login_content/register_submit" autocomplete="off">
				<p class="width49 fl">
                	<input type="text" name="firstname" value="<?php  if(isset($user_add_data['firstname'])){ echo $user_add_data['firstname'];}?>"   placeholder="First Name"/>
                </p>
				<p class="width49 fr">
				  <input type="text" name="lastname" value="<?php  if(isset($user_add_data['lastname'])){ echo $user_add_data['lastname'];}?>"   placeholder="Last Name"/>
                </p>
                <p>
				  <input type="text" name="email" value="<?php  if(isset($user_add_data['email'])){ echo $user_add_data['email'];}?>"   placeholder="Email Address"/>
                </p>
                <p>
				  <input type="password" name="pwd" id="pwd" placeholder="Password" value="<?php  if(isset($user_add_data['pwd'])){ echo $user_add_data['pwd'];}?>">
                </p>
                <p>
				  <input type="password" name="cnfpwd" name="cnfpwd" placeholder="Confirm Password" value="<?php  if(isset($user_add_data['cnfpwd'])){ echo $user_add_data['cnfpwd'];}?>" >
                </p>
	  			<p class="login-submit-block">
                  <input type="hidden" name="csrf_name" value="<?php echo htmlspecialchars($unique_form_name);?>"/>
   				  <input type="hidden"  name="csrf_token" value="<?php echo htmlspecialchars($token);?>"/>
				  <input type="submit" name="usersLogin" value="Register" class="prime-button"/>
				</p>
				<p class="login-footrllinks-block">
                <a href="<?php echo site_url('login'); ?>">Already have account? Login</a><br />
              <!--   <a href="<?php echo site_url('login/forgot'); ?>">forgot password?</a> 					
               -->  </p>
			  </form>
        </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $.validator.addMethod("EqualPassword", function(value, element) {
			if(value != $("#pwd").val()){
		   		return false;
		   	}else{
		   		return true;
		   		
		   	}
	});
	 $.validator.addMethod("Email", function(value, element) {
                return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
            }, "Email Address is invalid: Please enter a valid email address.");
jQuery.validator.addMethod("alpha", function(value, element) {
      	  return this.optional(element) || /^[a-zA-Z]+$/.test(value);
		});
         $("#signup_form").validate({
            rules: {
            		firstname: 
					  		{	required:true,
					  			alpha:true},
					lastname:
							{	required:true,
					  			alpha:true},
					  	pwd: {required:true},
					  	cnfpwd: {required:true,
					  				  EqualPassword:true},
	  				  	email: {required:true,
							  	Email:true},
					  	
					},

					  	messages: {
					  				firstname: {
					                	required:"First Name Required",
					                	alpha:"First Name should be alphabetical"},
					                 lastname: {
					                	required:"Last Name Required",
					                	alpha:"Last Name should be alphabetical"},
					               pwd:
	                                        {
	                                        required:"Password Required"},
					                    	
					           		cnfpwd: {
					                	required:"Confirm Password Required",
					                	EqualPassword:"Confirm password are not equal"},
					                email:
                                        {
                                        required:"Email Required",
					                	Email:"Email is not valid"},
					                },
					           
					           tooltip_options:
					                       {
					                       	firstname:{placement:'top',html:true},
							            	lastname: {placement:'top',html:true},
							               	pwd: {placement:'top',html:true},
											cnfpwd: {placement:'top',html:true},
											email: {placement:'top',html:true},
						
								   }
					});
</script>
       
