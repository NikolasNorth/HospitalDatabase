<?php
require_once('connecttodb.php');

$query = "SELECT Doctor.firstName, Doctor.lastName FROM Doctor WHERE Doctor.licenseNumber NOT IN (SELECT doctor FROM Treats)";
$result = mysqli_query($connection, $query);
if (!$result)
    die("Database query failed in 'listdoctorwithoutpatients.php'");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctor's Without Patients</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">Doctors Without Patients:</h1>
<table>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="table-row">';
        echo '<td>' . $row["firstName"] . '</td>';
        echo '<td>' . $row["lastName"] . '</td>';
        echo '</tr>';
    }
    ?>
</table>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
