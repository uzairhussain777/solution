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


		
			<div class="wrapper wrapper-content animated fadeInRight">
			
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        
                        <div class="ibox-content">
                        
                        	<h3>vendors Information</h3>
         
                        	<br/>
                              <form  method="post" action="#" class="form-horizontal" id="create_admin_form" name="create_admin_form">
                               
                                	<div class="form-group">
                                	<label class="col-sm-2 control-label">Name</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_category_id" name="edit_category_id">
                                    <div class="col-sm-4">
                                 	<input type="text" class="form-control"  name="categoryname" id="categoryname" value="<?php echo $result->name ?>" readonly></div>
                                    </div>
                                    
                                    
                                     	<div class="form-group">
                                	<label class="col-sm-2 control-label">category</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_category_id" name="edit_category_id">
                                    <div class="col-sm-4">
                                 	<input type="text" class="form-control"  name="categoryname" id="categoryname" value="<?php echo $result->category ?>" readonly></div>
                                    </div>
                                    
                                     	
                                    
                                     	<div class="form-group">
                                	<label class="col-sm-2 control-label">sub_category</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_category_id" name="edit_category_id">
                                    <div class="col-sm-4">
                                 	<input type="text" class="form-control"  name="categoryname" id="categoryname" value="<?php echo $result->sub_category ?>" readonly></div>
                                    </div>
                                    
                                     	<div class="form-group">
                                	<label class="col-sm-2 control-label">Description*</label>
									<input type="hidden" value="<?php echo $result->vendors_id ?>" id="edit_category_id" name="edit_category_id">
                                    <div class="col-sm-4">
                                 	<input type="text" class="form-control"  name="categoryname" id="categoryname" value="<?php echo $result->short_description ?>" readonly></div>
                                    </div>
                                    
                                     	
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Creation Info</label>
								    <div class="col-sm-4">
								    	
								    	<textarea class="form-control" readonly="readonly">Date: <?php echo date("jS M, Y",strtotime($result->date_created));?> Time: <?php echo date("g:i A",strtotime($result->date_created));?> </textarea>
                                    </div>
                                </div>
                                  	<div class="hr-line-dashed"></div>
                          
                                 <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
        <a href="<?php echo $this->config->base_url();?>vendors/view" class="btn btn-primary">Back</a>
       
                                <a href="<?php echo $this->config->base_url();?>vendors/edit?vendors_id=<?php echo $result->vendors_id ?>" class="btn btn-primary">Edit</a>
                            
                                                 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
   
      </div>