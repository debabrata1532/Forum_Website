<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
    
    $id=$_GET['threadid'];
    $sql= "select * from `category` where category_id = $id";
    $result=mysqli_query($con,$sql);

    while($row=mysqli_fetch_assoc($result)){
        $catname= $row['category_title'];
        $catdesc= $row['category_description'];

    }
    ?>

    <div class="container jumb">

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
    
    <!-- Store reply in comments table of db -->
    <?php
    $method=$_SERVER['REQUEST_METHOD'];
if($_SESSION['loggedin']){
if(isset($_POST['comment'])){
    $idd=$_SESSION['userid'];
$comment=$_POST['comment'];
$comment=str_replace("<","&lt;",$comment);
$comment=str_replace(">","&gt;",$comment);

$sql= "insert into `comments`(`comment`,`user_id`,`timestamp`) values ('$comment','$idd',current_timestamp())";
$result=mysqli_query($con, $sql);
}
}
  ?>  

<!-- Comment form -->

<?php
if ($_SESSION[loggedin]){


echo '  <div class="container">
      <form action=" ' .$_SERVER["REQUEST_URI"] . '" method="POST">
          <div class="form-group">
              <label for="exampleFormControlTextarea1">Share your answer</label>
              <textarea class="form-control" id="comment" name="comment" placeholder="" rows="3"></textarea>
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
<div class="container">



</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>