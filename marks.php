<!DOCTYPE HTML>
<html>
<head>
<?php
// Check if RegNo is set; otherwise, redirect to index.html
if(!isset($_GET['RegNo'])){
    exit(header("Location:index.html"));
}

// Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mark";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

// Extract and sanitize Register Number
$r = preg_replace("/[^0-9]/", "", $_GET['RegNo']);

// SQL query to select all columns from Marks table for the given Register Number
$sql = "SELECT * FROM Marks WHERE Regno='$r'";
$t = $conn->query($sql);

// HTML Head and Style for the page
echo '<title>Arrear Details</title>
<link rel="icon" type="image/png" href="files/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    @font-face {
        font-family: Montserrat-Regular;
        src: url("Montserrat-Regular.ttf");
    }
    * {
        font-family: Montserrat-Regular;
    }
    @media screen and (orientation: portrait) {
        #tbl {
            display: none;
        }
        article {
            align: center;
            width: 60%;
            border: 2px solid #f1f1f1;
            border-radius: 3px;
            padding: 10px;
            margin: 12px;
        }
        div {
            font-weight: bold;
        }
        hr {
            color: #f1f1f1;
            opacity: 0.5;
            width: 70%;
        }
        * {
            font-size: 14px;
        }
    }
    @media screen and (orientation: landscape) {
        #atl {
            display: none;
        }
        th {
            background-color: dodgerblue;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
    }
    th, tr, td {
        padding: 10px;
    }
    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px black;
    }
    .tooltip .tooltiptext {
        visibility: hidden;
        width: 350%;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
        top: 100%;
        left: 50%;
        margin-left: -60px;
    }
    .tooltip .tooltiptext::after {
        content: "";
        position: absolute;
        bottom: 100%;
        left: 20%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: transparent transparent black transparent;
    }
    .tooltip:hover .tooltiptext {
        visibility: visible;
    }
    table {
        font-size: 25px;
        width: 80%;
        height: 100%;
    }
</style>
</head>';
echo '<center id="tbl" style="padding-top:10%;">
    <table style="text-align:center; ">
        <thead>
            <tr> 
                <th scope="col">Sem1</th> 
                <th scope="col">Sem2</th> 
                <th scope="col">Sem3</th> 
                <th scope="col">Sem4</th> 
                <th scope="col">Sem5</th> 
                <th scope="col">Sem6</th> 
                <th scope="col">Sem7</th> 
                <th scope="col">Sem8</th> 
            </tr>
        </thead> 
        <tbody style="line-height:25px;" >';

// Fetch the row associated with the given Register Number
$r = $t->fetch_assoc();

// Explode the data into arrays for each semester
$s1 = explode(",", $r["Sem1"]);
$s2 = explode(",", $r["Sem2"]);
$s3 = explode(",", $r["Sem3"]);
$s4 = explode(",", $r["Sem4"]);
$s5 = explode(",", $r["Sem5"]); 
$s6 = explode(",", $r["Sem6"]);
$s7 = explode(",", $r["Sem7"]);
$s8 = explode(",", $r["Sem8"]);

$ar = [$s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8];

// Find the maximum count of subjects across all semesters
for ($j = 0; $j < count($ar); $j++) {
    $total_count[$j] = count($ar[$j]);
    $max_count = max($total_count);
}

// Loop through subjects and display in the table
for ($i = 0; $i < $max_count; $i++) {
    echo '<tr>';
    foreach ($ar as $ss) {
        // Check if the subject at index $i exists, otherwise display '-'
        if (isset($ss[$i])) {
            echo '<td> <div class="tooltip">' . ucfirst($ss[$i]) . '<span class="tooltiptext">Subject</span></div></td>';
        } else {
            echo '<td class=""> - </td>';
        }
    }
    echo '</tr>';
}

// Display the total count for each semester
echo '<tr style="text-align:center;">';
for ($k = 0; $k < count($ar); $k++) {
    if ($ar[$k][0] != "" ) {
        echo '<td>' . count($ar[$k]) . '</td>';
    } else {
        echo '<td>' . "0" . '</td>';
    }
}
echo ' </tr>';

echo '</tbody> </table> </center> ';

// Following content is displayed only on mobile
echo "";
echo '<center id="atl" >';
$ar = [$s1, $s2, $s3, $s4, $s5, $s6, $s7, $s8];
$i = 0;
foreach ($ar as $ss) {
    echo '<article><div>Sem' . ++$i . '</div><hr>';
    foreach ($ss as $s) {
        echo '<section><div class="tooltip">' . ucfirst($s) . '<span class="tooltiptext">Subject</span></div></section>';
    }
    echo '<section>';
    if ($ss[0] !== "" ) {
        echo '<td>' . count($ss) . '</td>';
    } else {
        echo '<td>' . "0" . '</td>';
    }
    echo '</section></article>';
}
echo '</center>';

// Create a button to download the page as PDF
$reg = $_GET["RegNo"];
echo '<br><br><center> <button style="font-size:20px; border-radius:5px;"> <a style="color:grey; text-decoration:none;" href="create_pdf.php?RegNo=' . $reg . '">Download Page »</a> </button> </center> <br>';
?>

<!-- JavaScript to dynamically update tooltips with subject names -->
<script type="text/javascript">
    $data = [
    ["1", "HS3152", "Professional English - I", "Pass"],
    ["1", "MA3151", "Matrices and Calculus", "Pass"],
    ["1", "PH3151", "Engineering Physics", "Pass"],
    ["1", "CY3151", "Engineering Chemistry", "Pass"],
    ["1", "GE3151", "Problem Solving and Python Programming", "Pass"],
    ["1", "GE3171", "Problem Solving and Python Programming Laboratory", "Pass"],
    ["1", "BS3171", "Physics and Chemistry Laboratory", "Pass"],
    ["1", "GE3172", "English Laboratory", "Pass"],
    ["2", "HS3252", "Professional English - II", "Pass"],
    ["2", "MA3251", "Statistics and Numerical Methods", "Pass"],
    ["2", "PH3256", "Physics for Information Science", "Pass"],
    ["2", "BE3251", "Basic Electrical and Electronics Engineering", "Pass"],
    ["2", "GE3251", "Engineering Graphics", "Pass"],
    ["2", "CS3251", "Programming in C", "Pass"],
    ["2", "GE3271", "Engineering Practices Laboratory", "Pass"],
    ["2", "CS3271", "Programming in C Laboratory", "Pass"],
    ["2", "GE3272", "Communication Laboratory", "Pass"],
    ["3", "MA3354", "Discrete Mathematics", "Pass"],
    ["3", "CS3351", "Digital Principles and Computer Organization", "Pass"],
    ["3", "CS3352", "Foundations of Data Science", "Pass"],
    ["3", "CS3301", "Data Structures", "Pass"],
    ["3", "CS3391", "Object Oriented Programming", "Pass"],
    ["3", "CS3311", "Data Structures Laboratory", "Pass"],
    ["3", "CS3381", "Object Oriented Programming Laboratory", "Pass"],
    ["3", "CS3361", "Data Science Laboratory", "Pass"],
    ["3", "GE3361", "Professional Development", "Pass"],
    ["4", "CS3452", "Theory of Computation", "Pass"],
    ["4", "CS3491", "Artificial Intelligence and Machine Learning", "Pass"],
    ["4", "CS3492", "Database Management Systems", "Pass"],
    ["4", "CS3401", "Algorithms", "Pass"],
    ["4", "CS3451", "Introduction to Operating Systems", "Pass"],
    ["4", "GE3451", "Environmental Sciences and Sustainability", "Pass"],
    ["4", "CS3461", "Operating Systems Laboratory", "Pass"],
    ["4", "CS3481", "Database Management Systems Laboratory", "Pass"],
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
    ["8", "CS3811", "Project Work", "Pass"]
];


    var elem, sub;
    var Element = document.getElementsByClassName("tooltip");

    for (var u = 0; u < Element.length; u++) {
        for (var v = 0; v < $data.length; v++) {
            elem = Element[u].innerText.replace("Subject", "").trim().toUpperCase();
            sub = $data[v][1].trim().toUpperCase();
            if (elem == sub) {
                //console.log(elem);
                Element[u].querySelector("span").innerHTML = $data[v][2].trim().toUpperCase();
            }
        }
    }
</script>
</html>
