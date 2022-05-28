<?php
session_start();
# if admin login
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

# database file
include "db_conn.php";

# book function
 include "func-book.php";
 $books = get_all_books($conn);

 # author function
 include "func-author.php";
 $authors = get_All_author($conn);

 # book function
 include "func-category.php";
 $categories = get_all_categories($conn);

?>


<!DOCTYPE html>
<html lang="en" id="admin">
    <head>
     <meta charset="UTF-8">
     <meta name="description" content="online book store">
     <meta name="keywords" content="store,author,book,category">
     <meta name="author" content="Abeer Abdelrahman">
        <title>ADMIN</title>
        <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<!-- bootstrap 5 Js bundle CDN-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
    
    </head>
    <body id="adminbody">

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
				<a class="nav-link" href="logout.php">Logout</a>
		    </li>
    </ul>
  </div>
    </div>
        </nav>

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
<div class="mt-5"></div>
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




<?php if ($books == 0) { ?>
  <div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" width="100">
        	     <br>
			  There is no book in the database
		  </div> 

<?php }else { ?>
  <!--  list of all books-->
<h4>All Books</h4>
<table class="table table-bordered shadow">
<thead>
	<tr>
		<th>#</th>
		<th>Title</th>
		<th>Author</th>
		<th>Description</th>
		<th>Category</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
  <?php 
  $i = 0;
   foreach ($books as $book) { 
  $i++;
  ?>
    <tr>
    <td><?=$i?></td>
    <td>
    <img width="100"
					     src="uploads/cover/<?=$book['cover']?>" alt="cover">
					<a  class="link-dark d-block
					           text-center"
					    href="uploads/files/<?=$book['file']?>">
					   <?=$book['title']?>	
					</a>
    
    </td>
    <td>
  <?php if ($authors == 0) {
          echo "Undefined";
        }else{
            foreach ($authors as $author) {
              if ($author['id'] == $book['author_id']) {
                echo $author['name'];
              }
            }
        }
        ?>
  
  </td>
    <td><?=$book['description']?></td>
    <td>
    <?php if ($categories == 0) {
						echo "Undefined";
          }else{ 

					    foreach ($categories as $category) {
					    	if ($category['id'] == $book['category_id']) {
					    		echo $category['name'];
					    	}
					    }
					}
					?>
  
  </td>
  <td>
        <a href="edit-book.php?id=<?=$book['id']?>" class="btn btn-warning">Edit</a>
        <a href="php/delete-book.php?id=<?=$book['id']?>" class="btn btn-danger">Delete</a>
    </td>
    </tr>
    <?php } ?>
</tbody>
</table>
<?php  } ?>

<?php if ($categories == 0) { ?>
  <div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" width="100">
        	     <br>
			  There is no category in the database
		  </div> 
  <?php } else { ?>
 <!--  list of all categories-->
 <h4>All categories</h4>
 <table class="table table-bordered shadow">
    <thead>
      <tr>
            <th>#</th>
            <th>Category Name</th>
            <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $j = 0;
      foreach ($categories as $category)  {
        $j++;
      ?>
      <tr>
            <td><?=$j?></td>
            <td><?=$category['name']?></td>
            <td>
            <a href="edit-category.php?id=<?=$category['id']?>" 
            class="btn btn-warning">Edit</a>
            
            <a href="php/delete-category.php?id=<?=$category['id']?>" 
						   class="btn btn-danger">
            Delete</a>
            </td>
      </tr>
      <?php } ?>
    </tbody>
 </table>
<?php } ?>

<?php if ($authors == 0) { ?>
  <div class="alert alert-warning 
        	            text-center p-5" 
        	     role="alert">
        	     <img src="img/empty.png" width="100">
        	     <br>
			  There is no category in the database
		  </div>
  <?php } else { ?>
 <!--  list of all authors-->
 <h4>All Authors</h4>
 <table class="table table-bordered shadow">
    <thead>
      <tr>
            <th>#</th>
            <th>Author Name</th>
            <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $k = 0;
      foreach ($authors as $author)  {
        $k++;
      ?>
      <tr>
            <td><?=$k?></td>
            <td><?=$author['name']?></td>
            <td>
            <a href="edit-author.php?id=<?=$author['id']?>" 
            class="btn btn-warning">
            Edit</a>
            <a href="php/delete-author.php?id=<?=$author['id']?>" class="btn btn-danger">Delete</a>
            </td>
      </tr>
      <?php } ?>
    </tbody>
 </table>
 <?php } ?>

</body>
</html>

<?php } else {
    header("Location: login.php");
    exit;
} ?>