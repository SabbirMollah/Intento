<?php
    require('header.php');
?>


<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Projects I have favorited</h2>
        </div>
        <div class="row">
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
                        echo '<div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">'. $row['project_name'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['project_start_date'] .'</div>
                                    <form action="includes/projects.inc.php" method="post">
                                        <input name="project-id" value="'. $row['project_id'] .'"hidden/>
                                        <input name="user-email" value="'. $_SESSION['email'] .'"hidden/>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="project-info" value="Info" />
                                        <input class="btn btn-warning my-2 my-sm-0" type="submit" name="favorite-delete" value="Unfavorite" />
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
                            <p> You have no favorited projects! </p>
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
            <h2 class="section-heading text-uppercase">Projects I have created</h2>
        </div>
        <div class="row">
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
                        echo '<div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">'. $row['project_name'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['project_start_date'] .'</div>
                                    <form action="includes/projects.inc.php" method="post">
                                        <input name="project-id" value="'. $row['project_id'] .'"hidden/>
                                        <input name="user-email" value="'. $_SESSION['email'] .'"hidden/>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="project-info" value="Info" />
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="project-favorite" value="Favorite" />
                                        <input class="btn btn-warning my-2 my-sm-0" type="submit" name="project-delete" value="Remove" />
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
                            <p> You have not created any projects! </p>
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
            <h2 class="section-heading text-uppercase">Projects I am appointed to</h2>
        </div>
        <div class="row">
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
                        echo '<div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">'. $row['project_name'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['project_start_date'] .'</div>
                                    <form action="includes/projects.inc.php" method="post">
                                        <input name="project-id" value="'. $row['project_id'] .'"hidden/>
                                        <input name="team-id" value="'. $row['team_id'] .'"hidden/>
                                        <input name="user-email" value="'. $_SESSION['email'] .'"hidden/>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                        </div>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="project-info" value="Info" />
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
                            <p> Your teams were not appointed to any projects! </p>
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
            <h2 class="section-heading text-uppercase">Add a new Project!</h2>
            <h3 class="section-subheading text-muted">Create your own project and assign teams to it.</h3>
        </div>
        <form action="includes/projects.inc.php" method="post">
            <div>  
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Project Title" name="project_name" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" placeholder="Description" name="project_start_date" required="required"/>
                </div>
                
            </div>
            <div class="text-center">
                <div id="success"></div>
                <button class="btn btn-primary btn-xl text-uppercase" name="project-create" type="submit">Create Project!</button>
            </div>
        </form>
    </div>
</section>


<?php
    require('footer.php');
?>