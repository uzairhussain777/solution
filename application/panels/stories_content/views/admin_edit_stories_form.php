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

<?php if (isset($file_size_error) && $file_size_error!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $file_size_error;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
<?php } ?>
<!-- <div id="page-wrapper" class="gray-bg"> -->

			<div class="wrapper wrapper-content animated fadeInRight">
        
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Edit Stories</h5>
                            
                        </div>
                        <div class="ibox-content">
                                <form method="post" action="<?php echo $this->config->base_url();?>stories_content/editstoryrecord" class="form-horizontal" id="edit_story_form" name="edit_story_form" enctype="multipart/form-data"> 
                              	<input type="hidden" name="edit_story_id" value="<?php echo $result->story_id; ?>" />
                              
                                <div class="form-group"><label class="col-sm-2 control-label">Story Name*</label>
                                    <div class="col-sm-4"><input type="text" placeholder="Enter Story Name" class="form-control"  name="edit_storyname" id="edit_storyname" value="<?php echo $result->story_name; ?>"></div>
                               <label class="col-sm-2 control-label">Story Description*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Story Description" class="form-control"  name="edit_storydescription" id="edit_storydescription" value="<?php echo $result->story_description; ?>" >
                                    	
                                    </div>

                                </div>
                          
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Select Category*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="edit_selectcategory" id="edit_selectcategory">
                                        <?php foreach ($categories as $key) { ?>
                                        	
                                        <option value="<?php echo $key->category_id ;?>"
                                        	<?php if($result->category_id==$key->category_id) {echo "selected";}?>
                                        	><?php echo $key->category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
									<label class="col-sm-2 control-label">Fundraising Target*</label>

                                    <div class="col-sm-4"><input type="number" min="1" placeholder="Enter Fundraising Target" class="form-control"  name="edit_fundraisingtarget" id="edit_fundraisingtarget" value="<?php echo $result->fundraising_target; ?>"></div>

                                 </div>
                                
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Fundraising Status*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="edit_fundraisingstatus" id="edit_fundraisingstatus">
                                        <option value="1" <?php if($result->fundraising_status=='1'){echo "selected";} ?>>Fullfilled</option>
                                        <option value="0" <?php if($result->fundraising_status=='0'){echo "selected";} ?>>In Process</option>
                                    </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Site Status*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="edit_allowedonsite" id="edit_allowedonsite">
                                        <option value="1" <?php if($result->story_is_allowed=='1'){echo "selected";} ?> >Active</option>
                                        <option value="0"<?php if($result->story_is_allowed=='0'){echo "selected";} ?> >In-Active</option>
                                    </select>
                                    </div>

                                </div>
                                 <div class="form-group">
                                	<label class="col-sm-2 control-label">Meta Tile*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Meta Title" class="form-control"  name="page_title" id="page_title" value="<?php echo $result->page_title?>"></div>
                             		<label class="col-sm-2 control-label">Meta keywords*</label>
                                    <div class="col-sm-4"><textarea name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Enter Meta Keywords"><?php echo $result->meta_keywords?></textarea></div>
                                </div>
                           
								<div class="form-group">
                             		<label class="col-sm-2 control-label">Meta Description*</label>
                                    <div class="col-sm-10"><textarea name="meta_description" id="meta_description" class="form-control" placeholder="Enter Meta Description"><?php echo $result->meta_description?></textarea></div>
                                </div>
                                <div class="form-group">
                                	<!-- <label class="col-sm-2 control-label">Story Status*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="edit_storystatus" id="edit_storystatus">
                                        <option value="1" <?php if($result->story_is_donated=='1'){echo "selected";} ?>>Active</option>
                                        <option value="0" <?php if($result->story_is_donated=='0'){echo "selected";} ?>>In-Active</option>
                                    </select> -->
                                    </div>
                                </div>
                                <div class="upload">
	                             	<div class="form-group" id="diUploadedPictures">
	                             	<label class="col-sm-2 control-label">Upload picture/video</label>
	                             		<div class="col-sm-10">
	                             		<div class="row">
	                             			<div class="col-sm-6">
			                             		<?php if(!empty($resources)){ ?>
			                             			<?php foreach($resources as $key){
			                             			if($key->resource_type=='video/mp4'){?>
				                             			<video poster="" controls style="width: 100% !important;height: auto !important;">
													    <source src="<?php echo resource_path ?>/stories/videos<?php echo $key->resource_name ?>" type="video/mp4">
														</video>
				                             			<a class="btn btn-danger" onclick="deleteresource('<?php echo $key->resource_id ?>')">Delete</a>
													<?php }else{ ?>
														<img src="<?php echo resource_path ?>/stories/images<?php echo $key->resource_name ?>" class="img-rounded" width="150px" height="150px" />
				                             			<a class="btn btn-danger" onclick="deleteresource('<?php echo $key->resource_id ?>')">Delete</a>	
				                             		<?php }
													}?>
			                             		<?php }else{?>
			                             			<div class="col-sm-8"><b>No Picture or video related to story</b></div>
			                             		<?php }?>
	                             			</div>
	                             		</div>
	                             	</div>
	                             </div>
	                             	
                             	<div class="upload">
	                             	<div class="form-group" id="divUpload">
	                             		
	                             		</div>
	                             	</div>
							 	<div class="form-group">
                             		<div class="col-sm-4 col-sm-offset-2">
                             			<a class="btn btn-white" onclick="clone()">Upload Picture/video</a>
                             		</div>
                             		
                             	</div>
                             	<div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                        <a class="btn btn-white" href="<?php echo $this->config->base_url();?>stories/view">Cancel</a>
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
	    $("#edit_story_form").validate({
	        rules: {
		  	
		   edit_storyname: {required: true},
		   edit_selectcategory: {required: true},
           edit_storydescription : {required: true},
		   edit_fundraisingtarget: {required: true},
		   edit_fundraisingstatus: {required: true},
		   edit_allowedonsite: {required: true},
		   edit_storystatus: {required: true},
		     page_title:{required: true},
                meta_keywords:{required: true},
                meta_description:{required: true},
		  },
		  messages: {
		                 
	                edit_storyname:{required: "Story Name Required"},
	                edit_selectcategory:{required: "Category Required"},
                    edit_storydescription:{required: "Story Description Required"},
	                edit_fundraisingtarget:{required: "Fundraising Target Required"},
	                edit_fundraisingstatus:{required: "Fundraising Status Required"},
	                edit_allowedonsite:{required: "Allowed On site Required"},
	                edit_storystatus:{required: "Story Status Required"},
	                page_title:{required: "Meta Title Required"},
		                meta_keywords:{required: "Meta Keywords Description Required"},
		                meta_description:{required: "Meta Description Required"},
		            },
		            tooltip_options: {
		            }
		});
		
		function clone(){
			$("#divUpload").clone().insertAfter(".upload:last");
			htmlStr="<label class='col-sm-2 control-label'>Upload picture/video</label>";
			htmlStr +="<input type='file' id='myFile' name='userfile[]'>";
			$("#divUpload").html(htmlStr)
		}
		
		function deleteresource(resource_id){
        $.ajax({
            url: "<?php echo site_url('stories_content/deleteresource/'); ?>" + resource_id,
            data: { 
                       func:'deleteresource',
                    },
            method: 'POST',
            dataType: "json",

        success: function(response) {
        	console.log("Resource Deleted");
        	window.location.reload();
            console.log(response);
        },
        error: function(response) {
        		console.log("ERROR");
            	console.log(response);
        	}
        });
        
    }
	
	
</script>