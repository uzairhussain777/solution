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
	
		$error_messages =  strip_tags($user_add_data['error_message']);
	    
	    $error_messages = str_replace(array("\r", "\n"), '', $error_messages);
		$error_messages= explode('.',$error_messages);
	 	if(count($error_messages)>1){
		 	for($i=0; $i<count($error_messages)-1; $i++){
	  			$error = $error_messages[$i];
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
			}else{
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
		 } ?>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
<div class="col-lg-12">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Add Permission Group</h5>
		</div>
		<div class="ibox-content">
			<form method="post" action="<?php echo $this->config->base_url();?>permissions_content/super_user_create_permissions" class="form-horizontal" id="create_category_form" name="create_category_form" >
				<div class="form-group">
					<label class="col-sm-2 control-label">Group Name*</label>
					<div class="col-sm-3"><input type="text" placeholder="Enter Group Name" class="form-control"  name="group_name" id="group_name" value="<?php if(isset($user_add_data)){ echo $user_add_data['group_name']; }?>"></div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Panel Permissions</label>
					<div class="col-sm-6">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example dataTable" data-page-size="8">
								<thead>
									<tr>
										<th data-toggle="true">Panel Name</th>
										<th data-hide="all">All Permissions</th>
										<th data-hide="all">View Permission</th>
										<th data-hide="all">None Permission</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach ($panels as $key => $value) {
											$permission_name = "r_".$value->panel_id;
										?>
									<tr>
										<td><?php echo $value->panel_name;?></td>
										<td>
											<input type="radio" value="all" name="<?php echo $permission_name;?>" <?php if(isset($user_add_data)){if($user_add_data[$permission_name]=="all"){echo 'checked="checked"';}}?>>
										</td>
										<td>
											<input type="radio" value="view" name="<?php echo $permission_name;?>" <?php if(isset($user_add_data)){if($user_add_data[$permission_name]=="view"){echo 'checked="checked"';}}?>>
										</td>
										<td>
											<input type="radio" value="none" name="<?php echo $permission_name;?>" <?php if(isset($user_add_data)){if($user_add_data[$permission_name]=="none"){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>>
										</td>
									</tr>
									<?php
										}
								 ?>
								</tbody>
							</table>
						</div>
						<div class="hr-line-dashed"></div>
						<div class="form-group">
							<div class="col-sm-7 col-sm-offset-2 pull-right">
								<a href="<?php echo $this->config->base_url(); ?>permissions/view" class="btn btn-white" >Cancel</a>
								<button class="btn btn-primary" type="submit">Create</button>
							</div>
						</div>
			</form>
			</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
	$("#create_category_form").validate({
	       rules: {
		   group_name: {required: true}
		  },
		  messages: {
		                group_name:{required: "Group Name Required"}
		                
		            },
		            tooltip_options: {
		               group_name: {placement:'top',html:true}
		            }
		});
	
</script>