<?php
    require "header.php";
    require "includes/connect_db.php";
?>

    <main class="main">
        <section class="section">
        <div class="columns">
            <div class="column is-half is-offset-6">
            <div class="notification has-text-centered ">
                <h1 class="title is-4 has-text-weight-bold has-text">Project Info</h1>
                <?php
                    $sql = 'SELECT project_name, project_start_date, owner_email FROM projects WHERE project_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            echo "<b>Project name:</b> " . $row['project_name'] . "</br>"
                                . "<b>Start Date</b>: " . $row['project_start_date'] . "</br></div>";
                        } 
                        else {
                            echo "No info!";
                        }
                    }
                ?>
            </div>
        </div>     
            </section>

            <section class="section has-text single-spaced">
            <div class="columns">
            <div class="column is-one-third is-4">
                    <h1 class="title is-4 has-text-weight-bold has-text-black">Add Intent</h1>
                    <form action="includes/project-info.inc.php" method="post">
                <div class="field">    
                <div class="control has-icons-left has-icons-right">
                    <input class="input is-info" type="text" name="intent-title" placeholder="Intent Title">
                        <span class="icon is-small is-left">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-spinner fa-pulse"></i>
                        </span>
                </div>
            </div>
                <input name="project-id" <?php echo 'value="'. $_GET['project-id'] .'"' ?> hidden/>
                <button type="submit" name="intent-add" class="button">Add an intent</button>
            </form>
            
                
            </section>

            <section class="section has-text-centered single-spaced">
                <h1 class="title is-4 has-text-weight-bold has-text-black">All your intents:</h1>
                <div class="columns">
                <?php
                    $sql = 'SELECT * FROM intents WHERE project_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        $intent_completed = true;
                        if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $intent_completed = true;
                                echo "<div class=\"column\">
                                <div class=\"notification is-info\">
                                <form action=\"includes/project-info.inc.php\" method=\"post\">
                                    <label class=\"label\"><b> ". $row['title'] ."</b></label>
                                    <input name=\"intent-title\" value=\"". $row['title'] ."\"hidden/>
                                    <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                    <input class=\"button is-success is-normal\" type=\"submit\" name=\"intent-info\" value=\"View Intent \" />
                                    <input class=\"button is-danger is-normal\" type=\"submit\" name=\"intent-delete\" value=\"Remove\" />";


                                // Check if all tasks are complete
                                $sql = 'SELECT * FROM tasks WHERE project_id=? AND intent_title=? AND task_percentage!=100';
                                $stmt = mysqli_stmt_init($conn);
                                if (mysqli_stmt_prepare($stmt, $sql)) {
                                    mysqli_stmt_bind_param($stmt, "ss", $_GET['project-id'], $row['title']);
                                    mysqli_stmt_execute($stmt);
                                    $tasks = $stmt->get_result();
                                    if ($tasks->num_rows > 0) {
                                        $intent_completed = false;
                                    }
                                }
                                //
                                if($intent_completed){
                                    echo "  ✅";
                                }
                                else{
                                    echo "  ⭕";
                                }

                                echo "</form></div></div>";
                            }
                        } 
                        else {
                            echo "<div class=\"column\">
                            <div class=\"notification is-info\">
                            No intents in this project yet!
                            </div></div>";
                        }
                    }
                ?>

            </section>

            <section class="section has-text-centered single-spaced">                
            <h1 class="title is-4 has-text-weight-bold has-text-black">Appointed Project Teams</h1>
            <div class="columns">
                <?php

                    $sql = 'SELECT teams.team_id, team_name, team_description FROM teams, appointed_to WHERE teams.team_id = appointed_to.team_id AND project_id=?';
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        
                        mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                        mysqli_stmt_execute($stmt);
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<div class=\"column\">

                                <div class=\"notification is-info\">
                                <form action=\"includes/project-info.inc.php\" method=\"post\">
                                    <label class=\"label\">Team name: ". $row['team_name']. " ". $row['team_description'] ."</label>
                                    <input name=\"project_id\" value=\"". $_GET['project-id'] ."\"hidden/>
                                    <input name=\"team_id\" value=\"". $row['team_id'] ."\"hidden/>
                                    <input class=\"button is-danger is-normal\" type=\"submit\" name=\"remove-team\" value=\"Remove team\" />
                                </form>
                                </div></div>";
                            }
                        }
                        else {
                            echo "<div class=\"column\">
                            <div class=\"notification is-info\">
                            No teams in this project yet!
                            </div>
                            </div>";
                        }
                    }
                ?>
                </div></div>
            </section>


            <section class="section has-text-centered single-spaced">                
            <h1 class="title is-4 has-text-weight-bold has-text-black">Add a team to this project:</h1>
            <div class="columns">

                <form action="includes/project-info.inc.php" method="post">     
                    <?php
                    $sql = 'SELECT * FROM teams, users WHERE leader_email =email';
                    $result = mysqli_query($conn, $sql);
                    $queryResults = mysqli_num_rows($result);
                    if($queryResults > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<div class=\"column\">
                            <div class=\"notification is-info\">
                            <form action=\"includes/project-info.inc.php\" method=\"post\">
                                    <label class=\"label\"><b>". $row['team_name']. "</b><br> ". $row['team_description']."</label>
                                    <br>
                                    <input name=\"team_id\" value=\"". $row['team_id'] ."\"hidden/>
                                    <input name=\"project-id\" value=\"". $_GET['project-id'] ."\"hidden/>
                                    <input class=\"button is-normal\" type=\"submit\" name=\"add-team\" value=\"add team\" />
                                </form>
                                </div></div>";
                        }       
                            
                    }
                    ?>
                    </div>
            </section>
    </main>
<?php
    require "footer.php";
?>