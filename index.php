<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">

                    <?php
                    include "config.php";

                    if(isset($_REQUEST["page"])){
                        $page_num = $_REQUEST["page"];
                        
                    }else{
                        $page_num =1; 
                    }
                    $offset = ($page_num - 1) * 5;

                    $sql = "SELECT post.post_id, post.title, post.description, post.post_date,post.category,post.post_img,category.category_name,post.author,user.username FROM post 
                    LEFT JOIN category ON post.category = category.category_id 
                    LEFT JOIN user ON post.author = user.user_id
                    ORDER BY post.post_id DESC LIMIT $offset,5";

                    $query = mysqli_query($con,$sql);
                    $count = mysqli_num_rows($query);

                    if($count > 0){

                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row["post_id"] ?>"><img src="admin/upload/<?php echo $row['post_img'] ?>"></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row["post_id"] ?>'><?php echo $row["title"] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row["category"] ?>'><?php echo $row["category_name"] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?auth_id=<?php echo $row["author"] ?>'><?php echo $row["username"] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row["post_date"] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row["description"],0 , 150) . "..."  ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row["post_id"] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                            }
                        }else{

                            echo "NO Record Found.!";
                        }
                            //pagination
                            $sql1 = "SELECT * FROM post";
                            $query1 = mysqli_query($con,$sql1);

                            if(mysqli_num_rows($query1) > 0){
                                $total_records = mysqli_num_rows($query1);
                                $total_pages = ceil($total_records / 5); //limi =3 mane per page e 3 ta data dekte chy

                                echo "<ul class='pagination admin-pagination'>";
                                if($page_num > 1){
                                    echo '<li><a href="index.php?page='.($page_num-1).'">Prev</a></li>';
                                }
                                
                                for($i=1; $i<= $total_pages; $i++){

                                if($i == $page_num){
                                    
                                    $active = "active";
                                }else{
                                    $active = "";
                                }

                                echo '<li class="'.$active.'"><a href="index.php?page='. $i .'">'.$i.'</a></li>';
                                }
                                
                                if($total_pages > $page_num){
                                    echo '<li><a href="index.php?page='.($page_num+1).'">Next</a></li>';
                                }
                                echo "</ul>";
                            }
                            
                        ?>
                        
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>
   

