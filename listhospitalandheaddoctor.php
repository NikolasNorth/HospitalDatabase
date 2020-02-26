<?php
require_once('connecttodb.php');

$query = "SELECT Doctor.firstName, Doctor.lastName, Hospital.hospitalName, HeadOfHospital.startDate FROM Doctor
INNER JOIN HeadOfHospital ON Doctor.licenseNumber = HeadOfHospital.doctor
INNER JOIN Hospital ON HeadOfHospital.hospital = Hospital.code
ORDER BY hospitalName";
$result = mysqli_query($connection, $query);
if (!$result)
    die("Database query failed in 'listhospitalandheaddoctor.php'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>List Hospital's Name and Head Doctor</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">List Hospital Name and Head Doctor</h1>
<?php
echo '<table>';
echo '<tr>';
echo '<th>First Name</th>';
echo '<th>Last Name</th>';
echo '<th>Hospital Name</th>';
echo '<th>Start Date</th>';
echo '</tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr class="table-row">';
    echo '<td>' . $row["firstName"] . '</td>';
    echo '<td>' . $row["lastName"] . '</td>';
    echo '<td>' . $row["hospitalName"] . '</td>';
    echo '<td>' . $row["startDate"] . '</td>';
    echo '</tr>';
}
echo '</table>';
?>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
