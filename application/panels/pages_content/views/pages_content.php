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

<?php if (isset($email_not_found) && $email_not_found!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $email_not_found;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
<?php } ?>


<?php if (isset($signup_error) && $signup_error!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $signup_error;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
<?php } ?>


<?php if (isset($invalid_email_pass) && $invalid_email_pass!=""){ ?>
<script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo $invalid_email_pass;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>

<?php } ?>
<?php
	if (isset($error_message) && $error_message!="" ){ ?>
		<?php if(!isset($user_add_data['error_message'])){
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
<?php if ($this->session->flashdata('flash_msg')) { ?>
  <script>
	setTimeout(function() {
	     $.bootstrapGrowl('<?php echo  $this->session->flashdata('flash_msg'); ;?>', {
	         type: 'danger',
	         align: 'center',
	         width: 'auto',
	         allow_dismiss: false
	     });
	 }, 1);
</script>
    <?php } ?>


<?php
	print_r($validation->page_content);
?>