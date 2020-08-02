<?php  
include "nav.php";

session_unset();
session_destroy();

?>
  
  <div class="alert alert-primary" role="alert">
 You are Logout now!<a class="alert-link" href="login.php"> Click here to Login.</a>
</div>
  