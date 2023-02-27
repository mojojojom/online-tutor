<?php
    include('connection/connect.php');
    session_start();
?>
<!-- TABLE -->
<table class="table table-bordered table-responsive app_list mb-0" id="app_list">
    
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col" class="d-none d-md-block">Program & Section</th>
            <th scope="col">Course</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $get_tutor = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '{$_SESSION['t_uid']}'");
            $tutor = mysqli_fetch_array($get_tutor);
            $check_applicants = mysqli_query($db, "SELECT * FROM appointments INNER JOIN tutees ON appointments.tutee_id = tutees.id WHERE appointments.tutor_id = '{$tutor['u_id']}' AND appointments.status = '1' AND appointments.app_status <> 'Done'");
            if(mysqli_num_rows($check_applicants) > 0) {
            while($app = mysqli_fetch_array($check_applicants)) {
                $name = $app['f_name']. " " .$app['l_name'];
                $program = $app['course']. " " .$app['y_lvl'];
                $get_course_title = mysqli_query($db, "SELECT * FROM courses WHERE course_code='{$app['course_code']}'");
                $ct = mysqli_fetch_assoc($get_course_title);
                $course = $ct['course_code'];
                $course_title = $ct['course_name'];
                
                $getDate = $app['app_date'];
                $date = date('F j, Y', strtotime($getDate));
                $day = date('l', strtotime($getDate));
                $stime = $app['app_time_start'];
                $etime = $app['app_time_end'];
                $startTime = date('h:i:s A', strtotime($stime));
                $endTime = date('h:i:s A', strtotime($etime));

                if($app['app_status'] === 'Done')
                {
                    $card_class = 'bg-success';
                    $text_class = 'text-light';
                }
                else if($app['app_status'] === 'Pending')
                {
                    $card_class = 'bg-secondary';
                    $text_class = 'text-light';
                }
                else if($app['app_status'] === 'Queue')
                {
                    $card_class = 'bg-warning';
                    $text_class = 'text-light';
                }
                else if($app['app_status'] === 'In-Progress')
                {
                    $card_class = 'bg-info';
                    $text_class = 'text-light';
                }
                else if($app['app_status'] === 'Cancelled')
                {
                    $card_class = 'bg-danger';
                    $text_class = 'text-light';
                }
                else
                {
                    $card_class = 'bg-light';
                    $text_class = 'text-dark';
                }

                $get_course = mysqli_query($db, "SELECT * FROM schedules WHERE sched_id='{$app['sched_id']}'");
                $course = mysqli_fetch_array($get_course);

        ?>
                <tr>
                    <th scope="row"><?=$name?></th>
                    <td class="d-none d-md-block"><?=$program?></td>
                    <td><?=$course['course_name']?></td>
                    <td><span class="badge <?=$card_class?>"><?=$app['app_status']?></span></td>
                    <td class="d-flex gap-2 justify-content-center align-items-center">
                        <a href="#viewApplicantModal<?=$app['sched_id']?>" class="t-primary" data-bs-toggle="modal" data-bs-target="#viewApplicantModal<?=$app['sched_id']?>"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
        <?php
            }
        } else {
        ?>
            <td colspan="5">
                <span class="alert alert-danger text-center d-flex justify-content-center align-items-center fw-bold mb-0 p-2">NO RECENT APPLICANTS</span>
            </td>
        <?php
        }
        ?>
    </tbody>

</table>