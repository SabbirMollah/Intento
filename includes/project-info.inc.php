<?php
    if(isset($_POST['remove-team'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project_id'];
        $team_id = $_POST['team-id'];
        
        $sql = "DELETE FROM appointed_to WHERE team_id =? AND project_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $team_id, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../project-info.php?remove-team=success&team-id=".$team_id);
            
            exit();
        }
    }

    if(isset($_POST['add-team'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project_id'];
        $team_id = $_POST['team-id'];

        echo $project_id."".$team_id;
        
        $sql = "INSERT INTO appointed_to (team_id,project_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $team_id, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../project-info.php?add-team=success&team-id=".$team_id);
            
            exit();
        }
    }


    if(isset($_POST['favorite-project'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project_id'];
        $user_email = $_SESSION['email'];
        
        $sql = "INSERT INTO favorites WHERE project_id =? AND user_email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $project_id, $user_email);
            mysqli_stmt_execute($stmt);
            header("Location: ../project-info.php?favorite-project=success&project-id=".$project_id);
            
            exit();
        }
    }
?>

