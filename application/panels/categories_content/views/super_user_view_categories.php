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
                            <h5>All Categories Record</h5>
                        </div>
                        <div class="ibox-content">
					<form method="post" action="<?php echo $this->config->base_url()?>categories/search">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="category_name_search" value="<?php echo $this->session->userdata('category_name');?>" name="category_name_search" placeholder="Name" class="form-control" >
							
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select name="status_search" class="form-control">
										<option  selected value="">Select Category status</option>
										<option value="1" <?php if($this->session->userdata('category_is_allowed')=="1"){echo "SELECTED";}?>>Active</option>
										<option value="0" <?php if($this->session->userdata('category_is_allowed')=="0"){echo "SELECTED";}?>>In-Active</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary"  value="Search"/>
							</div>
						</form>
	
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Category Name</th>
                                    <th data-toggle="true">Short Description</th>
                                    <th data-hide="all">Date Added</th>
                                    <th data-hide="all">Category Status </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                               <?php if(!empty($categories)){
									foreach ($categories as $key) { ?>
								<tr>
                                    <td><?php echo $key->category_name; ?></td>
                                    <?php if($key->category_short_description==''){?>
                                    	
                                    	 <td>---</td>
                                  <?php }else{ ?>
                                  
                                    <td><?php echo $key->category_short_description; ?></td>
                                    <?php } ?>
                                    <td><?php echo $key->date_created; ?></td>
                                    <?php if($key->category_is_allowed=='0') {?>
                                    <td><span class="label label-danger">In-Active</span></td>
                                    <?php } else{?>
                                    <td><span class="label label-primary">Active</span></td>
                                    <?php }?>	
                                  	<td>
                                	<a href="<?php echo $this->config->base_url();?>categories/edit?categoryid=<?php echo $key->category_id; ?>"class="btn btn-primary btn-xs" data-toggle="tooltip	" title="Edit">
                                		<span class="glyphicon glyphicon-pencil"></span>
                                		</button>
                                		</a>
                                		</td>
                                </tr>
                                
                                <?php }
									}else{ ?>
										
										<tr><b><td align="center" colspan="4"><b><?php echo "No Record Found"; ?></b></td></b></tr>
								<?php } ?>
                                </tbody>
                                <tfoot>
                                	<?php if( isset($categories) && ($categories!='')){ ?>
                                <tr>
                                    <td colspan="5">
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
            