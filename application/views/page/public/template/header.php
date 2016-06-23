<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo APP_NAME ?></title>

    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/universal/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/universal/css/bootstrap.min.css">

    <!-- Css animations  -->
    <link href="<?php echo base_url() ?>assets/universal/css/animate.css" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="<?php echo base_url() ?>assets/universal/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes -->
    <link href="<?php echo base_url() ?>assets/universal/css/custom.css" rel="stylesheet">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/universal/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url() ?>assets/universal/img/apple-touch-icon-152x152.png" />
    <!-- owl carousel css -->

    <link href="<?php echo base_url() ?>assets/universal/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/universal/css/owl.theme.css" rel="stylesheet">

    <script src="<?php echo base_url() ?>assets/universal/js/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/universal/js/jquery-1.11.0.min.js"><\/script>')
    </script>
    <script src="<?php echo base_url() ?>assets/universal/js/bootstrap.min.js"></script>
</head>

<body>

    <div id="all">

        <header>

            <!-- *** TOP ***
_________________________________________________________ -->
            <div id="top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-5 contact">
                            <p class="hidden-sm hidden-xs">Kontak kami ke <?php echo APP_EMAIL ?></p>
                            <p class="hidden-md hidden-lg">Kontak kami ke <?php echo APP_EMAIL ?>
                            </p>
                        </div>
                        <div class="col-xs-7">

                            <div class="login">
                                <?php if( ! $this->session->userdata('id')) { ?>
                                    <a href="<?php echo base_url('auth/login') ?>" data-toggle="modal" data-animate-hover="pulse">
                                        <i class="fa fa-sign-in"></i> 
                                        <span class="hidden-xs text-uppercase">Login</span>
                                    </a>
                                <?php } else { ?>                            
                                    <a href="<?php echo base_url('home') ?>" data-toggle="modal"><span class="hidden-xs text-uppercase">Dashboard</span></a>
                                    <a href="<?php echo base_url('auth/logout') ?>" data-toggle="modal" data-animate-hover="pulse">
                                        <i class="fa fa-sign-in"></i> 
                                        <span class="hidden-xs text-uppercase">Logout</span>
                                    </a>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- *** TOP END *** -->

            <!-- *** NAVBAR ***
    _________________________________________________________ -->

            <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

                <div class="navbar navbar-default yamm" role="navigation" id="navbar">

                    <div class="container">
                        <div class="navbar-header">

                            <a class="navbar-brand home" href="<?php echo base_url() ?>">
                                <img src="<?php echo base_url() ?>assets/universal/img/logo-dashboard.png" alt="" class="hidden-xs hidden-sm">
                                <img src="<?php echo base_url() ?>assets/universal/img/logo-dashboard-small.png" alt="Universal logo" class="visible-xs visible-sm"><span class="sr-only">Universal - go to homepage</span>
                            </a>
                            <div class="navbar-buttons">
                                <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                        </div>
                        <!--/.navbar-header -->

                        <div class="navbar-collapse collapse" id="navigation">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="use-yamm yamm-fw <?php if( ! $this->uri->segment(1) || ( ! $this->uri->segment(2) && $this->uri->segment(1) == 'guest')) echo 'active' ?>">
                                    <a href="<?php echo base_url() ?>">Home</a>
                                </li>
                                <li class="use-yamm yamm-fw <?php if( $this->uri->segment(2) == 'events') echo 'active' ?>">
                                    <a href="<?php echo base_url() ?>guest/events">Temukan Event</a>
                                </li>
                            </ul>

                        </div>
                        <!--/.nav-collapse -->

                    </div>

                </div>
                <!-- /#navbar -->

            </div>
            <!-- *** NAVBAR END *** -->

        </header>