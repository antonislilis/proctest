<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Currency Calculator Procon</title>

       <!-- <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/sb-admin.css" />
        <link href="<?php echo URL; ?>public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="<?php echo URL; ?>views/dashboard/js/dashboard.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-1.11.2.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->

        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/sb-admin.css" />
        <link href="<?php echo URL; ?>public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
       
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/dashboard.js"></script>
        
         <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/gritter/css/jquery.gritter.css" />
        <script type="text/javascript" src="<?php echo URL; ?>public/gritter/js/jquery.gritter.js"></script>
    </head>

    <body>        
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Currency Calculator</a>
                </div>
                <?php
                $general = new General_Model();
                $browser = $general->getBrowser();
                ?>
                <!-- We show on the top right nav the user agent -->
                <ul class="nav navbar-right top-nav">
                    <br>
                    <li>
                        <font color="white"><i class="fa fa-fw fa-user"></i> <?php echo $browser['name'] . ' ' . $browser['platform']; ?> User</font>
                    </li>
                </ul>
                <!-- Top Menu Items -->
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li>
                            <a href="<?php echo URL; ?>index"><i class="fa fa-fw fa-dashboard"></i> Index</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>currency"><i class="fa fa-fw fa-bar-chart-o"></i> Currency Calculator</a>
                        </li>
                        <li>
                            <a href="<?php echo URL; ?>dashboard"><i class="fa fa-fw fa-table"></i> Edit Currencies</a>
                        </li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">
