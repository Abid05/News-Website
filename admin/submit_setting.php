<?php
include "config.php";
if(empty($_FILES["logo"]["name"])){
    
    $file_name = $_REQUEST["old_logo"];
}else{
    $errors = array();
    $file_name = $_FILES["logo"]["name"];
    $temp_loc  = $_FILES["logo"]["tmp_name"];
    $file_size  = $_FILES["logo"]["size"];
    $file_type = $_FILES["logo"]["type"];
    $up_file = "/home/abid/Downloads/news-site/admin/images/" . $file_name;
    $exp = explode(".",$file_name );
    $file_exe = strtolower(end($exp));
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


    $sql = "UPDATE settings SET website_name ='{$_REQUEST["website_name"]}',logo = '{$file_name}',footer_desc = '{$_REQUEST["footer_desc"]}'";

    $query = mysqli_query($con,$sql) or die("Query Failed.");

    if($query){

        header("location:setting.php");
    }else{
        echo"Query Failed.!";
    }
    