<?php
    require('header.php');
?>

<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Teams you lead</h2>
            <h3 class="section-subheading text-muted">Here are the teams that you have created.</h3>
        </div>
        <div class="row">
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
                            echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">Team '. $row['team_name'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['team_description'] .'</div>
                                    <form action="includes/teams.inc.php" method="post">
                                        <input name="team-id" value="'. $row['team_id'] .'" hidden/>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="team-info" value="Info" />
                                        <input class="btn btn-warning my-2 my-sm-0" type="submit" name="team-delete" value="Delete" />
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
                                    <p> You lead no team! </p>
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
            <h2 class="section-heading text-uppercase">Teams I belong to</h2>
            <h3 class="section-subheading text-muted">Here are the teams were added by other users</h3>
        </div>
        <div class="row">
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
                            echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">Team '. $row['team_name'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['team_description'] .'</div>
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


<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Add a new Team!</h2>
            <h3 class="section-subheading text-muted">Create your own team and add members to it.</h3>
        </div>
        <form action="includes/teams.inc.php" method="post">
            <div>  
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Title" name="title" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Description" name="description" required="required"/>
                </div>
                
            </div>
            <div class="text-center">
                <div id="success"></div>
                <button class="btn btn-primary btn-xl text-uppercase" name="team-create" type="submit">Create Team!</button>
            </div>
        </form>
    </div>
</section>



<?php
    require('footer.php');
?>