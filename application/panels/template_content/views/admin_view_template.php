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

<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>All templates Record</h5>
                        </div>
                        <div class="ibox-content">
				<form method="post" action="<?php echo $this->config->base_url()?>template/search">
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" id="temp_name_search" value="<?php echo $this->session->userdata('temp_name');?>" name="temp_name_search" placeholder="Name" class="form-control">
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" id="temp_subject_search" value="<?php echo $this->session->userdata('temp_subject');?>" name="temp_subject_search" placeholder="Subject" class="form-control">
							
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<input type="text" id="temp_from_name_search" value="<?php echo $this->session->userdata('temp_from_name');?>" name="temp_from_name_search" placeholder="From Name" class="form-control">
							
								</div>
							</div>
								<div class="col-sm-2">
								<div class="form-group">
									<input type="text" id="temp_from_email_search" value="<?php echo $this->session->userdata('temp_from_email');?>" name="temp_from_email_search" placeholder="From Email" class="form-control">
								</div>
							</div>
						
							<div class="form-group">
								<input type="submit" class="btn btn-primary"  value="Search"/>
							</div>
						</form>

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>

                                    <th data-toggle="true">Template Name</th>
                                    <th data-hide="all">Template Subject</th>
                                    <th data-hide="all">Template Type </th>
                                    <th data-hide="all">Template Text Body </th>
                                    <th data-hide="all">From Name</th>
                                    <th data-hide="all">From Email</th>
                                    <th data-hide="all">Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php if(isset($result)){
										
									foreach ($result as $key) { ?>
								
                                <tr>
                                
                                    <td><?php echo $key->template_name; ?></td>
                                    <td><?php echo $key->template_subject; ?></td>
                                    <td><?php echo $key->template_type; ?></td>
                                    <td><?php echo $key->text_body; ?></td>
                                    <td><?php echo $key->from_name; ?></td>
                                    <td><?php echo $key->from_email; ?></td>
                                    <td><?php echo $key->date_created; ?></td>
                                  	<td>
                                	<a href="<?php echo $this->config->base_url();?>template/edit?templateid=<?php echo $key->email_template_id; ?>"class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit">
                                		<span class="glyphicon glyphicon-pencil"></span>
                                		</button>
                                		</a>
                                	</td>
                                		
                                </tr>
                                
                                <?php }
									}else{ ?>
											<tr><b><td align="center" colspan="7"><b><?php echo "No Record Found"; ?></b></td></b></tr>
									
									<?php }
								
                                ?>
                                </tbody>
                                <tfoot>
                                	<?php if(isset($result) && $result!=''){
									?> 	
                                <tr>
                                    <td colspan="8">
                                        <div class="pagination_ci" style="float:right;"> <?php echo $paginglinks; ?></div>
										<div class="pagination_ci" style="float:left;"> <?php echo (!empty($pagermessage) ? $pagermessage : ''); ?></div>
                                    </td>
                                </tr>
                              <?php } ?>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            