<?php
require_once('connecttodb.php');

$isEditVisible = false;
if (isset($_POST['edit-cancel'])) {
    $isEditVisible = false;
} elseif (isset($_POST['hospitalCode'])) {
    $isEditVisible = true;
} elseif (isset($_POST['edit-name'])) {
    // Edit hospital name
    $newName = $_POST['newHospitalName'];
    $hospitalCode = $_POST['edit-name'];  // stores code for hospital of interest
    $query = "UPDATE Hospital SET hospitalName = '" . $newName . "' WHERE code = '" . $hospitalCode . "'";
    $result = mysqli_query($connection, $query);
    if (!$result)
        die("Error in `updatehospitalname.php`: Cannot update hospital in Hospital table.");
    else {
        $isEditVisible = false;
        echo '<h3 class="success-msg">Name Changed Successfully.</h3>';
    }
}

// List all hospitals in Hospital table
$query = "SELECT * FROM Hospital";
$result = mysqli_query($connection, $query);
if (!$result)
    die("Error in `updatehospitalname.php`: Cannot query all hospitals in Hospital table.");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Hospital Name</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">Update Hospital Name</h1>
<form method="post">
    <table>
    <tr>
        <th>Hospital Name</th>
        <th>City</th>
        <th>Province</th>
        <th>Number of Beds</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr class="table-row">';
        echo '<td>' . $row["hospitalName"] . '</td>';
        echo '<td>' . $row["city"] . '</td>';
        echo '<td>' . $row["province"] . '</td>';
        echo '<td>' . $row["numberBeds"] . '</td>';
        echo '<td><button class="btn" type="submit" name="hospitalCode" value="' . $row["code"] . '">Change Name</button></td>';
        echo '</tr>';
    }?>
    </table>
</form>
    <?php
    if ($isEditVisible) {
        echo '<h3>Enter New Name:</h3>';
        echo '<form method="post">';
        echo 'Enter New Name: <input type="text" name="newHospitalName"/><br>';
        echo '<button class="btn" type="submit" name="edit-name" value="' . $_POST['hospitalCode'] . '">Edit Name</button>';
        echo '<button class="btn" type="submit" name="edit-cancel">Cancel</button>';
        echo '</form>';
    }
    ?>
</table>
<a class="home-link" href="index.php">Return to Main Page</a>
</body>
</html>
