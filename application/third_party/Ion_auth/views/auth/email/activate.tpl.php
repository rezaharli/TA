<html>
<body>
	<h1><?php echo sprintf(lang('email_activate_heading'), $identity);?></h1>
	<p><?php echo sprintf(lang('email_activate_subheading'), anchor('auth/aktivasi/'. $id .'/'. $activation . '/true', lang('email_activate_link')));?></p>
</body>
</html>