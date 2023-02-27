<?php
session_start();
require('../connection/connect.php');
?>
<thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Tutor Name</th>
        <th scope="col">Course Name</th>
        <th scope="col">Schedule Date</th>
        <th scope="col">Start Time</th>
        <th scope="col">End Time</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $get_sched = mysqli_query($db, 'SELECT * FROM schedules ORDER BY id ASC');
    $count = 1;
    if(mysqli_num_rows($get_sched) > 0) {
        while($row = mysqli_fetch_array($get_sched))
        {
            $get_course = mysqli_query($db, "SELECT * FROM courses WHERE course_code = '{$row['course_name']}'");
            $course = mysqli_fetch_assoc($get_course);
            $course_name = $course['course_name'];
            
            $get_tut = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '{$row['tutor_id']}'");
            $tut = mysqli_fetch_assoc($get_tut);
            $name = $tut['f_name']. " ".$tut['l_name'];

            $getDate = $row['sched_date'];
            $date = date('F j, Y', strtotime($getDate));
            $day = date('l', strtotime($getDate));
            $stime = $row['app_time_start'];
            $etime = $row['app_time_end'];
            $startTime = date('h:i', strtotime($stime));
            $endTime = date('h:i', strtotime($etime));
    ?>
            <tr>
                <th scope="row"><?=$count?></th>
                <td><?=$name?></td>
                <td><?=$course_name?></td>
                <td><?=$date?></td>
                <td><?=$startTime?></td>
                <td><?=$endTime?></td>
                <td>
                    <?php
                    if($row['status'] === 'Active')
                    {
                    ?>
                    <span class="badge bg-success fw-bold">ACTIVE</span>
                    <?php
                    }
                    else
                    {
                    ?>
                    <span class="badge bg-danger fw-bold">INACTIVE</span>
                    <?php
                    }
                    ?>
                </td>
                <td class="d-flex justify-content-around admin__table-actions">
                    <a href="#" class="delete delete_sched-btn" data-id="<?=$row['sched_id']?>"><i class="fas fa-trash text-danger"></i></a>
                </td>
            </tr>
    <?php
        $count = $count+1;
        }
    } else {
    ?>
    <td colspan="7" class="text-center fw-bold text-danger">NO SCHEDULES AVAILABLE!</td>
    <?php
    }
    ?>

</tbody>