<?php 
session_start();
include('includes/connect_db.php'); 
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Intento</title>
<link rel="icon" href="images/icon.png" type="image/x-icon">




</head>

<body>
<h1>Intento<br/> : : A project management solution : : </h1>

<header>
    
    
    <div>
        <div>
            <?php
                if (isset($_SESSION['email'])) {
                    echo 'Hello '. $_SESSION['last_name'] . '!'.'<nav>
                    <a href="index.php"><img src="images/logo.png" alt="logo"></a>
                    <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href= "teams.php">Teams</a></li>
                    </ul>
                </nav>
            
                    <form action="includes/logout.inc.php" method="post">
                    <button type="Submit" name="logout-submit" class="btn"> Logout </button>
                    </form>';
                }
                else{
                    echo '<nav>
                    <a href="index.php"><img src="images/logo.png" alt="logo"></a>
                    <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">About US</a></li>
                    </ul>
                </nav>
                    <form action="includes/login.inc.php" method="post">
                    <input type="text" name="email" placeholder="E-mail..">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="Submit" name="login-submit" class="btn">Login</button>
                </form>
                <a href="signup.php">Signup</a>';
                }
            ?>
            

        </div>
    </div>
</header>


</body>
</html>