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
                            <h5>All Users Record</h5>
                        </div>
                        <div class="ibox-content">
	<form method="post" action="<?php echo $this->config->base_url()?>user/search">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="user_name_search" value="<?php echo $this->session->userdata('user_name');?>" name="user_name_search" placeholder="User Name" class="form-control">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="user_email_search" value="<?php echo $this->session->userdata('user_email');?>" name="user_email_search" placeholder="Email" class="form-control">
							
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="user_country_search" value="<?php echo $this->session->userdata('user_country');?>" name="user_country_search" placeholder="Country" class="form-control">
							
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary"  value="Search"/>
							</div>
						</form>
	

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>

                                    <th data-toggle="true">User Name</th>
                                    <th>Email</th>
                                    <th>First Name</th>
                                    <th data-hide="all">Last Name</th>
                                    <th data-hide="all">Country</th>
                                    <th data-hide="all">City</th>
                                    <th data-hide="all">Front Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php if(isset($result_all_user)){
									foreach ($result_all_user as $key) { ?>
								
                                <tr>
                                
                                    <td><?php echo $key->user_name; ?></td>
                                    <td><?php echo $key->email; ?></td>
                                    <td><?php echo $key->first_name; ?></td>
                                    <td><?php echo $key->last_name; ?></td>
                                    <td><?php echo $key->country; ?></td>
                                    <td><?php echo $key->city; ?></td>
                                    <td><?php echo $key->front_name; ?></td>
                                  	<td>
                                	<a href="<?php echo $this->config->base_url();?>user/edit?id=<?php echo $key->user_id; ?>"class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit">
                                		<span class="glyphicon glyphicon-pencil"></span>
                                		</button>
                                		</a>
                                		</td>
                                		
                                </tr>
                                
                                <?php 	}
									}else{ ?>
						<tr><b><td align="center" colspan="7"><b><?php echo "No Record Found"; ?></b></td></b></tr>
							
								<?php	}
								
                                ?>
                                </tbody>
                                <tfoot>
                                	<?php if(isset($result_all_user) && $result_all_user!=''){
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
            