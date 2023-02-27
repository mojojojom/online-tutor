<?php
    include('connection/connect.php');
    error_reporting(0);
    session_start();
    
    include('styles.php');
    if(empty($_SESSION['uid']))
    {
        header('Location: index.php');
    }
?>

    <section class="c_banner-wrap">
        <div class="row">
            <!-- CHATS -->

            <div class="col-12 col-md-4 col-lg-3 p-0">
                <div class="c_banner-nav-wrap container border border-end-1 border-bottom-1 d-flex align-items-center">
                    <div class="c_banner-title-wrap d-flex align-items-center justify-content-between w-100">
                        <a href="profile.php" class="fw-bold btn-link text-decoration-none d-flex align-items-center gap-1 mb-0" style="font-size:12px;"><i class="fa-solid fa-hand-point-left"></i> BACK TO DASHBOARD</a>
                        <h5 class="fw-bold mb-0 titles d-flex align-items-center gap-1"><i class="fa-solid fa-comments"></i> CHATS</h5>
                    </div>
                </div>
                <div class="c_banner-chats-wrap">
                    <div class="c_banner-chats">

                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>
                        <div class="t_chat-wrap border-bottom-1 border px-3">
                            <a href="#">
                                <div class="t_chat-img-wrap">
                                    <img src="../images/about-sec.jpg" alt="">
                                </div>
                                <div class="t_chat-user-wrap">
                                    <p class="t_chat-user-name">Sample Name</p>
                                    <p class="t_chat-user-msg">This is just a sample message. Lorem ipsum dolor.</p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-9 p-0">

                <div class="c_banner-nav-wrap container border border-end-1 border-bottom-1 d-flex align-items-center">
                    <div class="c_banner-title-wrap d-flex align-items-center gap-2">
                        <img src="/uploads/tutors/63fa0c4826c42.jpg" style="height:35px; width: 35px; border-radius:50%; object-fit: cover;" alt="Display Image">
                        <div class="c_banner-chat-name-wrap">
                            <p class="mb-0 fw-semibold">Sample Name</p>
                            <small>Active Now</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php
    include('scripts.php');
?>