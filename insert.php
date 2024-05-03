<?php

// dummy values to insert into the database for testcacse running 

$conn = new  mysqli("localhost", "root", "");
	
	// Create database
$sql = "CREATE DATABASE mytabsgkhjne";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully" , '<br>' ;
} else {
  echo "Error creating database: " . $conn->error;
}

mysqli_close($conn);

$conn = new  mysqli("localhost", "root", "" , "mytabsgkhjne");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE marks (
Regno BIGINT(12) UNSIGNED , 
Name VARCHAR(50) NOT NULL,
Sem1 VARCHAR(100),
Sem2 VARCHAR(100),
Sem3 VARCHAR(100),
Sem4 VARCHAR(100),
Sem5 VARCHAR(100),
Sem6 VARCHAR(100),
Sem7 VARCHAR(100),
Sem8 VARCHAR(100),
Total INT(3) UNSIGNED )";

if ($conn->query($sql) === TRUE) {
  echo "Table marks created successfully",'<br>';
} else {
  echo "Error creating table: " . $conn->error;
}


for ($i=0; $i < 10; $i++) { 

$sql = " INSERT INTO marks (Regno, Name, Sem1, Sem2, Sem3, Sem4, Sem5, Sem6, Sem7, Sem8, Total) VALUES ('6201171040{$i}', 'Arunvignesh', 'english,tamil,hindi', 'english', 'social,history', 'gk,moral,physics,chemistry,computer', '', '', '', '', '11') ";

if ($conn->query($sql) === TRUE) {
  echo "New record {$i} created successfully", '<br>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

} //for

$conn->close();

?>