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
                            <h5>All Stories Record</h5>
                        </div>
                                <div class="ibox-content">
		<form method="post" action="<?php echo $this->config->base_url()?>stories/search">
							<div class="col-sm-3">
								<div class="form-group">
									<input type="text" id="story_name_search" value="<?php echo $this->session->userdata('story_name');?>" name="story_name_search" placeholder="Name" class="form-control">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select name="status_search" id="status_search" class="form-control">
										<option  selected value="">Select Story status</option>
										<option value="1" <?php if($this->session->userdata('is_donated')=="1"){echo "SELECTED";}?>>Active</option>
										<option value="0" <?php if($this->session->userdata('is_donated')=="0"){echo "SELECTED";}?>>In-Active</option>
									</select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select name="site_status_search" id="site_status_search" class="form-control">
										<option  selected value="">Select Site status</option>
										<option value="1" <?php if($this->session->userdata('story_is_allowed')=="1"){echo "SELECTED";}?>>Active</option>
										<option value="0" <?php if($this->session->userdata('story_is_allowed')=="0"){echo "SELECTED";}?>>In-Active</option>
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
                            <th data-toggle="true">Story Name</th>
                            <th data-hide="all">Category Name</th>
                            <th data-hide="all">Story Description</th>
                            <th data-hide="all">Fundraising Target</th>
                            <th data-hide="all">Fundraising Status</th>
                            <th data-hide="all">Site Status</th>
                            <!-- <th data-hide="all">Story Status</th> -->
                  		    <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($result)){
                            foreach ($result as $key) { ?>
                         <tr>
                            <td><?php echo $key->story_name; ?></td>
                            <td><?php echo $key->category_name; ?></td>
                            <?php if($key->story_description!='') { ?>
                            
                            <td><?php echo $key->story_description; ?></td>
                            <?php } else{ ?>
                             <td>----</td>
                           <?php } ?>
                            <td>$<?php echo $key->fundraising_target; ?></td>
                            <?php if($key->fundraising_status=='1') {?>
                            <td><span class="label label-success"><?php echo "Fulfilled"; ?></span></td>
                            <?php }else{ ?>
                            <td><span class="label label-danger"><?php echo "In Process"; ?></span></td>
                            <?php }?>
                            <?php if($key->story_is_allowed=='1'){ ?>
                            <td><span class="label label-primary"><?php echo "Active"; ?></span></td>
                            <?php }else{ ?>
                            <td><span class="label label-danger"><?php echo "In-Active"; ?></span></td>
                            <?php }?>
                            
                            <td>
                            
                            <td>
                            <?php 
                                   if($permission){
                                   	?>
                                   	
	                           		 	<a href="<?php echo $this->config->base_url();?>stories/edit?storyid=<?php echo $key->story_id; ?>"class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit">
	                                	<span class="glyphicon glyphicon-pencil"></span>
	                                	</a>
	                           		 
                                   	
                                   	<?php
                                   }
                                   ?>
                            		<button class="btn btn-danger btn-xs" onclick="viewDonationRecord(<?php echo $key->story_id;?>)" data-id="" data-toggle="modal" data-target="#myModal">
	                               	 <span class="glyphicon glyphicon-eye-open"></span>
	                                </button>
	                                </td>
                        </tr>

                        <?php 	}
                            }else{?>
                        			<tr><b><td align="center" colspan="7"><b><?php echo "No Record Found"; ?></b></td></b></tr>
							
                        <?php	} ?>
                        
                        </tbody>
                        <tfoot>
                        	<?php if(isset($result) && $result!=''){ ?>
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
 <div class="container">
  <div class="modal" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">View Donation History</h4>
        </div>
        <div class="modal-body" >
        	<form method="post" class="form-horizontal"> 
	        <div class="form-group"><label class="col-sm-2 control-label">Story Name</label>
	            <div class="col-sm-10"><input type="text" placeholder="Enter Story Name" class="form-control"  name="story_name" id="story_name" value="" readonly></div>
	        </div>
	        <div class="hr-line-dashed"></div>
	        <div class="form-group"><label class="col-sm-2 control-label">Total Donation To Story</label>
	            <div class="col-sm-10"><input type="text" placeholder="Enter Story Name" class="form-control"  name="total_donation" id="total_donation" value="" readonly></div>
	        </div>
	        <div class="hr-line-dashed"></div>

	         <div class="form-group"><label class="col-sm-2 control-label">Donation By</label>
	            <div class="col-sm-10" id="donationByUser">

                </div>
	        </div>
	        <div class="hr-line-dashed"></div>
	        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<script type="text/javascript">
	function viewDonationRecord($story_id){
		$.ajax({
            url: "<?php echo site_url('stories_content/ajaxdonationreqbystoryid/'); ?>" + $story_id,
            data: { 
                    func: 'ajaxdonationreqbystoryid',
               	 },
            method: 'POST',
            dataType: "json",

        success: function(response) {
            console.log(response);
            $('#story_name').val(null);
            $('#total_donation').val(null);
            $('#last_donation').val(null);
            if (!$.trim(response.totalDonationSum) && !$.trim(response.editResult)){

            }
            else{
                $('#myModal').modal('show');
                $('#story_name').val(response.totalDonationSum[0].story_name);
                $('#total_donation').val(response.totalDonationSum[0].donation_amount);
                $('#last_donation').val(response.editResult[0].last_donation);
            }

//              $.each(response.donationByUser, function() {
//			   $.each(this, function(k, v) {
//			       console.log(v);
//			      $('#donationByUser').append('<select> <option selected>"+v+"</option> </select>');
//			   });
//			 });
           
        },
        error: function(response) {
        	console.log("Error");
            console.log(response);
        }
        });
	}
	     
        
</script>            