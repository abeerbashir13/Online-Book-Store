<?php
session_start();

# if admin login
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
    
# database file
include "../db_conn.php";


# check if category name is submitted

if (isset($_POST['category_name']) &&
   isset($_POST['category_id'])) {

# get data from POST request
$name = $_POST['category_name'];
$id   = $_POST['category_id'];

# form validation
if (empty($name)) {
    $em = "The category name is required";
    header("Location: ../edit-category.php?error=$em&id=$id");
    exit;
}else {
    # update database
    $sql  = "UPDATE categories SET name=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $res  = $stmt->execute([$name, $id]);

# if there is error during insersion
if ($res) {
    # success message
    $sm = "Successfully updated";
    header("Location: ../edit-category.php?success=$sm&id=$id");
    exit;
}else {
    # error message
    $em = "Unknown error occurred";
    header("Location: ../edit-category.php?error=$em&id=$id");
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