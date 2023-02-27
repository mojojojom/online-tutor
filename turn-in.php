<?php
    session_start();
    require('connection/connect.php');

    // if(isset($_POST["tutee_id"]) && isset($_FILES["activity_file"]) && isset($_POST['sched_id']) && isset($_POST['course']) && isset($_POST['title'])) {
    if(isset($_FILES["activity_file"]) && isset($_POST['sched_id']) && isset($_SESSION['uid'])) {
        $tuteeId = $_SESSION['uid'];
        $schedId = mysqli_real_escape_string($db, $_POST['sched_id']);

        $target_dir = "uploads/turned-in/";
        $target_file = $target_dir . basename($_FILES["activity_file"]["name"]);
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $get_activity = mysqli_query($db, "SELECT * FROM activities WHERE sched_id = '$schedId'");
        if(mysqli_num_rows($get_activity) > 0)
        {
            $task = mysqli_fetch_assoc($get_activity);

            $title = $task['title'];
            $filename = $task['filename'];
            $tutorId = $task['tutor_id'];
            $course = $task['course'];
            $status = 'Submitted';

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "err_exists";
            } else if(empty($_FILES["activity_file"])) {
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
            else if (move_uploaded_file($_FILES["activity_file"]["tmp_name"], $target_file)) {
                $filename = basename($_FILES["activity_file"]["name"]);
                $query = "INSERT INTO activities_submitted (filename, title, tutee_id, tutor_id, course, sched_id, status) VALUES ('$filename', '$title','$tuteeId', '$tutorId', '$course', '$schedId','$status')";
                $result = mysqli_query($db, $query);

                if($result)
                {
                    $response = array('status' => 'success', 'message' => 'File uploaded successfully.');
                }
                else
                {
                    $response = array('status' => 'error', 'message' => 'Error uploading file.');
                }
                
                echo json_encode($response);
                
            } else {
                echo "error";
            }
        }
        else
        {
            echo 'error_exists';
        }

    }

