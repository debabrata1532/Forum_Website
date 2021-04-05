<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
    .jumb {
        display: flex;
        align-items: center;

    }
    </style>

    <title>Ask anything</title>
</head>

<body>
    <!-- including external files -->

    <?php include 'header.php';
    include 'database_connection.php';
    ?>

    <?php
    
    $id=$_GET['catid'];
    $sql= "select * from `category` where category_id = $id";
    $result=mysqli_query($con,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $catname= $row['category_title'];
        $catdesc= $row['category_description'];

    }
    ?>

    <div class="container" background="blue">

        <div class="jumbotron">
            <h1 class="display-4">Hello to <?php echo $catname ?> </h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
<!-- question form and store question to database  -->
<?php
$method=$_SERVER['REQUEST_METHOD'];
if($_SESSION['loggedin']){
if(isset($_POST['title']))
// if(isset($_POST['title'])){

    // if($method='post') 
    {
        $user=$_SESSION['userid'];
        $title=$_POST['title'];
        $title = str_replace("<", "&lt;", $title);
        $title = str_replace(">", "&gt;", $title);
        $desc=$_POST['desc'];
        $desc = str_replace("<", "&lt;", $desc);
        $desc = str_replace(">", "&gt;",$desc);
        
        $sql= "INSERT INTO `thread` (`thread_title`, `thread_desc`, `thread_cat_id`, `user_id`) VALUES ('$title', '$desc', '$id', '$user')";
        $result=mysqli_query($con,$sql);
        
        
        
    
    }
}

?>

<!-- Form to submit question -->
<?php

if ($_SESSION[loggedin]){


  echo '  <div class="container">
        <form action=" ' .$_SERVER["REQUEST_URI"] . '" method="POST">
            <div class="form-group">
                <label for="exampleInputEmail1">Ask a question</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp"
                    placeholder="Enter Title name">
                <small id="emailHelp" class="form-text text-muted">Use short title as possible</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Share your problem here</label>
                <textarea class="form-control" id="desc" name="desc" placeholder="" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
    </div>';
}

else{
   echo '<div class="container">
    <p class="lead">you\'re not loggedin, Login to post anythng</p>
    </div>';
}
?>


<!-- Browse questions from databases -->

    <div class="container ques">

        <?php


    
    $id=$_GET['catid'];
    $sql= "select * from `thread` where thread_cat_id = $id";
    $result=mysqli_query($con,$sql);
    $noquestion=true;
    while($row=mysqli_fetch_assoc($result)){
        $noquestion=false;
        $id=$row['thread_id'];
        $thread_title= $row['thread_title'];
        
        $thread_desc= $row['thread_desc'];
        $userid=$row['user_id'];  /* user id from thread table (questions) */
        $sql2= "select * from `users` where user_id='$userid'" ;
        $result2=mysqli_query($con,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $useremail=$row2['user_email']; /* user email from user table */
        $username=$row2['user_name'];
    

       echo  '<div class="row"> 
        <div class="media">
            <img src="" class="mr-3" alt="user">
            <p>Posted by ' . $username . ' </p>
            <div class="media-body">
            
                <h5 class="mt-0"><a href= "/forum_website/thread.php/?threadid='.$id.'">'.$thread_title.' </a></h5>
                <p>'.$thread_desc.'</p>
                
            </div>
        </div>
        </div>

    ';

    

    }
    if ($noquestion){

        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <p class="display-4">No result found</p>
          <p class="lead">be the first person to ask</p>
        </div>
      </div>';
    }

    ?>
    </div>

    <?php  get_footer(); ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>