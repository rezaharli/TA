<?php 
$user = $this->session->userdata('logged_in_user');

echo $user['username']; ?> <br />
<a href="user/logout">logout</a>