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
	
		$error_messages =  strip_tags($user_add_data['error_message']);
	    
	    $error_messages = str_replace(array("\r", "\n"), '', $error_messages);
		$error_messages= explode('.',$error_messages);
	 	if(count($error_messages)>1){
		 	for($i=0; $i<count($error_messages)-1; $i++){
	  			$error = $error_messages[$i];
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
			}else{
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
		 } ?>


			<div class="wrapper wrapper-content animated fadeInRight">
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Manage Users</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo $this->config->base_url();?>permissions_content/super_user_manage_users_update_content" class="form-horizontal" id="create_category_form" name="create_category_form" > 
                               
                               	<div class="form-group">
									<label class="col-sm-2 control-label">Group Name</label>
									<div class="col-sm-3"><input type="text" readonly="" placeholder="Enter Group Name" class="form-control"  name="group_name" id="group_name" value="<?php echo $group->group_name;?>"></div>
									<input type="hidden" name="group_id" value="<?php echo $group->group_id; ?>" />
								</div>
							
                               
                               
                               		<div class="form-group">
                               	    <label class="col-sm-2 control-label">Admin Users</label>
                                    <div class="col-sm-4">
                            		   <select id="sbOne" multiple="multiple" class="form-control" size="8">
									        <?php 
									       foreach ($users as $key => $value) {
										       	if($group->group_id != $value->group_id){
										       		?>
											   			<option value="<?php echo $value->user_id;?>"><?php echo $value->user_name;?></option>
										        	<?php	
											   	} 
										   	}
										   	?>
									    </select>
									    <div class="pull-right">
										    <input class="btn btn-info" type="button" id="right" value=">" />
	    									<input  class="btn btn-info" type="button" id="rightall" value=">>" />
										</div>
                            		</div>
                            	    <div class="col-sm-4">
                            			<select id="sbTwo" name="option_groups[]" multiple="multiple" class="form-control" size="8">
									        <?php 
										       foreach ($users as $key => $value) {
											       	if($group->group_id == $value->group_id){
											       		?>
												   			<option value="<?php echo $value->user_id;?>"><?php echo $value->user_name;?></option>
											        	<?php	
												   	} 
											   	}
										   	?>
									    </select>
                            		    <input class="btn btn-info" type="button" id="left" value="<" />
    									<input class="btn btn-info" type="button" id="leftall" value="<<" />
                            		</div>
							   </div>
                               
                               
                                <div class="hr-line-dashed"></div>
                                
                                
                                
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a href="<?php echo $this->config->base_url(); ?>permissions/view" class="btn btn-white" >Cancel</a>
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        
<script type="text/javascript">

	$("#create_category_form").validate({
            rules: {
				group_id: 
					  	{ required:true}
						 },

					  	messages: {
					                 group_id: { required:"Required"}					                 
					               	},
					       
					           tooltip_options:
					                       {
					            	group_id:{placement:'top',html:true},
					               },
					           	submitHandler: function(form) {
									$('#sbTwo option').prop('selected', true);
									form.submit();
				      			}
					});
						
		$(function () { function moveItems(origin, dest) {
		    $(origin).find(':selected').appendTo(dest);
		    $('#sbTwo option').prop('selected', true);
		}
		 
		function moveAllItems(origin, dest) {
		    $(origin).children().appendTo(dest);
		    $('#sbTwo option').prop('selected', true);
		}
		 
		$('#left').click(function () {
		    moveItems('#sbTwo', '#sbOne');
		});
		 
		$('#right').on('click', function () {
		    moveItems('#sbOne', '#sbTwo');
		});
		 
		$('#leftall').on('click', function () {
		    moveAllItems('#sbTwo', '#sbOne');
		});
		 
		$('#rightall').on('click', function () {
		    moveAllItems('#sbOne', '#sbTwo');
		});
		});
</script>