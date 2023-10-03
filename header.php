<!-- dynamic Page Title -->
<?php 
include "config.php";
$page = basename($_SERVER["PHP_SELF"]);

switch($page){
    case "single.php":
        if(isset($_REQUEST["id"])){

            $sql = "SELECT * FROM post WHERE post_id = {$_REQUEST["id"]}";
            $query = mysqli_query($con,$sql);
            $row_title = mysqli_fetch_assoc($query);
            $page_title = $row_title["title"];
        }else{
            echo "No Post found";
        }
     break;
     case "category.php":
        if(isset($_REQUEST["cid"])){

            $sql = "SELECT * FROM category WHERE category_id = {$_REQUEST["cid"]}";
            $query = mysqli_query($con,$sql);
            $row_title = mysqli_fetch_assoc($query);
            $page_title = $row_title["category_name"] . " News";
        }else{
            echo "No Post found";
        }
     break;
     
     case "author.php":
        if(isset($_REQUEST["auth_id"])){

            $sql = "SELECT * FROM user WHERE user_id = {$_REQUEST["auth_id"]}";
            $query = mysqli_query($con,$sql);
            $row_title = mysqli_fetch_assoc($query);
            $page_title = "News By " . $row_title["username"];
        }else{
            echo "No Post found";
        }
    break;
    case "search.php":

        if(isset($_REQUEST["search"])){

            $page_title = $_REQUEST["search"];
        }else{
            echo "No search found";
        }
    break;
    
    default:
        $page_title ="News Site";
    break; 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
            <?php
              
              $sql = "SELECT * FROM settings";
              $query = mysqli_query($con,$sql);
              $count = mysqli_num_rows($query);
              if($count > 0){

              while($row = mysqli_fetch_assoc($query)){

                  if($row["logo"] == ""){
                      echo '<a href="index.php" <h1> '.$row["website_name"].'</h1></a>';
                  }else{
                      echo  '<a href="index.php"><img id="logo" src="/admin/images/'. $row["logo"].'" ></a>';
                  }
          ?>
             
              <?php
                  }
              }
              ?>
            <!-- /LOGO -->
            </div>
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <?php
                include "config.php";
                if(isset($_REQUEST["cid"])){
                    $cid = $_REQUEST["cid"];
                }
                $sql = "SELECT * FROM category WHERE post > 0";
                $query = mysqli_query($con,$sql);
                $count = mysqli_num_rows($query);
                if($count > 0){

                    $active = "";
      
            ?>
                <ul class='menu'>
                <li><a href="<?php echo $hostname ?>">HOME</a></li>
                <?php 
                    while($row = mysqli_fetch_assoc($query)){

                        if(isset($_REQUEST["cid"])){

                            if($row["category_id"] == $cid){

                                $active = "active";
                            }else{
                                $active = "";
                            }
                        }

                  echo   "<li><a  class='$active' href='category.php?cid={$row['category_id']}'>
                  {$row['category_name']} </a></li>" ;

                    }
                ?>

                </ul>

                <?php 
                        
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
