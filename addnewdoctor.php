<?php
require_once('connecttodb.php');

/*
 * TODO:
 */

$licenseNumber = '';
$firstName = '';
$lastName = '';
$speciality = '';
$employer = '';
$licenseDate = '';
if (isset($_POST['license-number']) &&
    isset($_POST['first-name']) &&
    isset($_POST['last-name']) &&
    isset($_POST['speciality']) &&
    isset($_POST['employer']) &&
    isset($_POST['license-date'])
) {
    $licenseNumber = $_POST['license-number'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $speciality = $_POST['speciality'];
    $employer = $_POST['employer'];
    $licenseDate = $_POST['license-date'];

    if (($licenseNumber == '' ||
        $firstName == '' ||
        $lastName == '' ||
        $speciality === '' ||
        $employer === '' ||
        $licenseDate === ''
    )) {
        // Let user know there is missing information
        echo '<h3 class="error-msg">Error: All Entries Must Be Filled In.</h3>';
    } else {
        // Check if licenseNumber already exists
        $query = "SELECT COUNT(*) AS total FROM Doctor WHERE licenseNumber = '" . $licenseNumber . "'";
        $result = mysqli_query($connection, $query);
        if (!$result)
            die("Error in 'addnewdoctor.php': Cannot query count for all Doctor's matching licenseNumber");
        $row = mysqli_fetch_assoc($result);
        if ($row['total'] == '1')
            echo "<h3 class='error-msg'>Error: License Number already exists. Please enter a unique one.\n</h3>";
        else {
            // Prepare SQL statement
            $query = "INSERT INTO Doctor (licenseNumber, firstName, lastName, speciality, employer, licenseDate) VALUES ('" . $licenseNumber . "', '" . $firstName . "', '" . $lastName . "', '" . $speciality . "', '" . $employer . "', '" . $licenseDate . "')";
            if (!mysqli_query($connection, $query))
                die("Error in 'addnewdoctor.php': Cannot add new Doctor");
            else
                echo "<h3 class='success-msg'>Doctor Successfully Added.</h3>";
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add New Doctor</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">Add New Doctor</h1>
<form method="post">
    License Number: <input type="text" name="license-number"><br>
    First Name: <input type="text" name="first-name"><br>
    Last Name: <input type="text" name="last-name"><br>
    Specialty: <input type="text" name="speciality"><br>
    Employer:
    <select name="employer">
        <option value="ABC">Victoria (London, ON)</option>
        <option value="BBC">St. Joseph (London, ON)</option>
        <option value="DDE">Victoria (Victoria, BC)</option>
    </select>
    <br>
    License Date: <input type="date" name="license-date">
    <br>
    <button class="btn" type="submit">Add Doctor</button>
</form>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
