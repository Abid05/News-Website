<?php include "header.php"; ?>

  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
              <?php
              
                $sql = "SELECT * FROM settings";
                $query = mysqli_query($con,$sql);
                $count = mysqli_num_rows($query);
                if($count > 0){

                while($row = mysqli_fetch_assoc($query)){
             ?>

                  <!-- Form -->
                  <form  action="submit_setting.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Website Name</label>
                          <input type="text" name="website_name"  value="<?php echo $row["website_name"]; ?>" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Website Logo</label>
                          <input type="file" name="logo" required>
                          <img  src="images/<?php echo $row["logo"]; ?>" height="150px">
                          <input type="hidden" name="old_logo" value="<?php echo $row["logo"]; ?>">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Footer Description</label>
                          <textarea name="footer_desc" class="form-control" rows="5"  required><?php echo $row["footer_desc"]; ?></textarea>
                      </div>
             
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                    }
                  }
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
