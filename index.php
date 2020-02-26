<?php
require_once('connecttodb.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h1 class="page-title">Computer Science 3319 Assignment 3</h1>
<h3 class="subtitle">Please Select An Option To Continue...</h3>
<div class="main-index">
    <a class="grid-item" href='getdoctorbyname.php'>Get Doctor Information</a>
    <a class="grid-item" href='listdocsbydate.php'>List Doctor's Before Given License Date</a>
    <a class="grid-item" href='addnewdoctor.php'>Add New Doctor</a>
    <a class="grid-item" href="deletedoctor.php">Delete Doctor</a>
    <a class="grid-item" href="updatehospitalname.php">Update Hospital Name</a>
    <a class="grid-item" href="listhospitalandheaddoctor.php">List Hospital and Head Doctor</a>
    <a class="grid-item" href="searchpatientbyohip.php">Search for Patient by OHIP</a>
    <a class="grid-item" href="listdoctorwithoutpatients.php">List Doctors Without Patients</a>
    <a class="grid-item" href="listpatients.php">Manage Patient-Doctor Relationships</a>
</div>
</body>
</html>
