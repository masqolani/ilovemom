<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>I LOVE MOM</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Bootstrap datepicker CSS -->
    <!-- <link href="<?php //echo base_url('vendor/bootstrap/css/datepicker.css'); ?>" rel="stylesheet"> -->
    <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap-datetimepicker.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('vendor/bootstrap/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url('vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('vendor/morrisjs/morris.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .logo {
            width: 150px;
            padding: 10px;
            align: center;
        }

        .page-header {
            /* margin-top: 25px;
            font-size: 21px;
            text-align: center; */
            animation: fadein 2s;
            -moz-animation: fadein 2s; /* Firefox */
            -webkit-animation: fadein 2s; /* Safari and Chrome */
            -o-animation: fadein 2s; /* Opera */
        }

      @keyframes fadein {
          from {
              opacity:0;
          }
          to {
              opacity:1;
          }
      }
      @-moz-keyframes fadein { /* Firefox */
          from {
              opacity:0;
          }
          to {
              opacity:1;
          }
      }
      @-webkit-keyframes fadein { /* Safari and Chrome */
          from {
              opacity:0;
          }
          to {
              opacity:1;
          }
      }
      @-o-keyframes fadein { /* Opera */
          from {
              opacity:0;
          }
          to {
              opacity: 1;
          }
      }
    </style>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <h3>I LOVE MOM</h3> -->
                <!-- <a><img class="logo" src="<?php //echo base_url()."/assets/images/logo_kumon.png"?>"> </> </a> -->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                       <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo ' Hello '.$this->session->userdata['logged_in']['first_name']; ?></a></li>
                        <li><a href="<?php echo base_url('login/destroy'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url('home'); ?>"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('saving'); ?>"><i class="fa fa-globe fa-fw"></i> Saving</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('about'); ?>"><i class="fa fa-user-secret fa-fw"></i> About</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
    </div>
    <!-- /#wrapper -->
