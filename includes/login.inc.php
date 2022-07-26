<?php
if(isset($_POST['login-submit'])){
    require 'connect_db.php';
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];


    if (empty($email) || empty($pwd)) {
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
                if(strcmp($pwd, $row['passcode']) != 0){
                    header("Location: ../index.php?error=wrongpassword".$pwd."-".$row['passcode']."-".$pwdcheck);
                    exit();
                }
                else{
                    session_start();
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['first_name'] = $row['first_name'];
                    $_SESSION['last_name'] = $row['last_name'];
                    $_SESSION['pwd'] = $row['passcode'];

                    header("Location: ../index.php?login=success");
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

?>