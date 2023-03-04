<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();

    include('header.php');
?>


    <section class="c_course-banner-wrap sec-pad">
        <div class="container">

            <div class="c_course-sub-wrap">
                <div class="row">

                    <!-- MAIN CONTENT -->
                    <div class="col-lg-9 c_course-left-wrap">
                        <div class="c_course-left-nav-wrap">
                            <?php
                            $get_title = mysqli_query($db, "SELECT * FROM courses WHERE course_code='".$_GET['course']."'");
                            while($cname = mysqli_fetch_array($get_title)) {
                                $course = $cname['course_name'];
                            }
                            ?>
                            <h5 class="fw-bold text-uppercase text-center text-md-start">AVAILABLE TUTORS FOR <span class="t-primary"><?=$course?></span></h5>
                        </div>

                        <div class="row">

                            <?php
                            $query = mysqli_query($db, "SELECT tutor_id, course_name FROM schedules WHERE course_name = '".$_GET['course']."' AND status='Active' GROUP BY tutor_id, course_name");

                            if(mysqli_num_rows($query) > 0) {
                                while($tutor = mysqli_fetch_assoc($query)) {

                                    $get_user = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '{$tutor['tutor_id']}'");
                                    $user = mysqli_fetch_assoc($get_user);

                                    $name = $user['f_name']. " " .$user['l_name'];
                                    $course = $user['course']. " - " .$user['y_lvl'];

                            ?>
                                    <div class="col-md-6 col-lg-4 tutor_page-card mb-4">
                                        <div class="card">
                                            <a href="tutor-profile.php?id=<?=$tutor['tutor_id']?>">
                                                <div class="tutor_page-card-img-wrap">
                                                    <?php
                                                    if(empty($user['dp']))
                                                    {
                                                    ?>
                                                    <img src="images/DEFAULT/user_icon.png" alt="" class="tutor_page-card-img">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <img src="uploads/tutors/<?=$user['dp']?>" alt="" class="tutor_page-card-img">
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($tutor['active_status'] === '1')
                                                    {
                                                    ?>
                                                    <span class="badge bg-success position-absolute text-center fw-normal d-flex align-items-center gap-2" style="top: 10px; right: 10px;"><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Online</span>
                                                    <?php
                                                    } 
                                                    else 
                                                    {
                                                    ?>
                                                    <span class="badge bg-secondary position-absolute text-center fw-normal d-flex align-items-center gap-2" style="top: 10px; right: 10px;"><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Offline</span>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="tutor_page-card-body">
                                                    <p class="mb-0 tutor_name"><?=$name?></p>
                                                    <p class="mb-2 tutor_course" style="font-size:14px;"><?=$course?></p>
                                                    <div class="tutor_page-card-stars-wrap">
                                                        <a href="#course_sched-<?=$tutor['tutor_id']?>" class="c-btn c-btn-inline c-btn-primary" data-bs-toggle="modal" data-bs-target="#course_sched-<?=$tutor['tutor_id']?>">SEE AVAILABLE SCHEDULES</a>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- SCEDULES MODAL -->
                                    <div class="modal fade" id="course_sched-<?=$tutor['tutor_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-lg-down">
                                            <div class="modal-content">
                                                <form method="POST" id="course_sched-form">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"><?=$user['f_name']?>'s Schedule</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <table class="table table-bordered table-hover table-responsive mb-0 table-responsive-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">Date</th>
                                                                            <th scope="col">Day</th>
                                                                            <th scope="col">Start Time</th>
                                                                            <th scope="col">End Time</th>
                                                                            <th scope="col">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $get_single = mysqli_query($db, "SELECT * FROM schedules WHERE tutor_id = '".$tutor['tutor_id']."' AND status = 'Active' AND course_name = '".$_GET['course']."'");
                                                                        if(mysqli_num_rows($get_single) > 0)
                                                                        {
                                                                            while($sched = mysqli_fetch_array($get_single))
                                                                            {
                                                                                $getDate = $sched['sched_date'];
                                                                                $date = date('F j, Y', strtotime($getDate));
                                                                                $day = date('l', strtotime($getDate));
                                                                                $stime = $sched['app_time_start'];
                                                                                $etime = $sched['app_time_end'];
                                                                                $startTime = date('h:i:s A', strtotime($stime));
                                                                                $endTime = date('h:i:s A', strtotime($etime));
                                                                        ?>
                                                                            <tr>
                                                                                <th scope="row"><?=$date?></th>
                                                                                <td><?=$day?></td>
                                                                                <td><?=$startTime?></td>
                                                                                <td><?=$endTime?></td>
                                                                                <td class="text-center">
                                                                                    <?php
                                                                                    if(isset($_SESSION['t_uid']))
                                                                                    {
                                                                                    ?>
                                                                                    <a class="t-desc"><i class="fa-solid fa-square-plus"></i></a>
                                                                                    <?php
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                    ?>
                                                                                    <a href="#" class="t-primary confirm_appointment" data-id="<?=$sched['sched_id']?>"><i class="fa-solid fa-square-plus"></i></a>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <td colspan="5"><span class="alert alert-danger d-flex align-items-center justify-content-center fw-bold mb-0">NO AVAILABLE SCHEDULES</span></td>
                                                                        <?php
                                                                        }
                                                                        ?>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                            ?>
                            <div class="c_course-left-content-wrap">
                                <span class="alert alert-danger d-flex align-items-center justify-content-center fw-bold mb-4">NO ACTIVE TUTORS AVAILABLE</span>
                            </div>
                            <?php
                            }
                            ?>
                            
                        </div>


                    </div>

                    <!-- SIDEBAR -->
                    <div class="col-lg-3 c_course-right-wrap">

                        <div class="c_course-right-inner-wrap">
                            <h5 class="fw-bold">NEW TUTORS</h5>

                                <div class="row">
                                    <?php
                                    $query = mysqli_query($db, "SELECT * FROM tutors WHERE status='Yes' LIMIT 3");
                                    if(mysqli_num_rows($query) > 0) {
                                        while($tutor = mysqli_fetch_array($query)) {
                                    ?>
                                    <div class="col-md-6 col-lg-12">
                                        <div class="card mb-2 tutor_new-add">
                                            <a href="tutor-profile.php?id=<?=$tutor['u_id']?>" class="p-1">
                                                <div class="c_course-right-main-wrap d-flex align-items-start gap-2">

                                                    <?php
                                                    if(empty($user['dp']))
                                                    {
                                                    ?>
                                                    <img class="img-thumbnail" src="images/DEFAULT/user_icon.png" style="height: 80px; width:30%; object-fit:cover;" alt="">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <img class="img-thumbnail" src="uploads/tutors/<?=$tutor['dp']?>" style="height: 80px; width:30%; object-fit:cover;" alt="">
                                                    <?php
                                                    }
                                                    ?>
                                                    <div>
                                                        <h6 class="mb-0 fw-semibold"><?=$tutor['f_name']." ".$tutor['l_name']?></h6>
                                                        <p class="mb-0" style="font-size: 14px;"><?=$tutor['course']."-".$tutor['y_lvl']?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                    <span class="alert alert-danger d-flex align-items-center justify-content-center fw-bold">NO TUTORS AVAILABLE</span>
                                    <?php
                                    }
                                    ?>
                                </div>

                            <div class="c_course-right-btn-wrap">
                                <a href="tutors.php" class=" c-btn c-btn-primary c-btn-inline c-btn-sm">VIEW ALL TUTORS</a>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>


<?php
    include('footer.php');
?>

<script>
    jQuery(function($) {
        $(document).ready(function() {

            $('.confirm_appointment').click(function(e) {
                e.preventDefault();

                var id = $(this).data('id');

                Swal.fire({
                title: 'Are you sure you want to set a schedule?',
                text: "This action cannot be undone.",
                icon: 'info',
                confirmButtonColor: '#315dfc',
                cancelButtonColor: "#dc3545",
                showCancelButton: true,
                confirmButtonText: 'Confirm'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                        url: 'action.php',
                        type: 'POST',
                        data: { id: id, action:'book_sched' },
                        success: function(response) {
                            if(response === 'success')
                            {
                                // SHOW STATUS
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true
                                })
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Your appointment has been made!'
                                })
                            }
                            else if(response === 'error_user')
                            {
                                Swal.fire({
                                    title: 'Something went wrong!',
                                    text: 'Please login before making an appointment.',
                                    icon: 'error'
                                });
                            }
                            else if(response === 'error_admin')
                            {
                                Swal.fire({
                                    title: 'Something went wrong!',
                                    text: 'Only tutees can make an appointment.',
                                    icon: 'error'
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    title: 'Something went wrong!',
                                    text: 'Unable to apply for this course.',
                                    icon: 'error'
                                });
                            }
                        }
                        });
                    }
                });


            })

        })
    })
</script>