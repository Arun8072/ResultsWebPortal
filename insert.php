<?php

// dummy values to insert into the database for testcacse running 
/*
$conn = new mysqli("localhost", "id21666751_markdatabase", "Arun_marks1.4");
	
	// Create database
$sql = "CREATE DATABASE mark";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully" , '<br>' ;
} else {
  echo "Error creating database: " . $conn->error;
}

mysqli_close($conn);
*/
$conn = new  mysqli("localhost", "id21666751_markdatabase", "Arun_marks1.4" , "id21666751_marks");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE Marks (
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
/*
if ($conn->query($sql) === TRUE) {
  echo "Table marks created successfully",'<br>';
} else {
  echo "Error creating table: " . $conn->error;
}

*/
for ($i=0; $i < 10; $i++) { 

$sql = " INSERT INTO Marks (Regno, Name, Sem1, Sem2, Sem3, Sem4, Sem5, Sem6, Sem7, Sem8, Total) VALUES ('62011710401{$i}', 'Gayathri', 'GE3151,PH3151', 'MA3251', 'CS3351,CS3301', 'CS3451', 'CB3491', 'CS3691','CCS335','GE3751', '13') ";


if ($conn->query($sql) === TRUE) {
  echo "New record {$i} created successfully", '<br>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

} //for

$conn->close();

?>