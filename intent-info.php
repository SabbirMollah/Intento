<?php
    require "header.php";
?>

    <main class="main">
           
        <section class="section">
        <div class="columns">
            <div class="column is-one-third is-4">
                <h3 class="title">Add Task</h3>

        
            <form action="includes/intent-info.inc.php" method="post">
            <div class="field">
                <label for="title" class="label">Title</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" name="task-title" placeholder="Task Title">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-icon"></i>
                        </span>
                </div>
            </div>

            <div class="field">
                <label class="label" for="Description">Description</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" name="task-description" placeholder="Task Description">
                        <span class="icon is-small is-left">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="icon is-small is-right">
                            <i class="fas fa-spinner fa-pulse"></i>
                        </span>
                </div>
            </div>

            <div class="field">
                <label class="label" for="Start Date">Start Date</label>
                <div class="control has-icons-left">
                    <input class="input is-info" type="date" name="task-start-date">
                        <span class="icon is-small is-left">
                            <i class="fas fa-info-circle"></i>
                        </span>
                </div>
            </div>
            <div class="field">
                <label class="label" for="Due Date">Due Date</label>
                <div class="control has-icons-left">    
                    <input class="input" type="date" name="task-due-date">
                        <span class="icon is-small is-left">
                            <i class="fas fa-info-circle"></i>
                        </span>
                </div>
            </div>
                
                <input name="project-id" <?php echo 'value="'. $_GET['project-id'] .'"' ?> hidden/>
                <input name="intent-title" <?php echo 'value="'. $_GET['intent-title'] .'"' ?> hidden/>
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" name="task-add" class="button is-info">Add a task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
                
            </section>

            <section class="section has-text-centered single-spaced">
                <h1 class="title is-4 has-text-weight-bold has-text-black">Tasks in this intent:</h1>
                <div class="columns">
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
                                echo "<div class=\"column\">
                                <div class=\"notification is-info\">
                                <form action=\"includes/intent-info.inc.php\" method=\"post\">
                                <label><h1 class=\"title is-size-4\"> ". $row['title'] ."</h1></label>
                                <br>
                                <label><b>Description:</b> ". $row['task_description'] ."</label>
                                <br>
                                <label> <b>Start date:</b> ". $row['task_start_date'] ."</label>
                                <br>
                                <label><b>Due date: </b>". $row['task_due_date'] ."</label>
                                <br><br>
                                <b>Percentage:</b> <input id=\"sliderWithValue\" class=\"slider has-output is-large is-danger is-circle\" step=\"1\" name=\"task-percentage\" type=\"range\" min=\"1\" max=\"100\" value=\"".$row['task_percentage']."\">
                                <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                <input name=\"intent-title\" value=\"". $row['intent_title'] ."\"hidden/>
                                <input name=\"task-title\" value=\"". $row['title'] ."\"hidden/>
                                <br>
                                <br>
                                <input class=\"button is-success is-normal\" type=\"submit\" name=\"task-progress\" value=\"Update\" />
                                <input class=\"button is-danger is-normal\" type=\"submit\" name=\"task-delete\" value=\"Delete\" />
                                </form>
                                </div></div>";
                            }
                        } 
                        else {
                            echo "Your teams are not appointed to any projects yet!";
                        }
                    }
                ?>
                </div>
            </section>
            
        </div>
    </main>

            <script>  
                bulmaSlider.attach();
            </script>  
<?php
    require "footer.php";
?>