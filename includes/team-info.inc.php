<?php
    if(isset($_POST['remove-member'])){
        require 'connect_db.php';
        
        $member_email = $_POST['member-email'];
        $team_id = $_POST['team-id'];
        
        $sql = "DELETE FROM belongs_to WHERE team_id =? AND user_email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../teams.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $team_id, $member_email);
            mysqli_stmt_execute($stmt);
            header("Location: ../team-info.php?remove-member=success&team-id=".$team_id);
            
            exit();
        }
    }

    if(isset($_POST['add-member'])){
        require 'connect_db.php';
        
        $member_email = $_POST['member-email'];
        $team_id = $_POST['team-id'];

        echo $member_email."".$team_id;
        
        $sql = "INSERT INTO belongs_to (team_id,user_email) VALUES (?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../teams.php?sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "ss", $team_id, $member_email);
            mysqli_stmt_execute($stmt);
            header("Location: ../team-info.php?remove-member=success&team-id=".$team_id);
            
            exit();
        }
    }
?>

