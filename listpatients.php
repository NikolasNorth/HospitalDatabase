<?php
require_once 'connecttodb.php';

$query = "SELECT * FROM Patient";
$result = mysqli_query($connection, $query);
if (!$result)
    die("Query failed in listpatients.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Patients Listing</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">List of all patients:</h1>
<form action="managepatient.php" method="post">
    <table>
        <tr>
            <th>OHIP</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="table-row">';
            echo '<td>' . $row['ohip'] . '</td>';
            echo '<td>' . $row['firstName'] . '</td>';
            echo '<td>' . $row['lastName'] . '</td>';
            echo '<td><button class="btn" type="submit" name="editPatient" value="' . $row['ohip'] . '">Manage</button></td>';
            echo '</tr>';
        }
        ?>
    </table>
</form>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
