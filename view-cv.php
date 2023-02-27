<?php
// Connect to database
require('connection/connect.php');

// Get the CV ID from the URL parameter
$cv_id = $_GET['id'];

// Query the database for the CV content
$query = mysqli_query($db, "SELECT * FROM tutors_cv WHERE u_id = '$cv_id'");

// If the query returned a result, set the appropriate headers and output the content
if(mysqli_num_rows($query) > 0)
{
    $row = mysqli_fetch_assoc($query);

    // Set the content type header based on the file type
    header('Content-Type: '.$row['cv_type']);

    // Set the content disposition header to force a download with the original file name
    header('Content-Disposition: attachment; filename='.$row['cv_name']);

    // Output the content
    echo $row['cv_content'];
}
else
{
    // CV not found
    echo 'CV not found.';
}
?>

