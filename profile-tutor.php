<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();

    include('header.php');
?>

    <section class="t_banner-wrap sec-pad">
        <div class="container">

            <!-- MESSAGE -->
            <?php
                if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?>

            <div class="row">

                <div class="col-12">

                    <?php
                    $tut_id = $_SESSION['t_uid'];
                    $check_tutor = mysqli_query($db, "SELECT * FROM tutors WHERE u_id='$tut_id'");
                    if(mysqli_num_rows($check_tutor) > 0)
                    {
                    ?>
                    
                    <?php
                        $get_tutor = mysqli_query($db, "SELECT * FROM tutors WHERE u_id = '$tut_id'");
                        $fetch = mysqli_fetch_assoc($get_tutor);
                        $fullname = $fetch['f_name']. " " .$fetch['l_name'];

                        $get_cv = mysqli_query($db, "SELECT * FROM tutors_cv WHERE u_id = '$tut_id'");
                        $cv = mysqli_num_rows($get_cv);
                        if($cv <= 0)
                        {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                            <strong>Verify your account</strong> by uploading your CV.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                        }
                    ?>
                        <div class="row">

                            <!-- PROFILE -->
                            <div class="col-lg-4 mb-3">
                                <div class="card mb-3">
                                    <div class="card-body">
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
                                                <img style="object-fit: cover; width: 180px; height: 180px; border-radius: 100%;" src="uploads/tutors/<?=$fetch['dp']?>" alt="User Image">
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
                                                    <a class=" c-btn c-btn-sm c-btn-sm-primary t-light fw-bold" href="#upload_cv" data-bs-toggle="modal" data-bs-target="#upload_cv"><i class="fa-solid fa-file"></i> UPLOAD CV</a>
                                                <?php
                                                }
                                                ?>

                                                <div class="modal fade" id="upload_cv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form method="POST" action="action.php" enctype="multipart/form-data">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">UPLOAD YOUR CV</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">YOUR CV</label>
                                                                            <input type="file" class="form-control" name="cv" >
                                                                            <input type="hidden" name="action" value="upload_cv">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class=" c-btn c-btn-primary c-btn-sm" id="upload_cv_btn" data-id="<?=$tut_id?>">UPLOAD</button>
                                                                    <button type="button" class=" c-btn c-btn-primary c-btn-sm bg-danger border border-1 border-danger" data-bs-dismiss="modal">CANCEL</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                
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

                                <!-- <div class="card mb-3">
                                    <div class="card-body"> -->
                                        <button class=" c-btn c-btn-inline c-btn-primary c-btn-sm" data-bs-toggle="modal" data-bs-target="#edit_tutee<?=$tut_id?>">EDIT PROFILE</button>
                                    <!-- </div>
                                </div> -->

                            </div>

                            <!-- SCHEDULES -->
                            <div class="col-lg-8 mb-3">

                                <h5 class="fw-bold mb-2">Your Active Courses</h5>

                                <!-- <div class="row mb-3" style="min-height: 100vh;"> -->
                                <div class="row mb-3">

                                    <?php
                                    $get_sched = mysqli_query($db, "SELECT * FROM schedules WHERE tutor_id='$tut_id'");
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
                                                        <p class="mb-2 fw-bold text-capitalize t-primary" style="min-height: 50px;"><?=$cname['course_name']?></p>
                                                    </div>
                                                    <div class="tutor_profile-course-info">
                                                        <div class="tutor_profile-course-date">
                                                            <p class="mb-0 fw-bold" style="font-size: 14px;">AVAILABLE DATE</p>
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
                                    
                                    <!-- BUTTON -->
                                    <div class="text-center d-flex align-items-center justify-content-center">
                                        <a href="dashboard.php" class="c-btn c-btn-primary c-btn-sm">MANAGE SCHEDULE</a>
                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- EDIT PROFILE MODAL -->
                        <div class="modal fade" id="edit_tutee<?=$tut_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <!-- <div class="modal-header">
                                        <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel">EDIT YOUR PROFILE</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div> -->
                                    <div class="modal-body">
                                        <h1 class="modal-title fs-5 fw-bold mb-2" id="exampleModalLabel">EDIT YOUR PROFILE</h1>
                                        <form method="POST" action="action.php" enctype="multipart/form-data">

                                            <div class="card">
                                                <div class="card-body">

                                                    <div class="row">
                                                        
                                                        <div class="col-12 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">USERNAME</label>
                                                            <input type="text" class="form-control" name="username" value="<?=$fetch['username']?>" >
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">FIRST NAME</label>
                                                            <input type="text" class="form-control" name="fname" value="<?=$fetch['f_name']?>" >
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">LAST NAME</label>
                                                            <input type="text" class="form-control" name="lname" value="<?=$fetch['l_name']?>" >
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">EMAIL</label>
                                                            <div class="form-control" ><?=$fetch['email']?></div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">PHONE NUMBER</label>
                                                            <input type="text" class="form-control" name="phone" value="<?=$fetch['num']?>" >
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">Password</label>
                                                            <input type="password" class="form-control" name="pass" value="" placeholder="********">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">Repeat Password</label>
                                                            <input type="password" class="form-control" name="r_pass" value="" placeholder="********">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">PROGRAM</label>
                                                            <input type="text" class="form-control text-uppercase" name="course" id="tutor_course" value="<?=$fetch['course']?>" placeholder="e.g. BS INFO TECH">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">YEAR LEVEL</label>
                                                            <select id="tutor_level" class="form-select" name="level" aria-label="Default select">
                                                                <option selected><?=$fetch['y_lvl']?></option>
                                                                <option value="1">I</option>
                                                                <option value="2">II</option>
                                                                <option value="3">III</option>
                                                                <option value="4">IV</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">YOUR IMAGE</label>
                                                            <input type="file" class="form-control" name="dp" >
                                                        </div>
                                                        <!-- <div class="col-md-6 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">YOUR CV</label>
                                                            <input type="file" class="form-control" name="cv" >
                                                        </div> -->
                                                        <div class="col-12 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">TAGLINE</label>
                                                            <input type="text" class="form-control" name="tagline" value="<?=$fetch['my_tagline']?>" >
                                                        </div>
                                                        <div class="col-12 mb-3">
                                                            <label for="vcode" class="form-label mb-1 fw-bold" style="font-size: 14px;">INTRODUCTION</label>
                                                            <textarea name="intro" rows="3" class="form-control"><?=$fetch['about_me']?></textarea>
                                                        </div>

                                                    </div>
                                                
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <input type="hidden" name="action" value="edit_tutor">
                                                        <button type="submit" class=" c-btn c-btn-primary c-btn-sm" id="upload_cv_btn" data-id="<?=$tut_id?>">SAVE</button>
                                                        <button type="button" class=" c-btn c-btn-primary c-btn-sm bg-danger border border-1 border-danger" data-bs-dismiss="modal">CANCEL</button>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </form>
                                    </div>
                                </div>
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