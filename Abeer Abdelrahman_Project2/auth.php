<?php
session_start();

if (isset($_POST['email']) &&
    isset($_POST['password'])) {

        include "db_conn.php";
        include "func-validation.php";

    # get data from POST request
        
        $email    = $_POST['email'];
        $password = $_POST['password'];

        # form validation
        $text = "Email";
        $location = "login.php";
        $ms = "error";
        is_empty($email, $text, $location, $ms, "");

        $text = "Password";
        $location = "login.php";
        $ms = "error";
        is_empty($password, $text, $location, $ms, "");

        $sql  = "SELECT * FROM admin WHERE email=?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);

        # if email exit 
        if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();
    
        $user_id       = $user['id'];
        $user_email    = $user['email'];
        $user_password = $user['password'];
        if ($email === $user_email) {
                if (password_verify($password, $user_password)) {
                    $_SESSION['user_id']    = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    header("Location: admin.php");
        }else {
            # Error message
            $em = "Incorrect User name or password";
            header("Location: login.php?error=$em");
        }
    }else {
        # Error message
        $em = "Incorrect User name or password";
        header("Location: login.php?error=$em");
    }
}else{
    # Error message
    $em = "Incorrect User name or password";
    header("Location: login.php?error=$em");
}

}else {
# Redirect to "login.php"
header("Location: login.php");
}