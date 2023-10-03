<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <?php
              include "config.php";
              $sql = "SELECT * FROM settings";
              $query = mysqli_query($con,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){

              while($row = mysqli_fetch_assoc($query)){

            ?>
                <span><?php echo $row["footer_desc"]; ?></a></span>
                
            <?php
              }
            }
            ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
