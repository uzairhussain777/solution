<?php
	if (isset($error_message) && $error_message!=""){ ?>
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
<?php } ?>
<?php
	if (isset($success_message) && $success_message!=""){ ?>
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
<div class="wrapper wrapper-content animated fadeIn">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox-title">
				<h5>Import CSV</h5>
			</div>
			<div class="ibox-content">
				<div class="row">
					<form role="form" id="site_add_form" action="<?php echo $this -> config -> base_url(); ?>school_content/warranty_registrar_upload_csv" name="site_add_form" method="post" enctype="multipart/form-data">
						<div class="row padmarg">
							<div class="col-md-12">
								<br>
							<!-- upload csv/docx files 	
								<h2>Select CSV file to upload</h2>
								<br>
								
								</br>
								<input id="userfile" name="userfile" type="file">  
							-->
							</div>
						</div>
			
								
								</div>
						
						</div>
						<button type="submit" class="btn btn-primary pull-left">Import</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
        $("#site_add_form").validate({
            rules: {
					  	userfile: 
					  	{required:true},
						
						},
					  	messages: {
					                userfile: {
					                	required:"File Required"},
					            },
					           tooltip_options:
					                       {
					                userfile:{placement:'top',html:true},
					               }
					});
</script>

