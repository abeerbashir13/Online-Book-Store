<?php
session_start();
# if admin login
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

    # database file
    include "db_conn.php";

    # book function
    include "func-category.php";
    $categories = get_all_categories($conn);

     # author helper function
	include "func-author.php";
    $authors = get_all_author($conn);

    if (isset($_GET['title'])) {
    	$title = $_GET['title'];
    } else {$title = '';}

    if (isset($_GET['desc'])) {
    	$desc = $_GET['desc'];
    }else {$desc = '';}

    if (isset($_GET['category_id'])) {
    	$category_id = $_GET['category_id'];
    }else {$category_id = 0;}

    if (isset($_GET['author_id'])) {
    	$author_id = $_GET['author_id'];
    }else { $author_id = 0; }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
	 <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
        <title>Add Book</title>
		<link rel="stylesheet" href = "style.css">

        <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<!-- bootstrap 5 Js bundle CDN-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    
    </head>
    <body id="addbook-body">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
		<a class="navbar-brand" href="#">Admin</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
		   

	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav">
		    <li class="nav-item">
				<a class="nav-link active" aria-current="page" href="index1.php">Store</a>
		    </li>
			<li class="nav-item">
				<a class="nav-link" href="add-book.php">Add Book</a>
		    </li>
        <li class="nav-item">
				<a class="nav-link" href="add-category.php">Add Category</a>
		    </li>
        <li class="nav-item">
				<a class="nav-link" href="add-author.php">Add Author</a>
		    </li>
        <li class="nav-item">
				<a class="nav-link" href="index.php">Logout</a>
		    </li>
    </ul>
  </div>
    </div>
        </nav>

		<div class="addbook">
<form action ="php/add-book.php" method ="POST"
      enctype="multipart/form-data">
    <h1 class="addbook">
      Add New Book
    </h1>
    <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label>
		           	Book title
		    </label>
		    <input type="text" 
        value="<?=$title?>"
        name="book_title">
		</div>
        <div class="mb-3">
		    <label class="form-label">
		           	Book Description
		           </label>
		    <input type="text"
        value="<?=$desc?>"  
		    name="book_description">
		</div>
        <div class="mb-3">
        <label>
		    Book Author
		</label>
		<select name="book_author">
		<option value="0">
		    	Select author
        </option>
		<?php 
            if ($authors == 0) {
                # Do nothing!
            }else{
		    	foreach ($authors as $author) { 
		    if ($author_id == $author['id']) { ?>
		<option selected
		    value="<?=$author['id']?>">
		    <?=$author['name']?>
		</option>
		<?php }else{ ?>
		<option 
				value="<?=$author['id']?>">
				<?=$author['name']?>
		</option>
		<?php }
  } 
  } ?>
		</select>
	</div>
      
        <div class="mb-3">
		    <label class="form-label">
		           	Book Category
		           </label>
            <select name="book_category">
            <option value= "0">
                    Select category
            </option>
    <?php
    if ($categories == 0) {
        # do nothing
    } else {
    
    foreach ($categories as $category) { 
        if ($category_id == $category['id']) { ?>
        <option 
        value= "<?=$category['id']?>">
        <?=$category['name']?>
        </option>

    <?php } else { ?>
        <option 
		value="<?=$category['id']?>">
		<?=$category['name']?>
		</option>
	<?php }
} 
} ?>
    </select>
</div>
        <div class="mb-3">
		    <label class="form-label">
		           	Book Cover
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="book_cover">
		</div>
        <div class="mb-3">
		    <label class="form-label">
		           	File
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="file">
		</div>

    <button type="submit">Add Book</button>
</form>
</div>



</body>
</html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>