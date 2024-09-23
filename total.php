<?php
// Check if 'Reg' key is set in POST data, if not, redirect to index.html
if (!isset($_POST["Reg"])) {
    exit(header("Location:index.html"));
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mark";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input data from POST
$r = preg_replace("/[^0-9]/", "", $_POST["Reg"]);
$n = preg_replace("/[^A-z.\s]/", "", $_POST["Name"]);

// Query to get 'Total' from 'Marks' table where 'Regno' and 'Name' match sanitized values
$sql = "SELECT Total FROM Marks where Regno='$r' and Name='$n' ";

// Execute the query
$t = $conn->query($sql);

// Echo HTML head and style tags
echo '<head><title>Total Arrear Count</title><link rel="icon" type="image/png" href="files/favicon.ico"><meta name="viewport" content="width=device-width, initial-scale=1"></head><style>
@font-face {
 font-family:Montserrat-Regular;
  src: url("Montserrat-Regular.ttf");
}
*{font-family:Montserrat-Regular;}
</style>';

// Check if there is a row in the result set
if ($row = $t->fetch_assoc()) {
    // Echo total arrear count with styling and a button to view details
    echo '<center style="padding:18%;"><span style="line-height:1px;"><p style="font-size:55px; width:20%;">' .
        $row["Total"] .
        '</p><p style="font-size:35px;width:25%;">Total</p></span><br><br><form action="marks.php" method="GET"><button name="RegNo" type="submit" value="' .
        $r .
        '" style="font-size:30px; border-radius:5px;">Details</button></form></center>';
} else {
    // Echo "Invalid" if there is no matching record
    echo "Invalid";
}

// Close the database connection
$conn->close();
?>
