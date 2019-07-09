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
                            <h5>Add Page</h5>
                        </div>
                        <div class="ibox-content">
                            <form  method="post" action="<?php echo $this->config->base_url();?>pages_content/addnewpage" class="form-horizontal" id="create_admin_form" name="create_admin_form">
                               
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Meta Title*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Ttitle" class="form-control"  name="pagetitle" id="pagetitle" value="<?php if(isset($user_add_data)){ echo $user_add_data['pagetitle'];} ?>" ></div>
                                <label class="col-sm-2 control-label">Meta Description*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Description" class="form-control"  name="metadesc" id="metadesc" value="<?php if(isset($user_add_data)){ echo $user_add_data['metadesc'];} ?>" ></div>

                                </div>
                                    <div class="form-group">
                           	     <label class="col-sm-2 control-label">Meta Keywords*</label>

                                    <div class="col-sm-4">
                                 <input type="text" placeholder="Enter Keywords" class="form-control"  name="metakey" id="metakey" value="<?php if(isset($user_add_data)){ echo $user_add_data['metakey'];} ?>" ></div>

                          			<label class="col-sm-2 control-label">Slug*</label>
									<div class="col-sm-4">
                                <input type="text" placeholder="Enter Slug" class="form-control"  name="slug" id="slug" value="<?php if(isset($user_add_data)){ echo $user_add_data['slug'];} ?>" ></div>
									 </div>
							 <div class="form-group">
                           	     <label class="col-sm-2 control-label">Page Heading*</label>

                                    <div class="col-sm-4">
                                 <input type="text" placeholder="Enter Heading" class="form-control"  name="pagehead" id="pagehead" value="<?php if(isset($user_add_data)){ echo $user_add_data['pagehead'];} ?>" ></div>
								
                          	 		 </div>
                          	 		 <div class="form-group">
								 <label class="col-sm-2 control-label">Page Content*</label>
              <div class="col-sm-10">
              	<textarea class="ckeditor" placeholder="Enter Html Body" name="pagecontent" id="pagecontent">
              		<?php if(isset($user_add_data)){ echo $user_add_data['pagecontent'];} ?>
              	</textarea>
              	</div>
                      </div>
 									
								    
	               	<div class="hr-line-dashed"></div>
                             	
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                        <a href="<?php echo $this->config->base_url(); ?>pages/view" class="btn btn-white" >Cancel</a>
                                     
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
	    $("#create_admin_form").validate({
	        rules: {
		        pagetitle: {required: true},
           		     metadesc: {required: true},
                metakey: {required: true},
                slug: {required: true},
                pagehead: {required: true},
                pagecontent: {required: true},
               
		   
		  },
		  messages: {
		                
		                pagetitle:{required: "Title Required"},
                        metadesc:{required: "Description Required"},
                        metakey:{required: "Keys Required"},
                        slug:{required: "Slug Required"},
                        pagehead:{required: "Heading Required"},
                        pagecontent:{required: "Content Required"},
                       
		            },
		            tooltip_options: {
		       
		            }
		});
	  
</script>