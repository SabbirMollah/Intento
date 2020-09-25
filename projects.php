<?php
    require "header.php";
?>

    <main class="main">
 
        
            <section>
                <div class="column">
                    <form action="includes/projects.inc.php" method="post">
                        <label for="project_name">Project Title</label>
                        <br>
                        <input type="text" name="project_name" placeholder="Project Title">
                        <br><br>
                        <label for="project_start_date">Project Start Date</label>
                        <br>
                        <input type="date" name="project_start_date">
                        <br><br>
                        
                        <button type="submit" name="project-create" class="btn">Create New Project</button>
                    </form>
                </div>
            </section>
            <div class="columns">
            <section>
                <div class="column">
                    <div class="notification">
                        <h2>Projects I Favorited</h2>
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
                                
                                echo "
                                <form action=\"includes/projects.inc.php\" method=\"post\">
                                    <label>Project name: ". $row['project_name'] ."</label>
                                    <label>Project start date: ". $row['project_start_date'] ."</label>
                                    <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                    <input name=\"user-email\" value=\"". $_SESSION['email'] ."\"hidden/>
                                    <br>
                                    <input type=\"submit\" name=\"project-info\" value=\"Info\" />
                                    <input type=\"submit\" name=\"favorite-delete\" value=\"Delete\" />
                                </form>";                                
                                }
                            }
                        else {
                            echo "You haven't favorited any projects yet!";
                        }
                    }
                    ?>
                </div>
                </div>
            </section>


            <section>
                <div class="column">
                <div class="notification">
                    <h2>Projects I Created</h2>
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
                                <form action=\"includes/projects.inc.php\" method=\"post\">
                                    <label>Project name: ". $row['project_name'] ."</label>
                                    <label>Project start date: ". $row['project_start_date'] ."</label>
                                    <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                    <input type=\"submit\" name=\"project-info\" value=\"Info\" />
                                    <input type=\"submit\" name=\"project-favorite\" value=\"Add Favorite\" />
                                    <input type=\"submit\" name=\"project-delete\" value=\"Delete\" />
                                </form>";
                            }
                        }
                        else {
                            echo "You haven't created any projects yet!";
                        }
                    }
                ?>
                </div>
                </div>

            </section>
            
            <section>
                <div class="column">
                <div class="notification">
                <h2>Projects I am appointed to</h2>
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
                                echo "
                                <form action=\"includes/projects.inc.php\" method=\"post\">
                                    <label>Project name: ". $row['project_name'] ."</label>
                                    <label>Start date: ". $row['project_start_date'] ."</label>
                                    <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                    <input name=\"team-id\" value=\"". $row['team_id'] ."\"hidden/>
                                    <input type=\"submit\" name=\"project-info\" value=\"Info\" />
                                </form>";
                            }
                        } 
                        else {
                            echo "Your teams are not appointed to any projects yet!";
                        }
                    }
                ?>
            </div>
            </div>
            </section>

            
        </div>
    </main>
<?php
    require "footer.php";
?>