<?php include "header.php"; 
//update_submit recv


if(isset($_REQUEST["submit"])){

    $category_id   = mysqli_real_escape_string ($con,$_REQUEST["category_id"]);
    $category_name = mysqli_real_escape_string ($con,$_REQUEST["category_name"]);

    $sql1 = "UPDATE category SET category_name ='$category_name' WHERE category_id = '$category_id'";
    $run_query1 = mysqli_query($con,$sql1) or die("Query Failed.");

    if($run_query1){

        header("location:category.php");
    }
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

              <!-- update_category_id recv -->
                
                <?php 
                    include "config.php";

                    if(isset($_REQUEST["id"])){

                        $category_id = $_REQUEST["id"];
                        $sql = "SELECT * FROM category Where category_id = '$category_id'";
                        $query = mysqli_query($con,$sql);
                        $count = mysqli_num_rows($query);

                        if($count > 0){

                            while($row = mysqli_fetch_assoc($query)){
                  
                ?>

                  <form action="<?php $_SERVER["PHP_SELF"]; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required >
                  </form>
                  <?php
                            }
                        }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
