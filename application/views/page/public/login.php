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
				
				<form id="form-login" class="form" style="display: none;">
					
					<div id="message-login" class="message"><?php echo $this->session->flashdata('message') ?></div>
					
					<?php echo form_input(array('name' => 'identity', 'id' => 'identity', 'type' => 'text', 'placeholder' => 'Username')); ?>
					<?php echo form_input(array('name' => 'password', 'id' => 'password', 'type' => 'password', 'placeholder' => 'Password'));?>
					
					<p><label><?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>Ingat saya</label></p>
					<button type="submit">Login</button>
					<p><a href="" id="link-forgot-password"><?php echo lang('login_forgot_password');?></a></p>
				
				</form>

				<form id="form-forgot-password" class="form" style="display: none;">

					<div id="message-forgot" class="message"><?php echo $this->session->flashdata('message') ?></div>
      				
      				<?php echo form_input(array('name' => 'identity', 'id' => 'identity', 'type' => 'text', 'placeholder' => 'Username'));?>
					
					<button type="submit"><?php echo lang('forgot_password_submit_btn') ?></button>
					<p><a href="" class="link-login">Kembali ke login</a></p>

				</form>

				<form id="form-register-password" class="form" style="display: none;">
					
					<div id="message-register" class="message"><?php echo $this->session->flashdata('message') ?></div>

					<?php echo form_input(array('name' => 'new', 'id' => 'new', 'type' => 'password', 'placeholder'	=> lang('change_password_validation_new_password_label')));?>
      				<?php echo form_input(array('name' => 'new_confirm', 'id' => 'new_confirm', 'type' => 'password', 'placeholder'	=> lang('change_password_validation_new_password_confirm_label')));?>
					
					<button type="submit"><?php echo lang('forgot_password_submit_btn') ?></button>

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

    </body>
	    
    <script src='<?php echo base_url(); ?>assets/jquery/2.1.3/jquery.min.js'></script>
	<script>
	var id, code;

	$( document ).ready(function() {
		<?php if ($this->session->flashdata('halaman') != null) { ?>
			$('#form-register-password').fadeIn(250);
		<?php } else {?>
	    	$('#form-login').fadeIn(250);
	    <?php } ?>
	});

	$("#form-login").submit(function(event){
		event.preventDefault();

	    var form = $(this);

	    var request = $.ajax({
	        url: "login",
	        type: "post",
	        data: form.serialize()
	    });

	    request.done(function (response){
	    	if(response == ''){
	    		$('#message-login').css('display', 'none');
				$('#form-login').fadeOut(500);
				$('.bg-bubbles').delay(1500).fadeOut(1500);
				$('.wrapper').addClass('form-success');
				$('.container').delay(1500).fadeOut(500);
      			$('.wrapper').delay(2500).fadeOut(500);
				window.setTimeout(function(){
					window.location="<?php echo base_url('auth'); ?>";
				}, 3000);
	    	} else {
	    		var json = JSON.parse(response);
	    		$('#message-login').html(json.message);
	    		id = json.id;
	    		code = json.code;
	    	}
	    });
	});

	$("#form-register-password").submit(function(event){
		event.preventDefault();

	    var form = $(this).serializeArray();
	    form.push(
	    	{name: "id", value: '<?php echo $this->session->flashdata('id') ?>'},
	    	{name: "code", value: '<?php echo $this->session->flashdata('code') ?>'}
	    	);

	    var request = $.ajax({
	        url: "aktivasi",
	        type: "post",
	        data: form
	    });

	    request.done(function (response){
	    	var message;
	    	if(response){
	    		var json = JSON.parse(response);
	    		$('#message-register').html(json.message);
	    	} else {
	    		$('#message-login').html("<p><?php echo lang('activate_successful') ?></p>");
	    		showHalaman('form-register-password', 'form-login');
	    	}
	    });
	});

	$("#link-forgot-password").click(function(event){
		event.preventDefault();
		showHalaman("form-login", "form-forgot-password");
	});

	$(".link-login").click(function(event){
		event.preventDefault();
		showHalaman("form-forgot-password", "form-login");
	});

	function aktivasi(){
		request = $.ajax({
	        url: "aktivasi",
	        type: "post",
	        data: {id: id, code: code, a: false}
	    });

		$('#message-login').html("Mohon tunggu");

	    request.done(function (response){
	    	var json = JSON.parse(response);
	    	$('#message-login').html(json.message);
	    });
	}

	function showHalaman(sebelum, sesudah){
		$('#'+sebelum).fadeOut(250);
		$('#'+sesudah).delay(250).fadeIn(250);
	}
	</script>
</html>