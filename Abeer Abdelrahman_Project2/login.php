<?php  
session_start();

# If the admin is logged in
if (!isset($_SESSION['user_id']) &&
    !isset($_SESSION['user_email'])) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
     <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
        <title>Login</title>
        <link rel="stylesheet" href = "style.css">
    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    </head>
     <body id="adminbody">
 <div class="container">
     <form class="form1" action ="auth.php" method ="POST">
     
     <h1 id="h1-admin">Admin Login</h1>
    <?php if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger" role="alert">
       <?=htmlspecialchars($_GET['error']); ?>
    </div>
    <?php } ?>

    <div>
        <label>Email Address</label>
        <input type="email" name="email">
            
        <label>Password</label>
        <input type="password" name="password">
        
        <button type="submit">Login</button>
        <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
            </div>
        </form>
        </div>
    </body>
</html>
<?php }else{
  header("Location: admin.php");
  exit;
} ?>
