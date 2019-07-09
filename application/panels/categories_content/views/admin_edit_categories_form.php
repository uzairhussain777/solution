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
                            <h5>Update Category</h5>
                        </div>
                        <div class="ibox-content">
          					         <form enctype="multipart/form-data" method="post" action="<?php echo $this->config->base_url();?>categories_content/editcategory" class="form-horizontal" id="edit_category_form" name="edit_category_form" >
                               <input type="hidden" value="<?php echo $result->category_id; ?>" name="edit_category_id" />
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Category Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Category Name" class="form-control"  name="edit_categoryname" id="edit_categoryname" value="<?php echo $result->category_name; ?>"></div>
                                 	<label class="col-sm-2 control-label">Short Description*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Category Name" class="form-control"  name="shortdescription" id="shortdescription" value="<?php echo $result->category_short_description; ?>"></div>

                                </div>
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Category Short Text*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Category Short Text" class="form-control"  name="categoryshorttext" id="categoryshorttext" value="<?php echo $result->category_short_text; ?>"></div>
                               <label class="col-sm-2 control-label">Category Long Text*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Category Long Text" class="form-control"  name="categorylongtext" id="categorylongtext" value="<?php echo $result->category_long_text; ?>"></div>

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
                                 	<label class="col-sm-2 control-label">Select Status</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="edit_categorystatus" id="edit_categorystatus">
                                        <?php if($result->category_is_allowed=='0') {?>
                                        <option value="0" selected>In-Active</option>
                                        <option value="1">Active</option>
                                        <?php } else{ ?>
                                        <option value="1" selected>Active</option>
                                        <option value="0">In-Active</option>
                                        <?php }?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group" id="diUploadedPictures">
	                             	<label class="col-sm-2 control-label">Upload picture/video</label>
	                             		<div class="col-sm-4">
	                             		<div class="row">
	                             			<div class="col-sm-6">
	                         <?php if(isset($result->resource_name) && $result->resource_name!=""){ ?>
			                             			<div id="img_show">
			                             			<?php if($result->resource_type=='video/mp4'){?>
				                             			<video poster="" controls style="width: 100% !important;height: auto !important;">
													    <source src="<?php echo $this->config->base_url() ?>uploads/categories/videos/<?php echo $result->resource_name ?>" type="video/mp4">
														</video>
				                             			<a class="btn btn-danger" onclick="deleteresource('<?php echo $result->category_id ?>')">Delete</a>
													<?php }else{ ?>
														
														<img src="<?php echo $this->config->base_url() ?>uploads/categories/images/<?php echo $result->resource_name ?>" class="img-rounded" width="150px" height="150px" />
				                             			<a class="btn btn-danger" onclick="deleteresource('<?php echo $result->category_id ?>')">Delete</a>	
				                             		<?php }
													?>
												</div>
											
			                             		<?php }
												else{ 
												?>
			                             		   <div class="form-group" id="divUpload">
	                             		<input type="file" id="myFile" name="userfile" accept="image/*,video/*">
	                             		</div>
	                             
	                        
			                             		<?php }?>
			                     	</div>
							        		
	                             			</div>
	                             		</div>
	                             	</div>
	                           
	                                	<div class="hr-line-dashed"></div>
                        
	                              <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                        <a href="<?php echo $this->config->base_url();?>categories/view" class="btn btn-white" >Cancel</a>
                                        <button class="btn btn-primary" type="submit">Update</button>
                         
	                             </div>
	                           
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
	    $("#edit_category_form").validate({
	        rules: {
		   edit_categoryname: {required: true},
		   shortdescription:{required: true},
		   categoryshorttext:{required:true},
                categorylongtext:{required:true},
                 page_title:{required: true},
                meta_keywords:{required: true},
                meta_description:{required: true},
		  },
		  messages: {
		                
		                edit_categoryname:{required: "Category Name Required"},
		           shortdescription:{required: "Short Description Required"},
		           categoryshorttext:{required:"Short Text Required"},
                        categorylongtext:{required:"Long Text Required"},
                         page_title:{required: "Meta Title Required"},
		                meta_keywords:{required: "Meta Keywords Description Required"},
		                meta_description:{required: "Meta Description Required"},
		                
		            },
		            tooltip_options: {
		               
		            }
		});
	
			function deleteresource(category_id){
				// alert(category_id);
		var url_path="<?php echo site_url('categories_content/updateresource/'); ?>" + category_id;
		//alert(url_path);
        $.ajax({
            url: url_path,
            
            method: 'GET',
            dataType: "json",

        success: function(response) {
        //	$("#img_show").hide();
        	//$("#divUpload").show();
        //	alert("success");
        	window.location.reload();
            console.log(response);
        },
        error: function(response) {
       // 	alert("error");
        		console.log("ERROR");
            	console.log(response);
        	}
        });
        
    }
	
</script>
