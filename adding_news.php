<?php
session_start();
$name = $_REQUEST['name'];
$description = $_REQUEST['description'];
$author=$_REQUEST['author']; 
$active="yes"; 
$creationtime=time();

include('conexioninclude.php');
//for scaping special characters:
$name=mysqli_real_escape_string($con,$name);
$description=mysqli_real_escape_string($con,$description);

$query=mysqli_query($con,"INSERT INTO news(name,description, author_id, created_at, updated_at, is_active) values('$name','$description','$author','$creationtime','$creationtime','yes')");
$id = mysqli_insert_id($con);
$query2=mysqli_query($con,"SELECT*FROM news WHERE id='$id'");


if($reg=mysqli_fetch_array($query2))
{ 
$news=array();
$news[0]=$reg['name'];
$news[1]=$reg['description'];
$news[2]=$reg['author_id'];
$news[3]=$reg['id'];

echo json_encode($news);
//we get the details back from the database (I think it is more secure doing it this way, before allowing the clienst to update them)
}
mysqli_close($con);