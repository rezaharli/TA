<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_NAME ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url() ?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url() ?>assets/adminlte/bootstrap/js/bootstrap.min.js"></script>

  </head>
  <body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url() ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>K</b>MH</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo APP_NAME ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="tombol-notifikasi">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning" id="jumlah-notifikasi"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- <li class="header">You have 10 notifications</li> -->
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu" id="konten-notifikasi"></ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url() ?>assets/img/foto-profil/<?php echo $foto_profil ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $username ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url() ?>assets/img/foto-profil/<?php echo $foto_profil ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $nama ?>
                      <small>
                      <?php 
                      $jenis_user = $jenis;
                      if ($jenis_user == 'kaur') { 
                        echo 'Kepala Urusan Kemahasiswaan';
                      } elseif ($jenis_user == 'staff_kemahasiswaan') {
                        echo 'Staff Kemahasiswaan';
                      } elseif ($jenis_user == 'staff_admin') {
                        echo 'Staff Admin';
                      } else {
                        echo 'Mahasiswa';
                      } ?>
                      </small>
                      <small><?php echo $email ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url() ?>user/edit" class="btn btn-default btn-flat">Edit Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url() ?>user/logout" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="dropdown">
                
              </li>
            </ul>
          </div>
        </nav>
      </header>