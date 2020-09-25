<?php
    require "header.php";
?>

    <main>
    <div>
        <section class="section no-margin">
            <div class="container">
                <div class="columns">
                    <div class="column"></div>
                    <div class="column"></div>
                    <div class="column">
                    <h1 class="title is-4 has-text-black has-text-centered">Signup</h1>
                        <form action="includes/signup.inc.php" method="post">
                            
                            <div class="field">
                                <label for="first_name" class="label">First Name</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input type="text" class="input" name="first_name" placeholder="First Name">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fas fa-icon"></i>
                                        </span>
                                    </div>
                            </div>
                            
                            <div class="field">
                                <label for="last_name" class="label">Last Name</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input type="text" class="input" name="last_name" placeholder="Last Name">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fas fa-icon"></i>
                                        </span>
                                    </div>
                            </div>

                            <div class="field">
                                <label for="email" class="label">Email</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input type="email" class="input" name="email" placeholder="E-mail">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                            <i class="fas fa-triangle"></i>
                                        </span>
                                    </div>
                            </div>

                            <div class="field">
                            <label for="pwd" class="label">Password</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="pwd" placeholder="Password">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                </div>
                            </div>

                            <div class="field">
                            <label for="pwd" class="label">Password</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="pwd-repeat" placeholder="Repeat password">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                </div>
                            </div>
                                <br><br>
                                                        
                                <div class="control">               
                                    <button class="button is-link" type="submit" name="signup-submit" class="btn">Signup</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    </div>
<?php
    require "footer.php";
?>