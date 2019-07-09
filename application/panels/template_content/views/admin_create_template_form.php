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
                            <h5>Add Template</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo $this->config->base_url();?>template_content/addnewtemplate" class="form-horizontal" id="create_template_form" name="create_template_form" >
                               
                                <div class="form-group"><label class="col-sm-2 control-label">Template Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Template Name" class="form-control"  name="templatename" id="templatename" value="<?php echo $user_add_data['templatename']?>"></div>
                              <label class="col-sm-2 control-label">Template Subject*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Template Subject" class="form-control"  name="templatesubject" id="templatesubject" value="<?php echo $user_add_data['templatesubject']?>"></div>

                                </div>
                                
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Select Tempelete Type*</label>
									<div class="col-sm-4"><select class="form-control m-b" name="templatetype" id="templatetype">
                                        <option value="newsletter" selected>Newsletter</option>
                                        <option value="website">Website</option>
                                    </select>
                                    </div>
                                       	<label class="col-sm-2 control-label">Template Text Body*</label>

                                    <div class="col-sm-4"><textarea placeholder="Enter Template Text Body" class="form-control"  name="templatetextbody" id="templatetextbody"><?php echo $user_add_data['templatetextbody']?></textarea></div>

                                </div>
                                
                                
                                <div class="form-group"><label class="col-sm-2 control-label">Template Html Body*</label>

                                    <div class="col-sm-10"><textarea class="ckeditor" placeholder="Enter Template Html Body" class="form-control"  name="templatehtmlbody" id="templatehtmlbody"><?php echo $user_add_data['templatehtmlbody']?></textarea></div>
                                </div>
                                
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">From Name*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter From Name" class="form-control"  name="fromname" id="fromname" value="<?php echo $user_add_data['fromname']?>"></div>
                               <label class="col-sm-2 control-label">From Email*</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter From Email" class="form-control"  name="fromemail" id="fromemail" value="<?php echo $user_add_data['fromemail']?>"></div>

                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                        <a href="<?php echo $this->config->base_url();?>template/view" class="btn btn-white" >Cancel</a>
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
	
	
	  $.validator.addMethod("fromemail", function(value, element) {
	            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
	        }, "Invalid Email Address.");
	    $("#create_template_form").validate({
	        rules: {
		   templatename: {required: true},
		   templatesubject: {required: true},
		   templatetype: {required: true},
		   templatetextbody: {required: true},
		   templatehtmlbody: {required: true},
		   fromname: {required: true},
		   fromemail: {required: true},
		   fromemail: {required:true,
		  	fromemail:true},
		   
		  },
		  messages: {
		                
		                templatename:{required: "Template Name Required"},
		           		templatesubject:{required: "Template Subject Required"},
		           		templatetype:{required: "Template Type Required"},
		           		templatetextbody:{required: "Template Text Body Required"},
		           		templatehtmlbody:{required: "Template Html Body Required"},
		           		fromname:{required: "Template From Name Required"},
		           		fromemail:{ required:"Template From Email Required",
		                fromemail:"Email is not valid"},
		                
		            },
		            tooltip_options: {
		              fromemail: {placement:'top',html:true}, 
		            }
		});
	
</script>