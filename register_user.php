<?php
session_start();
$name = $_REQUEST['name'];
$lastname = $_REQUEST['lastname'];
$email=$_REQUEST['email']; 
$gender=$_REQUEST['gender'];
$password=$_REQUEST['password'];
$creationtime=time();

include('conexioninclude.php');
//for scaping special characters:
$name=mysqli_real_escape_string($con,$name);
$lastname=mysqli_real_escape_string($con,$lastname);

$query=mysqli_query($con,"INSERT INTO users (first_name,second_name, email, password, gender,created_at,updated_at, is_active) values('$name','$lastname','$email','$password','$gender','$creationtime','$creationtime','yes')");

if (mysqli_query($con, $query)) {
echo "great";    
//if the data was inserted, "great" word is returned to the previous page to know teh registration was done and let the user know
}


mysqli_close($con);
