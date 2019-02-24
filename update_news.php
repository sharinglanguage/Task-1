<?php
session_start();
$id=$_REQUEST['id'];
$name = $_REQUEST['name'];
$description = $_REQUEST['description'];
$author = $_REQUEST['author'];
$updatetime=time();

include('conexioninclude.php');
$query=mysqli_query($con,"UPDATE news
SET name='$name',description='$description', updated_at='$updatetime' WHERE id='$id'");

include('conexioninclude.php');
$query2=mysqli_query($con,"SELECT*FROM news WHERE id='$id'");

if($reg=mysqli_fetch_array($query2)){

$news=array();
$news[0]=$reg['name'];
$news[1]=$reg['description'];
$news[2]=$reg['author_id'];
$news[3]=$id;
echo json_encode($news);
}
mysqli_close($news);
?>