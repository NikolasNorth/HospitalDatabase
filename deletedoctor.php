<?php
require_once('connecttodb.php');

if (isset($_POST['delete']) && isset($_POST['license-number'])) {
    // Delete confirmed
    // Perform delete query
    $deleteLicenseNumber = $_POST['license-number'];
    $query = "DELETE FROM Doctor WHERE licenseNumber = '" . $deleteLicenseNumber . "'";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Error in 'deletedoctor.php': Cannot delete doctor matching licenseNumber because he/she is a Head Doctor");
    else
        echo "<h3 class='success-msg'>Doctor deleted successfully.</h3>";
}
else if (isset($_POST['licenseNumber'])) {
    $licenseNumber = $_POST['licenseNumber'];
    // Check if doctor is treating patients
    $query = "SELECT COUNT(*) as total FROM Treats WHERE doctor = '" . $licenseNumber . "'";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Error in 'deletedoctor.php': Cannot query count for all Doctor's matching licenseNumber");
    $row = mysqli_fetch_assoc($result);
    if ($row['total'] > '0') {
        // Doctor is treating patients
        // Send user to confirmation page
        header("Location: confirmdeletedoctor.php?licenseNumber=" . $licenseNumber . '"');
        exit;
    } else {
        // Doctor is not treating patients
        // Perform delete query
        $query = "DELETE FROM Doctor WHERE licenseNumber = '" . $licenseNumber . "'";
        $result = mysqli_query($connection, $query);
        if (!$result)
            die("Error in 'deletedoctor.php': Cannot delete doctor matching licenseNumber who is not treating patients");
        else
            echo "<h3 class='success-msg'>Doctor deleted successfully.</h3>";
    }
}
// List all doctors in Doctor table
$query = "SELECT * FROM Doctor";
$result = mysqli_query($connection, $query);
if (!$result)
    die("Error in `deletedoctor.php`: Cannot query all doctors in Doctor table");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Doctor</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">Delete Doctor</h1>
<form method="post">
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>License Number</th>
            <th>License Date</th>
            <th>Speciality</th>
            <th>Hospital Code</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="table-row">';
            echo '<td>' . $row["firstName"] . '</td>';
            echo '<td>' . $row["lastName"] . '</td>';
            echo '<td>' . $row["licenseNumber"] . '</td>';
            echo '<td>' . $row["licenseDate"] . '</td>';
            echo '<td>' . $row["speciality"] . '</td>';
            echo '<td>' . $row["employer"] . '</td>';
            echo '<td><button class="btn" type="submit" name="licenseNumber" value="' . $row["licenseNumber"] . '">Delete</button></td>';
            echo '</tr>';
        }
        ?>
    </table>
</form>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
