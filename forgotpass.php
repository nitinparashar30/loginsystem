<?php

include "nav.php";
include "db.php";
$notmail = false;
$otpsent = false;
$maindiv = true;
$resetdiv = false;
$otpfail = false;
$otpsucc = false;
$passNM = false;
$alldone = false;



if(isset($_POST['email'])){

    $email = $_POST['email'];

    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
if ($count> 0){

$otp = rand(100000,999999);
$status = 0;

$sqlot = "INSERT INTO `otp` ( `email`, `otp`, `dt`, `status`)
 VALUES ( '$email', '$otp', current_timestamp(), '$status');";

 $result1 = mysqli_query($con, $sqlot);

include "otpmail.php";
$mail_body = "Your OTP is $otp";

$mail->addAddress($email);  

$mail->Subject = 'OTP for reset your Password';
$mail->Body    = $mail_body;
//$mail->AltBody = '';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;

  
} 
else {
    $otpsent = true;
    $maindiv = false;
  

}

}
else{

    $notmail = true;
}
}
if(!empty($_POST['otpe'])){
    $otpsent = false;
    $maindiv = false;
    $resetdiv = true;
    $alldone = false;

    $otp  = $_POST['otp'];
    $otpe = $_POST['otpe'];
    $email = $_POST['email'];
      
if($otpe == $otp)

{
 $otpsucc = true;
}
else {
    $otpfail = true;
    $otpsent = true;
    $maindiv = false;
    $resetdiv = false;
}
}
if(isset($_POST['passw'])){

    $passw = $_POST['passw'];
    $passc = $_POST['passc'];
    $email1 = $_POST['email1'];

    if ($passw==$passc)

    { 
        $passh = password_hash($passw, PASSWORD_DEFAULT);
        $sqlup = "UPDATE `users` SET `passw` = '$passh' WHERE `users`.`email` = '$email1';";
        $result22 = mysqli_query($con, $sqlup);
        
if ($result22)
{
    $alldone = true;
    $maindiv = false;
}


    }
else {
    $passNM = true;
}
}

?>



<?php

if($alldone)
{
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Thank you!</strong> Your Password has been changed Successfully. <a href='login.php'>Click here to Login.</a>
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}
if($passNM)
{
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Error!</strong> Password Not Match, Please type same Passwords.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}

if($otpsucc)
{
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Thank you!</strong> OTP Match Successfully.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}




if($otpfail)
{
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Error!</strong> OTP not Match.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";
}

if ($notmail)
{
  echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' style='background-color: coral;'>
  <strong>Error!</strong> Invalid Mail ID, Your mail is not registered with us.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button></div>";

}
?>

<div class="container col-md-4 my-5">



<?php
if ($otpsent){

echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Sent!</strong> OTP sent to your mail ID.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button></div>
<button type="button" class="btn btn-dark col-md-12">ENTER YOUR OTP HERE</button>
  <div class="alert alert-warning  border border-primary">
<form action="forgotpass.php" method="post">
<div class="form-group">
  <label for="exampleInputEmail1">Enter your OTP</label>
  <input type="text" class="form-control" name="otpe" required>';
 echo"<input type= 'hidden' name='otp' value='$otp'/>
  <input type= 'hidden' name='email' value='$email'/>";
  
 echo'</div>
<button type="submit" class="btn btn-primary col-md-12">Login</button>
</form>';
}

?>
<?php
if ($maindiv){
echo'
<div class="alert alert-danger border border-warning" role="alert">
 <strong>iSecure</strong> Forgot Password.
</div><button type="button" class="btn btn-dark col-md-12">ENTER YOUR REGISTERED MAIL HERE</button>
  <div class="alert alert-warning  border border-primary">

  <form action="forgotpass.php" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required>
    <small id="emailHelp" class="form-text text-muted">We will send OTP to your registered mail.</small>
  </div>
  

  <button type="submit" class="btn btn-primary col-md-12">Login</button>
</form>';
}
?>

<?php
if ($resetdiv){

echo'
<button type="button" class="btn btn-dark col-md-12">ENTER YOUR NEW PASSWORD HERE</button>
  <div class="alert alert-warning  border border-primary">
<form action="forgotpass.php" method="post">
<div class="form-group">
  <label for="exampleInputEmail1">Enter your Password</label>
  <input type="text" class="form-control" name="passw" required>
  </div>

  <div class="form-group">
  <label for="exampleInputEmail1">Confirm Password</label>
  <input type="text" class="form-control" name="passc" required>';
  echo"<input type= 'hidden' name='email1' value='$email'/>";
   
  echo'</div>
<button type="submit" class="btn btn-primary col-md-12">Login</button>
</form>';
}

?>
</div>
</div>