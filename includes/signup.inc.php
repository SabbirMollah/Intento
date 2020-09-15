<?php
if(isset($_POST['signup-submit'])){
    require 'connect_db.php';

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwd-repeat'];

    if(empty($firstName) || empty($lastName) || empty($email) || empty($pwd) || empty($pwdRepeat)){
        header("Location: ../signup.php?error=emtyfields&uid=".$firstName."&lastName=".$lastName."&email=".$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstName)){
        header("Location: ../signup.php?error=invalidmailuid");
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../signup.php?error=invalidmail&uid=".$firstName."&lastName=".$lastName);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $firstName)){
        header("Location: ../signup.php?error=invalidname&email=".$lastName."&email=".$email);
        exit();
    }
    else if ($pwd !== $pwdRepeat){
        header("Location: ../signup.php?error=passwordcheck&uid=".$firstName."&lastName=".$lastName."&email=".$email);
        exit();
    }


        else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if($resultcheck > 0){
                header("Location: ../signup.php?error=emailalreadyused=".$firstName."&lastName=".$lastName);
            exit();
            }
            else{
                $sql = "INSERT INTO users (email, first_name, last_name, pwd) VALUES(?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?sqlerror");
                    exit();
                }

                else{
                    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);


                    mysqli_stmt_bind_param($stmt, "ssss", $email, $firstName, $lastName,  $hashpwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
                
            }
        }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else{
    header("Location: ../signup.php?");
    exit();
}
    