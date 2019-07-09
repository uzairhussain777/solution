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
                            <h5>All vendors Record</h5>
                        </div>
                        <div class="ibox-content">
					<form method="post" action="<?php echo $this->config->base_url()?>vendors/search">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="name_search" value="<?php echo $this->session->userdata('name_search');?>" name="name_search" placeholder="Enter Vendors Name" class="form-control" >
							
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary"  value="Search"/>
							</div>
						</form>
	
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="4">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Name</th>
                                    <th data-toggle="true">category</th>
                                   
                                    <th data-toggle="true">sub_category</th>
                                    <th data-toggle="true">Description</th>
                                   
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                               <?php if(!empty($vendors)){
									foreach ($vendors as $key) { ?>
								<tr>
                                    <td><?php echo $key->name; ?></td>
                                   <td><?php echo $key->category; ?></td>
                                 
                                   <td><?php echo $key->sub_category; ?></td>
                                   <td><?php echo $key->short_description; ?></td>
                                   
                               
                               	
                                  <td>
                                	<a href="<?php echo $this->config->base_url();?>vendors/edit?vendors_id=<?php echo $key->vendors_id; ?>"class="btn btn-primary btn-xs" data-toggle="tooltip	" title="Edit">
                                		<span class="glyphicon glyphicon-pencil"></span>
                                		</button>
                                		</a>
                                		
                                		 <a class="open-AddBookDialog-assign btn btn-danger btn-xs" data-id="<?php echo $key->vendors_id;?>" data-title="Delete" data-toggle="modal" data-target="#assingModal" data-toggle="tooltip" title="Delete">
                                		 			<span class="glyphicon glyphicon-trash"></span>
                                		 </a>
                                		 
                                		<a href="<?php echo $this->config->base_url();?>vendors/viewdetails?vendors_id=<?php echo $key->vendors_id; ?>" class="btn btn-primary btn-xs">
                                		<span> View Details</span>
                                		
                                		</button>
                                		</a>
                                
                                		</td>
                                </tr>
                                
                                <?php }
									}else{ ?>
										
										<tr><b><td align="center" colspan="2"><b><?php echo "No Record Found"; ?></b></td></b></tr>
								<?php } ?>
                                </tbody>
                                    	<td>Total Records<b> <?php echo $total; ?></b>
                                	</td>
                            
                                <tfoot>
                              	<?php if(!empty($vendors)){ ?>
                                <tr>
                                    <td colspan="3">
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
            <!--
            <a href="vendors/createCsv">Download result as CSV</a>
-->
                  <div class="modal fade" id="assingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align: center;"><strong>Are you sure you want to Delete this vendors?<br />
       </strong></p>
        <div class="col-md-6 ">
	        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">NO</button>
	    </div>
	     <div class="col-md-6 ">
	        <a href="" id="cancel" class="btn btn-danger pull-left">YES</a>
	    </div>
       	<div class="col-md-12">&nbsp;</div>
	    	<div style="clear:both"></div>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).on("click", ".open-AddBookDialog-assign", function () {
	 var orgid = $(this).data('id');
	 old_href='<?php echo $this->config->base_url()."vendors_content/delete_vendors";?>';
	 new_href= old_href+"?vendors_id="+orgid;
	 $("#cancel").prop("href", new_href)
	 return false;
	});
	</script>