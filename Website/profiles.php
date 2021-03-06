<?php

session_start();

$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
$url .= $_SERVER["REQUEST_URI"];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Project Space - Profiles</title>
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
    <style>
        .inactive-text{
            color: #c6c6c6;
        }

        .text-left{
            text-align: left;
        }
    </style>
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
                    <div class="col-xs-12" id="banner" style="background-image: url(images/banner4.jpg);">
                        <h1 class="uppercase" id="banner-text">Profiles</h1> <!-- CHANGE THIS -->
                    </div>
                </div>
				<!-- End of Banner section -->
            </div>
        </header>

        <!-- Page content starts here -->
        <div class="container">
            <div class="row">
                <br/><br/><br/>
                <div class="col-xs-10 col-sm-8 col-md-6 col-lg-5 div-center">
                    <form class="form-group" action="searchProfiles.php" method="post">
                        <div class="input-group input-group-hg input-group-rounded">
                            <span class="input-group-btn">
                                <button type="submit" name="submit" class="btn"><span class="fui-search"></span></button>
                            </span>              
                            <input type="text" class="form-control" name="keywords" placeholder="Search students by name or skill" id="searchProfiles">
                        </div>
                        <span class="help-block inactive-text text-center">Eg: C++, public relations, fashion design</span>
                    </form>
                </div>
            </div>
            <br/><br/>
            <div class="row">
                <div class="col-md-3 text-center profile-box">
                    <div class="well">
                        <img class="img-circle" src="images/users/kf.jpg"/>
                        <h5>Kristina Perry</h5>
                        <p style="margin-top:-15px;">Journalist</p>
                        <div class="text-left">
                            <strong>Skills: </strong><p>Blogging, journal essays, story telling, news writing</p>
                        </div>
                        <form action="view-profile.html?id=34" method="post">
                            <input type="submit" class="btn btn-danger" name="submit" value="More..">
                        </form>
                    </div>
                </div>
                <div class="col-md-3 text-center profile-box">
                    <div class="well">
                        <img class="img-circle" src="images/users/eb.jpg"/>
                        <h5>Edwell Brooks</h5>
                        <p style="margin-top:-15px;">Web developer</p>
                        <div class="text-left">
                            <strong>Skills: </strong><p>PHP, Javascipt, angular JS, ruby, python</p>
                        </div>
                        <form action="view-profile.html?id=33" method="post">
                            <input type="submit" class="btn btn-danger" name="submit" value="More..">
                        </form>
                    </div>
                </div>
                <div class="col-md-3 text-center profile-box">
                    <div class="well">
                        <img class="img-circle" src="images/users/js.jpg"/>
                        <h5>Jenny Shen</h5>
                        <p style="margin-top:-15px;">Fashion designer</p>
                        <div class="text-left">
                            <strong>Skills: </strong><p>Developing patterns, fabric trends, producing concepts</p>
                        </div>
                        <form action="view-profile.html?id=27" method="post">
                            <input type="submit" class="btn btn-danger" name="submit" value="More..">
                        </form>
                    </div>
                </div>
                <div class="col-md-3 text-center profile-box">
                    <div class="well">
                        <img class="img-circle" src="images/users/hh.jpg"/>
                        <h5>Herr Hasse</h5>
                        <p style="margin-top:-15px;">Photographer</p>
                        <div class="text-left">
                            <strong>Skills: </strong><p>Fashion, portraits, composition, digital retouching</p>
                        </div>
                        
                        <form action="view-profile.html?id=99" method="post">
                            <input type="submit" class="btn btn-danger" name="submit" value="More..">
                        </form>
                    </div>
                </div>
            </div>
            <br/><br/>
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
    <script src="js/jasny-bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>   
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/application.js"></script>

    <script type="text/javascript">
        uname = "<?php echo $_SESSION['name'];?>";
        
        if (uname!=("")){//indicaates that no one is logged in
            $('#account-button').toggleClass('hidden');
            $('#login-text').toggleClass('hidden');
        }
    </script>

  </body>

</html>
