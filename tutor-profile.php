<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();

    include('header.php');
?>

    <section class="t_banner-wrap sec-pad">
        <div class="container">

            <div class="row">

                <div class="col-12">

                    <?php
                    $check_tutor = mysqli_query($db, "SELECT * FROM tutors WHERE u_id='".$_GET['id']."'");
                    if(mysqli_num_rows($check_tutor) > 0)
                    {
                    ?>
                        <div class="row">

                            <!-- PROFILE -->
                            <div class="col-lg-4 mb-3">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <?php
                                            $tut_id = $_GET['id'];
                                            $get_tutor = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '$tut_id'");
                                            $fetch = mysqli_fetch_assoc($get_tutor);
                                            $fullname = $fetch['f_name']. " " .$fetch['l_name'];
                                        ?>
                                        <div class="tutor_profile-wrap">
                                            <div class="tutor_profile-img-wrap d-flex align-items-center justify-content-center mb-2 position-relative">
                                                <?php
                                                if($fetch['active_status'] === '1')
                                                {
                                                ?>
                                                <span class="badge bg-success position-absolute top-0 end-0 text-center fw-normal d-flex align-items-center gap-2"><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Online</span>
                                                <?php
                                                } else {
                                                ?>
                                                <span class="badge bg-secondary position-absolute top-0 end-0 text-center fw-normal d-flex align-items-center gap-2"><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Offline</span>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if(empty($fetch['dp']))
                                                {
                                                ?>
                                                <img style="object-fit: cover; width: 180px; height: 180px; border-radius: 100%;" src="images/DEFAULT/user_icon.png" alt="User Image">
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <img style="object-fit: cover; width: 180px; height: 180px; border-radius: 100%;" src="uploads/tutors/<?=$fetch['dp']?>" alt="User Image">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="tutor_profile-info-wrap text-center mb-3">
                                                <h5 class="fw-semibold d-flex align-items-center gap-2 justify-content-center">
                                                    <?=$fullname?>
                                                    <?php
                                                    $check_cv = mysqli_query($db, "SELECT * FROM tutors_cv WHERE u_id = '$tut_id'");
                                                    if(mysqli_num_rows($check_cv) > 0)
                                                    {
                                                        while($cv = mysqli_fetch_array($check_cv))
                                                        {
                                                    ?>
                                                        <img src="/icons/verified-symbol-icon.svg" style="height: 16px; width:16px;" alt="">
                                                    <?php
                                                        }
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <!-- <img src="/icons/verified-symbol-icon.svg" style="height: 16px; width:16px;" alt=""> -->
                                                    <?php
                                                    }
                                                    ?>
                                                </h5>
                                                <p class="mb-2"><?=$fetch['my_tagline']?></p>

                                                <!-- REVIEWS -->
                                                <div class="tutor_profile-stars-wrap d-flex align-items-center justify-content-center gap-1">
                                                    <div class="tutor_profile-stars">
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                        <i class="fa-solid fa-star"></i>
                                                    </div>
                                                    <p class="mb-0">5</p>
                                                    <p class="mb-0 text-secondary">(10 reviews)</p>
                                                </div>

                                            </div>
                                            <div class="tutor_profile-details-wrap">
                                                <div class="tutor_profile-course d-md-flex align-items-center justify-content-between mb-2">
                                                    <p class="fw-normal d-flex align-items-center gap-2 mb-0"><i class="fa-solid fa-book"></i>Program & Year</p>
                                                    <p class="fw-semibold mb-0"><?=$fetch['course']." ".$fetch['y_lvl']?></p>
                                                </div>
                                                <div class="tutor_profile-email d-md-flex align-items-center justify-content-between mb-2">
                                                    <p class="fw-normal d-flex align-items-center gap-2 mb-0"><i class="fa-solid fa-envelope"></i>Email</p>
                                                    <p class="fw-semibold mb-0"><?=$fetch['email']?></p>
                                                </div>
                                                <div class="tutor_profile-num d-md-flex align-items-center justify-content-between mb-2">
                                                    <p class="fw-normal d-flex align-items-center gap-2 mb-0"><i class="fa-solid fa-mobile"></i>Contact Number</p>
                                                    <p class="fw-semibold mb-0"><?=$fetch['num']?></p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-3">
                                                <?php
                                                $check_cv = mysqli_query($db, "SELECT * FROM tutors_cv WHERE u_id = '$tut_id'");
                                                if(mysqli_num_rows($check_cv) > 0)
                                                {
                                                    while($cv = mysqli_fetch_array($check_cv))
                                                    {
                                                ?>
                                                    <a class=" c-btn c-btn-sm c-btn-sm-primary t-light fw-bold" href="view-cv.php?id=<?=$fetch['u_id']?>" target="_blank"><i class="fa-solid fa-file"></i> VIEW CV</a>
                                                <?php
                                                    }
                                                }
                                                else
                                                {
                                                ?>
                                                    <a class=" c-btn c-btn-sm c-btn-sm-primary bg-secondary t-light fw-bold disabled" href="view-cv.php?id=<?=$fetch['u_id']?>"><i class="fa-solid fa-file"></i> VIEW CV</a>
                                                <?php
                                                }
                                                ?>
                                                
                                            </div>
                                        </div>
                                            
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-2">Introduction</h6>
                                        <p class="mb-0 text-secondary"><?=$fetch['about_me']?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- SCHEDULES -->
                            <div class="col-lg-8 mb-3">

                                <h5 class="fw-bold mb-2"><?=$fullname?>'s Courses</h5>

                                <!-- <div class="row mb-3" style="min-height: 100vh;"> -->
                                <div class="row mb-3">

                                    <?php
                                    $get_sched = mysqli_query($db, "SELECT * FROM schedules WHERE tutor_id='$tut_id' AND status='Active'");
                                    if(mysqli_num_rows($get_sched) > 0)
                                    {
                                        while($row = mysqli_fetch_array($get_sched))
                                        {
                                            $get_course_name = mysqli_query($db, "SELECT * FROM courses WHERE course_code='".$row['course_name']."'");
                                            $cname = mysqli_fetch_assoc($get_course_name);
                                            $getDate = $row['sched_date'];
                                            $date = date('F j, Y', strtotime($getDate));
                                            $day = date('l', strtotime($getDate));
                                            $stime = $row['app_time_start'];
                                            $etime = $row['app_time_end'];
                                            $startTime = date('h:i:s A', strtotime($stime));
                                            $endTime = date('h:i:s A', strtotime($etime));
                                    ?>
                                        <div class="col-md-6 col-lg-4 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <!-- <img style="object-fit: cover; width: 30px; height: 30px; border-radius: 100%;" src="uploads/tutors/<?=$fetch['dp']?>" alt=""> -->
                                                        <a href="tutors-list.php?course=<?=$row['course_name']?>" class="mb-2 fw-bold text-capitalize t-primary" style="min-height: 50px;"><?=$cname['course_name']?></a>
                                                    </div>
                                                    <div class="tutor_profile-course-info">
                                                        <div class="tutor_profile-course-date">
                                                            <p class="mb-0 fw-bold" style="font-size: 14px;">AVAILABLE DATE</p>
                                                            <!-- <p class="mb-3"><?=$row['sched_date']?></p> -->
                                                            <p class="mb-3"><?=$day.' - '.$date?></p>
                                                        </div>
                                                        <div class="tutor_profile-course-date">
                                                            <p class="mb-0 fw-bold" style="font-size: 14px;">START OF SESSION TIME</p>
                                                            <p class="mb-3"><?=$row['app_time_start']?></p>
                                                        </div>
                                                        <div class="tutor_profile-course-date">
                                                            <p class="mb-0 fw-bold" style="font-size: 14px;">END OF SESSION TIME</p>
                                                            <p class="mb-3"><?=$row['app_time_end']?></p>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer bg-white p-0">
                                                        <?php
                                                        if(isset($_SESSION['t_uid']) || $row['status'] === 'Inactive')
                                                        {
                                                        ?>
                                                        <button class="c-btn-sm c-btn-inline c-btn-primary bg-secondary t-light mt-2 disabled" disabled="true" style="font-size: 12px;">BOOK AN APPOINTMENT</button>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <a href="#" class="c-btn-sm c-btn-inline c-btn-primary t-light mt-2" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#book_sched<?=$row['sched_id']?>">BOOK A CONSULTATION</a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- BOOK SCHED MODAL -->
                                        <div class="modal fade" id="book_sched<?=$row['sched_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form method="POST">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">CONFIRMATION</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <h6 class="mb-0">Are you sure you want to book a sched for <br><span class="fw-semibold t-primary"><?=$cname['course_name']?></span>?</h6>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class=" c-btn c-btn-primary c-btn-sm book_sched-btn" data-id="<?=$row['sched_id']?>" data-bs-dismiss="modal">Confirm</button>
                                                            <button type="button" class=" c-btn c-btn-sm c-btn-primary bg-danger text-light border border-0" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    } else {
                                    ?>
                                        <span class="alert alert-danger d-flex justify-content-center align-items-center fw-bold">NO COURSES AVAILABLE!</span>
                                    <?php
                                    }
                                    ?>

                                </div>

                                <?php
                                $get_reviews = mysqli_query($db, "SELECT * FROM tutors_testi WHERE t_id = '{$_GET['id']}'");
                                $reviews = mysqli_num_rows($get_reviews);
                                ?>

                                <h6 class="fw-bold">
                                    <?php
                                    if ($reviews > 0) {
                                    ?>
                                        <?=$courses?> reviews for <?=$fullname?>
                                    <?php
                                    } else {
                                    ?>
                                        No available reviews for <?=$fullname?>
                                    <?php
                                    }
                                    ?>
                                </h6>

                                <?php
                                if($reviews > 0)
                                {
                                ?>
                                    <div class="tutor_profile-reviews-wrap">

                                        <div class="mt-4 tutor_profile-review-main-wrap">
                                            <div class="tutor_profile-review-inner-wrap">
                                                <div class="tutor_profile-review-info-wrap d-flex align-items-center gap-2">
                                                    <img src="uploads/tutors/<?=$fetch['dp']?>" style="height: 50px; width: 50px; object-fit: cover; border-radius: 100%;" alt="">
                                                    <div class="tutor_profile-review-info-wrap">
                                                        <h6 class="fw-semibold mb-0">Sample Name</h6>
                                                        <p class="mb-0">Sample Program</p>
                                                    </div>
                                                </div>
                                                <div class="tutor_profile-review-wrap mb-4">
                                                    <div class="d-flex align-items-center gap-1 mb-1">
                                                        <div class="tutor_profile-stars">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <p class="mb-0 fw-semibold">5</p>
                                                    </div>
                                                    <div class="tutor_profile-review">
                                                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est, repellat iure? Repellendus, minima temporibus omnis modi eligendi veritatis ab aliquam repellat ut dicta sunt vel, dolore sit aut nisi nulla.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php
                                }
                                ?>





                            </div>

                        </div>
                    <?php
                    } 
                    else
                    {
                    ?>
                    <span class="alert alert-danger fw-bold text-center d-flex justify-content-center align-items-center">USER DOESN'T EXISTS</span>
                    <?php
                    }
                    ?>

                </div>

            </div>

        </div>
    </section>

<?php
    include('footer.php');
?>

<script>

    jQuery(function($) {
        $(document).ready(function () {
            $('.book_sched-btn').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                
                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: {id:id, action:'book_sched'},
                    success: function (response) {
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

            })
        })
    })

</script>