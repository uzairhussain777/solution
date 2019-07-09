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
                            <h5>Add new Story</h5>
                            
                        </div>
                        <div class="ibox-content">
                        	                 <form method="post" action="<?php echo $this->config->base_url();?>stories_content/addnewstory" class="form-horizontal" id="create_story_form" name="create_story_form" enctype="multipart/form-data">
                               
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Story Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Story Name" class="form-control"  name="storyname" id="storyname" value="<?php echo $user_add_data['storyname']?>"></div>
                                     	<label class="col-sm-2 control-label">Story Description*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Story Description" class="form-control"  name="storydescription" id="storydescription" value="<?php echo $user_add_data['storydescription']?>"></div>

                                    
                                </div>
                                
                               
                                
                                <div class="form-group">
                                	 	<label class="col-sm-2 control-label">Select Category*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="selectcategory" id="selectcategory">
                                        <?php foreach ($categories as $key) { ?>
                                        <option value="<?php echo $key->category_id ;?>"><?php echo $key->category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>	
                                	<label class="col-sm-2 control-label">Fundraising Target*</label>

                                    <div class="col-sm-4"><input type="number" min="1" placeholder="Enter Fundraising Target" class="form-control"  name="fundraisingtarget" id="fundraisingtarget" value="<?php echo $user_add_data['fundraisingtarget']?>"></div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Fundraising Status*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="fundraisingstatus" id="fundraisingstatus" value="<?php echo $user_add_data['fundraisingstatus']?>">
                                        
                                        <option value="0">In Process</option>
                                        <option value="1">Fullfilled</option>
                                        
                                    </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Site Status*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="allowedonsite" id="allowedonsite" value="<?php echo $user_add_data['allowedonsite']?>">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    </div>

                                </div>
                                
                                
                                <div class="form-group">
                                	<!-- <label class="col-sm-2 control-label">Story Status*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="storystatus" id="storystatus" value="<?php echo $user_add_data['storystatus']?>">
                                        <option value="1">Active</option>
                                        <option value="0">In-Active</option>
                                    </select>
                                    </div> -->
                                    <label class="col-sm-2 control-label">Resource Direct URL</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Url" class="form-control"  name="resourceurl" id="resourceurl"></div>

                                </div>
                                 <div class="form-group">
                                	<label class="col-sm-2 control-label">Meta Tile*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Meta Title" class="form-control"  name="page_title" id="page_title" value="<?php echo $user_add_data['page_title']?>"></div>
                             		<label class="col-sm-2 control-label">Meta keywords*</label>
                                    <div class="col-sm-4"><textarea name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Enter Meta Keywords"><?php echo $user_add_data['meta_keywords']?></textarea></div>
                                </div>
                           
								<div class="form-group">
                             		<label class="col-sm-2 control-label">Meta Description*</label>
                                    <div class="col-sm-10"><textarea name="meta_description" id="meta_description" class="form-control" placeholder="Enter Meta Description"><?php echo $user_add_data['meta_description']?></textarea></div>
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
	$.validator.addMethod("notEqual", function(value, element, param) {
	    return this.optional(element) || value != param;
	});
	
	
	  $.validator.addMethod("email", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	        }, "Invalid Email Address.");
	    $("#create_story_form").validate({
	        rules: {
		  	
           storyname: {required: true},
           selectcategory: {required: true},
            storydescription: {required: true},
           fundraisingtarget: {required: true},
           fundraisingstatus: {required: true},
           allowedonsite: {required: true},
           storystatus: {required: true},
            page_title:{required: true},
                meta_keywords:{required: true},
                meta_description:{required: true},
		  },
		  messages: {
		                 
	                storyname:{required: "Story Name Required"},
	                selectcategory:{required: "Category Required"},
                    storydescription:{required: "Description Required"},
	                fundraisingtarget:{required: "Fundraising Target Required"},
	                fundraisingstatus:{required: "Fundraising Status Required"},
	                allowedonsite:{required: "Allowed On site Required"},
	                storystatus:{required: "Stiory Status Required"},
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
	
</script>