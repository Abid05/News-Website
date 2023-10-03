<?php 
include "config.php";

$post_id = $_REQUEST["id"];
$category_id  = $_REQUEST["cat_id"];

//delete image from folder
$sql1 = "SELECT * FROM post WHERE post_id = '$post_id'";
$query1 = mysqli_query($con,$sql1);
$row = mysqli_fetch_assoc($query1);
unlink("upload/".$row["post_img"]);
//

$sql = "DELETE FROM post WHERE post_id = '$post_id';";

$sql .= "UPDATE category SET post = post -1  WHERE category_id = '$category_id'";

$query = mysqli_multi_query($con,$sql);

if($query){

    header("location:post.php");
}else{
    echo "Query Failed";
}

?>