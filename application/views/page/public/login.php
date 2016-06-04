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
					<div id="message"></div>
					<?php echo form_input($identity);?>
					<?php echo form_input($password);?>
					<p>
						<label><?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>Ingat saya</label>
					</p>
					<button type="submit" id="login-button">Login</button>
					<p><a href="lupa_password"><?php echo lang('login_forgot_password');?></a></p>
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
	    
	    <script src='<?php echo base_url(); ?>assets/jquery/2.1.3/jquery.min.js'></script>
		<script>
		var request;

		$("#login").submit(function(event){
			event.preventDefault();

		    var $form = $(this);

		    var serializedData = $form.serialize();

		    // Fire off the request to /form.php
		    request = $.ajax({
		        url: "<?php echo base_url(); ?>auth/login",
		        type: "post",
		        data: serializedData
		    });

		    // Callback handler that will be called on success
		    request.done(function (response){
		    	if(response == ''){
		    		$('#message').css('display', 'none');
					$('form').fadeOut(500);
					$('.bg-bubbles').delay(1500).fadeOut(1500);
					$('.wrapper').addClass('form-success');
					$('.container').delay(1500).fadeOut(500);
          			$('.wrapper').delay(2500).fadeOut(500);
					window.setTimeout(function(){
						window.location="<?php echo base_url('auth'); ?>";
					}, 3000);
		    	} else {
		    		$('#message').html(response); // show error msg
		    	}
		    });
		});
		</script>

    </body>
</html>