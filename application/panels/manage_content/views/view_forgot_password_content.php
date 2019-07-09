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

	<div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">
                <!-- <div class="ibox-content"> -->

                    <h2 class="font-bold">Forgot password</h2>

                    <p>
                        Enter your email address and your password will be reset and emailed to you.
                    </p>

                    <div class="row">

                        <div class="col-lg-12">
                            <form method="post" name="forgot_password_form" id="forgot_password_form" class="m-t" action="<?php echo site_url('manage_content/forgot_validate');?>">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email address" name="forgot_email" id="email">
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">Send Password Reset Link</button>
								<input type="hidden" name="csrf_name" value="<?php echo htmlspecialchars($unique_form_name);?>"/>
    							<input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token);?>"/>
                            </form>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <!-- <hr> -->
        <div class="row">
            <div class="col-md-6">
                school
            </div>
            <div class="col-md-6 text-right">
               <small>© 2017</small>
            </div>
        </div>
    </div>


<script type="text/javascript">

    $.validator.addMethod("Email", function(value, element) {
                return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
            }, "Email Address is invalid: Please enter a valid email address.");

         $("#forgot_password_form").validate({
            rules: {
				  	forgot_email: {required:true,
				  	Email:true},
				    },

				  	messages: {
				                forgot_email:
                                    {
                                    required:"Email Required",
				                	Email:"Email is not valid"},
				            	},
				       
				           tooltip_options:
				                       {
				                forgot_email: {placement:'top',html:true},
				               }
					});
</script>       
