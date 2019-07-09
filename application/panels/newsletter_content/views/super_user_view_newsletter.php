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
                            <h5>All Newsletters Record</h5>
                        </div>
                        <div class="ibox-content">
						<form method="post" action="<?php echo $this->config->base_url()?>newsletter/search">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="news_name_search" value="<?php echo $this->session->userdata('news_name');?>" name="news_name_search" placeholder="Name" class="form-control">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select name="status_search" class="form-control">
										<option  selected value="">Select Newsletter status</option>
										<option value="Sent" <?php if($this->session->userdata('status_news')=="Sent"){echo "SELECTED";}?> >Sent</option>
										<option value="Draft"  <?php if($this->session->userdata('status_news')=="Draft"){echo "SELECTED";}?> >Draft</option>
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

                                    <th data-toggle="true">Name</th>
                                    <th data-hide="all">Template Name</th>
                                    <th data-hide="all">Status</th>
                                    <th data-hide="all">Scheduled Date And Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <?php if(isset($newsletter)){
									foreach ($newsletter as $key) { ?>
								
                                    <td><?php echo $key->name; ?></td>
                                    <td><?php echo $key->template_name; ?></td>
                                    <td><?php echo $key->status; ?></td>
                                    <?php if($key->datetime!=='0000-00-00 00:00:00'){ ?>
                                    <td><?php echo $key->datetime; ?></td>
                                    <?php } else{?>
                                    <td><?php echo "------"; ?></td>
                                    <?php }?>
                                  	<td>
                                  	<?php if($key->status!="Done" && $key->status!="Cancel") {?>
                                	<a href="<?php echo $this->config->base_url();?>newsletter/edit?newsletterid=<?php echo $key->id; ?>"class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit">
                                		<span class="glyphicon glyphicon-pencil"></span>
                                		</button>
                                		</a>
                                		<a class="open-AddBookDialog-delete btn btn-danger btn-xs" data-id="<?php echo $key->id;?>" data-title="Delete" data-toggle="modal" data-target="#deleteModal" data-toggle="tooltip" title="Delete">
                            		 			<span class="glyphicon glyphicon-trash"></span>
                            			 </a>
                                		<?php }elseif($key->status!="Cancel"){ ?>
                                			<i class="fa fa-check text-navy"></i>
                                			<?php } ?>
                                	<?php if($key->status=="Schedule") {?>
                                		<a class="open-AddBookDialog-assign btn btn-warning btn-xs" data-id="<?php echo $key->id;?>" data-title="Cancel" data-toggle="modal" data-target="#assingModal" data-toggle="tooltip" title="Cancel">
                            		 		Cancel	<span class="glyphicon glyphicon-remove"></span>
                            			 </a>
                            			 <!-- <a class="open-AddBookDialog-assign btn btn-danger btn-xs" data-id="<?php echo $key->id;?>" data-title="Delete" data-toggle="modal" data-target="#deleteModal" data-toggle="tooltip" title="Delete">
                            		 		Delete	<span class="glyphicon glyphicon-remove"></span>
                            			 </a> -->
                                		<?php }?>
                                	</td>
                                </tr>
                                
                                <?php 	}
									}else{?>
											<tr><b><td align="center" colspan="4"><b><?php echo "No Record Found"; ?></b></td></b></tr>
							
									<?php	}
								
                                ?>
                                </tbody>
                                <tfoot>
                                	 	<?php if( isset($newsletter) && ($newsletter!='')){ ?>
                               
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
<div class="modal fade" id="assingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align: center;"><strong>Are you sure you want to cancel this newsletter?<br />
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p style="text-align: center;"><strong>Are you sure you want to delete this newsletter?<br />
       </strong></p>
        <div class="col-md-6 ">
	        <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">NO</button>
	    </div>
	     <div class="col-md-6 ">
	        <a href="" id="cancel_del" class="btn btn-danger pull-left">YES</a>
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
	 old_href='<?php echo $this->config->base_url()."newsletter_content/cancelnewsletter";?>';
	 new_href= old_href+"?id="+orgid;
	 $("#cancel").prop("href", new_href)
	 return false;
	});
	
	$(document).on("click", ".open-AddBookDialog-delete", function () {
	 var orgid = $(this).data('id');
	 old_href='<?php echo $this->config->base_url()."newsletter_content/deletenewsletter";?>';
	 new_href= old_href+"?id="+orgid;
	 $("#cancel_del").prop("href", new_href)
	 return false;
	});
	</script>