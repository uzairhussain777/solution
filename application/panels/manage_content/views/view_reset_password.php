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

                    <h2 class="font-bold">Reset password</h2>
                    <div class="row">

                        <div class="col-lg-12">
                            <form method="post"  name="reset_form" id="reset_form" action="<?php echo  site_url('manage_content/check_reset_password');?>" class="m-t">
                                <div class="form-group">
                                    <input class="form-control" type="password" name="recover_pass" id="recover_pass" maxlength="20" value=""  placeholder="Enter Password" />
                                	
                                </div>
                                <div class="form-group">
                                	<input class="form-control" type="password" name="conf_recover_pass" id="conf_recover_pass" maxlength="20" placeholder="Enter Confirm Password" />
                                </div>
                                <button type="submit" class="btn btn-primary block full-width m-b">Confirm Password</button>
								
								<input type="hidden" name="forgot_token" value="<?php echo htmlspecialchars($forgot_token);?>" />
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

    $.validator.addMethod("EqualPassword", function(value, element) {
			if(value != $("#recover_pass").val()){
		   		return false;
		   	}else{
		   		return true;
		   		
		   	}
	});

         $("#reset_form").validate({
            rules: {
					  	recover_pass: {required:true},
					  	conf_recover_pass: {required:true,
					  				  EqualPassword:true},
					  	
					},

					  	messages: {
					               conf_recover_pass: {
					                	required:"Confirm Password Required",
					                	EqualPassword:"Confirm password is not matched"},
					               recover_pass:
	                                        {
	                                        required:"Password Required"},
					                    	},
					       
					           tooltip_options:
					                       {
					                recover_pass: {placement:'top',html:true},
									conf_recover_pass: {placement:'top',html:true},
						
								   }
					});
</script>