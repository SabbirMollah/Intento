<?php
    if(isset($_POST['remove-team'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project_id'];
        $team_id = $_POST['team_id'];
        
        $sql = "DELETE FROM appointed_to WHERE team_id =? AND project_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $team_id, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../project-info.php?remove-team=success&project-id=".$project_id);
            
            exit();
        }
    }

    if(isset($_POST['intent-add'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project-id'];
        $intent_title = $_POST['intent-title'];
        
        $sql = "INSERT INTO intents (title, project_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $intent_title, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../project-info.php?intent-add=success&project-id=".$project_id);
            
            exit();

        }
    }

    if(isset($_POST['intent-delete'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project-id'];
        $intent_title = $_POST['intent-title'];
        
        $sql = "DELETE FROM intents WHERE title=? AND project_id=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $intent_title, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../project-info.php?intent-delete=success&project-id=".$project_id);
            
            exit();

        }
    }

    if(isset($_POST['intent-info'])){
        header("Location: ../intent-info.php?project-id=". $_POST['project-id'] . "&intent-title=". $_POST['intent-title'] );
        exit();
    }

    if(isset($_POST['add-team'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project-id'];
        $team_id = $_POST['team_id'];

        
        $sql = "INSERT INTO appointed_to (team_id, project_id) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $team_id, $project_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../project-info.php?add-team=success&project-id=".$project_id);
            
            exit();

        }
    }


    if(isset($_POST['project-favorite'])){
        require 'connect_db.php';
        
        $project_id = $_POST['project_id'];
        $user_email = $_SESSION['email'];
        
        $sql = "INSERT INTO favorites (project_id, user_email) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../projects.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $project_id, $user_email);
            mysqli_stmt_execute($stmt);
            header("Location: ../projects.inc.php?favorite-project=success&project-id=".$project_id);
            
            exit();
        }
    }
?>

