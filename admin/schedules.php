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
                    <a class="nav-link active" href="schedules.php">
                    <i class='bi bi-calendar-event'></i>
                        <span>Tutor Schedules</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointments.php">
                    <i class='bi bi-calendar-check' ></i>
                        <span>Appointments</span>
                    </a>
                </li>
                <!-- End Error 404 Page Nav -->

            </ul>
        </aside>

        <!-- MAIN PAGE -->
        <main id="main" class="main main-wrap">
            <div class="pagetitle">
                <h1>Schedules</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Schedules</li>
                    </ol>
                </nav>
            </div>

            <section class="admin_courses-wrap">
                <div class="card">
                    <div class="card-body">

                        <table class="table table-striped table-bordered py-3" id="sched_table">
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
                        </table>

                    </div>
                </div>
            </section>

        </main>

<?php
    include('footer.php');
?>

<script>
    jQuery(function($) {
        $(document).ready(function () {


            $('#sched_table').DataTable();

            $('body').on('click', '.delete_sched-btn', function(e) {
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
                            data: {id:id, action:'del_sched'},
                            success: function (response) {
                                if(response === 'success')
                                {
                                    update_sched();
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: false
                                    })
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Schedule has been deleted!'
                                    })
                                }
                                else
                                {
                                    Swal.fire(
                                        'Something went wrong!',
                                        'Unable to delete Schedule.',
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

            function update_sched()
            {
                $.ajax({
                    type: "GET",
                    url: "get_sched.php",
                    success: function (response) {
                        $('#sched_table').empty().html(response);
                    }
                });
            }


        });
    })
</script>