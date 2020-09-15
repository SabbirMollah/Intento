<?php
    require "header.php";
?>

    <main>
    <div class="fdiv">
        <section>
            <h1>Signup</h1>
            <form action="includes/signup.inc.php" method="post">
                <label for="first_name">First Name</label>
                <br>
                <input type="text" name="first_name" placeholder="First Name">
                <br><br>
                <label for="last_name">Last Name</label>
                <br>
                <input type="text" name="last_name" placeholder="Last Name">
                <br><br>
                <label for="email">Email</label>
                <br>
                <input type="text" name="email" placeholder="E-mail">
                <br><br>
                <label for="pwd">Password</label>
                <br>
                <input type="password" name="pwd" placeholder="Password">
                <br><br>
                <label for="pwd">Repeat Password</label>
                <br>
                <input type="password" name="pwd-repeat" placeholder="Repeat password">
                <br><br>
                <button type="submit" name="signup-submit" class="btn">Signup</button>
            </form>
        </section>
    </main>
    </div>
<?php
    require "footer.php";
?>