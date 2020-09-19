<?php
if(isset($_POST['project-create'])){
    require 'connect_db.php';
    session_start();
    
    $project_name = $_POST['project_name'];
    $project_start_date = $_POST['project_start_date'];
    $owner_email = $_SESSION['email'];

    $sql = "INSERT INTO projects (project_name, project_start_date, owner_email) VALUES(?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../projects.php?sqlerror");
        
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "sss", $project_name, $project_start_date, $owner_email);
        mysqli_stmt_execute($stmt);
        header("Location: ../projects.php?create-project=success");
        
        exit();
    }
}

if(isset($_POST['project-info'])){
    header("Location: ../project-info.php?project-id=". $_POST['project-id'] );
    exit();
}

if(isset($_POST['project-delete'])){
    require 'connect_db.php';
    session_start();
    
    $project_id = $_POST['project-id'];
    
    $sql = "DELETE FROM projects WHERE project_id =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../projects.php?sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $project_id);
        mysqli_stmt_execute($stmt);
        header("Location: ../projects.php?project-delete=success");
        
        exit();
    }
}


if(isset($_POST['project-favorite'])){
    require 'connect_db.php';
    session_start();
    
    $project_id = $_POST['project-id'];
    $user_email = $_SESSION['email'];

    $sql = "INSERT INTO favorites (project_id, user_email) VALUES(?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../projects.php?sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "ss", $project_id, $user_email);
        mysqli_stmt_execute($stmt);
        header("Location: ../projects.php?project-favorite=success");
        
        exit();
    }
}
?>