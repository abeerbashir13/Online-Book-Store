<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# If book ID is not set
	if (!isset($_GET['id'])) {
		#Redirect to admin.php page
        header("Location: admin.php");
        exit;
	}

	$id = $_GET['id'];

	# Database File
	include "db_conn.php";

	# Book function
	include "func-book.php";
    $book = get_book($conn, $id);
    
    # If the ID is invalid
    if ($book == 0) {
    	#Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }

    # Category helper function
	include "func-category.php";
    $categories = get_all_categories($conn);

    # author helper function
	include "func-author.php";
    $authors = get_all_author($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
	<title>Edit Book</title>
	<link rel="stylesheet" href = "style.css">

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body id="edit-book-body">

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
     <form action="php/edit-book.php"
           method="post"
           enctype="multipart/form-data">

     	<h1 class = "editbook">
     		Edit Book
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
     	<div>
		    <label>
		           Book Title
		           </label>
		    <input type="text" 
		           hidden
		           value="<?=$book['id']?>" 
		           name="book_id">

		    <input type="text"
		           value="<?=$book['title']?>" 
		           name="book_title">
		</div>

		<div>
		    <label>
		           Book Description
		           </label>
		    <input type="text" 
		           value="<?=$book['description']?>"
		           name="book_description">
		</div>

		<div>
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
		    	    	if ($book['author_id'] == $author['id']) { ?>
		    	    	<option 
		    	    	  selected
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

		<div>
		    <label>
		           Book Category
		           </label>
		    <select name="book_category">
		    	    <option value="0">
		    	    	Select category
		    	    </option>
		    	    <?php 
                    if ($categories == 0) {
                    	# Do nothing!
                    }else{
		    	    foreach ($categories as $category) { 
		    	    	if ($book['category_id'] == $category['id']) { ?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$category['id']?>">
		    	    	  <?=$category['name']?>
		    	        </option>
		    	        <?php }else{ ?>
						<option 
							value="<?=$category['id']?>">
							<?=$category['name']?>
						</option>
		    	   <?php }
				}
			 } ?>
		    </select>
		</div>

		<div>
		    <label>
		           Book Cover
		           </label>
		    <input type="file" 
		           name="book_cover">

		     <input type="text" 
		           hidden
		           value="<?=$book['cover']?>" 
		           name="current_cover">

		    <a href="uploads/cover/<?=$book['cover']?>">
            Current Cover</a>
		</div>

		<div>
		    <label>
		           File
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="file">

		     <input type="text" 
		           hidden
		           value="<?=$book['file']?>" 
		           name="current_file">

		    <a href="uploads/files/<?=$book['file']?>"
		       class="link-dark">Current File</a>
		</div>

	    <button type="submit" >
	            Update</button>
     </form>
	
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>