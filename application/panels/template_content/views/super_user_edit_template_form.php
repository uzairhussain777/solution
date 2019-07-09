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
                            <h5>Edit Template</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo $this->config->base_url();?>template_content/edittemplatetrecord" class="form-horizontal" id="edit_template_forms" name="edit_template_form" >
                               
                               <input type="hidden" name="edit_templateid" value="<?php echo $result->email_template_id; ?>" />
                               
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Template Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Template Name" class="form-control"  name="edit_templatename" id="edit_templatename" value="<?php echo $result->template_name; ?>"></div>
                               <label class="col-sm-2 control-label">Template Subject*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Template Subject" class="form-control"  name="edit_templatesubject" id="edit_templatesubject" value="<?php echo $result->template_subject; ?>"></div>

                                </div>
                                
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Select Template Type*</label>
									<div class="col-sm-4"><select class="form-control m-b" name="edit_templatetype" id="edit_templatetype">
                                        <?php if($result->template_type=='newsletter') {?>
                                        <option value="newsletter" selected>Newsletter</option>
                                        <option value="website">Website</option>
                                        <?php }else{?>
                                        <option value="newsletter">Newsletter</option>
                                        <option value="website" selected>Website</option>
                                        <?php }?>
                                    </select>
                                    </div>
                                    <label class="col-sm-2 control-label">Template Text Body*</label>

                                    <div class="col-sm-4"><textarea placeholder="Enter Template Text Body" class="form-control"  name="edit_templatetextbody" id="edit_templatetextbody"><?php echo $result->text_body; ?></textarea></div>

                                </div>
                                
                               
                                <div class="form-group"><label class="col-sm-2 control-label">Template Html Body*</label>

                                    <div class="col-sm-10"><textarea class="ckeditor" placeholder="Enter Template Html Body" class="form-control"  name="edit_templatehtmlbody" id="edit_templatehtmlbody"><?php echo $result->html_body; ?></textarea></div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">From Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter From Name" class="form-control"  name="edit_fromname" id="edit_fromname" value="<?php echo $result->from_name; ?>"></div>
                                <label class="col-sm-2 control-label">From Email*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter From Email" class="form-control"  name="edit_fromemail" id="edit_fromemail" value="<?php echo $result->from_email; ?>"></div>

                                </div>
                                
                             <div class="hr-line-dashed"></div>
                                   
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                        <a href="<?php echo $this->config->base_url();?>template/view" class="btn btn-white" >Cancel</a>
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
	
	
	  $.validator.addMethod("Email", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	        }, "Invalid Email Address.");
	    $("#edit_template_forms").validate({
	        rules: {
		   edit_templatename: {required: true},
		   edit_templatesubject: {required: true},
		   edit_templatetype: {required: true},
		   edit_templatetextbody: {required: true},
		   edit_templatehtmlbody: {required: true},
		   edit_fromname: {required: true},
		   edit_fromemail: {required: true},
		   edit_fromemail: {required:true,
		   					Email:true},
		   
		  },
		  messages: {
		                
		                edit_templatename:{required: "Template Name Required"},
		           		edit_templatesubject:{required: "Template Subject Required"},
		           		edit_templatetype:{required: "Template Type Required"},
		           		edit_templatetextbody:{required: "Template Text Body Required"},
		           		edit_templatehtmlbody:{required: "Template Html Body Required"},
		           		edit_fromname:{required: "Template From Name Required"},
		           		edit_fromemail:{ required:"Template From Email Required",
		                				Email:"Email is not valid"},
		                
		            },
		            tooltip_options: {
		              edit_fromemail: {placement:'top',html:true}, 
		            }
		});
	
</script>