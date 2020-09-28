<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Intento! Manage Projects</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="assets/img/navbar-logo.svg" alt="" /></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                        <?php 
                        session_start();
                        if (isset($_SESSION['email'])) {
                            echo '
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="profile.php">Profile</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="teams.php">Teams</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="projects.php">Projects</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="about.php">About Us</a></li>
                            <form class="form-inline mr-sm-8" action="includes/logout.inc.php" method="post">
                                <button class="btn btn-warning my-2 my-sm-0" type="Submit" name="logout-submit">Logout</button>
                            </form>';
                        }
                        else {
                            echo '<li class="nav-item"><a class="nav-link js-scroll-trigger" href="about.php">About Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                                           
                                <form class="form-inline mr-sm-8" action="includes/login.inc.php" method="post">
                                    <input class="form-control mr-sm-2" type="email" placeholder="Email input"  name="email">
                                    <input class="form-control mr-sm-2" type="password" name="pwd" placeholder="Password">
                                    <button class="btn btn-success my-2 my-sm-0" type="Submit" name="login-submit">Login</button>
                                </form>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="masthead">
            <div class="container">

            <?php 
                if (isset($_SESSION['email'])) {
                    echo '<div class="masthead-subheading">Welcome ' . $_SESSION['last_name'] . '!</div>
                    <div class="masthead-heading text-uppercase">It\'s Nice To Meet You!</div>';
                }
                else{
                    echo '<div class="masthead-heading text-uppercase">It\'s Nice To Meet You!</div>
                    <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="signup.php">Sign Up!</a>';  
                }
            ?>
                
        
            </div>
        </header>