<?php
    if(isset($_POST['task-add'])){
        require 'connect_db.php';
        session_start();
        
        $project_id = $_POST['project-id'];
        $intent_title = $_POST['intent-title'];

        $task_title = $_POST['task-title'];
        $task_description = $_POST['task-description'];
        $task_start_date = $_POST['task-start-date'];
        $task_due_date = $_POST['task-due-date'];

        $sql = "INSERT INTO tasks (title, task_description, task_start_date, task_due_date, intent_title, project_id, task_percentage) VALUES(?, ?, ?, ?, ?, ?, 0)";
        $stmt = mysqli_stmt_init($conn);
        
        // echo $project_id." ".$intent_title. " ". $task_title . " " . $task_description. " ". $task_start_date . " ".$task_due_date;

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssssss", $task_title, $task_description, $task_start_date, $task_due_date, $intent_title, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../intent-info.php?task-add=success&intent-title=". $intent_title . "&project-id=" . $project_id );
            
            exit();
        }
    }

    if(isset($_POST['task-progress'])){
        require 'connect_db.php';
        session_start();
        
        $project_id = $_POST['project-id'];
        $intent_title = $_POST['intent-title'];
        $task_title = $_POST['task-title'];
        
        $task_percentage = $_POST['task-percentage'];
        
        $sql = "UPDATE tasks SET task_percentage=? WHERE project_id=? AND intent_title=? AND title=? ";
        $stmt = mysqli_stmt_init($conn);
        
        // echo $project_id." ".$intent_title. " ". $task_title . " " . $task_description. " ". $task_start_date . " ".$task_due_date;

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ssss", $task_percentage, $project_id, $intent_title, $task_title);
            mysqli_stmt_execute($stmt);
            header("Location: ../intent-info.php?task-progress=success&intent-title=". $intent_title . "&project-id=" . $project_id );
            
            exit();
        }
    }

    if(isset($_POST['task-delete'])){
        require 'connect_db.php';
        session_start();
        
        $project_id = $_POST['project-id'];
        $intent_title = $_POST['intent-title'];

        $task_title = $_POST['task-title'];
        $task_description = $_POST['task-description'];
        $task_start_date = $_POST['task-start-date'];
        $task_due_date = $_POST['task-due-date'];

        $sql = "DELETE FROM tasks WHERE title=? AND intent_title=? AND project_id=?";
        $stmt = mysqli_stmt_init($conn);
        
        // echo $project_id." ".$intent_title. " ". $task_title . " " . $task_description. " ". $task_start_date . " ".$task_due_date;

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "sss", $task_title, $intent_title, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../intent-info.php?task-delete=success&intent-title=". $intent_title . "&project-id=" . $project_id );
            
            exit();
        }
    }

?>