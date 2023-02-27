<?php
    include('header.php');
?>

        <!-- SIDEBAR -->
        <aside id="sidebar" class="sidebar">
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
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
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>

            <section class="section dashboard">
                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- TUTORS -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                    Tutors
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $query = mysqli_query($db, "SELECT * FROM tutors");
                                            $count = mysqli_num_rows($query);
                                            
                                            if($count > 0)
                                            {
                                            ?>
                                            <h6><?=$count?></h6>
                                            <?php
                                            } else {
                                            ?>
                                            <h6>0</h6>
                                            <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- TUTEES -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                    Tutees
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                        <?php
                                            $query = mysqli_query($db, "SELECT * FROM tutees");
                                            $count = mysqli_num_rows($query);
                                            
                                            if($count > 0)
                                            {
                                            ?>
                                            <h6><?=$count?></h6>
                                            <?php
                                            } else {
                                            ?>
                                            <h6>0</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- COURSES -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                    Courses
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                                        >
                                            <i class="fa-solid fa-book"></i>
                                        </div>
                                        <div class="ps-3">
                                        <?php
                                            $query = mysqli_query($db, "SELECT * FROM courses");
                                            $count = mysqli_num_rows($query);
                                            
                                            if($count > 0)
                                            {
                                            ?>
                                            <h6><?=$count?></h6>
                                            <?php
                                            } else {
                                            ?>
                                            <h6>0</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- APPOINTMENTS -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                    Appointments
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <!-- <i class="bi bi-calendar"></i> -->
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $query = mysqli_query($db, "SELECT * FROM appointments");
                                            $count = mysqli_num_rows($query);
                                            
                                            if($count > 0)
                                            {
                                            ?>
                                            <h6><?=$count?></h6>
                                            <?php
                                            } else {
                                            ?>
                                            <h6>0</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- SCHEDULES -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                    Active Schedules
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <!-- <i class="bi bi-calendar"></i> -->
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $query = mysqli_query($db, "SELECT * FROM schedules WHERE status = 'Active'");
                                            $count = mysqli_num_rows($query);
                                            
                                            if($count > 0)
                                            {
                                            ?>
                                            <h6><?=$count?></h6>
                                            <?php
                                            } else {
                                            ?>
                                            <h6>0</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- SCHEDULES -->
                            <div class="col-md-4 col-lg-3">
                                <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                    Total Schedules Made
                                    </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <!-- <i class="bi bi-calendar"></i> -->
                                            <i class="fa-solid fa-calendar-days t-primary"></i>
                                        </div>
                                        <div class="ps-3">
                                            <?php
                                            $query = mysqli_query($db, "SELECT * FROM schedules");
                                            $count = mysqli_num_rows($query);
                                            
                                            if($count > 0)
                                            {
                                            ?>
                                            <h6><?=$count?></h6>
                                            <?php
                                            } else {
                                            ?>
                                            <h6>0</h6>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>
        </main>

<?php
    include('footer.php');
?>
