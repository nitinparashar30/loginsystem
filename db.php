<?php

$con = new mysqli("localhost", "root", "", "isecure");

if (!$con) {
    die("Database connection not esablished: ". mysqli_connect_error());
}

/*else
{
 echo "Database connection successfully";
}*/
?>