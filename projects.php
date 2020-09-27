<?php
    require "header.php";
?>

    <main class="main">
 
        
            <section class="section">
                <div class="columns">
                    <div class="column is-one-third is-4">
                        <form action="includes/projects.inc.php" method="post">
                            <div class="field">
                                <label for="project_name" class="label">Project Title</label>
                            <div class="control has-icons-left has-icons-right">
                                <input class="input is-info" type="text" name="project_name" placeholder="Project Title">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="icon is-small is-right">
                                    <i class="fas fa-spinner fa-pulse"></i>
                                </span>
                            </div>
                            </div>

                            <div class="field">
                                <label for="project_start_date" class="label">Project Start Date</label>
                                <div class="control has-icons-left">
                                    <input class="input is-info" type="date" name="project_start_date">
                                    <span class="icon is-small is-left">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-info is-outlined is-inverted" type="submit" name="project-create">Create New Project</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="column"></div>
                    <div class="column"></div>
                </div>
            </section>
            
            <section class="section has-text-centered single-spaced">
            <h1 class="title is-4 has-text-weight-bold has-text-black">Projects I Favorited</h1>
                <div class="columns">
                    <?php
                    require "includes/connect_db.php";

                    $sql = 'SELECT projects.project_id, project_name, project_start_date, user_email FROM projects, favorites WHERE favorites.project_id = projects.project_id AND user_email=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                
                                echo "<div class=\"column\">
                                <div class=\"notification is-info\">
                                <form action=\"includes/projects.inc.php\" method=\"post\">
                                    <label><h1 class=\"title is-size-4\"> ". $row['project_name'] ."</h1></label>
                                    <label><h2> <b>Start date:</b> ". $row['project_start_date'] ."</h2></label>
                                    <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                    <input name=\"user-email\" value=\"". $_SESSION['email'] ."\"hidden/>
                                    <br>
                                    <input class=\"button is-success is-normal\" type=\"submit\" name=\"project-info\" value=\"Info\" />
                                    <input class=\"button is-danger is-normal\" type=\"submit\" name=\"favorite-delete\" value=\"Delete\" />
                                </form>
                                </div>
                                </div>";                                
                                }
                            }
                        else {
                            echo "<div class=\"column\">
                            <div class=\"notification is-info\">
                            You haven't favorited any projects yet!
                            </div>
                            </div>";
                        }
                    }
                    ?>
                </div>
            </section>

            <br><br>


            <section class="section has-text-centered single-spaced">
                <h1 class="title is-4 has-text-weight-bold has-text-black">Projects I Created</h1>
                <div class="columns">
                <?php
                    require "includes/connect_db.php";

                    $sql = 'SELECT project_id, project_name, project_start_date, owner_email FROM projects WHERE owner_email=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <div class=\"column\">
                                    <div class=\"notification is-info\">
                                        <form action=\"includes/projects.inc.php\" method=\"post\">
                                            <label<h1 class=\"title is-size-4\"> ". $row['project_name'] ."</h1></label>
                                            <label><h2> <b>Start date:</b> ". $row['project_start_date'] ."</h2></label>
                                            <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                            <br>
                                            <input class=\"button is-success is-normal\" type=\"submit\" name=\"project-info\" value=\"Info\" />
                                            <input class=\"button is-danger is-normal\" type=\"submit\" name=\"project-delete\" value=\"Delete\" />
                                            <br>
                                            <input class=\"button is-info is-normal\" type=\"submit\" name=\"project-favorite\" value=\"Add to Favorites\" />
                                        </form>
                                    </div>
                                </div>
                                ";
                            }
                        }
                        else {
                            echo "<div class=\"column\">
                            <div class=\"notification is-info\">
                            You haven't created any projects yet!
                            </div>
                            </div>";
                        }
                    } 
                    ?>
                </div>
            </section>
            
            <section class="section has-text-centered single-spaced">
                <h1 class="title is-4 has-text-weight-bold has-text-black">Projects I am appointed to</h1>
                <div class="columns">
                    
                <?php
                    require "includes/connect_db.php";

                    $sql = 'SELECT appointed_to.team_id, appointed_to.project_id, project_name, project_start_date, owner_email FROM projects, appointed_to WHERE projects.project_id = appointed_to.project_id AND owner_email= ?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<div class=\"column\">
                                <div class=\"notification is-info\">
                                <form action=\"includes/projects.inc.php\" method=\"post\">
                                    <label><h1 class=\"title is-size-4\"> ". $row['project_name'] ."</h1></label>
                                    <label><h1><b>Start date:</b> ". $row['project_start_date'] ."</h1></label>
                                    <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                    <input name=\"team-id\" value=\"". $row['team_id'] ."\"hidden/>
                                    <br>
                                    <input class=\"button is-success is-normal\" type=\"submit\" name=\"project-info\" value=\"Info\" />
                                </form>
                                </div>
                                </div>";
                            }
                        } 
                        else {
                            echo "<div class=\"column\">
                            <div class=\"notification is-info\">
                            Your teams are not appointed to any projects yet!
                            </div>
                            </div>";
                        }
                    }
                ?>
                </div>
            </section>

            
    </main>
<?php
    require "footer.php";
?>