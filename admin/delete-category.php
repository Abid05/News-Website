<?php 
include "config.php";

if(isset($_REQUEST['id'])){

    $category_id = $_REQUEST["id"];

    $sql = "DELETE FROM category  WHERE category_id = '$category_id'";

    $query = mysqli_query($con,$sql);

    if($query){

    header("location:category.php");
    exit(0);

    }else{
        echo "Can't Delet User";
    }

}

?>