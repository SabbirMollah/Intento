<?php
    require('header.php');
?>

<section class="page-section bg-light" id="portfolio">
    <div class="container">

    <?php
        require "includes/connect_db.php";
        $sql = 'SELECT team_name, team_description, leader_email FROM teams WHERE team_id=?';
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $_GET['team-id']);
            mysqli_stmt_execute($stmt);
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<div class="text-center">
                    <h2 class="section-heading text-uppercase">'. $row['team_name'] .'</h2>
                    <h3 class="section-subheading text-muted">'. $row['team_description'] .'</h3>
                </div>
                ';
            } 
            else {
                echo "No info!";
            }
        }
    ?>

        <div class="text-center">
            <h2 class="section-heading text-uppercase">Team members</h2>
            <h3 class="section-subheading text-muted">Members that belong to this team</h3>
        </div>
        <div class="row">
            <?php
                require "includes/connect_db.php";

                $sql = 'SELECT first_name, last_name, email FROM users, belongs_to WHERE email=user_email AND team_id=?';
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                            
                    mysqli_stmt_bind_param($stmt, "s", $_GET['team-id']);
                    mysqli_stmt_execute($stmt);
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">'. $row['first_name'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['email'] .'</div>
                                    <form action="includes/team-info.inc.php" method="post">
                                        <input name="team-id" value="'. $_GET['team-id'] .'" hidden/>
                                        <input name="member-email" value="'. $row['email'] .'"hidden/>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="remove-member" value="Remove Member" />
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
                                    <p> This team has no members yet! </p>
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
            <h2 class="section-heading text-uppercase">Add a member to your team!</h2>
            <h3 class="section-subheading text-muted">Add a member to this team.</h3>
        </div>
        <form action="includes/team-info.inc.php" method="post">
            <div>  
                <div class="form-group">
                    <input class="form-control" type="email" placeholder="Email" name="member-email" required="required"/>
                </div>
                <input name="team-id" value= <?php echo '"'. $_GET['team-id'] .'"'; ?>hidden/>
                
            </div>
            <div class="text-center">
                <div id="success"></div>
                <button class="btn btn-primary btn-xl text-uppercase" name="add-member" type="submit">Add member!</button>
            </div>
        </form>
    </div>
</section>

<?php
    require('footer.php');
?>