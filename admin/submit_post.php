<?php
include "config.php";
if(isset($_FILES["up_file"])){

    $errors = array();
    $file_name = $_FILES["up_file"]["name"];
    $temp_loc  = $_FILES["up_file"]["tmp_name"];
    $file_size  = $_FILES["up_file"]["size"];
    $file_type = $_FILES["up_file"]["type"];
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
    
    session_start();
    $post_title = mysqli_real_escape_string($con,$_REQUEST["post_title"]);
    $post_desc  = mysqli_real_escape_string($con,$_REQUEST["post_desc"]);
    $category   = mysqli_real_escape_string($con,$_REQUEST["category"]);
    $date       = date("d M, Y");
    $author     = $_SESSION["user_id"];
    $sql        = "INSERT INTO post (title,description,category,post_date,author,post_img)
                  VALUES ('$post_title','$post_desc','$category','$date','$author','$file_name');";

                  
    $sql .= "UPDATE category SET post = post + 1 WHERE category_id = '$category'";

    $query = mysqli_multi_query($con,$sql);

    if($query){
        header("location:post.php");
    }else{
        echo "Query failed";
    }

}
?>