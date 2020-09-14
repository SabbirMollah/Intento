<?php include('includes/connect_db.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style.css">


</head>

<body>

<div class="main_wrap">

<h1>Intento<br/> : : A project management solution : : </h1>
<div id= "header" class="menu">
    <ul class="navigation">
	    <li><a href="index.php">Home</a></li>
        <li><a href="#">About US</a></li>
    </ul>
    <div class="divf">
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="email" placeholder="E-mail..">
        <br>

        <input type="password" name="password" placeholder="Password">
        <br><br>
        <button type="Submit" name="login-submit" class="btn">Login</button>
    </form>
    </div>
    <a href="signup.php">Signup</a>

    <form action="includes/logout.inc.php" method="post">
        <button type="Submit" name="logout-submit" class="btn" >Logout</button>
    </form>

</div>
</div>

</body>
</html>