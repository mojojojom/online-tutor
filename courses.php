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
                            <h5 class="fw-bold">AVAILABLE COURSES</h5>
                            <nav class="card p-2 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="c_course-left-nav-search-wrap">
                                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a course you want">
                                            <div class="c_course-left-nav-search-btn">
                                                <a href="#" class="d-flex align-items-center gap-2 justify-content-center">SEARCH<i class="fa-solid fa-magnifying-glass"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                        <div class="row">

                        <?php
                        $get_courses = mysqli_query($db, "SELECT * FROM courses");
                        if(mysqli_num_rows($get_courses) > 0)
                        {
                            while($course = mysqli_fetch_assoc($get_courses))
                            {
                                $count_tutors = mysqli_query($db, "SELECT * FROM schedules INNER JOIN courses ON schedules.course_name = courses.course_code WHERE schedules.course_name='".$course['course_code']."'");
                        ?>
                                <div class="col-lg-3 c_course-card-wrap mb-3">
                                    <a href="tutors-list.php?course=<?=$course['course_code']?>">
                                        <div class="card c_course-card">
                                            <div class="card-body text-center">
                                                <div class="c_course-card-title-wrap">
                                                    <h6 class="mb-0"><?=$course['course_name']?></h6>
                                                    <?php
                                                    $query = mysqli_query($db, "SELECT tutor_id, course_name FROM schedules WHERE course_name = '".$course['course_code']."' AND status = 'Active' GROUP BY tutor_id, course_name");
                                                    $courses = mysqli_num_rows($query);

                                                    if ($courses > 0) {
                                                    ?>
                                                        <p class="mb-0 c_course-card-tutors"><?=$courses?> Available Tutors</p>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <p class="mb-0 c_course-card-tutors">No available tutors</p>
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php
                            }
                        } 
                        else 
                        {
                        ?>
                            <div class="c_course-left-content-wrap">
                                <span class="alert alert-danger d-flex align-items-center justify-content-center fw-bold">NO COURSES AVAILABLE</span>
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
                                                    <img class="img-thumbnail" src="uploads/tutors/<?=$tutor['dp']?>" style="height: 80px; width:30%; object-fit:cover;" alt="">
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

            // $('.c_course-card-wrap').mouseenter(function () {
            //     $('.c_course-card-tutors').animate({
            //         marginTop: "0px",
            //         opacity: '1'
            //     }, 300);
            // });

            // $('.c_course-card-wrap').mouseleave(function () {
            //         $('.c_course-card-tutors').animate({
            //             marginTop: "30px",
            //             opacity: '0'
            //         }, 300);
            //     }
            // ).mouseleave();

        })
    })
</script>