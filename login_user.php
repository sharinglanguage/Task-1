<?php
session_start();

$emaillog=$_REQUEST['emaillog']; 
$passwordlog=$_REQUEST['passwordlog'];


include('conexioninclude.php');

$query=mysqli_query($con,"SELECT*FROM users WHERE email='$emaillog'AND password='$passwordlog'");
if($reg=mysqli_fetch_array($query)){    
$_SESSION['codigo']=$reg['user_id'];
echo "great";
}

mysqli_close($con);
