<?php
require_once("connecttodb.php");

$displayDoctors = false;
if (isset($_POST['license-date'])) {
    $displayDoctors = true;
    $licenseDate = $_POST['license-date'];
    $query = "SELECT Doctor.firstName, Doctor.lastName, Doctor.speciality, Doctor.licenseDate FROM Doctor WHERE licenseDate < '" . $licenseDate . "'";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Database query failed to retrieve all Doctor's before given licenseDate in 'listdocsbydate.php'");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Doctor's Before Given Date</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">List Doctor's Before Given License Date</h1>
<form method="post">
    Show All Doctor's Before This Date:
    <input type="date" name="license-date">
    <button class="btn" type="submit">Show results</button>
</form>
<?php
if ($displayDoctors) {
// Display Doctor's information to front end
    echo '<table>';
    echo '<tr>';
    echo '<th>First Name</th>';
    echo '<th>Last Name</th>';
    echo '<th>Speciality</th>';
    echo '<th>License Date</th>';
    echo '</tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="table-row">';
        echo '<td>' . $row["firstName"] . '</td>';
        echo '<td>' . $row["lastName"] . '</td>';
        echo '<td>' . $row["speciality"] . '</td>';
        echo '<td>' . $row["licenseDate"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>