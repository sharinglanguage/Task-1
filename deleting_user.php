<?php
$id=$_REQUEST['id'];

include('conexion_table.php');
//deleting a user
$query=mysqli_query($conexion,"DELETE FROM students WHERE id='$id'");
if (mysqli_query($conexion, $query)) {
    //echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conexion);
}
mysqli_close($conexion);
?>
