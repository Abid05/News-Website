<?php
include "config.php";
if(empty($_FILES["new_image"]["name"])){
    
    $file_name = $_REQUEST["old_image"];
}else{
    $errors = array();
    $file_name = $_FILES["new_image"]["name"];
    $temp_loc  = $_FILES["new_image"]["tmp_name"];
    $file_size  = $_FILES["new_image"]["size"];
    $file_type = $_FILES["new_image"]["type"];
    $up_file = "/home/abid/Downloads/news-template/admin/upload/" . $file_name;
    $file_exe = strtolower(end(explode(".",$file_name )));
    $extention  = array("jpeg", "jpg", "png");

    if(in_array($file_exe,$extention) == false){

        $errors[]= "This extention file not allowed,Please choose a jpg or png file";
    }
    if(file_exists($up_file)){
        $errors[]= "File already exists";
    }
    if($file_size > 2097152){
        $errors = "File size must be 2mb or lower";
    }
    if(empty($errors)){

        move_uploaded_file($temp_loc, $up_file);

    }else{
        print_r($errors);
        die();
    }
}

if(isset($_REQUEST["submit"])){

    $post_id      = mysqli_real_escape_string ($con,$_REQUEST["post_id"]);
    $post_title   = mysqli_real_escape_string ($con,$_REQUEST["post_title"]);
    $description  = mysqli_real_escape_string ($con,$_REQUEST["postdesc"]);
    $category     = mysqli_real_escape_string ($con,$_REQUEST["category"]);
    $old_category = mysqli_real_escape_string ($con,$_REQUEST["old_category"]);

    $sql = "UPDATE post SET title ='$post_title',description = '$description',category = '$category', post_img = '$file_name' WHERE post_id = '$post_id';";

    if($old_category != $category){

        $sql .= "UPDATE category SET post = post -1 WHERE category_id = '$old_category';";
        $sql .= "UPDATE category SET post = post +1 WHERE category_id = '$category';";
    }
     
    $query = mysqli_multi_query($con,$sql) or die("Query Failed.");

    if($query){

        header("location:post.php");
    }else{
        echo"Query Failed.!";
    }
    
}