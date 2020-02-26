<?php
require_once("connecttodb.php");

$displayAllDoctors = false;
$displaySingleDoctor = false;
if (isset($_POST['sort-order'])) {
    $displayAllDoctors = true;  // data ready to be displayed on front end
    $sortOrder = $_POST['sort-order'];
    $query = '';
    if ($sortOrder == 'first-name-asc') {
        $query = "SELECT Doctor.firstName, Doctor.lastName, Doctor.licenseNumber FROM Doctor ORDER BY firstName";
    } elseif ($sortOrder == 'first-name-des') {
        $query = "SELECT Doctor.firstName, Doctor.lastName, Doctor.licenseNumber FROM Doctor ORDER BY firstName DESC";

    } elseif ($sortOrder == 'last-name-asc') {
        $query = "SELECT Doctor.firstName, Doctor.lastName, Doctor.licenseNumber FROM Doctor ORDER BY lastName";

    } elseif ($sortOrder == 'last-name-des') {
        $query = "SELECT Doctor.firstName, Doctor.lastName, Doctor.licenseNumber FROM Doctor ORDER BY lastName DESC";
    }
    unset($_POST['sort-order']);

    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Database query failed to retrieve all Doctor's first and last names inside 'getdoctorbyname.php'");
} elseif (isset($_POST['doctor-info'])) {
    $displaySingleDoctor = true;
    $licenseNumber = $_POST['doctor-info'];
    $query = "SELECT Doctor.firstName, Doctor.lastName, Doctor.speciality, Doctor.licenseDate, Hospital.hospitalName FROM Doctor, Hospital WHERE code = employer AND licenseNumber = '" . $licenseNumber . "'";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Database query failed to retrieve particular Doctor's info inside 'getdoctorbyname.php'");
    unset($_POST['doctor-info']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Get Doctor Info By Name</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">Get Doctor by First or Last Name</h1>
<h3>Order By:</h3>
<form method="post">
    <div class="item-container">
        First Name (ASCENDING):
        <input type="radio" name="sort-order" value="first-name-asc"><br>
    </div>
    <div class="item-container">
        First Name (DESCENDING):
        <input type="radio" name="sort-order" value="first-name-des"><br>
    </div>
    <div class="item-container">
        Last Name (ASCENDING):
        <input type="radio" name="sort-order" value="last-name-asc"><br>
    </div>
    <div class="item-container">
        Last Name (DESCENDING):
        <input type="radio" name="sort-order" value="last-name-des"><br>
    </div>
    <button class="btn" type="submit">Sort</button>
</form>
<?php
if ($displayAllDoctors) {
    // Display list of doctors to front end
    echo '<form method="post">';
    echo '<table>';
    echo '<tr>';
    echo '<th>First Name</th>';
    echo '<th>Last Name</th>';
    echo '<th>Display More Info</th>';
    echo '</tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="table-row">';
        echo '<td>' . $row["firstName"] . '</td>';
        echo '<td>' . $row["lastName"] . '</td>';
        echo '<td><input type="radio" name="doctor-info" value="' . $row["licenseNumber"] . '"></td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '<button class="btn" type="submit">Get More Info</button>';
    echo '</form>';
}
if ($displaySingleDoctor) {
    // Display Doctor's information to front end
    echo '<table>';
    echo '<tr>';
    echo '<th>First Name</th>';
    echo '<th>Last Name</th>';
    echo '<th>Speciality</th>';
    echo '<th>License Date</th>';
    echo '<th>Hospital Name</th>';
    echo '</tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="table-row">';
        echo '<td>' . $row["firstName"] . '</td>';
        echo '<td>' . $row["lastName"] . '</td>';
        echo '<td>' . $row["speciality"] . '</td>';
        echo '<td>' . $row["licenseDate"] . '</td>';
        echo '<td>' . $row["hospitalName"] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
