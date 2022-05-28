<?php 
session_start();

if (isset($_SESSION['id']) && 
isset($_SESSION['username'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="">
</head>
<body >
     <h1>Hello</h1>
     <a href="../index1.php">Welcome to your Online Store</a>
     <a href="logout.php">Logout</a>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>

