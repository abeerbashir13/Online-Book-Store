<?php 
session_start();


?>

<!DOCTYPE html>
<html lang="en" id="main">
    <head>
     <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
        <title>Wellcome</title>
        <link rel="stylesheet" href = "style.css">
        <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </head>

    <body id="mainpage">
       
<div id="nav">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
		<a class="navbar-brand" href="index.php">Online Book Store</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		    <li class="nav-item">
				<a class="nav-link active" aria-current="page" href="contact.html">Contact</a>
		    </li>
			<li class="nav-item">
				<a class="nav-link active" href="about.html">About</a>
		    </li>

            <li class="nav-item">
            <?php if (isset($_SESSION['user_id'])) {?>
		          	<a class="nav-link active" 
		             href="admin.php">Admin Logout</a>
		          <?php }else{ ?>
		          <a class="nav-link active" 
		             href="login.php">Admin Login</a>
		          <?php } ?>
		    </li>


            <li class="nav-item">
            <?php if (isset($_SESSION['id'])) {?>
		          	<a class="nav-link active" 
		             href="index1.php">User Logout</a>
		          <?php }else{ ?>
		          <a class="nav-link active" 
		             href="registration/login.php" tabindex="-1" aria-disabled="true">User Login</a>
		          <?php } ?>
		    </li>
        </ul>
    </div>
        </div>
    </nav>
    </div>
    
    <section>
        <h2 id="h2main">Welcome To Your Favourite Online Book</h2>
        </section>

        <section id="link2">
        <div class="slider">
            <div class="slides">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">
                <input type="radio" name="radio-btn" id="radio4">
    <div class="slide first">
        <img src="img/1.png" alt="pic1" width="800" height="500">
    </div>
    <div class="slide">
        <img src="img/2.png" alt="pic2" width="800" height="500">
    </div>
    <div class="slide">
        <img src="img/3.png" alt="pic3" width="800" height="500">
    </div>
    <div class="slide">
        <img src="img/4.png" alt="pic4" width="800" height="800">
    </div>
<!-- slide imgs end -->
<!-- automatic nav start -->
<div class="nav-auto">
    <div class="auto-btn1"></div>
    <div class="auto-btn2"></div>
    <div class="auto-btn3"></div>
    <div class="auto-btn4"></div>
</div>
<!-- automatic nav end -->
  </div>
  <!-- manual nav start -->
  <div class="nav-manual">
      <label for="radio1" class="manual-btn"></label>
      <label for="radio2" class="manual-btn"></label>
      <label for="radio3" class="manual-btn"></label>
      <label for="radio4" class="manual-btn"></label>
  </div>
  <!-- manual nav end -->
</div>

</section>

<script type="text/javascript">
    var counter = 1;
    setInterval(function() {
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > 4) {
            counter= 1;
        }
    }, 5000);
</script>
    </body>

</html>