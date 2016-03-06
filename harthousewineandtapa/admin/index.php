<? include('inc/connect.php'); ?>
<?php
    if (isset($_SESSION["user_login"])) {
        header( 'Location: control.php' ) ;
    }
    else
    {
        echo "";

    }
?>
<?php
    //Login Script
    if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
        $user_login = $_POST["user_login"]; // filter everything but numbers and letters
        $password_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password_login"]); // filter everything but numbers and letters
        $md5password_login = md5($password_login);
        $sql = mysql_query("SELECT id FROM users WHERE username='$user_login' AND pwd='$md5password_login' LIMIT 1"); // query the person
        //Check for their existance
        $userCount = mysql_num_rows($sql); //Count the number of rows returned
        if ($userCount == 1) {
            while($row = mysql_fetch_array($sql)){ 
                 $id = $row["id"];
        }
			$database_name = mysql_fetch_array(mysql_query("SELECT username FROM users WHERE id='$id'"));
			$database_name = $database_name[0];
			
			
			 if ($user_login != $database_name) {
				 $user_login = $database_name;
			 } else {
				 echo "";
			 }
             $_SESSION["id"] = $id;
             $_SESSION["user_login"] = $user_login;
             $_SESSION["password_login"] = $password_login;
			 $url="dash";
             echo "<meta http-equiv=\"refresh\" content=\"0; url=$url\">";	
			 exit();
            } else {
            echo '<center><div class="col-lg-12">That information is incorrect, try again</center>';
			echo '<center><a href="/admin">Click Here to Go Back</a></center></div>';
    
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GM Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

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

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">GM Management System</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="" method="post" id="form1">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" id="user_login" placeholder="Username" name="user_login" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="password_login" placeholder="Password" name="password_login" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                            </fieldset>
                        </form>
						<center><p>Made by James Chen<br/> For HHWT User only.</p><br/><a href="
						../">Go back to main site</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
