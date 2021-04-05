<?php 

include 'database_connection.php';

if ($_SERVER["REQUEST_METHOD"] = "POST") {

  $email = $_POST['loginemail'];
  $password = $_POST['loginpassword'];


  $sql="select * from users where user_email='$email'";
  $result=mysqli_query($con, $sql);
  $numRows=mysqli_num_rows($result);


if($numRows==1){
    $row= mysqli_fetch_assoc($result);
    $userid=$row['user_id'];
    $username=$row['user_name'];
    if(password_verify($password, $row['password'])){
        $login=true;
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['email']=$email;
        $_SESSION['userid']=$userid;
        // $_SESSION['username']=$username;
        header("location: /forum_website/index.php");
        exit();

    }
}

}
  ?>