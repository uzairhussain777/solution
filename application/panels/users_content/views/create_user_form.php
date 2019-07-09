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
                            <h5>Add new User</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo $this->config->base_url();?>users_content/create_user" class="form-horizontal" id="create_user_form" name="create_user_form" >
                               
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">First Name*</label>
                                    <div class="col-sm-4">
                                    	<input type="text" placeholder="Enter First Name" class="form-control"  name="firstname" id="firstname" value="<?php echo $user_add_data['firstname']?>">
                                    </div>
                                
                                	<label class="col-sm-2 control-label">Last Name*</label>

                                    <div class="col-sm-4">
                                    	<input type="text" placeholder="Enter last Name" class="form-control"  name="lastname" id="lastname" value="<?php echo $user_add_data['lastname']?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">User Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter User Name" class="form-control"  name="username" id="username" value="<?php echo $user_add_data['username']?>"></div>
                               <label class="col-sm-2 control-label">Email*</label>

                                <div class="col-sm-4"><input type="email" placeholder="Enter email" class="form-control"  name="email" id="email" value="<?php echo $user_add_data['email']?>"></div>

                                </div>
                               
                                
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Password*</label>

                                    <div class="col-sm-4">
                                   <input type="password" class="form-control" name="password" placeholder="Enter Password" > 
                                   </div>
                               <label class="col-sm-2 control-label">Country*</label>

                                    <div class="col-sm-4">
                                 <input type="text" placeholder="Enter Country" class="form-control"  name="country" id="country" value="<?php echo $user_add_data['country']?>">
                                    	
                                    </div>

                                </div>
                               
                             
                                                
                                <div class="form-group">
                                <label class="col-sm-2 control-label">State*</label>

                                <div class="col-sm-4"><input type="text" placeholder="Enter State" class="form-control"  name="state" id="state" value="<?php echo $user_add_data['state']?>"></div>
                                <label class="col-sm-2 control-label">Zip Code*</label>

                                <div class="col-sm-4"><input type="text" placeholder="Enter Zip Code" class="form-control"  name="zipcode" id="zipcode" value="<?php echo $user_add_data['zipcode']?>"></div>

                                </div>
                                
                                    <div class="form-group"><label class="col-sm-2 control-label">City*</label>

                                <div class="col-sm-4"><input type="text" placeholder="Enter City" class="form-control"  name="city" id="city" value="<?php echo $user_add_data['city']?>"></div>
                              <label class="col-sm-2 control-label">Select User Type</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="systemtype" id="systemtype">
                                        <option value="1">Super User</option>
                                        <option value="2">Admin</option>
                                    </select>
                                    </div>

                                </div>

                                     	<div class="hr-line-dashed"></div>
                        
                                
                                <div class="form-group" >
                                    <div class="col-sm-7 col-sm-offset-2 pull-right" >
                                        <a href="<?php echo $this->config->base_url();?>user/view" class="btn btn-white" type="submit">Cancel</a>
                                        <button class="btn btn-primary" type="submit">Create</button>
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
	  $.validator.addMethod("Email", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	        }, "Invalid Email Address.");
	  
	  $.validator.addMethod("MinLengthlogin", function(value, element) {	  
		if(value.length < 8){	   		
		 	return false;	  
		}else{	   	
		 return true;	   
		}
	});
	
	    $("#create_user_form").validate({
	        rules: {
		  	email: {required:true,
		  	Email:true},
		  	// password: "required"
		   username: {required: true},
		   firstname: {required: true},
		   lastname: {required: true},
		   password: {required: true,
		   	MinLengthlogin:true},
		   city: {required: true},
		   state: {required: true},
		   zipcode: {required: true},
		   country: {required: true},
		   systemtype:{required: true}
		  },
		  messages: {
		                 email:
	                                    {
	                                    required:"Email Required",
		               	Email:"Email is not valid"},
		                username:{required: "Username Required"},
		                firstname:{required: "First Name Required"},
		                lastname:{required: "Last Name Required"},
		                password:{required: "Password Required",
		                MinLengthlogin:"Minimum Length is 8 characters"},
		                city:{required: "City Required"},
		                state:{required: "State Required"},
		                zipcode:{required: "Zip Code Required"},
		                country:{required: "Country Required"},
		                systemtype:{require: "System Type Required"}
		                
		            },
		            tooltip_options: {
		                email: {placement:'top',html:true},
		                username: {placement:'top',html:true},
		                firstname: {placement:'top',html:true},
		                lastname: {placement:'top',html:true},
		                password: {placement:'top',html:true},
		                city: {placement:'top',html:true},
		                state: {placement:'top',html:true},
		                zipcode: {placement:'top',html:true},
		                country: {placement:'top',html:true},
		                systemtype: {placement:'top',html:true},
		                password: {placement:'top',html:true},
		                username: {placement:'top',html:true},
		            }
		});
	
</script>