<?php 
session_start();

# If not author ID is set
if (!isset($_GET['id'])) {
	header("Location: index1.php");
	exit;
}

# Get author ID from GET request
$id = $_GET['id'];

# Database Connection File
include "db_conn.php";

# Book helper function
include "func-book.php";
$books = get_books_by_author($conn, $id);

# author helper function
include "func-author.php";
$authors = get_all_author($conn);
$current_author = get_author($conn, $id);


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
	<title><?=$current_author['name']?></title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="">

</head>
<body>
	<div class="container">
		<nav>
		  <div class="container-fluid">
		<a href="index1.php">Online Book Store</a>
		    <div>
		    <ul>
		    <li>
		    <a aria-current="page" href="index1.php">Store</a>
		    </li>
		    <li>
		<a href="contact.html">Contact</a>
		    </li>
		    <li>
		<a href="about.html">About</a>
		    </li>
		    <li>
		        <?php if (isset($_SESSION['user_id'])) {?>
        <a href="admin.php">Admin</a>
		        <?php }else{ ?>
		<a href="login.php">Login</a>
		        <?php } ?>

		    </li>
	   </ul>
   </div>
</div>
		</nav>
		<h1> 
		<a href="index1.php">
			<img src="img/back-arrow.PNG"  width="35">
		</a>
		   <?=$current_author['name']?>
		</h1>
		<div>
			<?php if ($books == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	<img src="img/empty.png" width="100">
        	<br>
			    There is no book in the database
	</div>
			<?php }else{ ?>
	<div>
				<?php foreach ($books as $book) { ?>
				<div>
					<img src="uploads/cover/<?=$book['cover']?>">
					<div>
			<h5>
				<?=$book['title']?>
			</h5>
			<p>
			By:
				<?php foreach($authors as $author){ 
				if ($author['id'] == $book['author_id']) {
					echo $author['name'];
				break;
			}
				?>

				<?php } ?>
				<br>
				<?=$book['description']?>
					<br>Category:
				<?php foreach($categories as $category){ 
				if ($category['id'] == $book['category_id']) {
					echo $category['name'];
				break;
			}
			    ?>

			<?php } ?>
			<br>
			</p>
            <a href="uploads/files/<?=$book['file']?>">
            Open</a>

            <a href="uploads/files/<?=$book['file']?>"
                 download="<?=$book['title']?>">Download</a>
		</div>
	</div>
		    <?php } ?>
			</div>
		  <?php } ?>

		<div>
			<!-- List of categories -->
			<div>
				<?php if ($categories == 0){
	        # do nothing
				}else{ ?>
			<a href="#">Category</a>
				<?php foreach ($categories as $category ) {?>
				  
			<a href="category.php?id=<?=$category['id']?>">
				<?=$category['name']?></a>
				<?php } } ?>
			</div>

			<!-- List of authors -->
			<div>
				<?php if ($authors == 0){
			# do nothing
				}else{ ?>
			<a href="#">Author</a>
				<?php foreach ($authors as $author ) {?>
				  
			<a href="author.php?id=<?=$author['id']?>">
				<?=$author['name']?></a>
				<?php } } ?>
			</div>
		</div>
		</div>
	</div>
</body>
</html>