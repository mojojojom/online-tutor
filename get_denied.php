<?php
    include('connection/connect.php');
    session_start();
?>
<table class="table table-bordered table-responsive t_pending-tutee mb-0">
    
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Program & Section</th>
            <th scope="col">Course</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $check_applicants = mysqli_query($db, "SELECT * FROM appointments INNER JOIN tutees ON appointments.tutee_id = tutees.id WHERE appointments.tutor_id = '{$_SESSION['t_uid']}' AND appointments.app_status = 'Denied'");
        if(mysqli_num_rows($check_applicants) > 0) {
            while($app = mysqli_fetch_array($check_applicants)) {
                $name = $app['f_name']. " " .$app['l_name'];
                $program = $app['course']. " " .$app['y_lvl'];

                $get_course = mysqli_query($db, "SELECT * FROM schedules WHERE sched_id='{$app['sched_id']}'");
                $course = mysqli_fetch_array($get_course);

        ?>
                <tr>
                    <th scope="row"><?=$name?></th>
                    <td><?=$program?></td>
                    <td><?=$course['course_name']?></td>
                </tr>
        <?php
            }
        } else {
        ?>
            <td colspan="3">
                <span class="alert alert-danger text-center d-flex justify-content-center align-items-center fw-bold mb-0 p-2">NO RECENT APPLICANTS</span>
            </td>
        <?php
        }
        ?>
    </tbody>

</table>