<?php
    include('../connection/connect.php');
    error_reporting(0); 
    session_start();
    if(empty($_SESSION['admin_id'])) {
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>Dashboard - Tutor</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"/>

        <!-- Vendor CSS Files -->
        <script src="../node_modules/jquery/dist/jquery.min.js" rel="stylesheet"></script>
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet"/>
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../node_modules/datatables/media/css/jquery.dataTables.min.css">
        
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

    </head>

    <body>
        <!-- HEADER -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <div class="d-flex align-items-center justify-content-between">
                <a href="index.html" class="logo d-flex align-items-center">
                    <!-- <img src="" alt="LOGO" /> -->
                    <span class="d-none d-lg-block">Tutor</span>
                </a>
                <i class="bi bi-list toggle-sidebar-btn"></i>
            </div>

            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">

                <?php
                $query = mysqli_query($db, "SELECT * FROM admin WHERE id='".$_SESSION['admin_id']."'");
                while($row = mysqli_fetch_array($query))
                {
                ?>

                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"/>
                            <span class="d-none d-md-block dropdown-toggle ps-2"><?=$row['username']?></span> 
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6><?=$row['username']?></h6>
                                <span>Admin</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                    <i class="bi bi-gear"></i>
                                    <span>Account Settings</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php
                }
                ?>

                </ul>
            </nav>
        </header>