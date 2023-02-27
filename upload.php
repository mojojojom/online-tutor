<?php
    session_start();
    require('connection/connect.php');

    if(isset($_POST["tutee_id"]) && isset($_FILES["activity_file"]) && isset($_POST['sched_id']) && isset($_POST['course']) && isset($_POST['title'])) {

        $tutorId = $_SESSION['t_uid'];
        $title = mysqli_real_escape_string($db, $_POST['title']);
        $tuteeId = mysqli_real_escape_string($db, $_POST['tutee_id']);
        $schedId = mysqli_real_escape_string($db, $_POST['sched_id']);
        $course = mysqli_real_escape_string($db, $_POST['course']);

        $target_dir = "uploads/activity/";
        $target_file = $target_dir . basename($_FILES["activity_file"]["name"]);
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "err_exists";
        }
        else if(empty($_FILES["activity_file"]))
        {
            echo 'err_empty';
        }
        // Check file size (max 5MB)
        else if ($_FILES["activity_file"]["size"] > 5000000) {
            echo "err_size";
        }
        // Allow only PDF files
        else if($fileType != "pdf") {
            echo "err_type";
        }
        // Upload the file and insert record into database
        else if (move_uploaded_file($_FILES["activity_file"]["tmp_name"], $target_file)) 
        {
            $filename = basename($_FILES["activity_file"]["name"]);
            $query = "INSERT INTO activities (filename, title, tutee_id, tutor_id, course, sched_id) VALUES ('$filename', '$title','$tuteeId', '$tutorId', '$course', '$schedId')";
            $result = mysqli_query($db, $query);

            if($result)
            {
                echo "success";
            }
            else
            {
                echo "error";
            }
        } 
        else 
        {
            echo "error";
        }
    }
?>
