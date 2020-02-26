<?php
require_once 'connecttodb.php';

$displayDoctors = false;

if (isset($_POST['editPatient'])) {
    $displayDoctors = true;
    $ohip = $_POST['editPatient'];
    // Display all patient's doctor's info to frontend
    $query = "SELECT Doctor.licenseNumber, Doctor.firstName, Doctor.lastName FROM Doctor INNER JOIN Treats ON Doctor.licenseNumber = Treats.doctor INNER JOIN Patient ON Treats.patient = Patient.ohip WHERE Patient.ohip = '" . $ohip . "'";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Query failed in managepatient.php");
} elseif (isset($_POST['deleteDoc']) && isset($_POST['ohip'])) {
    $displayDoctors = true;
    $ohip = $_POST['ohip'];
    $licenseNumber = $_POST['deleteDoc'];
    // Delete Treat relationship between doctor and patient
    $query3 = "DELETE FROM Treats WHERE doctor = '" . $licenseNumber . "' AND patient = '" . $ohip . "'";
    $result3 = mysqli_query($connection, $query3);
    if (!$result3)
        die("Delete query failed in managepatient.php");
    else {
        $displayDoctors = true;
        // Display all remaining doctors (if any)
        $query = "SELECT Doctor.licenseNumber, Doctor.firstName, Doctor.lastName FROM Doctor INNER JOIN Treats ON Doctor.licenseNumber = Treats.doctor INNER JOIN Patient ON Treats.patient = Patient.ohip WHERE Patient.ohip = '" . $ohip . "'";
        $result = mysqli_query($connection, $query);
        if (!$result)
            die("Query failed in 'managepatient.php'");
    }

} elseif ($_POST['submitDoc'] && $_POST['newDoc']) {
    // Add new doctor-patient relationship
    $licenseNumber = $_POST['newDoc'];
    $ohip = $_POST['ohip'];
    $query = "INSERT INTO Treats (doctor, patient) VALUES ('" . $licenseNumber . "', '" . $ohip . "')";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Insert query failed in 'managepatient.php'");
    else {
        $displayDoctors = true;
        // Display all remaining doctors (if any)
        $query = "SELECT Doctor.licenseNumber, Doctor.firstName, Doctor.lastName FROM Doctor INNER JOIN Treats ON Doctor.licenseNumber = Treats.doctor INNER JOIN Patient ON Treats.patient = Patient.ohip WHERE Patient.ohip = '" . $ohip . "'";
        $result = mysqli_query($connection, $query);
        if (!$result)
            die("Query failed in 'managepatient.php'");
    }
} else {
    echo '<h3 class="error-msg">Error: POST is not set.</h3>';
}

$query2 = "SELECT * FROM Doctor";
$result2 = mysqli_query($connection, $query2);
if (!$result2)
    die("Select query failed to retrieve info for Doctor table in managepatient.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patient's Doctors</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">List of Doctor's Treating this Patient:</h1>
<form method="post">
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php
        if ($displayDoctors) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr class="table-row">';
                echo '<td>' . $row['firstName'] . '</td>';
                echo '<td>' . $row['lastName'] . '</td>';
                echo '<td><button class="btn" type="submit" name="deleteDoc" value="' . $row['licenseNumber'] . '">Remove</button></td>';
                echo '</tr>';
            }
        }
        echo '</table>';
        echo '<h3 class="subtitle">Add Another Doctor To Treat This Patient: </h3>';
        echo '<div class="flex-container">';
        echo '<select class="flex-item" name="newDoc">';
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo '<option value="' . $row2['licenseNumber'] . '">' . $row2['firstName'] . ' ' . $row2['lastName'] . '</option>';
        }
        echo '</select>';
        echo '<button class="btn flex-item" type="submit" name="submitDoc" value="Submit Doctor">Add New Doctor</button>';
        echo '</div>';
        echo '<input type="hidden" name="ohip" value="' . $ohip . '">';
        ?>
</form>
<a class="home-link" href="listpatients.php">Return to List of All Patients</a>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
