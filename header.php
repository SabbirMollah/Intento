<?php 
session_start();
include('includes/connect_db.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intento</title>
<link rel="icon" href="images/icon.png" type="image/x-icon">
<link rel="stylesheet" 
        href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.0/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
        <script  src="js/index.js"></script>
        <script  src="js/slider.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- <link rel="stylesheet" href="styles/debug.css"> -->
        <link rel="stylesheet" href="styles/helpers.css">
        <link rel="stylesheet" href="styles/grid.css">
        <link rel="stylesheet" href="styles/slider.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>

.hero {
	background: black url(images/b1.png) center / cover;
}

@media (max-width: 1024px) { .hero { background: black url(images/3.jpg) center / cover; } }
@media (max-width:  768px) { .hero { background: black url(images/rose.jpg) center / cover; } }

</style>

</head>

<body class="hero">
    
    <div class="hero-body">
    <header class="hero-body">
        <div class="has-text-centered single-spaced" style="top: 82px;">
            <h1 class="title is-1 has-text-black">Intento</h1> 
            <h2 class="subtitle is-4 has-text-weight-light has-text-black"> : A project management solution : : </h2>
	    </div>    
    </header>
                <div>
                    <?php
                        if (isset($_SESSION['email'])) {
                            echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="index.php">Hello '. $_SESSION['last_name'] . '!</a>
                            '.'
                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav mr-auto">
                                            <li class="nav-item active">
                                                <a class="nav-link" href="index.php">Home<span class="sr-only"></span></a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Profile</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" href="teams.php">Teams</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="projects.php">Projects</a>
                                            </li>
                                    </div>
                                    <div class="column right">
                                        <form class="form-inline mr-sm-2" action="includes/logout.inc.php" method="post" class="navbar-item has-text-black desktop">
                                            <div class="control">
                                                <button class="btn btn-success" type="Submit" name="logout-submit"> Logout </button>
                                            </form>
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                        else{
                            echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <a class="navbar-brand" href="#">Navbar</a>
                                    <div class="column left">                  
                                        </div>
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <ul class="navbar-nav mr-auto">
                                        <li class="nav-item active">
                                        <a class="nav-link" href="index.php">Home</a></p>
                                            <p class="navbar-item has-text-black"><a href="#">About Us</a></p>
                                            <div class="control">
                                            
                                                <a class="navbar-item button is-link is-light" href="signup.php">Signup</a>
                                        </div>
                                        </div>
                                        <div class="column right">
			                            <p class="navbar-item has-text-black desktop">
                                        <form action="includes/login.inc.php" method="post">
                                            <div class="field is-horizontal">
                                                <div class="control has-icons-left has-icons-right">
                                                    <input class="input" type="email" placeholder="Email input"  name="email">
                                                        <span class="icon is-small is-left">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                        <span class="icon is-small is-right">
                                                            <i class="fas fa-triangle"></i>
                                                        </span>
                                                </div>
                                                <div class="field">
                                                <div class="control has-icons-left">
                                                    <input class="input" type="password" name="pwd" placeholder="Password">
                                                    <span class="icon is-small is-left">
                                                        <i class="fas fa-lock"></i>
                                                    </span>
                                                </div>
                                                </div>
                                                <div class="control">
                                                   <button class="button is-link is-light" type="Submit" name="login-submit">Login</button>
                                                </div>
                                            </div>
                                        </form>
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                </div>';
                            }
                    ?>

                </div>
        </nav>



