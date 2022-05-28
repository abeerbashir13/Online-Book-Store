<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {
    
    # If author ID is not set
	if (!isset($_GET['id'])) {
		#Redirect to admin.php page
        header("Location: admin.php");
        exit;
	}

	$id = $_GET['id'];

	# Database Connection File
	include "db_conn.php";

    # author helper function
	include "func-author.php";
    $author = get_author($conn, $id);
    
    # If the ID is invalid
    if ($author == 0) {
    	#Redirect to admin.php page
        header("Location: admin.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
	<title>Edit Author</title>

	<link rel="stylesheet" href = "style.css">

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body id="edit-auth-body">
	
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
     <form action="php/edit-author.php" method="post">

     	<h1 class = "editauth">
     		Edit Author
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
		           	Author Name
		           </label>

		     <input type="text" 
		            value="<?=$author['id'] ?>" 
		            hidden
		            name="author_id">


		    <input type="text" 
		           value="<?=$author['name'] ?>" 
		           name="author_name">
		</div>

	    <button type="submit">
	            Update</button>
     </form>
	
</body>
</html>

<?php }else{
  header("Location: login.php");
  exit;
} ?>