<?php 
session_start();

# search key if it is not set or empty
if (!isset($_GET['key']) || empty($_GET['key'])) {
	header("Location: index1.php");
	exit;
}
$key = $_GET['key'];

# Database Connection File
include "db_conn.php";

# Book helper function
include "func-book.php";
$books = search_books($conn, $key);

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

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
	<div class="container">
		<nav>
		  <div>
		    <a href="index1.php">Online Book Store</a>
		    <div>
		      <ul>
		        <li>
		          <a  aria-current="page" 
		             href="index1.php">Store</a>
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
		</nav><br>
		Search result for <?=$key?>

		<div>
			<?php if ($books == 0){ ?>
				<div class="alert alert-warning 
        	            text-center p-5 pdf-list" 
        	     role="alert">
        	     <img src="img/empty-search.png" 
        	          width="100">
        	     <br>
				  The key "<?=$key?>" didn't match to any record in the database
			  </div>
			<?php }else{ ?>
			<div>
				<?php foreach ($books as $book) { ?>
				<div>
					<img src="uploads/cover/<?=$book['cover']?>"
					     class="card-img-top">
					<div class="card-body">
						<h5>
							<?=$book['title']?>
						</h5>
						<p>
						By: <?php foreach($authors as $author){ 
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

			<?php } ?> <br>
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
		</div>
	</div>
</body>
</html>