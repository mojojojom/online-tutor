<?php
    if(isset($_SESSION['admin_id']))
    {
        header('Location: admin/index.php');
    }
    include('session_expire.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tutor</title>

        <?php
            include('styles.php');
        ?>

    </head>
    <body>

        <header class="main_header" id="main_header">
            <nav class="container" id="main_nav">
                <div class="main_nav">

                    <div class="main_nav-logo">
                        <a href="#" class="fw-bold">LOGO</a>
                    </div>
                    <div class="main_nav-links d-none d-lg-flex">
                        <ul class="main_ul">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="courses.php">Courses</a></li>
                            <li><a href="tutors.php">Tutors</a></li>
                            <div class="main_nav-hr"></div>
                            <?php
                            if(isset($_SESSION['uid'])) 
                            {
                                ?>
                                <?php
                                    $get_user = mysqli_query($db, "SELECT * FROM tutees WHERE id='".$_SESSION['uid']."'");
                                    if(mysqli_num_rows($get_user) > 0) {
                                        $user = mysqli_fetch_array($get_user);
                                        $username = $user['username'];
                                        $img = $user['dp'];
                                    }
                                ?>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button class="btn btn-link text-decoration-none nav-link mx-2 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img class="header-img" style="height: 25px; width: 25px; border-radius: 50px; object-fit:cover;" src="/uploads/tutees/<?=$img?>" alt=""> <?=$username?>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="profile.php" class="dropdown-item text-start">Profile</a></li>
                                            <li><a href="chats.php" class="dropdown-item text-start">Messages</a></li>
                                            <li><a href="logout.php" class="dropdown-item text-start">Logout</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }
                            else if(isset($_SESSION['t_uid']))
                            {
                                ?>
                                    <?php
                                        $get_user = mysqli_query($db, "SELECT * FROM tutors WHERE u_id='".$_SESSION['t_uid']."'");
                                        if(mysqli_num_rows($get_user) > 0) {
                                            $user = mysqli_fetch_array($get_user);
                                            $username = $user['username'];
                                            $img = $user['dp'];
                                        }
                                    ?>
                                    <li class="nav-item">
                                        <div class="dropdown">
                                            <button class="btn btn-link text-decoration-none nav-link mx-2 dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <img class="header-img" style="height: 25px; width: 25px; border-radius: 50px; object-fit:cover;" src="/uploads/tutors/<?=$img?>" alt=""> <?=$username?>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="profile-tutor.php" class="dropdown-item text-start">Profile</a></li>
                                                <li><a href="chats_teacher.php" class="dropdown-item text-start">Messages</a></li>
                                                <li><a href="dashboard.php" class="dropdown-item text-start">Dashboard</a></li>
                                                <li><a href="logout.php" class="dropdown-item text-start">Logout</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                <?php
                            }
                            else 
                            {
                                ?>
                                <li><a href="register.php?type=tutee">Be a Tutee</a></li>
                                <li><a href="register.php?type=tutor">Be a Tutor</a></li>
                                <li><a class="c-btn c-btn-sm c-btn-sm-primary t-light" href="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                    <div class="main_nav-toggler d-flex d-lg-none">
                        <a href="#"><i class="fa-solid fa-bars"></i></a>
                    </div>

                </div>
            </nav>
        </header>
