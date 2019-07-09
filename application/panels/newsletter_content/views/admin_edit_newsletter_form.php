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
                        <div class="ibox-title">
                            <h5>Edit NewsLetter</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="<?php echo $this->config->base_url();?>newsletter_content/editnewsletterrecord" class="form-horizontal" id="edit_newsletter_from" name="edit_newsletter_from" >
                               
                                <input type="hidden" name="newletterid" id="newletterid" value="<?php echo $result->id; ?>">
                                <div class="form-group">
                                	<label class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-4"><input type="text" placeholder="Enter Name" class="form-control"  name="name" id="name" value="<?php echo $result->name;?>" ></div>
                              <label class="col-sm-2 control-label">Select Template*</label>

                                    <div class="col-sm-4"><select class="form-control m-b" name="selecttemplate" id="selecttemplate">
                                        <?php foreach ($templates as $key) { ?>
                                        <option value="<?php echo $key->email_template_id ;?>" 
                                        	<?php if($result->email_template_id==$key->email_template_id) {echo "selected";}?>
                                        	><?php echo $key->template_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>

                                </div>
                            <?php if($result->status!='Done'){ ?> 
                            	 <div class="form-group"><label class="col-sm-2 control-label">Select</label>
                                    <div class="col-sm-4">
                                    	<div class="i-checks"><label> <input type="radio" value="Schedule" id="sendnewletter" name="sendnewletter" onchange="showDateAndTime()" <?php if($result->status=='Schedule'){echo "checked";}?>> Schedule Newsletter</label></div>
                                    	<div class="i-checks"><label> <input type="radio" value="Draft" name="sendnewletter" id="saveasdraft" onchange="hideDateAndTime()" <?php if($result->status!='Schedule'){echo "checked";}?>> <i></i> Save As Draft </label></div>

                                    </div>
                                </div>
                          <div class="form-group datepicker" style="display: <?php if($result->status=='Schedule'){ echo 'block';}else{  echo 'none'; } ?>;">
                            	 
		                          	<div id="datepicker">
		                          		<label class="col-sm-2 control-label">Set Newsletter Date And Time<br>(MM/DD/YYYY HH:mm:ss)</label>
										<div class="col-sm-4" id="from_datepicker">
											<div class='input-group date' id='datetimepicker3' >
												<input type='text' class="form-control" placeholder="Select date and time to schedule" name="newsletterdatetime" value="<?php if($result->datetime!='0000-00-00 00:00:00'){ echo $result->datetime; } ?>"  />
												<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
									</div>
                        	  	</div>
                    		</div>
                 		 	<div class="form-group selectgroup" ><label class="col-sm-2 control-label">Select Group*</label>
                               <!-- <div class="col-sm-10"> -->
                               	<div>
                                        <input type="radio" id="allusers" value="allusers" name="selectgroupfornewsletter" onchange="hideselectstories()" <?php if($result->group=='allusers'){ echo "checked";}  ?>>
                                        <label for="allusers">All Users</label>
                                        <input type="radio" id="stories" value="stories" name="selectgroupfornewsletter" onchange="showselectstories()" <?php if($result->group=='stories'){ echo "checked";}  ?>>
                                        <label for="stories">Stories</label>
                                    </div>
                                    
                               <!-- </div> -->
              					</div>
              					<div class="form-group selectstoriesdropbox" style="display: <?php if($result->group=='stories'){ echo 'block';}else{  echo 'none'; } ?>;">
              						<label class="col-sm-2 control-label">Select Stories*</label>

                                    <div class="col-sm-4">
                                    	<select class="form-control m-b" name="selectstoriesdropbox" id="selectstoriesdropbox">
                                        <?php foreach ($stories as $key) { ?>
                                        <option value="<?php echo $key->story_id ;?>" <?php if($result->story_id==$key->story_id){ echo "selected"; } ?>><?php echo $key->story_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
              					</div>
                             
							
                     <?php }else{?>
                     	<label class="col-sm-2 control-label">Newsletter Sent Successfully</label>
                     <?php } ?>
                     
                                <div class="form-group">
                                    <div class="col-sm-7 col-sm-offset-2 pull-right">
                                        <a href="<?php echo $this->config->base_url(); ?>newsletter/view" class="btn btn-white" >Cancel</a>
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

	    $("#edit_newsletter_from").validate({
	        rules: {
		   name: {required: true},
		   newsletterdatetime:{required: true},
		  },
		  messages: {
		              name:{required: "Name Required"},
		                newsletterdatetime:{required: "Date and Time Required"},
		            
		            },
		            tooltip_options: {
		               
		            }
		});
		
		$('#datetimepicker3').datetimepicker({
        	sideBySide: true,
            format : 'MM/DD/YYYY HH:mm:ss',
            minDate:new Date(),
        });
			function showDateAndTime(){
			console.log('Here');
			 if($('#sendnewletter').is(":checked")){   
		        $(".datepicker").show();
		      //  $(".selectgroup").show();
		       }
		    else{
		        $(".datepicker").hide();
		       // $(".selectgroup").hide();
		       }
		}
		
		function hideDateAndTime(){
			if($('#saveasdraft').is(":checked")){
		    $(".datepicker").hide();
		   // $(".selectgroup").hide();
		   // $(".selectstoriesdropbox").hide();
		    //$('input[name=stories]').prop('checked', false);
		  //  $('input[name=allusers]').prop('checked', false);
		   }
		    else{
		    $(".datepicker").show();
		 //   $(".selectgroup").show();
		    }
		}
		
		function showselectstories(){
			 if($('#stories').is(":checked")){   
			 		$(".selectstoriesdropbox").show();
			 	}else{
			 		$(".selectstoriesdropbox").hide();
			 	}
		}
		function hideselectstories(){
			 if($('#allusers').is(":checked")){   
			 		$(".selectstoriesdropbox").hide();
			 	}else{
			 		$(".selectstoriesdropbox").show();
			 	}
		}
	
	
</script>