<?php
session_start();
require('../connection/connect.php');

$id = $_POST['newId'];

$get_tutors = mysqli_query($db, "SELECT status FROM tutors WHERE u_id = '$id'");

// Retrieve the updated status value
$get_tutors = mysqli_query($db, "SELECT status FROM tutors WHERE u_id = '$id'");
$row = mysqli_fetch_assoc($get_tutors);
$status = $row['status'];

// Return the updated status value as the AJAX response
echo $status;
?>