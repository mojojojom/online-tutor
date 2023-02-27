<?php
    session_start();
    require('../connection/connect.php');
?>
<thead>
    <tr>
        <th>#</th>
        <th>Tutor Name</th>
        <th>Course Name</th>
        <th>Tutee Name</th>
        <th>Schedule Date</th>
        <th>Application Status</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $get_app = mysqli_query($db, 'SELECT * FROM appointments ORDER BY app_id ASC');
    $count = 1;
    if(mysqli_num_rows($get_app) > 0) {
        while($row = mysqli_fetch_array($get_app))
        {
            $get_course = mysqli_query($db, "SELECT * FROM courses WHERE course_code = '{$row['course_code']}'");
            $course = mysqli_fetch_assoc($get_course);
            $course_name = $course['course_name'];
            
            $get_tut = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '{$row['tutor_id']}'");
            $tut = mysqli_fetch_assoc($get_tut);
            $name = $tut['f_name']. " ".$tut['l_name'];

            $get_tutee = mysqli_query($db, "SELECT * FROM tutees WHERE id = '{$row['tutee_id']}'");
            $tutee = mysqli_fetch_assoc($get_tutee);
            $fullname = $tutee['f_name']." ".$tutee['l_name'];

            $getDate = $row['app_date'];
            $date = date('F j, Y', strtotime($getDate));
            $day = date('l', strtotime($getDate));
            $stime = $row['app_time_start'];
            $etime = $row['app_time_end'];
            $startTime = date('h:i', strtotime($stime));
            $endTime = date('h:i', strtotime($etime));
    ?>
            <tr>
                <th><?=$count?></th>
                <td><?=$name?></td>
                <td><?=$course_name?></td>
                <td><?=$fullname?></td>
                <td><?=$date?></td>
                <td>
                    <?php
                        if($row['app_status'] === 'Done')
                        {
                            $card_class = 'bg-success';
                            $text_class = 'text-light';
                        }
                        else if($row['app_status'] === 'Pending')
                        {
                            $card_class = 'bg-secondary';
                            $text_class = 'text-light';
                        }
                        else if($row['app_status'] === 'Queue')
                        {
                            $card_class = 'bg-warning';
                            $text_class = 'text-light';
                        }
                        else if($row['app_status'] === 'In-Progress')
                        {
                            $card_class = 'bg-info';
                            $text_class = 'text-light';
                        }
                        else if($row['app_status'] === 'Cancelled')
                        {
                            $card_class = 'bg-danger';
                            $text_class = 'text-light';
                        }
                        else
                        {
                            $card_class = 'bg-light';
                            $text_class = 'text-dark';
                        }
                    ?>
                    <span class="badge fw-bold shadow-sm <?=$card_class?> <?=$text_class?>"><?=$row['app_status']?></span>
                </td>
                <td>
                    <?php
                    if($row['status'] === '1')
                    {
                    ?>
                    <span class="badge bg-success shadow-sm fw-bold">Available</span>
                    <?php
                    }
                    else
                    {
                    ?>
                    <span class="badge bg-danger fw-bold">Unavailable</span>
                    <?php
                    }
                    ?>
                </td>
                <td class="text-center">
                    <a class="mx-1" href="#viewApp-<?=$row['sched_id']?>" data-bs-toggle="modal" data-bs-target="#viewApp-<?=$row['sched_id']?>"><i class="fas fa-eye"></i></a>
                    <a class="mx-1 delete delete_app-btn" href="#" class="delete delete_app-btn" data-id="<?=$row['sched_id']?>"><i class="fas fa-trash text-danger"></i></a>
                </td>
            </tr>
    <?php
        $count = $count+1;
        }
    } else {
    ?>
    <td colspan="7" class="text-center fw-bold text-danger">NO APPOINTMENTS AVAILABLE!</td>
    <?php
    }
    ?>

</tbody>