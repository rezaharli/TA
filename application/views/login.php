<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html >
	<head>
	    <meta charset="UTF-8">
	    <title>Hmmm</title>
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css">
	</head>

  	<body>
  	<?php echo "lala ".$this->session->userdata('username'); ?> <br />
	<?php echo "lblb ".$this->session->userdata('is_logged_in'); ?> <br />
	    <div class="wrapper">
			<div class="container">
				<h1>Welcome</h1>
				
				<form id="login" class="form" >
					<input type="text" placeholder="Username" name="username">
					<input type="password" placeholder="Password" name="password">
					<button type="submit" id="login-button">Login</button>
				</form>
			</div>
			
			<ul class="bg-bubbles">
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
				<li></li>
			</ul>
		</div>
	    
	    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script>
		// Variable to hold request
		var request;

		// Bind to the submit event of our form
		$("#login").submit(function(event){
			event.preventDefault();

		    // Abort any pending request
		    if (request) {
		        request.abort();
		    }
		    // setup some local variables
		    var $form = $(this);

		    // Let's select and cache all the fields
		    var $inputs = $form.find("input");

		    // Serialize the data in the form
		    var serializedData = $form.serialize();

		    // Let's disable the inputs for the duration of the Ajax request.
		    // Note: we disable elements AFTER the form data has been serialized.
		    // Disabled form elements will not be serialized.
		    $inputs.prop("disabled", true);

		    // Fire off the request to /form.php
		    request = $.ajax({
		        url: "login",
		        type: "post",
		        data: serializedData
		    });

		    // Callback handler that will be called on success
		    request.done(function (response){
		    	if(response == "null"){
		    		alert(response);
		    	} else {
					$('form').fadeOut(500);
					$('.bg-bubbles').delay(1500).fadeOut(1500);
					$('.wrapper').addClass('form-success');
					$('.container').delay(1500).fadeOut(500);
          			$('.wrapper').delay(2500).fadeOut(500);
					window.setTimeout(function(){
						window.location="<?php echo base_url(); ?>";
					}, 3000);
		    	}
		    });
		});
		</script>

    </body>
</html>
