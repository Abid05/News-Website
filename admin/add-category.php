<?php include "header.php"; 
  if($_SESSION["role"] == 0){
    header("location:post.php");
    exit(0);
  }

  if(isset($_REQUEST["save"])){

    $category =mysqli_real_escape_string ($con,$_REQUEST["category_name"]);
    $sql = "SELECT category_name FROM category WHERE category_name = '$category' LIMIT 1";
    $run_query = mysqli_query($con,$sql) or die("Query Failed.");
    $count = mysqli_num_rows($run_query);

    if($count > 0){

        $_SESSION["status"]= "Category Already Exists.!";

    }else{

        $insert_category ="INSERT INTO category (category_name)
        VALUES ('$category')";
        $run_query = mysqli_query($con,$insert_category);

        if($run_query){
            header("location:category.php");
        }
    }

}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
