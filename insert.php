<?php  


    include("db.php");

$name = $_POST['name'];
$email = $_POST['email'];
$passw = $_POST['passw'];


echo "$name $email $passw";

$sql = "INSERT INTO `users` (`name`, `email`, `passw`, `dt`) 
VALUES ('$name', '$email', '$passw', current_timestamp());";

$ins = mysqli_query($con, $sql);


?>