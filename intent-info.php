<?php
    require('header.php');
?>

<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Tasks in this project</h2>
            <h3 class="section-subheading text-muted">Check out the tasks here!.</h3>
        </div>
        <div class="row">
            <?php
                require "includes/connect_db.php";

                $sql = 'SELECT * FROM tasks WHERE project_id = ? AND intent_title= ?';
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                            
                    mysqli_stmt_bind_param($stmt, "ss", $_GET['project-id'], $_GET['intent-title']);
                    mysqli_stmt_execute($stmt);
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="portfolio-item">
                                <div class="portfolio-caption portfolio-hover-content">
                                    <div class="portfolio-caption-heading">Team '. $row['title'].'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['task_description'] .'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['task_start_date'] .'</div>
                                    <div class="portfolio-caption-subheading text-muted">'. $row['task_due_date'] .'</div>
                                    <form action="includes/intent-info.inc.php" method="post">
                                        <input name="task-percentage" type="range" min="1" max="100" value="'.$row['task_percentage'].'">
                                        <input name="intent-title" value="'. $row['intent_title'] .'" hidden/>
                                        <input name="project-id" value="'. $row['project_id'] .'" hidden/>
                                        <input name="task-title" value="'. $row['title'] .'" hidden/>
                                        <input class="btn btn-success my-2 my-sm-0" type="submit" name="task-progress" value="Update" />
                                        <input class="btn btn-warning my-2 my-sm-0" type="submit" name="task-delete" value="Delete" />
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
                                    <p> This Intent has no task yet! </p>
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
            <h2 class="section-heading text-uppercase">Add task.</h2>
            <h3 class="section-subheading text-muted">Add a task from here.</h3>
        </div>
        <form action="includes/intent-info.inc.php" method="post">
            <div>  
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Task Title" name="task-title" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Task Description" name="task-description" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" placeholder="Start Date" name="task-start-date" required="required"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="date" placeholder="Due date" name="task-due-date" required="required"/>
                </div>
            </div>
            <div class="text-center">
                <div id="success"></div>
                <input name="project-id" <?php echo 'value="'. $_GET['project-id'] .'"' ?> hidden/>
                <input name="intent-title" <?php echo 'value="'. $_GET['intent-title'] .'"' ?> hidden/>
                <button class="btn btn-primary btn-xl text-uppercase" name="task-add" type="submit">Add New Task</button>
            </div>
        </form>
    </div>
</section>

<?php
    require('footer.php');
?>