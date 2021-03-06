<?php 

session_start();

$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
$url .= $_SERVER["REQUEST_URI"];

$host = "mysql.freehostingnoads.net";
$username="u342178811_nsa";
$password="untcsce4410";
$db_name="u342178811_ps";
$tbl_name="accountsTable";
$email = $_SESSION['email'];

$link = mysqli_connect("$host","$username","$password","$db_name") or die("Error " . mysqli_error($link));

$sql="SELECT ID FROM $tbl_name WHERE Email='$email'";

$result = mysqli_query($link, $sql);
$row = $result->fetch_array(MYSQLI_BOTH);
$id = $row['ID'];

$tbl_name="projects";
$link = mysqli_connect("$host","$username","$password","$db_name") or die("Error " . mysqli_error($link));
$sql="SELECT * FROM $tbl_name WHERE posterID='$id'";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Project Space - My posts</title>
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
                    <div class="col-xs-12" id="banner" style="background-image: url(images/banner8.jpg);">
                        <h1 class="uppercase" id="banner-text">My posts</h1> <!-- CHANGE THIS -->
                    </div>
                </div>
				<!-- End of Banner section -->
            </div>
        </header>

        <!-- Page content starts here -->
        <div class="container">
            <div class="row">

                    <div class="col-xs-12 col-md-8 div-center">
					<?php
						if ($result = mysqli_query($link, $sql)){

							if (mysqli_num_rows($result) == 0) { 
								echo "<br><br>";
							   echo "<div class=\"col-xs-12 text-center\">";
								echo "<h4 class=\"lightgray\">You have not posted anything yet</h4>";
									echo "</div>";
								echo "<br><br>";
							}
							else{
								echo "<br>";
								echo "<ul class=\"list-group\">";
								while($row = $result->fetch_array(MYSQLI_BOTH)){
										$title = $row['title'];
										$postID = $row['id'];
										echo "<li class=\"list-group-item\">" . $title . "<span class=\"pull-right\">" . "<a href=\"view-project.php?id=" . $postID . "\">" . "View" . "</a>" . " | " . "<a href=\"edit-post.php?postid=" . $postID . "\">" . "Edit" . "</a>" . " | " . "<a href=\"delete-post.php?postid=" . $postID . "\">" . "Delete" . "</a>" . "</span>" . "</li>";
								}
								echo "</ul>";
							}
						}
					?>
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
  </body>

</html>
