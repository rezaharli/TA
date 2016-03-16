<?php echo $this->session->userdata('username'); ?> <br />
<?php echo $this->session->userdata('is_logged_in'); ?> <br />
<a href="logout">logout</a>


<!-- <?php
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
    </div>
      
      <script src='<?php echo base_url(); ?>assets/jquery/2.1.3/jquery.min.js'></script>
    <script>
    </script>

    </body>
</html>
 -->