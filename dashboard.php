<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();
    
    include('header.php');
    if(empty($_SESSION['t_uid']))
    {
        header('Location: index.php');
    }
?>

    <section class="t_banner-wrap sec-pad">
        <div class="container">

            <div class="row">

                <div class="col-lg-7">

                    <div class="row">

                        <!-- APPLICANTS -->
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="fw-bold titles">MY STUDENTS</h4>
                                    <div class="row" id="applicants_list">

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
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SCHEDULE -->
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="fw-bold titles">SCHEDULES</h4>
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <span class="badge bg-success fw-bold">ACTIVE</span>
                                            <span class="badge bg-danger fw-bold">INACTIVE</span>
                                        </div>
                                    </div>
                                    <!-- <div class="sched_calendar" id="sched_calendar"></div> -->
                                    <div class="list-group" id="sched-list">

                                        <?php
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

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ADD SCHEDULE -->
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <button class=" c-btn c-btn-inline c-btn-primary c-btn-sm" data-bs-toggle="modal" data-bs-target="#addSched">ADD SCHEDULE</button>
                                </div>
                            </div>
                        </div>

                        <!-- ADD SCHEDULE MODAL -->
                        <div class="modal fade" id="addSched" tabindex="-1" aria-labelledby="addSchedLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    
                                    <form id="schedule-form" autocomplete="off">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 fw-bold t-dark" id="addSchedLabel">ADD SCHEDULE</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-12 mb-3">
                                                    <label for="course" class="form-label mb-1 fw-semibold">Course</label>
                                                    <select id="course" class="form-select" name="course" placeholder="Select Course" aria-label="Default select" required>
                                                        <!-- <option >Select Course</option> -->
                                                        <?php
                                                        $get_courses = mysqli_query($db, 'SELECT * FROM courses');
                                                        while($cname = mysqli_fetch_array($get_courses))
                                                        {
                                                        ?>
                                                        <option value="<?=$cname['course_code']?>" name="course"><?=$cname['course_name']?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-12 mb-3">
                                                    <label for="scheddate" class="form-label mb-1 fw-semibold d-block">Date</label>
                                                    <input type="text" id="sched_date" class="modal_input form-select" name="sched_date" required>
                                                </div>
                                                
                                                <div class="col-lg-6 mb-3">
                                                    <label for="start_time" class="form-label mb-1 fw-semibold d-block">Start Time</label>
                                                    <input type="text" id="start_time" class="modal_input form-select" name="start_time" required>
                                                </div>
                                                
                                                <div class="col-lg-6 mb-3">
                                                    <label for="end_time" class="form-label mb-1 fw-semibold d-block">End Time</label>
                                                    <input type="text" id="end_time" class="modal_input form-select" name="end_time" required>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="submit" class=" c-btn c-btn-primary c-btn-sm">Save changes</button>
                                                <button type="button" class="c-btn c-btn-primary c-btn-sm border border-1 border-danger bg-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <div class="col-lg-5">
                    <div class="row">

                        <!-- PENDING -->
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="fw-bold titles">PENDING STUDENTS</h4>

                                    <div class="card t_pending-tutee-card">
                                        <div class="card-body">
                                            <table class="table table-bordered table-responsive t_pending-tutee mb-0" id="t_pending">
                                                
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
                                                    $check_applicants = mysqli_query($db, "SELECT * FROM appointments INNER JOIN tutees ON appointments.tutee_id = tutees.id WHERE appointments.tutor_id = '{$_SESSION['t_uid']}' AND appointments.app_status = 'Checking'");
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
                                                                    <a href="#" class="approve-btn approve-btn-<?=$app['id']?>" data-id="<?=$app['sched_id']?>" class="text-primary"><i class="fa-solid fa-check"></i></a>
                                                                    <a href="#" class="text-danger cancel-btn cancel-btn-<?=$app['id']?>" data-id="<?=$app['sched_id']?>" data-tutee="<?=$app['tutee_id']?>"><i class="fa-solid fa-xmark"></i></a>
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

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- DENIED -->
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="fw-bold titles">DENIED STUDENTS</h4>

                                    <div class="card t_pending-tutee-card">
                                        <div class="card-body" id="t_denied">
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
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="fw-bold titles">TURNED IN ACTIVITIES</h4>
                                    <div class="card">
                                        <div class="card-body">
                                            <ol class="list-group list-group-numbered">
                                                <?php
                                                $get_activity = mysqli_query($db, "SELECT * FROM activities_submitted WHERE tutor_id='{$_SESSION['t_uid']}'");
                                                if(mysqli_num_rows($get_activity) > 0)
                                                {
                                                    while($task = mysqli_fetch_assoc($get_activity))
                                                    {
                                                ?>
                                                    <li class="list-group-item d-flex">
                                                        <span class="d-flex align-items-center justify-content-between w-100">
                                                            <span class="fw-bold text-decoration-none ms-1"><?=$task['title']?></span>
                                                            <a href="#viewTask<?=$task['sched_id']?>" data-bs-toggle="modal" data-bs-target="#viewTask<?=$task['sched_id']?>" class="badge bg-primary text-light" data-id="<?=$task['sched_id']?>">VIEW</a>
                                                        </span>
                                                    </li>
                                                <?php
                                                    }
                                                }
                                                else
                                                {
                                                ?>
                                                <span class="alert alert-danger fw-bold d-flex align-items-center justify-content-center">NO AVAILABLE ACTIVITY</span>
                                                <?php
                                                }
                                                ?>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- VIEW ACTIVITIES MODAL -->
    <?php
    $get_submitted = mysqli_query($db, "SELECT * FROM activities_submitted WHERE tutor_id = '{$_SESSION['t_uid']}'");
    if(mysqli_num_rows($get_submitted) > 0)
    {
        while($task = mysqli_fetch_assoc($get_submitted))
        {
            $get_course_title = mysqli_query($db, "SELECT * FROM courses WHERE course_code='{$task['course']}'");
            $ct = mysqli_fetch_assoc($get_course_title);
            $course = $ct['course_code'];
            $course_title = $ct['course_name'];
            $datetime = $task['created_at'];
            $date = date("F d, Y", strtotime($datetime)); // "February 26, 2023"
            $time = date("g:i a", strtotime($datetime)); // "8:03 pm"

            $get_tutee = mysqli_query($db, "SELECT * FROM tutees WHERE id = '{$task['tutee_id']}'");
            while($tutee = mysqli_fetch_assoc($get_tutee)){
                $tName = $tutee['f_name']." ".$tutee['l_name'];
            
    ?>
        <div class="modal fade" id="viewTask<?=$task['sched_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?=$task['title']?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="" class=" form-label fw-semibold mb-1">NAME</label>
                                <div class="form-control"><?=$tName?></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class=" form-label fw-semibold mb-1">COURSE</label>
                                <div class="form-control"><?=$course_title?></div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="" class=" form-label fw-semibold mb-1">DATE SUBMITTED</label>
                                <div class="form-control"><?=$date?></div>
                            </div>
                            <div class="col-lg-6 mb-3">
                                <label for="" class=" form-label fw-semibold mb-1">TIME SUBMITTED</label>
                                <div class="form-control"><?=$time?></div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class=" form-label fw-semibold mb-1">ACTIVITY SUBMITTED</label>
                                <div class="form-control"><?=$task['title']?></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/uploads/turned-in/<?=$task['filename']?>" target="_blank" class=" c-btn c-btn-primary c-btn-sm">VIEW ACTIVITY</a>
                        <button type="button" class=" c-btn c-btn-primary c-btn-sm bg-danger border border-1 border-danger" data-bs-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
            }
        }
    }
    ?>





    <!-- APPLICANTS MODAL -->
    <?php
    $select_app = mysqli_query($db, "SELECT * FROM appointments");
    while($sched = mysqli_fetch_assoc($select_app))
    {
        $get_course_title = mysqli_query($db, "SELECT * FROM courses WHERE course_code='{$sched['course_code']}'");
        $ct = mysqli_fetch_assoc($get_course_title);
        $course = $ct['course_code'];
        $course_title = $ct['course_name'];
    ?>
        <div class="modal fade" id="viewApplicantModal<?=$sched['sched_id']?>" tabindex="-1" aria-labelledby="viewApplicantModal<?=$app['sched_id']?>Label" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h1 class="modal-title fw-bold t-dark" style="font-size:18px;text-transform:uppercase;" id="viewApplicantModal<?=$app['sched_id']?>Label"><?=$name?>'s Appointment</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- APPOINTMENT INFO -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="fw-bold">APPOINTMENT INFO</p>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label for="course" class="form-label mb-1 fw-semibold">Student Name</label>
                                        <div class=" border border-2 p-2"><?=$name?></div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="course" class="form-label mb-1 fw-semibold">Course Name</label>
                                        <div class=" border border-2 p-2"><?=$course_title?></div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="course" class="form-label mb-1 fw-semibold">Day - Date</label>
                                        <div class=" border border-2 p-2"><?=$day?> - <?=$date?></div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="course" class="form-label mb-1 fw-semibold">Time Start</label>
                                        <div class=" border border-2 p-2"><?=$startTime?></div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <label for="course" class="form-label mb-1 fw-semibold">Time End</label>
                                        <div class=" border border-2 p-2"><?=$endTime?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- MEETING INFO -->
                        <div class="card mb-3">
                            <form method="POST" id="appointment_form">
                                <div class="card-body">

                                    <p class="fw-bold">MEETING INFO</p>
                                    <input type="hidden" name="action" value="set_meeting">
                                    <div class="col-12 mb-3">
                                        <label for="level" class="form-label mb-1 fw-semibold">Change Status</label>
                                        <select name="app_stat" id="app_stat-<?=$sched['sched_id']?>" class="form-select app_stat" name="level" aria-label="Default select">
                                            <option selected><?=$sched['app_status']?></option>
                                            <option value="Queue">Queue</option>
                                            <option value="In-Progress">In-Progress</option>
                                            <option value="Done">Done</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="course" class="form-label mb-1 fw-semibold">Conference Link</label>
                                        <input type="text" name="link" id="link-<?=$sched['sched_id']?>" class="form-control border border-2 p-2" placeholder="Add Conference Link" value="<?=$sched['app_link']?>">
                                    </div>
                                    
                                    <div class="d-flex align-items-center justify-content-start">
                                        <button type="button" id="save_btn<?=$sched['sched_id']?>" data-id="<?=$sched['sched_id']?>" class="save_btn c-btn c-btn-primary c-btn-sm" data-bs-dismiss="modal">SAVE</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <!-- ACTIVITIES -->
                        <div class="card mb-3">
                            <form method="POST" enctype="multipart/form-data" id="activity_form-<?=$sched['sched_id']?>" class="activity_form">
                                <div class="card-body">

                                    <?php
                                    $check_task = mysqli_query($db, "SELECT * FROM activities_submitted WHERE sched_id = '{$sched['sched_id']}'");
                                    if(mysqli_num_rows($check_task) > 0)
                                    {
                                        $task = mysqli_fetch_assoc($check_task);
                                        $title = $task['title'];
                                        $disable = 'disabled';
                                        $bg = 'bg-secondary';
                                        $status = '<span class="badge bg-success text-light">TURNED IN</span>';
                                    }
                                    else
                                    {
                                        $disable = '';
                                        $bg = '';
                                        $status = '';
                                    }
                                    ?>

                                    <p class="fw-bold d-flex align-items-center gap-2">ACTIVITY <?=$status?></p>

                                    <div class="col-12 mb-3">
                                        <label for="title" class="form-label mb-1 fw-semibold">Title</label>
                                        <input type="text" name="title" class="form-control <?=$disable?>" placeholder="Enter activity title" value="<?=$title?>" required>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="course" class="form-label mb-1 fw-semibold">Upload an Activity (PDF)</label>
                                        <input type="file" name="activity_file" id="activity_file" class="form-control <?=$disable?>" required>
                                        <input type="hidden" name="tutee_id" value="<?=$sched['tutee_id']?>">
                                        <input type="hidden" name="sched_id" value="<?=$sched['sched_id']?>">
                                        <input type="hidden" name="course" value="<?=$sched['course_code']?>">
                                    </div>

                                    <div class="d-flex align-items-center justify-content-start">
                                        <button type="submit" id="upload_activity" data-id="<?=$sched['sched_id']?>" class="c-btn c-btn-primary c-btn-sm upload_activity-btn <?=$disable." ".$bg?>">UPLOAD</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class=" c-btn c-btn-primary c-btn-sm bg-danger border-danger border border-1" data-bs-dismiss="modal">CLOSE</button>
                    </div>

                </div>
            </div>
        </div>
    <?php
    }

    ?>

<?php
    include('footer.php');
?>

<script>
    jQuery(function($) {
        $(document).ready(function () {

            // APPROVE APPLICANT
            $('.approve-btn').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {id:id, action:'approve'},
                    success: function (response) {
                        if(response === 'success')
                        {
                            // REFRESH PENDING LIST
                            get_pending();

                            // REFRESH APPLICANTS LIST
                            get_applicants()

                            // REFRESH SCHEDULES LIST
                            get_sched();

                            // DISPLAY MESSAGE
                            Swal.fire(
                                'Success!',
                                'Applicant Has Been Approved!',
                                'success'
                            );
                        }
                        else
                        {
                            // DISPLAY MESSAGE
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to approve appointment!',
                                'error'
                            );
                        }
                    }
                });

            })
            // CANCEL APPLICANT
            $('.cancel-btn').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var t_id = $(this).data('tutee');

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {id:id,t_id:t_id, action:'cancel'},
                    success: function (response) {
                        if(response === 'success')
                        {
                            // REFRESH PENDING LIST
                            get_pending();

                            // REFRESH APPLICANTS LIST
                            get_applicants()

                            // REFRESH SCHEDULES LIST
                            get_sched();

                            // REFRESH DENIED LIST
                            get_denied();

                            // DISPLAY MESSAGE
                            Swal.fire(
                                'Success!',
                                'Applicant Has Been Denied!',
                                'success'
                            );
                        }
                        else
                        {
                            // DISPLAY MESSAGE
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to deny appointment!',
                                'error'
                            );
                            alert(response);
                        }
                    }
                });

            })

            // UPLOAD AN ACTIVITY
            $('body').on('click','.upload_activity-btn',function(e) {
                e.preventDefault();

                var id = $(this).data('id');
                var formData = new FormData($('#activity_form-'+id)[0]);

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response === 'success')
                        {
                            get_applicants();
                            // SHOW STATUS
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Activity has been added!'
                            })
                        }
                        else if(response === 'err_size')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Sorry, your file is too large.',
                                'error'
                            )
                        }
                        else if(response === 'err_type')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Sorry, only PDF files are allowed.',
                                'error'
                            )
                        }
                        else if(response === 'err_exists')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Sorry, file already exists.',
                                'error'
                            )
                        }
                        else if(response === 'err_empty')
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Please fill all fields.',
                                'error'
                            )
                        }
                        else
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Sorry, there was an error uploading your file.',
                                'error'
                            )
                        }
                    }
                });
            });

            // add a click event listener to the download link
            $('#downloadLink').click(function(e) {
                e.preventDefault(); // prevent the default link click behavior

                // send an AJAX request to the PHP script to download the file
                $.ajax({
                    url: 'download.php',
                    type: 'GET',
                    success: function(response) {
                        // create a Blob object from the server response
                        var blob = new Blob([response]);

                        // create a URL for the Blob object
                        var url = URL.createObjectURL(blob);

                        // create a link element to download the file
                        var link = document.createElement('a');
                        link.href = url;
                        link.download = 'activity.pdf';
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                });
            });

            // DATEPICKER
            $(function() {
                $('input[name="sched_date"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format('YYYY'),10)
                });
            });
            // START TIME PICKER
            $('#start_time').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 10,
                minTime: '7:30',
                maxTime: '17:30',
                defaultTime: '7',
                startTime: '07:30',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
            // END TIME PICKER
            $('#end_time').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 10,
                minTime: '7:30',
                maxTime: '17:30',
                defaultTime: '7',
                startTime: '07:30',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });

            // ADD SCHEDULE
            $('#schedule-form').submit(function(e) {
                e.preventDefault();
                var course = $('#course').val();
                var sched_date = $('#sched_date').val();
                var start_time = $('#start_time').val();
                var end_time = $('#end_time').val();

                $.ajax({
                    url: 'create_schedule.php',
                    type: 'POST',
                    data: {course:course, sched_date:sched_date, start_time:start_time,end_time:end_time},
                    success: function(response) {
                        if(response === 'success')
                        {
                            // SHOW STATUS
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Schedule Has Been Created!'
                            })

                            get_sched();

                        }
                        else if(response === 'err_exists')
                        {
                            Swal.fire(
                                'Unable To Add Schedule',
                                'Schedule Date and Time Already Exists!',
                                'info'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable To Add Schedule.',
                                'info'
                            );
                        }
                    }
                });
            });

            // EDIT STATUS
            // $('.save_btn').click(function(e) {
            $('body').on('click','.save_btn',function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var status = $('#app_stat-' + id);
                var link = $('#link-' + id);

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {
                        id: id,
                        status: status.val(),
                        link: link.val(),
                        action: 'set_meeting'
                    },
                    success: function(response) {
                        if (response === 'success') 
                        {
                            get_applicants();
                            
                            get_sched();

                            // DISPLAY MESSAGE
                            Swal.fire(
                                'Success!',
                                'Appointment status has been updated!',
                                'success'
                            );
                        } 
                        else 
                        {
                            Swal.fire(
                                'Something went wrong!',
                                'Unable to update appointment status!',
                                'error'
                            );
                        }
                    }
                });
            });



            // GET APPLICANTS LIST
            function get_applicants() {
                $.ajax({
                    type: "GET",
                    url: "get_applicants.php",
                    success: function (response) {
                        $('#applicants_list').empty().html(response);
                    }
                });
            }
            // GET PENDING LIST
            function get_pending() {
                $.ajax({
                    type: "GET",
                    url: "get_pending.php",
                    success: function (response) {
                        $('#t_pending').empty().html(response);
                    }
                });
            }
            // UPDATE SCHED
            function get_sched() {
                $.ajax({
                    type: "GET",
                    url: "get_schedules.php",
                    success: function (response) {
                        $('#sched-list').empty().html(response);
                    }
                });
            }
            // UPDATE DENIED
            function get_denied() {
                $.ajax({
                    type: "GET",
                    url: "get_denied.php",
                    success: function (response) {
                        $('#t_denied').empty().html(response);
                    }
                });
            }

        })
    })


</script>