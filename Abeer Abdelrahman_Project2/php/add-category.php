<?php
session_start();

# if admin login
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
    
# database file
include "../db_conn.php";


# check if category name is submitted

if (isset($_POST['category_name'])) {
# get data from POST request
$name = $_POST['category_name'];


# form validation
if (empty($name)) {
    $em = "The category name is required";
    header("Location: ../add-category.php?error=$em");
    exit;
}else {
    # insert into data base
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$name]);

# if there is no error during insersion
if ($res) {
    # success message
    $sm = "Successfully created";
    header("Location: ../add-category.php?success=$sm");
    exit;
}else {
    # error message
    $em = "Unknown error occurred";
    header("Location: ../add-category.php?error=$em");
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