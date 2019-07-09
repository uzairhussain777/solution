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


<!-- <div id="page-wrapper" class="gray-bg"> -->

			<div class="wrapper wrapper-content animated fadeInRight">
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit User</h5>
                          
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo $this->config->base_url();?>users_content/edituser" class="form-horizontal" id="edit_user_form" name="edit_user_form" >
                                <input type="hidden" name="user_id" value="<?php echo $result->user_id; ?>" />
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">First Name*</label>
                                    <div class="col-sm-4"><input type="text" placeholder="Enter First Name" class="form-control"  name="edit_firstname" id="edit_firstname" value="<?php echo $result->first_name; ?>"></div>
                               <label class="col-sm-2 control-label">Last Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Last Name" class="form-control"  name="edit_lastname" id="edit_lastname" value="<?php echo $result->last_name; ?>"></div>

                                </div>
                                
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-4"><input type="password" class="form-control" name="edit_password" placeholder="Enter Password" ></div>
                                <label class="col-sm-2 control-label">Country*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Country" class="form-control"  name="edit_country" id="edit_country" value="<?php echo $result->country; ?>"></div>

                                </div>
                                
                                <div class="form-group">
                                <label class="col-sm-2 control-label">City*</label>

                                <div class="col-sm-4"><input type="text" placeholder="Enter City" class="form-control"  name="edit_city" id="edit_city" value="<?php echo $result->city; ?>"></div>
                                <label class="col-sm-2 control-label">State*</label>

                                <div class="col-sm-4"><input type="text" placeholder="Enter State" class="form-control"  name="edit_state" id="edit_state" value="<?php echo $result->state; ?>"></div>

                                </div>
                                
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Zip Code*</label>

                                <div class="col-sm-4"><input type="text" placeholder="Enter Zip Code" class="form-control"  name="edit_zipcode" id="edit_zipcode" value="<?php echo $result->zipcode; ?>"></div>
                                </div>
                                     	<div class="hr-line-dashed"></div>
                        
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                	     <a href="<?php echo $this->config->base_url();?>user/view" class="btn btn-white" type="submit">Cancel</a>
                                      
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- </div> -->
        
<script type="text/javascript">
	$.validator.addMethod("notEqual", function(value, element, param) {
	    return this.optional(element) || value != param;
	});
	
	
	  $.validator.addMethod("email", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	        }, "Invalid Email Address.");
	    $("#edit_user_form").validate({
	        rules: {
		   edit_firstname: {required: true},
		   edit_lastname: {required: true},
		   edit_city: {required: true},
		   edit_state: {required: true},
		   edit_zipcode: {required: true},
		   edit_country: {required: true},
		   edit_systemtype:{required: true}
		  },
		  messages: {
		                edit_firstname:{required: "First Name Required"},
		                edit_lastname:{required: "Last Name Required"},
		                edit_city:{required: "City Required"},
		                edit_state:{required: "State Required"},
		                edit_zipcode:{required: "Zip Code Required"},
		                edit_country:{required: "Country Required"},
		            },
		            tooltip_options: {

		            }
		});
	
</script>