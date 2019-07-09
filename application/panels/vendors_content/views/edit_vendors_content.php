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
                            <h5>Update vendors</h5>
                        </div>
                        <div class="ibox-content">
                              <form  method="post" role="form" action="<?php echo $this->config->base_url();?>vendors_content/admin_update_vendors" class="form-horizontal" id="create_vendors_form" name="create_vendors_form">
                               
                                
                                	<div class="form-group">
                                	<label class="col-sm-2 control-label">vendors Name</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_id" name="edit_id">
                                    <div class="col-sm-4"><input type="text" placeholder="Enter Subject Name" class="form-control"  name="name" id="name"  value="<?php echo $result->name ?>" ></div>
                                 
                                	<div class="form-group">
                                	<label class="col-sm-2 control-label">category</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_id" name="edit_id">
                                    <div class="col-sm-4"><input type="text" placeholder="Enter category" class="form-control"  name="category" id="category"  value="<?php echo $result->category ?>" ></div>
                                 
                                 
                                  <?php echo "<br>";
				   					echo "<br>";
				   					echo "<br>";?>   
 	 
                                	
                                	<div class="form-group">
                                	<label class="col-sm-2 control-label">sub_category</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_id" name="edit_id">
                                    <div class="col-sm-4"><input type="text" placeholder="Enter sub_category" class="form-control"  name="sub_category" id="sub_category"  value="<?php echo $result->sub_category ?>" ></div>
                                 	<div class="form-group">
                                	<label class="col-sm-2 control-label">Description</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_id" name="edit_id">
                                    <div class="col-sm-4"><input type="text" placeholder="Enter Description" class="form-control"  name="short_description" id="short_description"  value="<?php echo $result->short_description ?>" ></div>
                                 
                                 
                                 
                                 
                                
                                <!--
                                <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-4">
                                    	 		<?php if($result->status="active"){ ?>
                                   
                                    	<select class="form-control m-b" name="status" id="status">
                                        <option value="active" selected>Active</option>
                                        <option value="inactive">In-Active</option>
                                    </select>
                                       <?php } elseif($result->status="inactive"){ ?>
                                     
									<select class="form-control m-b" name="status" id="status">
                                        <option value="active">Active</option>
                                        <option value="inactive" selected>In-Active</option>
                                    </select>
    								  <?php } ?>
                                 
                                    	</div>
                                    	</div>
												
-->


									<?php echo "<br>";
				   					echo "<br>";
				   					echo "<br>";?>  
                             	
                             	
                             	<div class="hr-line-dashed"></div>
                             	<div class="form-group">
                                <div class="col-sm-7 col-sm-offset-2 pull-right">
                                <a href="<?php echo $this->config->base_url(); ?>vendors/view" class="btn btn-white" >Cancel</a>
                                <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                                </div>
								</div>
                                </div>                                  
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
   
         </div> 
        
<script type="text/javascript">

$("#create_vendors_form").validate({
	        rules: {
		         name: {required: true},
		        category: {required: true},
		       
		        short_description: {required: true},
		        sub_category: {required: true},
			
		  },
		  messages: {
		                
		               name:{required: "Name Required"},
		              category:{required: "category Required"},
		           
		              short_description:{required: "short description Required"},
		              sub_category:{required: "sub_category Required"},
		            },
		            tooltip_options: {
		         name: {placement:'top',html:true}
					                  category: {placement:'top',html:true}
					                   
					                      short_description: {placement:'top',html:true}
					                        sub_category: {placement:'top',html:true}
					          		
}
		            }
		});
	  
</script>

