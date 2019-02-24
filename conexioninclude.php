<?php

//PHP Mysqli function to connect to the database
//It includes the following parameters:
//host,username,password,databasename, whose values need to be replaced by the real ones, for my scripts to work
//to be replaced by the real ones

$con=mysqli_connect("localhost","my_user","my_password","my_db");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

?>
