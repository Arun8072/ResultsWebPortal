<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marks Input</title>
    <style>
        body {
            background: linear-gradient(to right, #F4E3CB, #D9BF91);
            margin: 0;
            padding: 0;
            font-family: 'Montserrat-Regular', sans-serif;
        }

        .wrapper {
            width: 60%;
            margin: auto;
            text-align: center;
        }

        .title {
            font-size: 170%;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        label {
            margin-right: 10px;
            width: 30%;
            text-align: right;
        }

        input {
            width: 65%;
        }

        .button-group {
            margin-top: 1%;
            display: flex;
            justify-content: space-around;
        }

        /* Responsive media queries */
        @media only screen and (max-width: 600px) {
            .wrapper {
                width: 80%;
            }

            .form-group {
                flex-direction: column;
                align-items: flex-start;
            }

            label, input {
                width: 100%;
                margin: 0;
                text-align: left;
            }
        }

        @media (orientation: landscape) {
            .wrapper {
                width: 95%;
            }
        }
    </style>
    <script>
        // JavaScript function to calculate total marks
        function calculateTotalMarks() {
            var totalMarks = 0;
            for (var semester = 1; semester <= 8; semester++) {
                var subjectsInput = document.getElementById('Sem' + semester).value;
                var subjectsArray = subjectsInput.split(',');
                for (var i = 0; i < subjectsArray.length; i++) {
                    var markValue = subjectsArray[i].trim();
                    if (markValue !== "") {
                        totalMarks++;
                    }
                }
            }
            document.getElementById('Total').value = totalMarks;
        }
    </script>
</head>
<body>

<div class="wrapper">
    <div class="title">
        Marks Input Form
    </div>

    <?php
    // Validate and sanitize input data
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Database connection details
        $servername = "localhost";
        $username = "id21666751_markdatabase";
        $password = "Arun_marks1.4";
        $dbname = "id21666751_marks";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize input data
        $name = sanitizeInput($_POST["Name"]);
        $regNo = sanitizeInput($_POST["RegNo"]);

        // Array to store semester marks
        $semesterMarks = array();
        $totalMarks = 0;

        // Validate and sanitize marks for each semester
        for ($semester = 1; $semester <= 8; $semester++) {
            $semesterKey = "Sem" . $semester;
            if (isset($_POST[$semesterKey])) {
                $subjectsInput = sanitizeInput($_POST[$semesterKey]);
                $subjectsArray = explode(',', $subjectsInput);
                $totalMarks += count(array_filter(array_map('trim', $subjectsArray)));
            }
        }

// Check if the "marks" table exists
$tableCheckSql = "SHOW TABLES LIKE 'marks'";
$tableCheckResult = $conn->query($tableCheckSql);

if ($tableCheckResult->num_rows == 0) {
    // "marks" table does not exist, so create it
    $sql = "CREATE TABLE marks (
        Regno BIGINT(12) NOT NULL UNSIGNED PRIMARY KEY, 
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
        echo "Table marks created successfully", '<br>';
    } else {
        echo "Error creating table: " . $conn->error;
    }
} else {
   
}



        if (isset($_POST["CreateNew"])) {
            // Insert operation for "Create New" button
            $insertSql = "INSERT INTO Marks (Name, RegNo, Sem1, Sem2, Sem3, Sem4, Sem5, Sem6, Sem7, Sem8, Total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param("ssssssssssi", $name, $regNo, $_POST["Sem1"], $_POST["Sem2"], $_POST["Sem3"], $_POST["Sem4"], $_POST["Sem5"], $_POST["Sem6"], $_POST["Sem7"], $_POST["Sem8"], $totalMarks);

            if ($stmt->execute()) {
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        } elseif (isset($_POST["UpdateOld"])) {
            // Update operation for "Update Old" button
            $updateSql = "UPDATE Marks SET Sem1 = ?, Sem2 = ?, Sem3 = ?, Sem4 = ?, Sem5 = ?, Sem6 = ?, Sem7 = ?, Sem8 = ?, Total = ? WHERE RegNo = ? AND Name = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("ssssssssiss", $_POST["Sem1"], $_POST["Sem2"], $_POST["Sem3"], $_POST["Sem4"], $_POST["Sem5"], $_POST["Sem6"], $_POST["Sem7"], $_POST["Sem8"], $totalMarks, $regNo, $name);

            if ($stmt->execute()) {
                echo "Data updated successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
            <label for="Name">Student Name:</label>
            <input type="text" name="Name" id="Name" placeholder="Enter Student Name" required>
        </div>

        <div class="form-group">
            <label for="RegNo">Register Number:</label>
            <input type="number" name="RegNo" id="RegNo" placeholder="Enter Register Number" required>
        </div>

        <!-- Input fields for each semester -->
        <?php for ($semester = 1; $semester <= 8; $semester++) { ?>
            <div class="form-group">
                <label for="Sem<?php echo $semester; ?>">Semester <?php echo $semester; ?> Marks:</label>
                <input type="text" id="Sem<?php echo $semester; ?>" name="Sem<?php echo $semester; ?>" placeholder="Enter Subject code with comma" oninput="calculateTotalMarks()">
            </div>
        <?php } ?>

        <!-- Total Marks Field -->
        <div class="form-group">
            <label for="Total">Total:</label>
            <input type="number" id="Total" name="Total" placeholder="Total" readonly>
        </div>

        <div class="button-group">
            <input type="submit" name="CreateNew" value="Create New">
            <input type="submit" name="UpdateOld" value="Update Old">
        </div>
    </form>
</div>
<br><br>
</body>
</html>
