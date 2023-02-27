<?php
    session_start();
    include('connection/connect.php');
    $get_sched = mysqli_query($db, "SELECT * FROM schedules INNER JOIN courses ON schedules.course_name = courses.course_code WHERE schedules.tutor_id = '{$_SESSION['t_uid']}' ORDER BY sched_id DESC");
    if(mysqli_num_rows($get_sched) > 0)
    {
        while($sched = mysqli_fetch_array($get_sched))
        {
            $getDate = $sched['sched_date'];
            $date = date('F j, Y', strtotime($getDate));
            $day = date('l', strtotime($getDate));
            $stime = $sched['app_time_start'];
            $etime = $sched['app_time_end'];
            $startTime = date('h:i:s A', strtotime($stime));
            $endTime = date('h:i:s A', strtotime($etime));
            if($sched['status'] === 'Active')
            {
    ?>
        <div class="list-group-item list-group-item-action position-relative bg-success" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 fw-bold text-light"><?=$sched['course_name']?></h5>
            </div>
            <small class="text-light"><span class="fw-semibold">SCHEDULED DATE</span> : <?=$day." - ".$date?> (<?=$stime." - ".$endTime?>)</small>
        </div>
    <?php
            }
            else
            {
    ?>
        <div class="list-group-item list-group-item-action position-relative bg-danger" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1 fw-bold text-light"><?=$sched['course_name']?></h5>
            </div>
            <small class="text-light"><span class="fw-semibold">SCHEDULED DATE</span> : <?=$day." - ".$date?> (<?=$stime." - ".$endTime?>)</small>
        </div>
    <?php
            }
        }
    }
    else
    {
    ?>
    <span class="alert alert-danger text-center d-flex justify-content-center align-items-center fw-bold mb-0 p-2">SCHEDULE IS EMPTY!</span>
    <?php
    }
    ?>