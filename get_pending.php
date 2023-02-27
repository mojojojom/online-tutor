<?php
    include('connection/connect.php');
    session_start();
?>
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Program & Section</th>
            <th scope="col">Course</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $check_applicants = mysqli_query($db, "SELECT * FROM appointments INNER JOIN tutees ON appointments.tutee_id = tutees.id WHERE appointments.tutor_id = '{$tutor['u_id']}' AND appointments.status = '0'");
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
                    <td class="d-flex gap-2 justify-content-center align-items-center">
                        <a href="#" class="approve-btn-<?=$app['id']?>" class="text-primary"><i class="fa-solid fa-check"></i></a>
                        <a href="#" class="text-danger cancel-btn-<?=$app['id']?>"><i class="fa-solid fa-xmark"></i></a>
                    </td>
                </tr>
        <?php
            }
        } else {
        ?>
            <td colspan="4">
                <span class="alert alert-danger text-center d-flex justify-content-center align-items-center fw-bold mb-0 p-2">NO RECENT APPLICANTS</span>
            </td>
        <?php
        }
        ?>
    </tbody>