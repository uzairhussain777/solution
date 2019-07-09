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
		//$error_message =  strip_tags($user_add_data['error_message']);
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


<div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
          
            <form class="m-t" role="form" id="loginform" action="<?php echo $this->config->base_url();?>manage_content/login_validate" name="loginform" method="post">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email" >
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" >
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            
                 <input type="hidden" name="csrf_name" value="<?php echo htmlspecialchars($unique_form_name);?>"/>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token);?>"/>
  
            </form>
            <p class="m-t"> <small>cbms &copy; 2018</small> </p>
        </div>
    </div>
    
<script type="text/javascript">
	$.validator.addMethod("notEqual", function(value, element, param) {
	    return this.optional(element) || value != param;
	});
	
	
	  $.validator.addMethod("email", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	        }, "Invalid Email Address.");
	    $("#loginform").validate({
	        rules: {
		  	email: {required:true,
		  	Email:true},
		  	password: {required:true},
		  },
		  messages: {
		                 email:
	                             {
	                              required:"Email Required",
		                	Email:"email is not valid"},
		                password: {required: "Password Required"},
		            },
		            tooltip_options: {
		                email: {placement:'right',html:true},
		                password: {placement:'right',html:true}
		            }
		});
	
</script>