<?php include "header.php";

if(isset($_REQUEST["save"])){

    include "config.php";
    $fname =mysqli_real_escape_string ($con,$_REQUEST["fname"]);
    $lname =mysqli_real_escape_string ($con,$_REQUEST["lname"]);
    $user  =mysqli_real_escape_string ($con,$_REQUEST["user"]);
    $pass  =mysqli_real_escape_string ($con,md5($_REQUEST["password"]));
    $role  =mysqli_real_escape_string ($con,$_REQUEST["role"]);

    $user_query = "SELECT username FROM user WHERE username = '$user' LIMIT 1";
    $run_query = mysqli_query($con,$user_query) or die("Query Failed.");
    $count = mysqli_num_rows($run_query);

    if($count > 0){

        $_SESSION["status"]= "UserName Already Exists.!";

    }else{

        $insert_user ="INSERT INTO user (first_name,last_name,username,password,role)
        VALUES ('$fname','$lname','$user','$pass','$role')";
        $run_query = mysqli_query($con,$insert_user);

        if($run_query){
            header("location:users.php");
        }
    }

}

?>
<!-- =====Front-Part===== -->

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER["PHP_SELF"] ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                          <?php if(isset($_SESSION["status"])){ ?>
                             <p><?php echo $_SESSION["status"] ;?> </p>
                          <?php unset($_SESSION["status"]); } ?>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Add" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>

<?php include "footer.php"; ?>
