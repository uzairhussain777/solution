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
                            <h5>Add vendors</h5>
                        </div>
                        <div class="ibox-content">
                            <form  method="post" enctype="multipart/form-data" action="<?php echo $this->config->base_url();?>vendors_content/addnewvendors" class="form-horizontal" id="create_vendors_form" name="create_vendors_form">
                               
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Name</label>
									<div class="col-sm-4"><input type="text" placeholder="Enter Name"  class="form-control"  name="name" id="name"  ></div>
									<label class="col-sm-2 control-label">category</label>
									<div class="col-sm-4"><input type="text" placeholder="Enter category For vendors" class="form-control"  name="category" id="category" </div>
                               		</div>
 	
 				                   <?php echo "<br>";
				   echo "<br>";
				   echo "<br>";?>
 	
                               
                               
                                	<label class="col-sm-2 control-label">Sub Category</label>
									<div class="col-sm-4"><input type="text" placeholder="Enter sub_category" class="form-control"  name="sub_category" id="sub_category" </div>
                               		</div>
 	
 	
 	
 					  <?php echo "<br>";
				   echo "<br>";
				   echo "<br>";?>   
 	 
                        <!--
                           <label class="control-label col-sm-3">Upload Subject Image*<span></span></label>
                                                    <div class="col-sm-9 martop10">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <span class="btn  btn-file">
                                                    <input type="file" id="image" name="image" accept="image/">
                                                    <span class="fileinput-new"></span>
                                                    <span class="fileinput-exists"></span>
                                                    </span>
                                                    </div>
                                                    </div>       	
                                                 -->
                        
                           <?php echo "<br>";
				   echo "<br>";
				   echo "<br>";?>   
 	 
                <div class="form-group">					
				<label class="col-sm-2 control-label">Description*</label>
                <div class="col-sm-10">
              	<textarea class="ckeditor" placeholder="Enter description" class="form-control" name="short_description" id="short_description">
              	<?php if(isset($user_add_data)){ echo $user_add_data['short_description'];} ?>
              	</textarea>
              	</div>
                </div>    	
                             	
                   <?php echo "<br>";
				   echo "<br>";
				   echo "<br>";?>   
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                        <a href="<?php echo $this->config->base_url(); ?>vendors/view" class="btn btn-white" >Cancel</a>
                                     
                                        <button class="btn btn-primary" type="submit">Create</button>
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

	 $.validator.addMethod("name", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9])+$/.test(value);
	        }, "Invalid Name.");
	        
	        $.validator.addMethod("category", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9])+$/.test(value);
	        }, "Invalid category.");



	    $("#create_vendors_form").validate({
	        rules: {
		        name: {required: true},
		        category: {required: true},
		     
		        short_description: {required: true},
		        sub_category: {required: true},
               		        image: {required: true},

			},
               
		   
		 
		  messages: {
		                
		              name:{required: "Name Required"},
		              category:{required: "category Required"},
		            
		              short_description:{required: "short description Required"},
		              sub_category:{required: "sub_category Required"},
                        		              image:{required: "image Required"},

                   },
		
		           
		             tooltip_options:
					                       {
					                name: {placement:'top',html:true}
					                  category: {placement:'top',html:true}
					                
					                      short_description: {placement:'top',html:true}
					                        sub_category: {placement:'top',html:true}
					          							                        image: {placement:'top',html:true}

}
					               
					             
					});
		           
	  
</script>

