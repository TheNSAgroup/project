<?php

	session_start();

	$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	$url .= $_SERVER["REQUEST_URI"];

	$host = "mysql.freehostingnoads.net";
	$username="u342178811_nsa";
	$password="untcsce4410";
	$db_name="u342178811_ps";
	$tbl_name="accountsTable";

	$keywords = $_POST['keywords'];

	$link = mysqli_connect("$host","$username","$password","$db_name") or die("Error " . mysqli_error($link));
	
	$query = mysqli_query($link, "SELECT * FROM $tbl_name WHERE Skills LIKE '%$keywords%' OR FirstName LIKE '%$keywords%' OR LastName LIKE '%$keywords%'");

	$count = mysqli_num_rows($query);
	
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Project Space - Search Projects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/ico" href="images/favicon.ico">
    
    <!-- Loading Bootstrap, Flat UI and custom site template -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="css/flat-ui.css" rel="stylesheet">
    <link href="css/template.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. -->
    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!--Login Modal -->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body">
                    <form role="form" id="login-form" action="login.php" method="post">
                        <div class="form-group">
                            <input type="text" name="email" id="email" placeholder="Email address" class="form-control flat" />
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control flat" />
                        </div>
                        
                        <input type="hidden" name="url" value="<?php echo $url ?>">
                </div>
                <div class="modal-footer">
                    <a class="pull-left lightgray" href="forgot.php">Forgot password?</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="login-btn" value="submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden Menu -->
    <nav id="hidden-menu" class="navmenu navmenu-inverse navmenu-fixed-left offcanvas" role="navigation">
        <p class="white uppercase" id="hidden-menu-header">Menu</p>
          <ul class="nav navmenu-nav uppercase">
            <li><a href="home.html">Home</a></li>
            <li><a href="projects.php">Projects</a></li>
            <li><a href="profiles.php">Profiles</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <br/>
        <p class="white uppercase" id="hidden-menu-header">Quick links</p>
        <ul class="nav navmenu-nav">
            <li><a href="form.html">Post project</a></li>
        </ul>
    </nav>

    <div id="wrap">
        <header>
            <div class="container-fluid">

                    <!-- Main header menu starts here -->
                <div class="row" id="header-top">
                    <div class="col-xs-2"> 
                        <a href="#" data-toggle="offcanvas" data-target="#hidden-menu" data-canvas="body"><img src="images/sidemenuicon.svg" alt="Menu"/></a>
                    </div>
                    <div class="col-xs-8"> 
                        <div id="logo"></div>
                    </div>
									
					<!-- Will be show by default -->
                    <div id="login-text" class="show col-xs-2"> 
						<div class="row  pull-right account-text">
							<div class="col-sm-6 col-md-5 col-lg-4">
								<a href="#" data-toggle="modal" data-target="#login-modal">Login</a>
							</div>
							<div class="col-sm-6 col-md-5 col-lg-4">
								<a href="signup.html">Signup</a>
							</div>
                    	</div>
					</div>
					
					<!-- User account drop down. Only visible when logged in -->
					<div id="account-button" class="hidden col-xs-2">
                        <div class="dropdown pull-right">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name']; ?><span class="caret"></span></button>
                            <span class="dropdown-arrow"></span>
                            <ul class="dropdown-menu">
                                <li><a href="account.html">Account</a></li>
                                <li><a href="my-posts.php">My posts</a></li>
                                <li><a href="logout.php" id="logout">Logout</a></li>
                            </ul>
                        </div>
                    </div>
					<!-- End of Main header menu -->
                </div>

                <!-- Banner section starts here -->
                <div class="row">
                    <div class="col-xs-12" id="banner" style="background-image: url(images/banner1.jpg);">
                        <h1 class="uppercase" id="banner-text">Search results</h1> <!-- CHANGE THIS -->
                    </div>
                </div>
				<!-- End of Banner section -->
            </div>
        </header>

        <!-- Page content starts here -->
        <div class="container">
            <div class="row">

           		<div class="col-xs-12 col-md-8 div-center text-center">
					<br>
					
					<?php 
						if ($count == 0){
							echo "<br><br>";
						   	echo "<div class=\"col-xs-12 text-center\">";
							echo "<h4 class=\"lightgray\">Sorry, no projects found matching that criteria</h4>";
							echo "<br>";
							echo "<a href=\"projects.php\" style=\"color: gray;\"><span class=\"glyphicon glyphicon-th-list\"> </span> Go back to projects</a>";
							echo "</div>";
							echo "<br><br>";						
						}
						else{
							while($row = mysqli_fetch_array($query)){
								$fname = stripslashes($row['FirstName']);
								$lname = stripslashes($row['LastName']);
								$skills = $row['Skills'];
								$major = $row['Major'];
								$ID = $row['ID'];

					?>
					
					
                        <div class="col-md-5 text-center profile-box">
		                    <div class="well">
		                        <img class="img-circle" src="images/defaultProPic.jpg"/>
		                        <h5><?php echo $fname . " " . $lname; ?></h5>
		                        <p style="margin-top:-15px;"><?php echo $major; ?></p>
		                        <div class="text-left">
		                            <strong>Skills: </strong><p><?php echo $skills; ?></p>
		                        </div>
		                        <form action="view-profile.html?id=<?php echo $ID ?>" method="post">
		                        	<input type="submit" class="btn btn-danger" name="submit" value="More..">
		                        </form>
		                    </div>
	                	</div>
                   
					
					<?php
					
							}	//end while

						} //end if

						mysqli_close($link);
					?>
					
					<br>
					
				</div>

            </div>
        </div>

        <div id="push"></div> <!-- This pushes the footer to the bottom -->
    
    </div>
    
    <!-- footer starts here --> 
    <footer>
        <p id="footer-text">Made with love at University of North Texas</p>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jasny-bootstrap.min.js"></script>

	<script type="text/javascript">
        uname = "<?php echo $_SESSION['name'];?>";
        
        if (uname!=("")){//indicaates that no one is logged in
            $('#account-button').toggleClass('hidden');
            $('#login-text').toggleClass('hidden');
        }
    </script>
  
  </body>

</html>
