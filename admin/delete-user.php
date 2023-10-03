<?php 
include "config.php";

if(isset($_REQUEST['id'])){

    $user_id = $_REQUEST["id"];

    $sql = "DELETE FROM user  WHERE user_id = '$user_id'";

    $query = mysqli_query($con,$sql);

    if($query){

    header("location:users.php");
    exit(0);

    }else{
        echo "Can't Delet User";
    }

}

