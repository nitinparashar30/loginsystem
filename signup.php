<?php  
$showE = false;
$exist = false;
include "nav.php";
if (isset ($_POST['name']))
{
include "db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$passw = $_POST['passw'];
$cpassw = $_POST['cpassw'];

$sqlexist = "SELECT * FROM `users` WHERE `email` = '$email'";

$resulte = mysqli_query($con, $sqlexist);
$numex = mysqli_num_rows($resulte);
if ($numex > 0)
{
   $exist = true;

}
else{
if ($cpassw==$passw)
{
  $passh = password_hash($passw, PASSWORD_DEFAULT);
  $sql = "INSERT INTO `users` (`name`, `email`, `passw`, `dt`) 
  VALUES ('$name', '$email', '$passh', current_timestamp());";
  
  $ins = mysqli_query($con, $sql);

}
else{

  $showE = true;
  
}


}
}
?>


<?php

if ($exist)
{
  echo "<div class='alert alert-primary alert-dismissible fade show' role='alert'>
  <strong>Error!</strong> Mail ID already exist, try with another Mail ID.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";

}

if ($showE)
{
  echo "<div class='alert alert-danger alert-dismissible fade show' role='alert' >
  <strong>Error!</strong> Your password not match.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";

}


 if (isset ($ins))
{
echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
<strong>Success!</strong> Your account has been successfully created, you can Login now.
<a class='alert-link' href='login.php'> Click here to Login.</a>
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
  <span aria-hidden='true'>&times;</span>
</button></div>";
}
?>
  

  <div class="container col-md-4 my-5">
<div class="alert alert-primary border border-warning" role="alert">
 <strong>iSecure</strong> Create your Account.
</div><button type="button" class="btn btn-dark col-md-12">SINGUP HERE</button>
  <div class="alert alert-warning  border border-primary">

  <form action="signup.php" method="post">
  <div class="form-group">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required> 
    </div>
    <div class="form-group">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
    </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="passw" required>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" name="cpassw" required>
  </div>
  
  <button type="submit" class="btn btn-primary col-md-12">Signup</button>
</form>
   
   
  
  </div>
  
  