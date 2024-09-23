<?php
$name_list=['James','John','Robert','Michael','William','David','Richard','Charles','Joseph','Thomas','Christopher','Daniel','Paul','Mark','Donald','George','Kenneth','Steven','Edward','Brian','Ronald','Anthony','Kevin','Jason','Matthew','Mary','Patricia','Linda','Barbara','Elizabeth','Jennifer','Maria','Susan','Margaret','Dorothy','Lisa','Nancy','Karen','Betty','Helen','Sandra','Donna','Carol','Ruth','Sharon','Michelle','Laura','Sarah','Eric','Stephen','Andrew','Raymond','Gregory','Joshua','Jerry','Dennis','Walter','Kimberly','Deborah','Jessica','Shirley','Cynthia','Angela'];


$data = [
    ["1", "HS3152", "Professional English - I", "Pass"],
    ["1", "MA3151", "Matrices  and  Calculus", "Pass"],
    ["1", "PH3151", "Engineering Physics", "Pass"],
    ["1", "CY3151", "Engineering Chemistry", "Pass"],
    ["1", "GE3151", "Problem Solving and Python Programming", "Pass"],
    [
        "1",
        "GE3171",
        "Laboratory Problem Solving and Python Programming",
        "Pass",
    ],
    ["1", "BS3171", "Laboratory Physics and Chemistry", "Pass"],
    ["1", "GE3172", "Laboratory English", "Pass"],
    ["2", "HS3252", "Professional English - II", "Pass"],
    ["2", "MA3251", "Engineering Mathematics - II", "Pass"],
    ["2", "PH3256", "Physics for Information Science", "Pass"],
    ["2", "BE3251", "Basic Electrical and Electronics Engineering", "Pass"],
    ["2", "GE3251", "Engineering Graphics", "Pass"],
    ["2", "CS3251", "Programming in C", "Pass"],
    ["2", "GE3271", "Laboratory Engineering Practices", "Pass"],
    ["2", "CS3271", "Laboratory Programming in C", "Pass"],
    ["2", "GE3272", "Laboratory Communication", "Pass"],
    ["3", "MA3354", "Discrete Mathematics", "Pass"],
    ["3", "CS3351", "Digital Principles and Computer Organization", "Pass"],
    ["3", "CS3352", "Foundations of Data Science", "Pass"],
    ["3", "CS3301", "Data Structures", "Pass"],
    ["3", "CS3391", "Object Oriented Programming", "Pass"],
    ["3", "CS3311", "Laboratory Data Structures", "Pass"],
    ["3", "CS3381", "Laboratory Object Oriented Programming", "Pass"],
    ["3", "CS3361", "Laboratory Data Science ", "Pass"],
    ["3", "GE3361", "Professional Development", "Pass"],
    ["4", "CS3452", "Theory of Computation", "Pass"],
    ["4", "CS3491", "Artificial Intelligence and Machine Learning", "Pass"],
    ["4", "CS3492", "Database Management Systems", "Pass"],
    ["4", "CS3401", "Algorithms", "Pass"],
    ["4", "CS3451", "Introduction to Operating Systems", "Pass"],
    ["4", "GE3451", "Environmental Sciences and Sustainability", "Pass"],
    ["4", "CS3461", "Laboratory Operating Systems", "Pass"],
    ["4", "CS3481", "Laboratory Database Management Systems", "Pass"],
    ["5", "CS3591", "Computer Networks", "Pass"],
    ["5", "CS3501", "Compiler Design", "Pass"],
    ["5", "CB3491", "Cryptography and Cyber Security", "Pass"],
    ["5", "CS3551", "Distributed Computing", "Pass"],
    ["6", "CCS356", "Software Engineering", "Pass"],
    ["6", "CS3691", "Embedded Systems and IoT", "Pass"],
    ["6", "CCS351", "Modern Cryptography", "Pass"],
    ["7", "CCS335", "Cloud Computing", "Pass"],
    ["7", "GE3791", "Human Values and Ethics", "Pass"],
    ["7", "GE3754", "Human Resource Management", "Pass"],
    ["8", "GE3751", "Principles of Management", "Pass"],
    ["8", "CS3811", "Project Work", "Pass"],
];

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
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mark";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE  IF NOT EXISTS Marks (
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

if ($conn->query($sql) === true) {
    echo "Table marks created successfully", "<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = $conn->prepare(
    "INSERT INTO Marks (Regno, Name, Sem1, Sem2, Sem3, Sem4, Sem5, Sem6, Sem7, Sem8, Total) VALUES (?,?,?,?,?,?,?,?,?,?,?) "
);
$sql->bind_param(
    "isssssssssi",
    $regnum,
    $name,
    $Sem1,
    $Sem2,
    $Sem3,
    $Sem4,
    $Sem5,
    $Sem6,
    $Sem7,
    $Sem8,
    $Total
);

for ($loopvar1 = 0; $loopvar1 < 60; $loopvar1++) {
    $regnum = "620125104" . substr("0000{$loopvar1}", -3);
    $name = $name_list[$loopvar1];

    $loopvar3 = 0; //for count of total subjects

    $Sem1 = $data[rand(0, count($data) - 1)][1];

    for ($loopvar2 = 0; $loopvar2 < rand(1, 2); $loopvar2++) {
        $loopvar3++;
        $Sem1 = $Sem1 . "," . $data[rand(0, count($data) - 1)][1];
    }

    $Sem2 = $data[rand(0, count($data) - 1)][1];

    for ($loopvar2 = 0; $loopvar2 < rand(1, 2); $loopvar2++) {
        $loopvar3++;
        $Sem2 = $Sem2 . "," . $data[rand(0, count($data) - 1)][1];
    }

    $Sem3 = $data[rand(0, count($data) - 1)][1];

    for ($loopvar2 = 0; $loopvar2 < rand(1, 2); $loopvar2++) {
        $loopvar3++;
        $Sem3 = $Sem3 . "," . $data[rand(0, count($data) - 1)][1];
    }

    $Sem4 = $data[rand(0, count($data) - 1)][1];

    for ($loopvar2 = 0; $loopvar2 < rand(1, 2); $loopvar2++) {
        $loopvar3++;
        $Sem4 = $Sem4 . "," . $data[rand(0, count($data) - 1)][1];
    }

    $Sem5 = $data[rand(0, count($data) - 1)][1];


    $Sem6 = $data[rand(0, count($data) - 1)][1];

    for ($loopvar2 = 0; $loopvar2 < rand(1, 2); $loopvar2++) {
        $loopvar3++;
        $Sem6 = $Sem6 . "," . $data[rand(0, count($data) - 1)][1];
    }

    $Sem7 = $data[rand(0, count($data) - 1)][1];


    $Sem8 = $data[rand(0, count($data) - 1)][1];

    for ($loopvar2 = 0; $loopvar2 < rand(1, 2); $loopvar2++) {
        $loopvar3++;
        $Sem8 = $Sem8 . "," . $data[rand(0, count($data) - 1)][1];
    }

    //+8 for each sem first data entered without loop
    $Total = $loopvar3 + 8;

    if ($sql->execute()) {
        echo "New record {$regnum} created successfully", "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} //for loopvar1
$sql->close;

$conn->close();

?>
