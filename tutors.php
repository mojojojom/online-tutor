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
                            <h5 class="fw-bold">OUR TUTORS</h5>
                            <nav class="card p-2 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="c_course-left-nav-search-wrap">
                                            <input type="text" class="form-control" id="searchTutor" aria-describedby="emailHelp" placeholder="Enter tutor name">
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>

                        <div class="row" id="tutors_list-wrap">
                            <?php
                            $query = mysqli_query($db, "SELECT * FROM tutors WHERE status='Yes'");
                            if(mysqli_num_rows($query) > 0) {
                                while($tutor = mysqli_fetch_assoc($query)) {
                                    $name = $tutor['f_name']. " " .$tutor['l_name'];
                                    $course = $tutor['course']. " - " .$tutor['y_lvl'];
                            ?>
                                    <div class="col-md-6 col-lg-4 tutor_page-card mb-3" id="<?=$name?>">
                                        <div class="card">
                                            <a href="tutor-profile.php?id=<?=$tutor['u_id']?>">
                                                <div class="tutor_page-card-img-wrap">
                                                    <?php
                                                    if(empty($row['dp']))
                                                    {
                                                    ?>
                                                    <img src="images/DEFAULT/user_icon.png" alt="" class="tutor_page-card-img">
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <img src="uploads/tutors/<?=$tutor['dp']?>" alt="" class="tutor_page-card-img">
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($tutor['active_status'] === '1')
                                                    {
                                                    ?>
                                                    <span class="badge bg-success position-absolute text-center fw-normal d-flex align-items-center gap-2" style="top: 10px; right: 10px;"><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Online</span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <span class="badge bg-secondary position-absolute text-center fw-normal d-flex align-items-center gap-2" style="top: 10px; right: 10px;"><i class="fa-solid fa-circle" style="font-size: 5px;"></i> Offline</span>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="tutor_page-card-body">
                                                    <p class="mb-0 tutor_name"><?=$name?></p>
                                                    <p class="mb-2 tutor_course"><?=$course?></p>
                                                    <div class="d-flex align-items-center gap-1 tutor_page-card-stars-wrap">
                                                        <div class="tutor_profile-stars tutor_page-card-stars d-flex align-items-center gap-1">
                                                            <i class="fa-solid fa-star"></i>
                                                            <p class="mb-0">5</p>
                                                        </div>
                                                        <p class="mb-0 text-secondary">(10 reviews)</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                            ?>
                            <div class="c_course-left-content-wrap">
                                <span class="alert alert-danger d-flex align-items-center justify-content-center fw-bold">NO ACTIVE TUTORS AVAILABLE</span>
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
                                                    if(empty($row['dp']))
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
            $("#searchTutor").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#tutors_list-wrap .tutor_page-card").filter(function() {
                var match = $(this).text().toLowerCase().indexOf(value) > -1;
                if (match) {
                    $(this).show();
                    $(this).animate({ opacity: 1 }, 200);
                } else {
                    $(this).animate({ opacity: 0 }, 200, function() {
                    $(this).hide();
                    });
                }
                return match;
                });
            });
        });

    })

</script>