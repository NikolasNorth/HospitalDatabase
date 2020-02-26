<?php
require_once("connecttodb.php");

$displayResult = false;
if (isset($_POST['ohip']) && isset($_POST['submit'])) {
    $displayResult = true;
    $ohip = $_POST['ohip'];
    // Check if patient exists
    $query = "SELECT COUNT(*) as total FROM Patient WHERE ohip = '" . $ohip . "'";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Database query failed to retrieve count of patient's with OHIP number in 'searchpatientbyohip.php'");
    else {
        $row = mysqli_fetch_assoc($result);
        if ($row['total'] > '0') {
            // Patient exists
            $query = "SELECT Patient.firstName AS pfirst, Patient.lastName AS plast, Doctor.firstName AS dfirst, Doctor.lastName AS dlast FROM Patient INNER JOIN Treats ON Patient.ohip = Treats.patient INNER JOIN Doctor ON Treats.doctor = Doctor.licenseNumber WHERE Patient.ohip = '" . $ohip . "'";
            $result = mysqli_query($connection, $query);
            if (!$result)
                die("Failed to list Patient's firstName, lastName and treating Doctor's firstName and lastName");
            else {
                // Display data to frontend
                $displayResult = true;
                $patientFirstName = '';
                $patienLastName = '';
            }
        } else {
            // Patient does not exist
            echo '<h3 class="error-msg">Error: There is no patient that exists with the OHIP number you provided.</h3>';
            $displayResult = false;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient Search</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">Search for patient by OHIP number</h1>
<form method="post">
    Enter OHIP number: <input type="text" name="ohip">
    <button class="btn" type="submit" name="submit" value="Submit">Search</button>
    <button class="btn" type="reset" name="reset" value="Reset">Clear</button>
</form>
<?php
if ($displayResult) {
    echo "<table>";
        echo "<tr>";
        echo "<th>Doctor's First Name</th>";
        echo "<th>Doctor's Last Name</th>";
        echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)){
        $patientFirstName = $row['pfirst'];
        $patienLastName = $row['plast'];
        echo "<tr class='table-row'>";
        echo "<td>" . $row['dfirst'] . "</td>";
        echo "<td>" . $row['dlast'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo '<h3 class="subtitle">Patient: ' . $patientFirstName . ' ' . $patienLastName . '</h3>';
}
?>
<a class="home-link" href="index.php">Return to main page</a>
</body>
</html>
