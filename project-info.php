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
                <h2>Appointed Project Teams</h2>
                <?php


                    $sql = 'SELECT teams.team_id, team_name, team_description FROM teams, appointed_to WHERE teams.team_id = appointed_to.team_id AND project_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "
                                <form action=\"includes/project-info.inc.php\" method=\"post\">
                                    <label>Team name: ". $row['team_name']. " ". $row['team_description'] ."</label>
                                    <input name=\"project_id\" value=\"". $_GET['project-id'] ."\"hidden/>
                                    <input name=\"team_id\" value=\"". $row['team_id'] ."\"hidden/>
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

                    <div>
                    <?php
                    $sql = 'SELECT * FROM teams, users WHERE leader_email =email';
                    $result = mysqli_query($conn, $sql);
                    $queryResults = mysqli_num_rows($result);
                    if($queryResults > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<form action=\"includes/project-info.inc.php\" method=\"post\">
                                    <label>Team name: ". $row['team_name']. " ". $row['team_description']."</label>
                                    <input name=\"team_id\" value=\"". $row['team_id'] ."\"hidden/>
                                    <input name=\"project-id\" value=\"". $_GET['project-id'] ."\"hidden/>
                                    <input type=\"submit\" name=\"add-team\" value=\"add team\" />
                                </form>";

                        }       
                            
                    }
                    ?>
                    </div>
            </section>
        </div>
    </main>
<?php
    require "footer.php";
?>