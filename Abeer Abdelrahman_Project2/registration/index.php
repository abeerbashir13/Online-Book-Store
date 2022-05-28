<!DOCTYPE html>
<html>
<head>
     <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
	<title>LOGIN</title>
	<link rel="stylesheet" href = "../style.css">
	<!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
		<body id="adminbody">
			<div class="container">

    	<form class="form1" action="login.php" method="post">

     	<h1 id="h1-admin">User Login</h1>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

		<div>
     	<label>User Name</label>
     	<input type="text" name="username" placeholder="username"><br>

     	<label>Password</label>
     	<input type="password" name="password" placeholder ="password"><br>

     	<button type="submit">Login</button>
		 <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
	<br>
	<p>
		Don't have an account: 
          <a href="signup.php">Register</a>
		  </p>
		  </div>
		</form>
</div>
</body>
</html>