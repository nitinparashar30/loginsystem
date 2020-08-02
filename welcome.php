<?php 
include "nav.php";
include "db.php";
if(isset($_SESSION['loggedin']))
{
   $name = $_SESSION['name'] ;
   $email = $_SESSION['email'] ;
?>


<div class="container col-md-6 my-5 ">

<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Hello! <?php echo $name; ?> 
<div class="spinner-grow text-success" role="status">
</div> </h4>
  <p>Your Register e-Mail ID is : <strong><?php echo $email; ?></strong></p>
  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
</div>

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Login History</h5>
    <p class="card-text">
    <?php

$sql = "SELECT * FROM `logintrk` WHERE `email` = '$email' ORDER BY sno DESC";

$result = mysqli_query($con, $sql);

$numrow = mysqli_num_rows($result);

if($numrow > 0){
  echo"<table class='table table-dark'>
  <tr>
  <td>Sno </td> <td>Email ID</td>  <td>Login Date</td> </tr>";
$sno = 1;
while ($row = mysqli_fetch_array($result))
{
  $email = $row['email'];
  $timelogin =$row['timelogin'];

  echo"<tr><td> $sno</td> <td>$email</td> <td>$timelogin</td> </tr>";
  
  $sno = $sno +1;

}
echo"</table>";
  
}


    ?>
    </p>
    <a href="logout.php" class="btn btn-primary">Logout</a>
  </div>
</div>


</div>


<?php
}
else{
    echo "Not Allowed";
}
?>