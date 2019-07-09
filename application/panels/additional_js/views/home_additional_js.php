

	 <div class="container">
	  <div class="modal" id="Modal-login" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Login</h4>
	        </div>
	        <div class="modal-body" >
	        	<form class="form" id="loginform" action="<?php echo $this->config->base_url();?>login_content/login_validate" name="loginform" method="post">
		    	<input type="text" name="email" id="email" placeholder="Enter your email address" class="email" >
			    <input type="password" name="password" id="password" placeholder="Enter your password" class="password" >
	        
	        <div class="modal-footer">
<!--
	        	<a href="#" class="forgot-password" id="forgotpassword" onclick="showforgotpassword()">Forgot Password?</a>
-->
	        	<button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Login</button>
	        </div>
	      </form>
	      </div>
	      </div>
	      
	    </div>
	  </div>
  
	</div>
	
	
	
	 <div class="container">
	  <div class="modal fade" id="Modal-forgot" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Forgot Password</h4>
	        </div>
	        <div class="modal-body">
	        	<form class="form" id="forgotpasswordform" action="<?php echo $this->config->base_url();?>login_content/email_validate" name="forgotpasswordform" method="post">
		       		<input type="text" name="useremail" id="useremail" placeholder="Enter your email address" class="email" >
	        <div class="modal-footer">
	        	<button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Send Code</button>
	        </div>
	         </form>
	         </div>
	      </div>
	      
	    </div>
	  </div>
  
	</div>
	
	<div class="container">
	  <div class="modal fade" id="Modal-conformationcode" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Conformation Code</h4>
	        </div>
	        <div class="modal-body" >
	        	<form class="form" id="conformationcode" action="<?php echo $this->config->base_url();?>login_content/conformation_code_validate" name="conformationcode" method="post">
		    	<input type="text"  placeholder="Conformation Code" name="code" id="code" class="signup-email">
	       
	        <div class="modal-footer">
	        	<button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Confirm Code</button>
	        </div>
	         </form>
	          </div>
	      </div>
	      
	    </div>
	  </div>
  
	</div>
	
	<div class="container">
	  <div class="modal fade" id="Modal-resetpassword" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Reset Password</h4>
	        </div>
	        <div class="modal-body" >
	        	<form class="form" id="resetpassword" action="<?php echo $this->config->base_url();?>login_content/newpassword" name="resetpassword" method="post">
                    <input type="password"  placeholder="New Password" name="pass1" id="pass1" class="signup-password" >
                	 <input type="password"  placeholder="Confirm Password" name="confirmPassword" id="confirmPassword" class="signup-password">
	        
	        <div class="modal-footer">
	        	<button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Reset</button>
	        </div>
	         </form>
	         </div>
	      </div>
	      
	    </div>
	  </div>
  
	</div>
	
	 <div class="container">
	  <div class="modal fade" id="Modal-signup" role="dialog">
	    <div class="modal-dialog">
	    
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Signup</h4>
	        </div>
	        <div class="modal-body">
	        	<form class="form " id="signupform" action="<?php echo $this->config->base_url();?>login_content/register_submit" name="signupform" method="post">
    			<input type="text" name="firstname" id="firstname" placeholder="Enter your First Name" class="signup-name" value="<?php if(isset($user_add_data['firstname'])){echo $user_add_data['firstname'];} ?>">
	        	<input type="text" name="lastname" id="lastname" placeholder="Enter your Last Name" class="signup-name"  value="<?php if(isset($user_add_data['lastname'])){echo $user_add_data['lastname'];} ?>">
	        	<input type="email" name="signup_email" id="signup_email" placeholder="Enter your Email" class="signup-email"  value="<?php if(isset($user_add_data['signup_email'])){echo $user_add_data['signup_email'];} ?>">
	        	<input type="password" name="signup_password" id="signup_password" placeholder="Enter your Password" class="signup-password" >
	        	<input type="password" name="signup_confirm_password" id="signup_confirm_password" placeholder="Confirm password" class="signup-name" >
	        	<input type="text" name="phone_number" id="phone_number" placeholder="Enter your arid Number" class="signup-name" value="<?php if(isset($user_add_data['phone_number'])){echo $user_add_data['phone_number'];} ?>">
	        	<input type="text" name="gender" id="gender" placeholder="Enter your gender" class="signup-name" value="<?php if(isset($user_add_data['gender'])){echo $user_add_data['gender'];} ?>">
	        
	        <div class="modal-footer">
	        	<button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Signup</button>
	        </div>
	         </form>
	         </div>
	      </div>
	      
	    </div>
	  </div>
  
	</div>

     <div class="container">
         <div class="modal" id="Modal-donation" role="dialog">
             <div class="modal-dialog">

                 <div class="modal-content">
                     <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title">Donate</h4>
                     </div>
                     <div class="modal-body" >
                         <form class="form " id="donate" action="<?php echo $this->config->base_url();?>donation_content/donate" name="donate" method="post">
                             <input type="hidden" name="story_id" id="story_id" class="signup-name" value="<?php if(isset($user_add_data['story_id'])){echo $user_add_data['story_id']; } ?>">
                             <?php if($this->session->userdata('is_logged_in')==1 && $this->session->userdata('user_type')=='registered_user') {?>
                                 <input type="text" name="firstname" id="firstname" placeholder="Enter your First Name"  class="signup-name" value="<?php echo $this->session->userdata('first_name')?>">
                                 <input type="text" name="lastname" id="lastname" placeholder="Enter your Last Name"  class="signup-name" value="<?php echo $this->session->userdata('last_name')?>">
                             	 <input type="email" name="donation_email" id="donation_email" placeholder="Enter your Email" class="signup-email"  value="<?php echo $this->session->userdata('email'); ?>">
                             <?php }else {?>
                                 <input type="text" name="firstname" id="firstname" placeholder="Enter your First Name"  class="signup-name" value="<?php if(isset($user_add_data['firstname'])){echo $user_add_data['firstname'];} ?>">
                                 <input type="text" name="lastname" id="lastname" placeholder="Enter your Last Name"  class="signup-name" value="<?php if(isset($user_add_data['lastname'])){echo $user_add_data['lastname'];} ?>">
                             	 <input type="email" name="donation_email" id="donation_email" placeholder="Enter your Email" class="signup-email"  value="<?php if(isset($user_add_data['donation_email'])){echo $user_add_data['donation_email'];} ?>">
                             <?php }?>
                            
                             <input type="text" maxlength="19" name="cardnumber" id="cardnumber" placeholder="Enter your Card Number"  class="signup-name" >
                             <input type="text" maxlength="4" name="cvc" id="cvc" placeholder="Enter your CVC Number"  class="signup-name"  value="<?php if(isset($user_add_data['cvc'])){echo $user_add_data['cvc'];} ?>">
		                     	<span class="currency-sign">$</span>
		                     <input type="number" min="0" name="amount" id="amount" placeholder="Enter Amount"  class="donation-price" value="<?php if(isset($user_add_data['amount'])){echo $user_add_data['amount'];} ?>">
                             <div class='input-group date' id='datetimepicker3'>
                                 <input  type='text' id="date" name="date" class="signup-name" class="signup-name" placeholder="Select Card Expiry Date" value="<?php if(isset($user_add_data['date'])){echo $user_add_data['date'];} ?>">
                                 <span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                             </div>
                             <div class="modal-footer">
                                 <button class="btn btn-default btn-success" type="submit" name="submit" value="Submit">Donate</button>
                             </div>
                         </form>
                     </div>
                 </div>

             </div>
         </div>

     </div>
	

<script>
	
	/* Set the width of the side navigation to 500px */
	function openNav() {
	    document.getElementById("mySidenav").style.width = "300px";
	}
	
	/* Set the width of the side navigation to 0 */
	function closeNav() {
	    document.getElementById("mySidenav").style.width = "0";
	}
	
</script>
<!-- script to open model is error message is set -->
<?php
	if (isset($error_message) && $error_message!="" ){ ?>
<script>
	$('#Modal-login').modal('toggle');
	$('#Modal-login').modal('show');
</script>
<?php }?>

 <?php
 if (isset($donation_validation_error) && $donation_validation_error!="" ){ ?>
     <script>
         $('#Modal-donation').modal('toggle');
         $('#Modal-donation').modal('show');
     </script>
 <?php }?>

<?php
	if (isset($error_reset_password) && $error_reset_password!="" ){ ?>
<script>
	$('#Modal-login').modal('hide');
	$('#Modal-resetpassword').modal('toggle');
	$('#Modal-resetpassword').modal('show');
</script>
<?php }?>

<?php
	if (isset($success) && $success!="" ){ ?>
<script>
	$('#Modal-login').modal('toggle');
	$('#Modal-login').modal('show');
</script>
<?php }?>

<?php
	if (isset($signup_error) && $signup_error!=""){ ?>
<script>
	$('#Modal-login').modal('hide');
	$('#Modal-signup').modal('toggle');
	$('#Modal-signup').modal('show');
</script>
<?php }?>		
	
<?php if (isset($email_validation_fail) && $email_validation_fail!="" ){ ?>
	<script>
	$('#Modal-login').modal('hide');
		$('#Modal-forgot').modal('show');
	</script>
	<?php }?>
	
<?php
	if (isset($email_found_success) && $email_found_success!="" ){ ?>
<script>
	$('#Modal-conformationcode').modal('show');
</script>
<?php }?>

<?php
	if (isset($success_conformation_code) && $success_conformation_code!="" ){ ?>
<script>
	$('#Modal-resetpassword').modal('show');
</script>
<?php }?>
<?php
	if (isset($error_conformation_code) && $error_conformation_code!="" ){ ?>
<script>
	$('#Modal-login').modal('hide');
	$('#Modal-conformationcode').modal('show');	
	
</script>
<?php }?>
<script>
function showforgotpassword(){
	$("#Modal-login .close").click()
		$('#Modal-forgot').modal('toggle');
		$('#Modal-forgot').modal('show');
	}
function showloginmodal(){
	$('#Modal-login').modal('toggle');
	$('#Modal-login').modal('show');
}

function showsignupmodal(){
	$('#Modal-signup').modal('toggle');
	$('#Modal-signup').modal('show');
}

function showdonationmodal(){
    $('#Modal-donation').modal('toggle');
    $('#Modal-donation').modal('show');
    var donation_amount = $('#donation_amount').val();
    var story_id = $('#storyid').val();
    $('#amount').val(donation_amount);
    $('#story_id').val(story_id);
}
</script>
     <script>

         $('#datetimepicker3').datetimepicker({
             sideBySide: true,
             format : 'MM/YYYY',
            //defaultDate: moment("11/01/2017", "MM/DD/YYYY"),
            minDate: new Date()
         });
         <?php if(isset($user_add_data['date']) && $user_add_data['date']){
	?>
	
	$("#date").val("<?php echo $user_add_data['date'];?>");
	
	<?php	
		
	}  ?>
     </script>

<script type="text/javascript">
  $.validator.addMethod("Email", function(value, element) {
            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Invalid Email Address.");
        
    $.validator.addMethod("MinLengthlogin", function(value, element) {	  
		if(value.length < 8){	   		
		 	return false;	  
		}else{	   	
		 return true;	   
		}
	});
	
    $("#loginform").validate({
        rules: {
	  	email: {required:true,
	  	Email:true},
	  	password:{required:true,
	  		MinLengthlogin:true
	  		},
	  },
	  messages: {
                 email:
                      {
                       required:"Email Required",
                		Email:"email is not valid"},
               		 password:
                      {
                       required:"Password Required",
                		MinLengthlogin:"Password requires 8 chracters"},
	            },
	            tooltip_options:{
	            	email: {placement:'top',html:true},
	                password: {placement:'top',html:true}
	            }
	});


	
	$.validator.addMethod("ForgotEmail", function(value, element) {
            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Invalid Email Address.");
        
    $("#forgotpasswordform").validate({
        rules: {
	  	useremail: {required:true,
	  	ForgotEmail:true},
	  },
	  messages: {
                 useremail:
                      {
                       required:"Email Required",
                		ForgotEmail:"email is not valid"},
	            },
	            tooltip_options:{
	            	useremail: {placement:'top',html:true},
	            }
	});
		
	$.validator.addMethod("Email_signup", function(value, element) {
            return this.optional(element) |/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
        }, "Invalid Email Address.");
        
     $.validator.addMethod("MinLengthsignup", function(value, element) {	  
		if(value.length < 8){	   		
		 	return false;	  
		}else{	   	
		 return true;	   
		}
	});
	
	$.validator.addMethod("EqualPasswordsignup", function(value, element) {
		if(value != $("#signup_password").val()){		
	   		return false;		
	   	}else{		   	
   			return true;	
		}	
	});
        
    $("#signupform").validate({
        rules: {
	  	signup_email: {required:true,
	  	Email_signup:true},
	  	signup_password:{required: true,
	  		MinLengthsignup:true
	  		},
	  	signup_confirm_password:{required: true,
	  		MinLengthsignup:true,
	  		EqualPasswordsignup:true
	  		},
	  	username:"required",
	  	firstname:"required",
	  	lastname:"required",
	  	phone_number:"required",
	  	gender:"required",
	  },
	  messages: {
                 signup_email:
                      {
                       required:"Email Required",
                		Email_signup:"email is not valid"},
               		 signup_password:
                      {
                       required:"Password Required",
                		MinLengthsignup:"Password requires 8 chracters"},
	        		signup_confirm_password:
	              	{
		               	required:"Confirm Password Required",
		        		MinLengthsignup:"Confirm Password requires 8 chracters",
		        		EqualPasswordsignup:"Passwords are not matched"},
               		 "username": "Username Required",
               		 "firstname": "Firstname Required",
               		 "lastname": "Lastname Required",
               		 "phone_number": "phone_number Required",
               		 "gender": "gender Required",
	            },
	            tooltip_options:{
	            	signup_email: {placement:'top',html:true},
	                signup_password: {placement:'top',html:true},
	                signup_confirm_password: {placement:'top',html:true},
	                username: {placement:'top',html:true},
	                firstname: {placement:'top',html:true},
	                lastname: {placement:'top',html:true},
	                phone_number: {placement:'top',html:true},
	                gender: {placement:'top',html:true},
	            }
	});
	
	
	$("#conformationcode").validate({
        rules: {
	  	code: "required",
	  },
	  messages: {
                 "code":"Conformation Code Required"
	            },
	            tooltip_options:{
	            	code: {placement:'top',html:true},
	            }
	});
	
	$.validator.addMethod("MinLength", function(value, element) {	  
		if(value.length < 8){	   		
		 	return false;	  
		}else{	   	
		 return true;	   
		}
	});
	
	$.validator.addMethod("EqualPassword", function(value, element) {
		if(value != $("#pass1").val()){		
	   		return false;		
	   	}else{		   	
   			return true;	
		}	
	});
	
	$("#resetpassword").validate({
        rules: {
	  	pass1: {required: true,
	  		MinLength:true
	  		},
  		confirmPassword: {required: true,
  		MinLength:true,
  		 EqualPassword:true
  		},
  	 },
	  messages: {
                 pass1:
                      {
                       required:"Password Required",
                		MinLength:"Password requires 8 chracters"},
	        		confirmPassword:
	              	{
		               required:"Confirm Password Required",
		        		MinLength:"Confirm Password requires 8 chracters",
		        		EqualPassword:"Passwords are not matched"},
	            },
	            tooltip_options:{
	            	pass1: {placement:'top',html:true},
	            	confirmPassword: {placement:'top',html:true},
	            }
	});

  $.validator.addMethod("CardLenght", function(value, element) {
      if(value.length > 19){
          return false;
      }else{
          return true;
      }
  });
  
  $.validator.addMethod("CvcLength", function(value, element) {
      if(value.length > 4){
          return false;
      }else{
          return true;
      }
  });
  
  $.validator.addMethod("chekamountdonation", function(value, element) {
      if(parseFloat(value) <= parseFloat($("#remaningamount").val())){
          return true;
      }else{
          return false;
      }
  });

  $("#donate").validate({
      rules: {
          firstname:{required:true},
          lastname:{required:true},
          cardnumber:{required:true,
              CardLenght:true},
          cvc:{required:true,
          	CvcLength:true},
          exp_month:{required:true},
          exp_year:{required:true},
          amount:{required:true,
          	chekamountdonation:true},
          donation_email:{required: true,
          	Email:true},
      },
      messages: {
          firstname:{required:"First Name is required"},
          lastname:{required:"Last Name is required"},
          cardnumber:{required:"Card Number is required",
              CardLenght:"Maximum 19 digits required"},
          cvc:{required:"Cvc/Cvv Number Name is required",
          CvcLength:"CVC number requires 4 digits"},
          exp_month:{required:"Exp Month Name is required"},
          exp_year:{required:"Exp Year Name is required"},
          amount:{required:"Amount Name is required",
          chekamountdonation:"Donation Amount is greater than required amount"},
          donation_email:{required: "Email address required",
          Email:"Enter valid email address"},
      },
      tooltip_options:{
          firstname: {placement:'top',html:true},
          lastname: {placement:'top',html:true},
          cardnumber: {placement:'top',html:true},
          cvc: {placement:'top',html:true},
          exp_month: {placement:'top',html:true},
          exp_year: {placement:'top',html:true},
          amount: {placement:'top',html:true},
			donation_email: {placement:'top',html:true},
      },

  });

  $.validator.addMethod("AmountCheck", function(value, element) {
      if(parseFloat(value) <= parseFloat($("#remaningamount").val())){
          return true;
      }else{
          return false;
      }
  });


  $("#storydonation").validate({
      rules: {
          donation_amount:{required:true,
          AmountCheck:true},
      },
      messages: {
          donation_amount:{required:"Donation Amount is required",
              AmountCheck:"Amount is greater than required amount"},
      },
      tooltip_options:{
          donation_amount: {placement:'top',html:true},
      },
      submitHandler: function(form) {
          var donation_amount = $('#donation_amount').val();
          var remaning_amount=$('#remaningamount').val();
          if(parseFloat(donation_amount)<=parseFloat(remaning_amount)){
              $('#Modal-donation').modal('toggle');
              $('#Modal-donation').modal('show');
              var story_id = $('#storyid').val();
              $('#amount').val(donation_amount);
              $('#story_id').val(story_id);
          }else{
              alert("Amount is greater than required amount");
          }

      }
  });

$("#cardnumber").keyup(function() {
    $("#cardnumber").val(this.value.match(/[0-9]*/));
});
$("#cvc").keyup(function() {
    $("#cvc").val(this.value.match(/[0-9]*/));
});



</script>