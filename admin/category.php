<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">

            <?php 
                  
                if(isset($_REQUEST["page"])){
                    $page_num = $_REQUEST["page"];
                    
                }else{
                    $page_num =1; 
                }
                $offset = ($page_num - 1) * 3; //limi =3 mane per page e 3 ta data dekte chy
                $sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT $offset,3"; //offest means bad
                $query = mysqli_query($con,$sql);
                $count = mysqli_num_rows($query);

                if($count > 0){

              ?> 
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
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
                            <td><?php echo $row["category_name"] ?></td>
                            <td><?php echo $row["post"] ?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo  $row["category_id"]; ?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a onclick="return confirm('Are You Sure?')" href='delete-category.php?id=<?php echo  $row["category_id"]; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                    </tbody>

                    <?php }?>

                </table>

                <?php  } 
                
                $sql1 = "SELECT * FROM category";
                $query1 = mysqli_query($con,$sql1);

                if(mysqli_num_rows($query1) > 0){
                    $total_records = mysqli_num_rows($query1);
                    $total_pages = ceil($total_records / 3); //limi =3 mane per page e 3 ta data dekte chy

                    echo "<ul class='pagination admin-pagination'>";
                    if($page_num > 1){
                        echo '<li><a href="category.php?page='.($page_num-1).'">Prev</a></li>';
                    }
                    
                    for($i=1; $i<= $total_pages; $i++){

                    if($i == $page_num){
                        
                        $active = "active";
                    }else{
                        $active = "";
                    }

                       echo '<li class="'.$active.'"><a href="category.php?page='. $i .'">'.$i.'</a></li>';
                    }
                    
                    if($total_pages > $page_num){
                        echo '<li><a href="category.php?page='.($page_num+1).'">Next</a></li>';
                    }
                    echo "</ul>";
                }
                
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
