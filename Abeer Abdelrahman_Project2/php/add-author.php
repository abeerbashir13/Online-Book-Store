<?php
session_start();

# if admin login
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
    
# database file
include "../db_conn.php";


# check if author name is submitted

if (isset($_POST['author_name'])) {
# get data from POST request
$name = $_POST['author_name'];


# form validation
if (empty($name)) {
    $em = "The author name is required";
    header("Location: ../add-author.php?error=$em");
    exit;
}else {
    # insert into data base
    $sql = "INSERT INTO authors (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$name]);

# if there is error during insersion
if ($res) {
    # success message
    $sm = "Successfully created";
    header("Location: ../add-author.php?success=$sm");
    exit;
}else {
    # error message
    $em = "Unknown error occurred";
    header("Location: ../add-author.php?error=$em");
    exit;
}
}


}else {
    header("Location: admin.php");
    exit;
}

} else {
    header("Location: login.php");
    exit;
} ?>