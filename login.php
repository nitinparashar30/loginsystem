<?php  
include "nav.php";
include "db.php";
$invalid = false;
if (isset ($_POST['email']))
{
$email = $_POST['email'];
$passw = $_POST['passw'];
 

$sql = "SELECT * FROM `users` WHERE `email` = '$email'";

$result = mysqli_query($con, $sql);
$num = mysqli_num_rows($result);

$row = mysqli_fetch_array($result);
$passh = $row['passw'];
$name = $row['name'];

if (password_verify($passw,$passh))
{
$sqltm = "INSERT INTO `logintrk` ( `email`, `timelogin`) VALUES ('$email', current_timestamp());";

$resulttm = mysqli_query($con, $sqltm);

  session_start();

  $_SESSION['loggedin'] = true;
  $_SESSION['email'] = $email;
  $_SESSION['name'] = $name;

  header("location:welcome.php");

}
else{
  $invalid = true;
}

}

?>
<?php
if ($invalid)
{
  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' style='background-color: coral;'>
  <strong>Error!</strong> Invalid Credentials, Please try again.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";

}
?>

<div class="container col-md-4 my-5">

<div class="alert alert-danger border border-warning" role="alert">
 <strong>iSecure</strong> Login to Your Account.
</div><button type="button" class="btn btn-dark col-md-12">LOGIN HERE</button>
  <div class="alert alert-warning  border border-primary">


  <form action="login.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="passw" id="exampleInputPassword1" required>
  </div>
  <a href="forgotpass.php" class="float-right">Forgotten Password ?</a>
  <br/><br>
  <button type="submit" class="btn btn-primary col-md-12">Login</button>
</form>

</div>
</div>

  