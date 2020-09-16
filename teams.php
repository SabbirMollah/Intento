<?php
    require "header.php";
?>

    <main>
        <div>
            <section>
            <form action="includes/teams.inc.php" method="post">
                <label for="title">Title</label>
                <br>
                <input type="text" name="title" placeholder="Team Title">
                <br><br>
                <label for="description">Description</label>
                <br>
                <input type="text" name="description" placeholder="Last Name">
                <br><br>
                
                <button type="submit" name="team-create" class="btn">Create New Team</button>
            </form>
                
   
            </section>

            <section>
                <h2>Teams I lead</h2>
                <?php
                    require "includes/connect_db.php";

                    $sql = 'SELECT team_id, team_name, team_description FROM teams WHERE leader_email=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <form action=\"includes/teams.inc.php\" method=\"post\">
                                    <label>Team name: ". $row['team_name'] ."</label>
                                    <label>Team description: ". $row['team_description'] ."</label>
                                    <input name=\"team-id\" value=\"". $row['team_id'] ."\"hidden/>
                                    <input type=\"submit\" name=\"team-info\" value=\"Info\" />
                                    <input type=\"submit\" name=\"team-delete\" value=\"Delete\" />
                                </form>";
                            }
                        } 
                        else {
                            echo "You lead no teams!";
                        }
                    }
                ?>

            </section>
            
            <section>
                <h2>Teams I belong to</h2>
                <?php
                    require "includes/connect_db.php";

                    $sql = 'SELECT teams.team_id, team_name, team_description, leader_email FROM teams, belongs_to WHERE teams.team_id = belongs_to.team_id AND user_email=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <form action=\"includes/teams.inc.php\" method=\"post\">
                                    <label>Team name: ". $row['team_name'] ."</label>
                                    <label>Team description: ". $row['team_description'] ."</label>
                                    <input name=\"team-id\" value=\"". $row['team_id'] ."\"hidden/>
                                    <input type=\"submit\" name=\"team-info\" value=\"Info\" />
                                </form>";
                            }
                        } 
                        else {
                            echo "You belong to no teams!";
                        }
                    }
                ?>

            </section>
        </div>
    </main>
<?php
    require "footer.php";
?>