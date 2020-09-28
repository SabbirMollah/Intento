<?php
    require('header.php');
?>

<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Sign Up Here!</h2>
            <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
        </div>
        <form action="includes/signup.inc.php" method="post">
            <div>  
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="First Name" name="first_name" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Last Name" name="last_name" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Email" name="email" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Password" name="pwd" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Repeat Password" name="pwd-repeat" required="required"/>
                </div>
            </div>
            <div class="text-center">
                <div id="success"></div>
                <button class="btn btn-primary btn-xl text-uppercase" name="signup-submit" type="submit">Signup!</button>
            </div>
        </form>
    </div>
</section>

<?php
    require('footer.php');
?>