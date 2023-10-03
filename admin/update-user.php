<?php include "header.php";
//Update_submit recv

if(isset($_REQUEST["submit"])){

    $user_id =mysqli_real_escape_string ($con,$_REQUEST["user_id"]);
    $f_name =mysqli_real_escape_string ($con,$_REQUEST["f_name"]);
    $l_name  =mysqli_real_escape_string ($con,$_REQUEST["l_name"]);
    $username  =mysqli_real_escape_string ($con,$_REQUEST["username"]);
    $role  =mysqli_real_escape_string ($con,$_REQUEST["role"]);

    $user_query = "UPDATE user SET user_id ='$user_id',first_name = '$f_name',last_name = '$l_name',username = '$username',role= '$role' WHERE user_id = '$user_id'";
    $run_query = mysqli_query($con,$user_query) or die("Query Failed.");

    if($run_query){

        header("location:users.php");
    }
    

}


?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">

              <!-- update_id recv -->
                <?php 
                    include "config.php";

                    if(isset($_REQUEST["id"])){

                        $user_id = $_REQUEST["id"];
                        $sql = "SELECT * FROM user Where user_id = '$user_id'";
                        $query = mysqli_query($con,$sql);
                        $count = mysqli_num_rows($query);

                        if($count > 0){

                            while($row = mysqli_fetch_assoc($query)){
                  
                ?>
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER["PHP_SELF"] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="" >
                      </div>
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role']; ?>">

                          <?php

                            if($row["role"] == 1): 

                               echo "<option value='0'>normal User</option>";
                               echo "<option value='1' selected>Admin</option>";
                            else:

                               echo "<option value='0'>normal User</option>";
                               echo "<option value='1'>Admin</option>";

                            endif;

                          ?> 
                          </select>
                      </div>

                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>

                  <?php

                        }

                       }
                    }
                  ?>

                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
