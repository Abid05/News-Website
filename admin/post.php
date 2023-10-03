<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">

              <?php 
                  
                if(isset($_REQUEST["page"])){
                    $page_num = $_REQUEST["page"];
                    
                }else{
                    $page_num =1; 
                }
                $offset = ($page_num - 1) * 3; //limi =3 mane per page e 3 ta data dekte chy

                if($_SESSION["role"] == 1){

                    $sql = "SELECT post.post_id, post.title, post.description, post.post_date,post.category,post.post_img,category.category_name,user.username FROM post 
                    LEFT JOIN category ON post.category = category.category_id 
                    LEFT JOIN user ON post.author = user.user_id
                    ORDER BY post.post_id DESC LIMIT $offset,3"; //offest means bad

                }elseif($_SESSION["role"] == 0){

                    $sql = "SELECT post.post_id, post.title, post.description, post.post_date,post.category,post.post_img,category.category_name,user.username FROM post 
                    LEFT JOIN category ON post.category = category.category_id 
                    LEFT JOIN user ON post.author = user.user_id
                    WHERE post.author = {$_SESSION["user_id"]}
                    ORDER BY post.post_id DESC LIMIT $offset,3";
                }
    
                $query = mysqli_query($con,$sql);
                $count = mysqli_num_rows($query);

                if($count > 0){

              ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Image</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>

                    <?php

                        $s_number = 0;
                        while($row = mysqli_fetch_assoc($query)){
                        $s_number++;
                       
                    ?>

                      <tbody>
                          <tr>
                              <td class='id'><?php echo $s_number ?></td>
                              <td>  <img height="50px" src="upload/<?php echo $row['post_img'] ?>"></td>
                              <td><?php echo $row["title"] ?></td>
                              <td><?php echo $row["category_name"] ?></td>
                              <td><?php echo $row["post_date"] ?></td>
                              <td><?php echo $row["username"] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo  $row["post_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete_post&category.php?id=<?php echo  $row["post_id"]; ?>&cat_id=<?php echo  $row["category"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                         
                      </tbody>
                      <?php } ?>
                  </table>

                  <?php  } 
                
                $sql1 = "SELECT * FROM post";
                $query1 = mysqli_query($con,$sql1);

                if(mysqli_num_rows($query1) > 0){
                    $total_records = mysqli_num_rows($query1);
                    $total_pages = ceil($total_records / 3); //limi =3 mane per page e 3 ta data dekte chy

                    echo "<ul class='pagination admin-pagination'>";
                    if($page_num > 1){
                        echo '<li><a href="post.php?page='.($page_num-1).'">Prev</a></li>';
                    }
                    
                    for($i=1; $i<= $total_pages; $i++){

                    if($i == $page_num){
                        
                        $active = "active";
                    }else{
                        $active = "";
                    }

                       echo '<li class="'.$active.'"><a href="post.php?page='. $i .'">'.$i.'</a></li>';
                    }
                    
                    if($total_pages > $page_num){
                        echo '<li><a href="post.php?page='.($page_num+1).'">Next</a></li>';
                    }
                    echo "</ul>";
                }
                
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
