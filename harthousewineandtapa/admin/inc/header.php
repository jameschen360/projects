<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GM Control Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                <a class="navbar-brand" href="#">You are Logged in as <?echo "$firstname $lastname";?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right pull-right">




						<li><a href="../"><i class="fa fa-sign-out fa-fw"></i> Go to Front Page</a>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>


                    <!-- /.dropdown-user -->

                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="control.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-o fa-fw"></i> Page Content Edits<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="home.php">Home Page Edit</a>
                                </li>
                                <li>
                                    <a href="about.php">About Us Edit</a>
                                </li>
								
								<li>
                                    <a href="menu.php">Menu Edit</a>
                                </li>
								<li>
                                    <a href="gallery.php">Gallery Edit</a>
                                </li>
								<li>
                                    <a href="news.php">Event/News Edit</a>
                                </li>
								<li>
                                    <a href="reserve.php">Reservation/Gift Edit</a>
                                </li>
								<li>
                                    <a href="contact.php">Contact Us Edit</a>
                                </li>
								<li>
                                    <a href="cwevents.php">Events Pricing Edit</a>
                                </li>								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="request.php"><i class="fa fa-lightbulb-o fa-fw"></i>Reservation Requests</a>
                        </li>
						
						
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>