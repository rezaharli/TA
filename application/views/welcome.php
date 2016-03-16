<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html >
	<head>
	    <meta charset="UTF-8">
	    <title>Hmmm</title>
	    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	</head>

  	<body>
	    <div class="wrapper">
			<div class="container">
				<h1>Welcome</h1>
				
				<form class="form">
					<input type="text" placeholder="Username">
					<input type="password" placeholder="Password">
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
			$("#login-button").click(function(event){
				event.preventDefault();
				 
				$('form').fadeOut(500);
				$('.wrapper').addClass('form-success');
			});
		</script>

    </body>
</html>
