<?php
    require "header.php";
?>

    <main>
        <div>    
        <section>
            <h3>Add Task</h3>

        
            <form action="includes/intent-info.inc.php" method="post">
                <label for="title">Title</label>
                <br>
                <input type="text" name="task-title" placeholder="Task Title">
                <br><br>
                <label for="Description">Description</label>
                <br>
                <input type="text" name="task-description" placeholder="Task Description">
                <br><br>
                <label for="Start Date">Start Date</label>
                <br>
                <input type="date" name="task-start-date">
                <br><br>
                <label for="Due Date">Due Date</label>
                <br>
                <input type="date" name="task-due-date">
                <br><br>
                
                <input name="project-id" <?php echo 'value="'. $_GET['project-id'] .'"' ?> hidden/>
                <input name="intent-title" <?php echo 'value="'. $_GET['intent-title'] .'"' ?> hidden/>
                <button type="submit" name="task-add" class="btn">Add a task</button>
            </form>
                
            </section>

            <section>
                <h2>Tasks in this intent:</h2>
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
                                echo "
                                <form action=\"includes/intent-info.inc.php\" method=\"post\">
                                    <label>Task title: ". $row['title'] ."</label>
                                    <label>Task Description: ". $row['task_description'] ."</label>
                                    <label>Start date: ". $row['task_start_date'] ."</label>
                                    <label>Due date: ". $row['task_due_date'] ."</label>
                                    Percentage: <input name=\"task-percentage\" type=\"range\" min=\"1\" max=\"100\" value=\"".$row['task_percentage']."\">
                                    <input name=\"project-id\" value=\"". $row['project_id'] ."\"hidden/>
                                    <input name=\"intent-title\" value=\"". $row['intent_title'] ."\"hidden/>
                                    <input name=\"task-title\" value=\"". $row['title'] ."\"hidden/>
                                    <input type=\"submit\" name=\"task-progress\" value=\"Update\" />
                                    <input type=\"submit\" name=\"task-delete\" value=\"Delete\" />
                                </form>";
                            }
                        } 
                        else {
                            echo "Your teams are not appointed to any projects yet!";
                        }
                    }
                ?>

            </section>

            
        </div>
    </main>
<?php
    require "footer.php";
?>