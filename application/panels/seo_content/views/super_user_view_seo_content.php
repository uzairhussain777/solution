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
                            <h5>All SEO Records</h5>
                        </div>
                        <div class="ibox-content">
					<form method="post" action="<?php echo $this->config->base_url()?>seo/search">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="slugsearch" value="<?php echo $this->session->userdata('slugsearch');?>" name="slugsearch" placeholder="Slug" class="form-control" >
							
								</div>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-primary"  value="Search"/>
							</div>
						</form>
	
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Page Title</th>
                                    <th data-hide="all">Slug </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                               <?php if(!empty($seos)){
									foreach ($seos as $key) { ?>
								<tr>
                                    <td><?php echo $key->page_title; ?></td>
                                    <td><?php echo $key->slug; ?></td>
                                  	<td>
                                	<a href="<?php echo $this->config->base_url();?>seo/edit?seoid=<?php echo $key->seo_id; ?>"class="btn btn-primary btn-xs" data-toggle="tooltip	" title="Edit">
                                		<span class="glyphicon glyphicon-pencil"></span>
                                		</button>
                                		</a>
                                		
                                		 <a class="open-AddBookDialog-assign btn btn-danger btn-xs" data-id="<?php echo $key->seo_id;?>" data-title="Delete" data-toggle="modal" data-target="#assingModal" data-toggle="tooltip" title="Delete">
                                		 			<span class="glyphicon glyphicon-trash"></span>
                                		 </a>
                                	
                                		</td>
                                </tr>
                                
                                <?php }
									}else{ ?>
										
										<tr><b><td align="center" colspan="4"><b><?php echo "No Record Found"; ?></b></td></b></tr>
								<?php } ?>
                                </tbody>
                                <tfoot>
                                	<?php if(!empty($seos)){ ?>
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
        <p style="text-align: center;"><strong>Are you sure you want to delete this SEO Setting?<br />
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
	 old_href='<?php echo $this->config->base_url()."seo_content/super_admin_delete_seo";?>';
	 new_href= old_href+"?id="+orgid;
	 $("#cancel").prop("href", new_href)
	 return false;
	});
	</script>