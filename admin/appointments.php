<?php
    include('header.php');
?>

        <!-- SIDEBAR -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- End Dashboard Nav -->

                <li class="nav-heading">Users</li>

                <li class="nav-item">
                    <a class="nav-link" href="tutors.php">
                        <i class="bi bi-person"></i>
                        <span>Tutors</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tutees.php">
                        <i class="bi bi-person"></i>
                        <span>Tutees</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="courses.php">
                        <i class='bi bi-book'></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="schedules.php">
                    <i class='bi bi-calendar-event'></i>
                        <span>Tutor Schedules</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="appointments.php">
                    <i class='bi bi-calendar-check' ></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <!-- End Error 404 Page Nav -->

            </ul>
        </aside>

        <!-- MAIN PAGE -->
        <main id="main" class="main main-wrap px-1 px-md-4">
            <div class="pagetitle">
                <h1>Appointments</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </nav>
            </div>

            <section class="admin_courses-wrap">
                <div class="card">
                    <div class="card-body p-2 p-md-3 p-lg-4">

                        <table class="table table-striped table-bordered py-3" style="width:100%" id="appointments_table">
                            
                            <thead>
                                <tr>
                                    <th class="d-none d-lg-table-cell">#</th>
                                    <th>Tutor Name</th>
                                    <th>Course Name</th>
                                    <th class="d-none d-lg-table-cell">Tutee Name</th>
                                    <th class="d-none d-lg-table-cell">Schedule Date</th>
                                    <th class="d-none d-lg-table-cell">Application Status</th>
                                    <th class="d-none d-lg-table-cell">Status</th>
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
                                            <th class="d-none d-lg-table-cell"><?=$count?></th>
                                            <td><?=$name?></td>
                                            <td class="d-none d-lg-table-cell"><?=$course_name?></td>
                                            <td class="d-table-cell d-lg-none"><?=$course['course_code']?></td>
                                            <td class="d-none d-lg-table-cell"><?=$fullname?></td>
                                            <td class="d-none d-lg-table-cell"><?=$date?></td>
                                            <td class="d-none d-lg-table-cell">
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
                                            <td class="d-none d-lg-table-cell">
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
                                                <a class="mx-1 delete delete_app-btn" href="#" data-id="<?=$row['sched_id']?>"><i class="fas fa-trash text-danger"></i></a>
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

                        </table>

                    </div>
                </div>
            </section>

        </main>

        <!-- VIEW/EDIT TUTEES -->
        <?php
            $get_app = mysqli_query($db, "SELECT * FROM appointments");
            while($row = mysqli_fetch_assoc($get_app)){

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

            <div class="modal fade" id="viewApp-<?=$row['sched_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" id="tutees_info">
                        
                        <form method="POST" class="edit-tutee-form-<?=$row['sched_id']?>">

                            <div class="modal-header">
                                <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">APPOINTMENT DETAILS</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <!-- VIEW -->
                            <div class="modal-body" id="show_tutee-<?=$row['sched_id']?>">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Tutor</label>
                                        <div class="form-control"><?=$name?></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Tutee</label>
                                        <div class="form-control"><?=$fullname?></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Course</label>
                                        <div class="form-control"><?=$course_name?></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Appointment Number</label>
                                        <div class="form-control"><?=$row['app_id']?></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Appointment Date</label>
                                        <div class="form-control"><?=$date?></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Appointment Day</label>
                                        <div class="form-control"><?=$day?></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Start Time</label>
                                        <div class="form-control"><?=$startTime?></div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">End Time</label>
                                        <div class="form-control"><?=$endTime?></div>
                                    </div>

                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Application Status</label>
                                            <?php
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
                                            ?>
                                        <div class="form-control">
                                            <span class="badge <?=$card_class?> <?=$text_class?>"><?=$row['app_status']?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="" class="form-label">Status</label>
                                        <div class="form-control">
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
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>

                        </form>

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
            // $('#appointments_table').DataTable();

            // DELETE APPOINTMENT 
            $('body').on('click', '.delete_app-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure you want to delete this appointment?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    confirmButtonColor: '#dc3545',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "action.php",
                            data: {id:id, action:'del_app'},
                            success: function (response) {
                                if(response === 'success')
                                {
                                    update_app();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: false
                                    })
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Appointment has been deleted!'
                                    })
                                }
                                else
                                {
                                    Swal.fire(
                                        'Something went wrong!',
                                        'Unable to delete appointment.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                                console.log(status);
                                console.log(error);
                            }
                        });
                    }
                });
            })


            function update_app() 
            {
                $.ajax({
                    type: "GET",
                    url: "get_app.php",
                    success: function (response) {
                        $('#appointments_table').empty().html(response);
                    }
                });
            }


        })
    })
</script>