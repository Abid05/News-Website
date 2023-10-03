<?php include "header.php";
  if($_SESSION["role"] == 0){
    header("location:post.php");
    exit(0);
  }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">

              <?php 
                  
                if(isset($_REQUEST["page"])){
                    
                    $page_num = $_REQUEST["page"];
                    
                }else{
                    $page_num =1; 
                }
                $offset = ($page_num - 1) * 3; //limi =3 mane per page e 3 ta data dekte chy
                $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset,3"; //offest means bad
                $query = mysqli_query($con,$sql);
                $count = mysqli_num_rows($query);

                if($count > 0){

              ?>

                  <table class="content-table"> 
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th> 
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                    
                    <?php
                        while($row = mysqli_fetch_assoc($query)){
                       
                    ?>

                      <tbody>
                          <tr>
                              <td class='id'><?php echo $row["user_id"]; ?></td>
                              <td><?php echo $row["first_name"] . " " . $row["last_name"]; ?></td>
                              <td><?php echo $row["username"]; ?></td>
                              <td>    
                                <?php

                                if($row["role"] == 1): 

                                    echo "Admin";
                                else:

                                    echo "Moderator";

                                endif;

                                ?>
                              </td>
                              <td class='edit'><a href='update-user.php?id=<?php echo  $row["user_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a onclick="return confirm('Are You Sure?')" href='delete-user.php?id=<?php echo  $row["user_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                      </tbody>

                    <?php  } ?>     

                  </table>

                <?php  } 
                
                $sql1 = "SELECT * FROM user";
                $query1 = mysqli_query($con,$sql1);

                if(mysqli_num_rows($query1) > 0){
                    $total_records = mysqli_num_rows($query1);
                    $total_pages = ceil($total_records / 3); //limi =3 mane per page e 3 ta data dekte chy

                    echo "<ul class='pagination admin-pagination'>";
                    if($page_num > 1){
                        echo '<li><a href="users.php?page='.($page_num-1).'">Prev</a></li>';
                    }
                    
                    for($i=1; $i<= $total_pages; $i++){

                    if($i == $page_num){
                        
                        $active = "active";
                    }else{
                        $active = "";
                    }

                       echo '<li class="'.$active.'"><a href="users.php?page='. $i .'">'.$i.'</a></li>';
                    }
                    
                    if($total_pages > $page_num){
                        echo '<li><a href="users.php?page='.($page_num+1).'">Next</a></li>';
                    }
                    echo "</ul>";
                }
                
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
