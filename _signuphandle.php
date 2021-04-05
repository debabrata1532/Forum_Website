<?php 

include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] = "POST") {

  $name=$_POST['name'];
  $name = str_replace("<", "&lt;", $name);
  $name = str_replace(">", "&gt;", $name);
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  $checkuser = "select * from `users` where user_email = '$email' ";
  $result2 = mysqli_query($con, $checkuser);
  $num = mysqli_num_rows($result2);
  if ($num > 0) {
    header("location: /forum_website/index.php?result=false");
  }
  else{
    
    if ($password == $cpassword){
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $insert = "insert into `users` (`user_name`,`user_email` , `password`) values ('$name','$email','$hash')";
      $result_insert = mysqli_query($con, $insert);
      if ($result_insert){
        header("location: /forum_website/index.php?result=true");
      }
    }
     else{
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> Password is mismatch
      <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#signupmodal">Try again</button>
    </div>';
    }
  }
  
}

?> 
