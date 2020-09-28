<?php
    require('header.php');
    require "includes/connect_db.php";
?>

<section class="page-section bg-light" id="portfolio">
    <div class="container">

    <?php
        $sql = 'SELECT project_name, project_start_date, owner_email FROM projects WHERE project_id=?';
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<div class="text-center">
                    <h2 class="section-heading text-uppercase">'. $row['project_name'] .'</h2>
                    <h3 class="section-subheading text-muted">'. $row['project_start_date'] .'</h3>
                </div>
                ';
            } 
            else {
                echo "No info!";
            }
        }
    ?>

        <div class="text-center">
            <h2 class="section-heading text-uppercase">Intents</h2>
            <h3 class="section-subheading text-muted">Intents that belong to this project</h3>
        </div>
        <div class="row">
            <?php
                require "includes/connect_db.php";

                $sql = 'SELECT * FROM intents WHERE project_id=?';                
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                            
                    mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                    mysqli_stmt_execute($stmt);
                    $result = $stmt->get_result();
                    $intent_completed = true;
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">'. $row['title'].'</div>
                                    <form action="includes/project-info.inc.php" method="post">
                                        <input name="project-id" value="'. $row['project_id'] .'"hidden/>
                                        <input name="intent-title" value="'. $row['title'] .'"hidden/>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="intent-info" value="View" />
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="intent-delete" value="Delete" />';
                            
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
                                echo '<div class="portfolio-item">Completed ✅</div>';
                            }
                            else{
                                echo '<div class="portfolio-item">In progress 🟡</div>';
                            }

                            echo '
                                    </form>
                                </div>

                                </div>
                            </div>';
                        }
                    } 
                    else {
                        echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <p> No intents in this project yet! </p>
                                </div>

                                </div>
                            </div>';
                    }
                }
            ?>
        </div>
    </div>
</section>  

<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Add a new Intent!</h2>
            <h3 class="section-subheading text-muted">Create your own Intent and manage tasks.</h3>
        </div>
        <form action="includes/project-info.inc.php" method="post">
            <div>  
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Title" name="intent-title" required="required"/>
                </div>
                         
            </div>
            <div class="text-center">
                <div id="success"></div>
                <input name="project-id" <?php echo 'value="'. $_GET['project-id'] .'"' ?> hidden/>
                <button class="btn btn-primary btn-xl text-uppercase" name="intent-add" type="submit">Add intent!</button>
            </div>
        </form>
    </div>
</section>

<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Teams appointed to this project</h2>
            <h3 class="section-subheading text-muted">Here are the teams were appointed to this project.</h3>
        </div>
        <div class="row">
            <?php
                require "includes/connect_db.php";

                $sql = 'SELECT teams.team_id, team_name, team_description FROM teams, appointed_to WHERE teams.team_id = appointed_to.team_id AND project_id=?';
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                            
                    mysqli_stmt_bind_param($stmt, "s", $_GET['project-id']);
                    mysqli_stmt_execute($stmt);
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                <form action="includes/project-info.inc.php" method="post">
                                    <div class="portfolio-caption-heading">Team '. $row['team_name'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['team_description'] .'</div>
                                    <input name="project_id" value="'. $_GET['project-id'] .'"hidden/>
                                    <input name="team_id" value="'. $row['team_id'] .'"hidden/>
                                    <input class="btn btn-warning" type="submit" name="remove-team" value="Remove team" />
                                </form>
                                </div>

                                </div>
                            </div>';
                        }
                    } 
                    else {
                        echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <p> You belong to no teams! </p>
                                </div>

                                </div>
                            </div>';
                    }
                }
            ?>
            
        </div>
    </div>
</section>    

<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Add a team to this project!</h2>
        </div>
        <div class="row">
            <?php
                require "includes/connect_db.php";

                $sql = 'SELECT * FROM teams, users WHERE leader_email = email';
                    $result = mysqli_query($conn, $sql);
                    $queryResults = mysqli_num_rows($result);
                    if($queryResults > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">Team '. $row['team_name'].'</div>
                                    <form action="includes/project-info.inc.php" method="post">
                                        <input name="team_id" value="'. $row['team_id'] .'" hidden/>
                                        <input name="project-id" value="'. $_GET['project-id'] .'" hidden/>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="add-team" value="Add team." />
                                    </form>
                                </div>

                                </div>
                            </div>';
                        }
                    } 
                    else {
                        echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                    <div class="portfolio-caption portfolio-hover-content">
                                        <p> You belong to no teams! </p>
                                    </div>
                                </div>
                            </div>';
                    }
                
            ?>
            
        </div>
    </div>
</section>               
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    
                    
                    
                    
                    

<?php
    require('footer.php');
?>