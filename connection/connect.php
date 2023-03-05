<?php

//main connection file for both admin & front end
$servername = "localhost"; //server
$username = "u329218242_pmsuccitmta"; //username
$password = "U7FIFx097f~"; //password
$dbname = "u329218242_pmsuccitmta";  //database

// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname); // connecting 
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}