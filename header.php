<?php 


echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum_website">Home</a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Dropdown
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="threadlist.php/?catid=1">Javascript</a></li>
          <li><a class="dropdown-item" href="threadlist.php/?catid=2">Python</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about_us.php">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact_us.php">Contact us</a>
      </li>
    </ul>';
    session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $sql="select * from users where user_email='$email'";
  $result=mysqli_query($con, $sql);
    echo '<form class="d-flex" action="search.php" method="get">
    <input class="form-control me-2" name="queries"  type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
    
  </form>
  <p><a href="/forum_website/questions.php" class= "my-2">Your questions</a></p>
      <a href="/forum_website/_logouthandle.php" class="btn btn-secondary mx-2">Logout</a>';

}
else  {

  echo   '<form class="d-flex" action="search.php" method="get">
      <input class="form-control me-2" name="queries" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <button class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
        <button class="btn btn-secondary ml-2"data-bs-toggle="modal" data-bs-target="#signupmodal">Sign Up</button>';
}
    
 echo '  </div>
</div>
</nav>';

include 'loginmodal.php';
include 'signupmodal.php';

// if ($_GET['result']='true'){
//   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
//   <strong>Holy guacamole!</strong> You should check in on some of those fields below.
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
// }
// if ($_GET['result']='false'){
//   echo "User is already exist";
// }

// data-bs-toggle="modal" data-bs-target="#loginmodal"






?>