<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpw = "cs3319";
$dbname = "nnorth2assign2db";
$connection = mysqli_connect($dbhost, $dbuser, $dbpw, $dbname);
if (mysqli_connect_errno())
    die("Database connection failed: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");