<?php
if(isset($_POST['login-submit'])){
    require 'connectdb.php';
    $mailuid = $_POST['email'];
    $pwd = $_POST['pwd'];


    if (empty($mailuid) || empty($pwd)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdcheck = password_verify($pwd, $row['pwd']);
                if($pwdcheck == false){
                    header("Location: ../index.php?error=wrongpassword");
                    exit();
                }
                else if($pwdcheck == true){
                    session_start();
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['pwd'] = $row['pwd'];

                    header("Location: ../inder.php?error=wrongpassword");
                    exit();

                }
            }
            else{
                header("Location: ../index.php?error=nouser");
            }
        }
    }
}

else{
    header("Location: ../index.php?");
    exit();
}