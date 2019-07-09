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
        <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       
                        <h5>Total Stories</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $total_stories; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        
                        <h5>Total Users</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo $total_users; ?></h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        
                        <h5>Total Donations</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins"><?php echo "$".$total_donations->donation_amount; ?></h1>
                            </div>
                            
                        </div>


                    </div>
                </div>
            </div>
           
        </div>
      
        </div>

		<div class="footer">
            <div class="pull-right">
                10GB of <strong>250GB</strong> Free.
            </div>
            <div>
                <strong>Copyright</strong> Example Company &copy; 2017
            </div>
        </div>
     <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Latest 10 Stories</h5>
                </div>
                <div class="ibox-content">
                	<table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                        <thead>
                        <tr>
                            <th data-toggle="true">Story Name</th>
                            <th data-hide="all">Category Name</th>
                            <th data-hide="all">Story Description</th>
                            <th data-hide="all">Fundraising Target</th>
                            <th data-hide="all">Fundraising Status</th>
                            <th data-hide="all">Site Status</th>
                            <th data-hide="all">Story Status</th>
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
                            <td><?php echo $key->fundraising_target; ?></td>
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
                            <?php if($key->story_is_donated=='1') {?>
                            <td><span class="label label-primary"><?php echo "Active"; ?></span></td>
                            <?php }else{ ?>
                            <td><span class="label label-danger"><?php echo "In-Active"; ?></span></td>
                            <?php }?>
                        </tr>
                        <?php }
                            }else{?>
                        			<tr><b><td align="center" colspan="7"><b><?php echo "No Record Found"; ?></b></td></b></tr>
							
                        <?php	} ?>
                        
                        </tbody>
                        <tfoot>
                        	
                        <tr>
                            <!-- <td colspan="8">
                                <div class="pagination_ci" style="float:right;"> <?php echo $paginglinks; ?></div>
                                <div class="pagination_ci" style="float:left;"> <?php echo (!empty($pagermessage) ? $pagermessage : ''); ?></div>
                             </td>-->
                        </tr>
                        
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <!-- </div> -->