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
	    <div class="wrapper">
			<div class="container">
				<h1>Selamat Datang</h1>
				<form id="login" class="form" >
					<input type="text" placeholder="Username" name="username">
					<input type="password" placeholder="Password" name="password">
					<button type="submit" id="login-button">Login</button>
				</form>
				<p style="display: none;" class="error">Login gagal. Mohon masukkan username atau password yang benar.</p>
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
	    
	    <script src='<?php echo base_url(); ?>assets/jquery/2.1.3/jquery.min.js'></script>
		<script>
		// Variable to hold request
		var request;

		// Bind to the submit event of our form
		$("#login").submit(function(event){
			event.preventDefault();

		    // Abort any pending request
		    // if (request) {
		    //     request.abort();
		    // }
		    // setup some local variables
		    var $form = $(this);

		    // Let's select and cache all the fields
		    var $inputs = $form.find("input");

		    // Serialize the data in the form
		    var serializedData = $form.serialize();

		    // Fire off the request to /form.php
		    request = $.ajax({
		        url: "<?php echo base_url(); ?>login/autentikasi",
		        type: "post",
		        data: serializedData
		    });

		    // Callback handler that will be called on success
		    request.done(function (response){
		    	if(response == true){
		    		$('.error').css('display', 'none');
					$('form').fadeOut(500);
					$('.bg-bubbles').delay(1500).fadeOut(1500);
					$('.wrapper').addClass('form-success');
					$('.container').delay(1500).fadeOut(500);
          			$('.wrapper').delay(2500).fadeOut(500);
					window.setTimeout(function(){
						window.location="<?php echo base_url(); ?>";
					}, 3000);
		    	} else {
		    		$('.error').css('display', 'block'); // show error msg
		    	}
		    });
		});
		</script>

    </body>
</html>