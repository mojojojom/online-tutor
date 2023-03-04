<?php
    if(isset($_SESSION['admin_id']))
    {
        header('Location: admin/index.php');
    }
    include('session_expire.php');
?>

<!DOCTYPE html>
<html lang="en">

        <?php
            include('styles.php');
        ?>
    <body>

        <header class="main_header" id="main_header">
            <nav class="container navbar navbar-expand-lg" id="main_nav">
                <div class="container-fluid main_nav">
                    <a class="navbar-brand main_nav-logo fw-bold" href="/">LOGO</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa-solid fa-bars"></i>
                    </button>
        
                    <div class="collapse navbar-collapse main_nav-links" id="navbarNav">
                        <ul class="navbar-nav main_ul ms-auto">
        
                            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="courses.php">Courses</a></li>
                            <li class="nav-item"><a class="nav-link" href="tutors.php">Tutors</a></li>
                            <li class="main_nav-hr d-none d-sm-none d-md-none d-lg-block"></li>
        
                            <?php if(isset($_SESSION['uid'])) : ?>
                                <?php $get_user = mysqli_query($db, "SELECT * FROM tutees WHERE id='".$_SESSION['uid']."'"); ?>
                                <?php if(mysqli_num_rows($get_user) > 0) : ?>
                                <?php $user = mysqli_fetch_array($get_user); ?>
                                <?php $username = $user['username']; ?>
                                <?php $img = $user['dp']; ?>
        
                                <li class="nav-item dropdown d-none d-md-block">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php
                                        if(empty($img))
                                        {
                                        ?>
                                        <img class="header-img" style="height: 25px; width: 25px; border-radius: 50px; object-fit:cover;" src="/images/DEFAULT/user_icon.png" alt=""> <?=$username?> 
                                        <?php
                                        } 
                                        else
                                        {
                                        ?>
                                        <img class="header-img" style="height: 25px; width: 25px; border-radius: 50px; object-fit:cover;" src="/uploads/tutees/<?=$img?>" alt=""> <?=$username?> 
                                        <?php
                                        }
                                        ?>
                                        <!-- <img class="header-img" style="height: 25px; width: 25px; border-radius: 50px; object-fit:cover;" src="/uploads/tutees/<?=$img?>" alt=""> <?=$username?> -->
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-start" href="profile.php">Profile</a></li>
                                        <li><a class="dropdown-item text-start" href="chats.php">Messages</a></li>
                                        <li><a class="dropdown-item text-start" href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                                <!--<hr class="nav-item d-block d-md-none">-->
                                <li class="nav-item d-block d-md-none"><a class="nav-link" href="profile.php">Profile</a></li>
                                <li class="nav-item d-block d-md-none"><a class="nav-link" href="chats.php">Messages</a></li>
                                <li class="nav-item d-block d-md-none"><a class="nav-link" href="logout.php">Logout</a></li>
                                <?php endif; ?>
                                <?php elseif(isset($_SESSION['t_uid'])) : ?>
                                <?php $get_user = mysqli_query($db, "SELECT * FROM tutors WHERE u_id='".$_SESSION['t_uid']."'"); ?>
                                <?php if(mysqli_num_rows($get_user) > 0) : ?>
                                <?php $user = mysqli_fetch_array($get_user); ?>
                                <?php $username = $user['username']; ?>
                                <?php $img = $user['dp']; ?>
                                <li class="nav-item dropdown d-none d-md-block">
                                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php
                                        if(empty($img))
                                        {
                                        ?>
                                        <img class="header-img" style="height: 25px; width: 25px; border-radius: 50px; object-fit:cover;" src="/images/DEFAULT/user_icon.png" alt=""> <?=$username?>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <img class="header-img" style="height: 25px; width: 25px; border-radius: 50px; object-fit:cover;" src="/uploads/tutors/<?=$img?>" alt=""> <?=$username?>
                                        <?php
                                        }
                                        ?>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item text-start" href="profile-tutor.php">Profile</a></li>
                                        <li><a class="dropdown-item text-start" href="chats_teacher.php">Messages</a></li>
                                        <li><a class="dropdown-item text-start" href="logout.php">Logout</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item d-block d-md-none"><a class="nav-link" href="profile-tutor.php">Profile</a></li>
                                <li class="nav-item d-block d-md-none"><a class="nav-link" href="chats_teacher.php">Messages</a></li>
                                <li class="nav-item d-block d-md-none"><a class="nav-link" href="logout.php">Logout</a></li>
                                <?php endif; ?>
                                <?php else : ?>
                            <li class="nav-item"><a class="nav-link" href="register.php?type=tutee">Be a Tutee</a></li>
                            <li class="nav-item"><a class="nav-link" href="register.php?type=tutor">Be a Tutor</a></li>
                            <li class="nav-item"><a class="nav-link c-btn c-btn-sm c-btn-sm-primary t-light" href="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
        
            </nav>
        </header>
