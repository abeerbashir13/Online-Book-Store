<?php 
session_start();

# Database Connection File
include "db_conn.php";

# Book helper function
include "func-book.php";
$books = get_all_books($conn);

# author helper function
include "func-author.php";
$authors = get_all_author($conn);

# Category helper function
include "func-category.php";
$categories = get_all_categories($conn);

 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
	 <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
        <title>Book Store</title>
		<link rel="stylesheet" href="style.css">
     <!-- bootstrap 5 CDN-->
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- bootstrap 5 JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    </head>
    <body id= "storebody">
		<div class="container">
<section>     
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
				<a class="nav-link" href="about.html">About</a>
		    </li>
			<li class="nav-item">
		          <?php if (isset($_SESSION['user_id'])) {?>
		          	<a class="nav-link" 
		             href="admin.php">Admin Login</a>
		          <?php }else{ ?>
		          <a class="nav-link" 
		             href="login.php">Admin Logout</a>
		          <?php } ?>
		    </li>
			<li class="nav-item">
		          <?php if (isset($_SESSION['id'])) {?>
		          	<a class="nav-link" 
		             href="registration/logout.php">User Login</a>
		          <?php }else{ ?>
		          <a class="nav-link" 
		             href="index.php" tabindex="-1" aria-disabled="true">User Logout</a>
		          <?php } ?>
		    </li>
		</ul>
	</div>
    </div>
</nav>
</section> 

<section>
		<form action="search.php" method="get"
            style="width: 100%; max-width: 30rem">

	<div class="input-group my-5">
	<input type="text" class="form-control"
		name="key" placeholder="Search Book..." 
		aria-label="Search Book..." 
		aria-describedby="basic-addon2">

		  <button class="input-group-text
		                 btn btn-primary" 
		          id="basic-addon2">
		          <img src="img/search.png"
		               width="20">
		  </button> 
		</div>
	</form>
</section>	
	

<section class="d-flex pt-3">
	<?php if ($books == 0){ ?>
	<div class="alert alert-warning text-center p-5" 
        	     role="alert">
        <img src="img/empty.png" width="100">
        	     <br>
		There is no book in the database
</div>
	<?php }else{ ?>
	<div  class="pdf-list d-flex flex-wrap">
		<?php foreach ($books as $book) { ?>
	<div  class="card m-1">
		<img src="uploads/cover/<?=$book['cover']?>" class="card-img-top">
	<div class="card-body">
				<h5 class="card-title"> <?=$book['title']?></h5>
				<p class="card-text">
					By:
					<?php foreach($authors as $author){ 
					if ($author['id'] == $book['author_id']) {
						echo $author['name'];
							break;
					} ?>

				<?php } ?>
				<br>
		<?=$book['description']?>
				<br>Category:
		<?php foreach($categories as $category){ 
					if ($category['id'] == $book['category_id']) {
						echo $category['name'];
							break;
					} ?>

				<?php } ?>
				<br> </p>

        <a href="uploads/files/<?=$book['file']?>"class="btn        btn-success">Open<a>

        <a href="uploads/files/<?=$book['file']?>"class="btn btn-primary"
            download="<?=$book['title']?>">
            Download</a>
		</div>
	</div>
		<?php } ?>
</div>
		<?php } ?>

		<div class="category">
		<!-- List of categories -->
		<div class="list-group">
		<?php if ($categories == 0){
		// do nothing
			}else{ ?>
		<a href="#"
			class="list-group-item list-group-item-action active">Category</a>
		<?php foreach ($categories as $category ) {?>
					  
		<a href="category.php?id=<?=$category['id']?>"
			class="list-group-item list-group-item-action">
		<?=$category['name']?></a>
		<?php } } ?>
</div>

		<!-- List of authors -->
		<div class="list-group mt-5">
		<?php if ($authors == 0){
		// do nothing
		}else{ ?>
		<a href="#"
			class="list-group-item list-group-item-action active">Author</a>
		<?php foreach ($authors as $author ) {?>
				  
		<a href="author.php?id=<?=$author['id']?>"
			 class="list-group-item list-group-item-action">
				      <?=$author['name']?></a>
		<?php } } ?>
			</div>
	</div>

</section>
</div>
</body>
</html>