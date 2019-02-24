<?php
/*
we can create the table from the Console or directly in the database panel using SQL.
This way we just need to run this file.
I have chosen to create the field id which will be the primary key and will be unique for each row or user
created_at and updated_at will be saved as timestamp integer. When called from the database they could be turned into date type, there are functions that to that. I think doing it this way is simpler.
*/
include('conexioninclude.php');
 
$query="CREATE TABLE users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(35),
  second_name VARCHAR(35),
  email VARCHAR(100),
  gender VARCHAR (6),
  password VARCHAR (18),
  created_at INT (30) ,
  updated_at INT (30),
  is_active VARCHAR(3)
)";
if (mysqli_query($con, $query)) {
    echo "<br><br>Table users created successfully<br><br>";
} else {
    echo "Error creating table: " . mysqli_error($con);
}


$query="CREATE TABLE news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(35),
  description TEXT,
  created_at INT(30),
  updated_at INT(30),
  is_active VARCHAR(3),
  author_id INT (10)

)";
if (mysqli_query($con, $query)) {
    echo "<br><br>Table news created successfully";
} else {
    echo "Error creating table: " . mysqli_error($con);
}
		

?>


