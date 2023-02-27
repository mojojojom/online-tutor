<?php
    session_start();
    include('connection/connect.php');

    $course = mysqli_real_escape_string($db, $_POST['course']);
    $date = mysqli_real_escape_string($db, $_POST['sched_date']);
    $startTime = mysqli_real_escape_string($db, $_POST['start_time']);
    $endTime = mysqli_real_escape_string($db, $_POST['end_time']);
    $t_id = $_SESSION['t_uid'];
    $status = 'Active';

    $schedId = uniqid('sc');

    $newDate = date("Y-m-d", strtotime($date));

    $check_sched = mysqli_query($db, "SELECT * FROM schedules WHERE sched_date = '$newDate' AND app_time_start = '$startTime' AND app_time_end = '$endTime'");
    if(mysqli_num_rows($check_sched) > 0)
    {
        echo 'err_exists';
    }
    else
    {
        $insert_sched = mysqli_query($db, "INSERT INTO schedules(sched_id, tutor_id, course_name, sched_date, app_time_start, app_time_end, status) VALUES('$schedId','$t_id', '$course', '$newDate', '$startTime', '$endTime', '$status')");
        if($insert_sched)
        {
            echo 'success';
        }
        else
        {
            echo 'error';
        }
    }




?>
