<?php
    require "header.php";
    require "includes/connect_db.php";
?>

    <main>
        <div>
            <section>
                <h2>Project Info</h2>
                <?php
                    $sql = 'SELECT project_name, project_start_date, owner_email FROM projects WHERE project_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo "Project name: " . $row['project_name'] . "</br>"
                                . "Start Date: " . $row['project_start_date'] . "</br>";
                        } 
                        else {
                            echo "No info!";
                        }
                    }
                ?>
                    
            </section>

            <section>
                <h2>Assigned Project Teams</h2>
                <?php
                    $sql = 'SELECT team_name, team_description, leader_email, project_id FROM teams, assigned_to WHERE teams.team_id=assigned_to.team_id AND teams.team_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <form action=\"includes/project-info.inc.php\" method=\"post\">
                                    <label>Team name: ". $row['team_name']. " ". $row['team_description'] ." - Team Leader's Email:". $row['leader_email'] ."</label>
                                    <input name=\"project-id\" value=\"". $row['project-id'] ."\"hidden/>
                                    <input name=\"team-id\" value=\"". $_GET['team-id'] ."\"hidden/>
                                    <input type=\"submit\" name=\"remove-team\" value=\"Remove team\" />
                                </form>";
                            }
                        } 
                        else {
                            echo "No teams in this project yet!";
                        }
                    }
                ?>

            </section>


            <section>
                <h2>Add a team to this project:</h2>
                <form action="includes/project-info.inc.php" method="post">
                    <label for="team_name">Team name</label>
                    <br>
                    <input type="text" name="team_name" placeholder="team name">
                    <input name="project-id" value= <?php echo '"'. $_GET['project-id'] .'"'; ?>hidden/>
                    <br><br>
                    <button type="submit" name="add-team" class="btn">Add Team</button>
                </form>
            </section>
        </div>
    </main>
<?php
    require "footer.php";
?>