<!-- LOGIN MODAL -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body position-relative login_modal-body">
                <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
                
                <div class="login_choices-wrap">

                    <!-- WELCOME WRAP -->
                    <div class="login_welcome-wrap">
                        <h2 class="fw-bold text-center mb-0 pb-1">HELLO!</h2>
                        <p class="text-center">Please select your role.</p>
                        
                        <div class="login_tutor-card text-center mb-2">
                            <a href="#" class="choices" id="login_as_tutor">Login as Tutor</a>
                        </div>
                        <div class="login_tutee-card text-center mb-2">
                            <a href="#" class="choices" id="login_as_tutee">Login as Tutee</a>
                        </div>
                        <div class="login_admin-card text-center mb-2">
                            <a href="#" class="choices" id="login_as_admin">Login as Admin</a>
                        </div>
                    </div>

                    <!-- LOGIN AS TUTOR -->
                    <div class="login_as_tutor-wrap">
                        <h3 class="text-center fw-bold">Tutor Login</h3>
                        <form method="POST" id="login_tutor">

                            <div class="row">
                                <div class="mb-2">
                                    <label for="username" class="form-label mb-0">Email/Username</label>
                                    <input type="text" class="form-control" name="user" id="login_tutor_email" placeholder="Enter your email/username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label mb-0">Password</label>
                                    <input type="password" class="form-control" name="pass" id="login_tutor_password" placeholder="Enter your password" required>
                                </div>
                                <div class="mb-2">
                                    <input type="hidden" name="action" value="tutor_login">
                                    <input type="submit" name="login_tutor" id="login_tutor_btn" class="login_tutor_btn" value="Login">
                                </div>
                                <div class="mb-1 text-center">
                                    <p class="mb-0"><a href="#">Forgot Password?</a></p>
                                </div>
                                <div class="mb-2 text-center">
                                    <p class="mb-0">Don't have an account? <a href="register.php?type=tutor" class="target_tutor">Sign Up</a></p>
                                </div>

                                <div class="mb-0">
                                    <a href="#" class="go_back_btn"><i class="fa-solid fa-arrow-left-long"></i> Go back</a>
                                </div>

                            </div>

                        </form>
                    </div>

                    <!-- LOGIN AS TUTEE -->
                    <div class="login_as_tutee-wrap">
                        <h3 class="text-center fw-bold">Tutee Login</h3>
                        <form method="POST" id="login_tutee">

                            <div class="row">
                                <div class="mb-2">
                                    <label for="username" class="form-label mb-0">Email/Username</label>
                                    <input type="text" name="user" class="form-control" id="login_tutee_email" placeholder="Enter your email/username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label mb-0">Password</label>
                                    <input type="password" name="pass" class="form-control" id="login_tutee_password" placeholder="Enter your password" required>
                                </div>
                                <div class="mb-2">
                                    <input type="hidden" name="action" value="tutee_login">
                                    <input type="submit" name="login_tutee" id="login_tutee_btn" class="login_tutee_btn" value="Login">
                                </div>
                                <div class="mb-1 text-center">
                                    <p class="mb-0"><a href="#">Forgot Password?</a></p>
                                </div>
                                <div class="mb-2 text-center">
                                    <p class="mb-0">Don't have an account? <a href="register.php?type=tutee" class="target_tutee">Sign Up</a></p>
                                </div>
                                
                                <div class="mb-0">
                                    <a href="#" class="go_back_btn"><i class="fa-solid fa-arrow-left-long"></i> Go back</a>
                                </div>

                            </div>

                        </form>
                    </div>

                    <!-- LOGIN AS ADMIN -->
                    <div class="login_as_admin-wrap">
                        <h3 class="text-center fw-bold">Admin Login</h3>
                        <form method="POST" id="login_admin">

                            <div class="row">
                                <div class="mb-2">
                                    <label for="username" class="form-label mb-0">Email/Username</label>
                                    <input type="text" name="user" class="form-control" id="admin_email" placeholder="Enter your email/username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label mb-0">Password</label>
                                    <input type="password" name="pass" class="form-control" id="admin_password" placeholder="Enter your password" required>
                                </div>
                                <div class="mb-2">
                                    <input type="hidden" name="action" value="admin_login">
                                    <input type="submit" name="login_admin" id="login_admin_btn" class="login_admin_btn" value="Login">
                                </div>
                                <div class="mb-1 text-center">
                                    <p class="mb-0"><a href="#">Forgot Password?</a></p>
                                </div>
                                
                                <div class="mb-0">
                                    <a href="#" class="go_back_btn"><i class="fa-solid fa-arrow-left-long"></i> Go back</a>
                                </div>

                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>   


<script src="node_modules/slick-carousel/slick/slick.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="node_modules/jquery-timepicker/jquery.timepicker.js"></script>


<script>
    jQuery(function($) {
        // HEADER FUNCTION
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                $("header").addClass("scrolled shadow-sm");
                $(".scroll-to-top").show();
            } else {
                $("header").removeClass("scrolled shadow-sm");
                $(".scroll-to-top").hide();
            }
        });

        // MOBILE NAV
        $(document).ready(function () {
            
            $(document).on('click', function(e) {
                var navMobile = $('.main_nav-mobile');

                if (!navMobile.is(e.target) && navMobile.has(e.target).length === 0 && navMobile.css('left') === '0px') {
                    navMobile.animate({
                        left: '-100%'
                    }, 500);
                }
            });

            $('.main_nav-toggler a').on('click', function(e) {
                e.preventDefault();
                console.log('clicked');
                var navMobile = $('.main_nav-mobile');

                if (navMobile.css('left') === '-100%') {
                    navMobile.animate({
                        left: '-100%',
                        display: 'flex'
                    }, 500);
                } else {
                    navMobile.animate({
                        left: '0'
                        // display: 'flex'
                    }, 500);
                }
            });

            $('.main_nav-mobile a').on('click', function() {
                var navMobile = $('.main_nav-mobile');

                navMobile.animate({
                    left: '-100%'
                }, 500);
            });

        })

        // COURSES SLIDER
        $('.h_courses-slider').slick({
            nextArrow: $('.h_courses-slider-custom-right'),
            prevArrow: $('.h_courses-slider-custom-left'),
            infinite: true,
            speed: 500,
            cssEase: 'linear',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // TUTORS SLIDER
        $('.h_tutors-slider').slick({
            nextArrow: $('.h_tutors-slider-custom-right'),
            prevArrow: $('.h_tutors-slider-custom-left'),
            infinite: true,
            speed: 500,
            cssEase: 'linear',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // TESTIMONIALS SLIDER
        $('.h_testi-slider').slick({
            nextArrow: $('.h_testi-slider-custom-right'),
            prevArrow: $('.h_testi-slider-custom-left'),
            infinite: true,
            speed: 500,
            cssEase: 'linear',
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        // LOGIN - MODAL
        $(document).ready(function () {
            $('#login_as_tutor, #login_as_tutee, #login_as_admin').on('click', function(e) {
                e.preventDefault();
                $('.login_welcome-wrap').hide();
                $('.' + $(this).attr('id') + '-wrap').show();
            });

            $('.go_back_btn').on('click', function(e) {
                e.preventDefault();
                $('.login_welcome-wrap').show();
                $('.login_as_tutor-wrap, .login_as_tutee-wrap, .login_as_admin-wrap').hide();
            });
        });

        // LOGIN FUNCTIONS
        $(document).ready(function() {

            // TUTOR
            $('#login_tutor').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: formData,
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
                                title: 'Logged In Successfully!'
                            })

                            // REDIRECT TO PROFILE
                            setTimeout(() => {
                                window.location.href='dashboard.php'
                            }, 1500);

                        }
                        else if(response === 'err_verify')
                        {
                            Swal.fire({
                                icon: 'info',
                                title: 'Seems like you haven\'t verified your account yet.',
                                html: 'We\'ve sent the code via your email.<br> <b>Redirecting you to verification page.</b><br> Please Wait.',
                                showConfirmButton: false
                            })
                            setTimeout(() => {
                                window.location.href='otp.php'
                            }, 3000);
                        }
                        else if(response === 'err_pass')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Incorrect Password!',
                                'error'
                            );
                        }
                        else if(response === 'err_disabled')
                        {
                            Swal.fire(
                                'Unable to login!',
                                'Your account has been <span class="text-danger fw-bold">DISABLED</span>. <br>If you think this is a mistake, <b>CONTACT US</b>!',
                                'error'
                            );
                        }
                        else if(response === 'err_exists')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'User Doesn\'t Exists!',
                                'error'
                            );
                        }
                        else if(response === 'err_not_sent')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to send verification code. Please try again later.',
                                'error'
                            );
                        }
                        else if(response === 'not_sent')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to send verification code. Please try again later.',
                                'error'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to login',
                                'error'
                            );
                            alert(response);
                        }
                    }
                });

            })

            // TUTEE
            $('#login_tutee').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: formData,
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
                                title: 'Logged In Successfully!'
                            })

                            // REDIRECT TO PROFILE
                            setTimeout(() => {
                                window.location.href='profile.php'
                            }, 1500);
                        }
                        else if(response === 'err_verify')
                        {
                            Swal.fire({
                                icon: 'info',
                                title: 'Seems like you haven\'t verified your account yet.',
                                html: 'We\'ve sent the code via your email.<br> <b>Redirecting you to verification page.</b><br> Please Wait.',
                                showConfirmButton: false
                            })
                            setTimeout(() => {
                                window.location.href='otp.php'
                            }, 3000);
                        }
                        else if(response === 'err_disabled')
                        {
                            Swal.fire(
                                'Unable to login!',
                                'Your account has been <span class="text-danger fw-bold">DISABLED</span>. <br>If you think this is a mistake, <b>CONTACT US</b>!',
                                'error'
                            );
                        }
                        else if(response === 'err_pass')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Incorrect Password!',
                                'error'
                            );
                        }
                        else if(response === 'not_verified')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Please Verify Your Account!',
                                'error'
                            );
                        }
                        else if(response === 'err_exists')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'User Doesn\'t Exists!',
                                'error'
                            );
                        }
                        else if(response === 'err_not_sent')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to send verification code. Please try again later.',
                                'error'
                            );
                        }
                        else if(response === 'not_sent')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to send verification code. Please try again later.',
                                'error'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Unable to login',
                                'error'
                            );
                            alert(response);
                        }
                    }
                });

            })

            // ADMIN
            $('#login_admin').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "action.php",
                    data: formData,
                    success: function (response) {
                        if(response === 'success') 
                        {
                            // SHOW STATUS
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Logged In Successfully!'
                            })

                            setTimeout(' window.location.href = "admin/index.php"; ', 1000);

                        }
                        else if(response === 'err_verify')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Please Verify Your Account!',
                                'error'
                            );
                        }
                        else if(response === 'err_pass')
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'Incorrect Password!',
                                'error'
                            );
                        }
                        else
                        {
                            Swal.fire(
                                'Something Went Wrong!',
                                'User Doesn\'t Exists!',
                                'error'
                            );
                        }
                    }
                });

            })
        })


    })
</script>