<?php
if(isset($_POST['team-create'])){
    require 'connect_db.php';
    session_start();
    
    $title = $_POST['title'];
    $description = $_POST['description'];
    $email = $_SESSION['email'];
    
    $sql = "INSERT INTO teams (team_name, team_description, leader_email) VALUES(?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../teams.php?sqlerror");
        
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "sss", $title, $description, $email);
        mysqli_stmt_execute($stmt);
        header("Location: ../teams.php?create-team=success");
        
        exit();
    }
}

if(isset($_POST['team-info'])){
    header("Location: ../team-info.php?team-id=". $_POST['team-id'] );
    exit();
}

if(isset($_POST['team-delete'])){
    require 'connect_db.php';
    session_start();
    
    $team_id = $_POST['team-id'];
    
    $sql = "DELETE FROM teams WHERE team_id =?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../teams.php?sqlerror");
        exit();
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $team_id);
        mysqli_stmt_execute($stmt);
        header("Location: ../teams.php?team-delete=success");
        
        exit();
    }
}
?>